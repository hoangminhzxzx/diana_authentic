<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Front\OrderDetail;
use App\Model\Front\OrderMaster;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function insertOrder(Request $request) {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required',
            ],
            [],
            [
                'name' => 'Họ tên',
                'phone' => 'Số điện thoại',
                'address' => 'Địa chỉ',
                'email' => 'Email'
            ]
        );
        $data = $request->input();

        $cart_total = Cart::total();
        dd(is_integer($cart_total));
        //save data into order_master table
        $modelOrderMaster = new OrderMaster();
        $modelOrderMaster->customer_name = $data['name'];
        $modelOrderMaster->customer_phone = $data['phone'];
        $modelOrderMaster->email = $data['email'];
        $modelOrderMaster->address = $data['address'];
        $modelOrderMaster->note = $data['note'];
        if ($cart_total) {
            $modelOrderMaster->total_price = $cart_total;
        }
        $modelOrderMaster->save();

        //save data info order_detail table
        $modelOrderDetail = new OrderDetail();
        $cart_info = Cart::content();
        if ($cart_info) {
            foreach ($cart_info as $item) {
//                $modelOrderDetail
            }
        }
    }
}
