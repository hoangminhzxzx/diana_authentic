<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Front\OrderDetail;
use App\Model\Front\OrderMaster;
use App\Model\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list() {
        $orders = OrderMaster::all();
        $data_response = [];
        if ($orders->count() > 0) {
            $data_response['orders'] = $orders;
        }
        return view('admin.order.list', $data_response);
    }

    public function detail($id) {
        $order_master = OrderMaster::query()->find($id);
        $order_details = OrderDetail::query()->where('order_id', '=', $id)->get();
        if ($order_details->count() > 0) {
            $data_response = [];
            $data_response['order_master'] = $order_master;
            foreach ($order_details as $order_detail) {
                $product_id = $order_detail->product_id;
                $product = Product::query()->find($product_id);
                $order_detail->product_title = $product->title;
                $order_detail->product_thumbnail = $product->thumbnail;
            }
            $data_response['order_details'] = $order_details;
            return view('admin.order.detail', $data_response);
        }
    }
}
