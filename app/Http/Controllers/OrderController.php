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

    public function checkOrder(Request $request) {
        $res = ['success' => false];
        $order_id = intval($request->input('order_id'));
        $status = config('constant.ORDER_STATUS.CHECK_ORDER');
        if ($this->changeStatusOrder($order_id, $status)) {
            $res['success'] = true;
        }
        if (!$res['success']) $res['message'] = 'Kiểm tra lại trạng thái hiện tại';
        return response()->json($res);
    }
    public function confirmShipOrder(Request $request) {
        $res = ['success' => false];
        $order_id = intval($request->input('order_id'));
        $status = config('constant.ORDER_STATUS.ORDER_SHIPPING');
        if ($this->changeStatusOrder($order_id, $status)) {
            $res['success'] = true;
        }
        if (!$res['success']) $res['message'] = 'Kiểm tra lại trạng thái hiện tại';
        return response()->json($res);
    }
    public function confirmCompleteOrder(Request $request) {
        $res = ['success' => false];
        $order_id = intval($request->input('order_id'));
        $status = config('constant.ORDER_STATUS.ORDER_COMPLETE');
        if ($this->changeStatusOrder($order_id, $status)) {
            $res['success'] = true;
        }
        if (!$res['success']) $res['message'] = 'Kiểm tra lại trạng thái hiện tại';
        return response()->json($res);
    }

    protected function changeStatusOrder($order_id, $status) {
        $order_master = OrderMaster::query()->find($order_id);
        if ($order_master) {
            $status_current = $order_master->status;
            if ($status == $status_current + 1) {
                $order_master->status = $status;
                $order_master->save();
                return true;
            }

            if ($status_current != 5) {

            }
        }
        return false;
    }

    public function confirmCancleOrder(Request $request) {
        $res = ['success' => false];
        $order_id = intval($request->input('order_id'));
        $order_master = OrderMaster::query()->find($order_id);
        if ($order_master) {
            $status_current = $order_master->status;
            if ($status_current == config('constant.ORDER_STATUS.ORDER_SHIPPING')) {
                $res['message'] = 'Không thể hủy đơn hàng vì hàng đang được giao !';
            } else {
                $order_master->status = config('constant.ORDER_STATUS.ORDER_CANCLE');
                $order_master->save();
                $res['success'] = true;
            }
        }
        return response()->json($res);
    }
}
