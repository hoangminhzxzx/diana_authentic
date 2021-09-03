<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Front\OrderDetail;
use App\Model\Front\OrderMaster;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
//    public function insertOrder(Request $request) {
//        $request->validate(
//            [
//                'name' => 'required',
//                'phone' => 'required',
//                'address' => 'required',
//                'email' => 'required',
//            ],
//            [],
//            [
//                'name' => 'Họ tên',
//                'phone' => 'Số điện thoại',
//                'address' => 'Địa chỉ',
//                'email' => 'Email'
//            ]
//        );
//        $data = $request->input();
//
//        $cart_total = Cart::total();
//        dd(is_integer($cart_total));
//        //save data into order_master table
//        $modelOrderMaster = new OrderMaster();
//        $modelOrderMaster->customer_name = $data['name'];
//        $modelOrderMaster->customer_phone = $data['phone'];
//        $modelOrderMaster->email = $data['email'];
//        $modelOrderMaster->address = $data['address'];
//        $modelOrderMaster->note = $data['note'];
//        if ($cart_total) {
//            $modelOrderMaster->total_price = $cart_total;
//        }
//        $modelOrderMaster->save();
//
//        //save data info order_detail table
//        $modelOrderDetail = new OrderDetail();
//        $cart_info = Cart::content();
//        if ($cart_info) {
//            foreach ($cart_info as $item) {
////                $modelOrderDetail
//            }
//        }
//    }

    public function insertOrder(Request $request) {
        $response = ['success' => false];
        $data = $request->input();

        //validate
        $mess_error = $this->validateOrder($data);
        if (count($mess_error) > 0) {
            //chưa required, trả mess về client
            $response['mess_error'] = $mess_error;
            return response()->json($response);
        } else {
            //đã chọn đủ trường, send order thôi nào !
        }
    }

    protected function validateOrder($data) {
        $mess = [];

        //check xem chọn tỉnh/thành phố, quận/huyện, phường/xã
        if (!array_key_exists('province', $data)) {
            $mess['province'] = 'Tỉnh/Thành phố không được để trống';
        }
        if (!array_key_exists('district', $data)) {
            $mess['district'] = 'Quận/Huyện không được để trống';
        }
        if (!array_key_exists('ward', $data)) {
            $mess['ward'] = 'Phường/Xã không được để trống';
        }

        foreach ($data as $key => $item) {
            if (in_array($key, ['name', 'email', 'phone', 'province', 'district', 'wards'])) {
                if ($item == null) {
                    $mess[$key] = 'Không được để trống';
                }
            }
        }
        return $mess;
    }
}
