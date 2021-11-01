<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Front\AccountClient;
use App\Model\Front\OrderDetail;
use App\Model\Front\OrderMaster;
use App\Model\Product;
use App\Model\ProductVariant;
use App\Model\Statistic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(Request $request) {
        $filter_keyword = $request->query('filter_keyword');
        $filter_status = $request->query('filter_status');

        $orders = OrderMaster::query()
            ->where(function (Builder $query) use ($filter_keyword) {
                return $query
                    ->where('id', '=', $filter_keyword)
                    ->orWhere('customer_name', 'like', '%'.$filter_keyword.'%')
                    ->orWhere('email', 'like', '%'.$filter_keyword.'%')
                    ->orWhere('customer_phone', 'like', '%'.$filter_keyword.'%')
                    ->orWhere('order_code', 'like', '%'.$filter_keyword.'%');
            })
            ->when($filter_status, function (Builder $query, $filter_status) {
                return $query->where('status', '=', $filter_status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $data_response = [];
        $data_response['filter_keyword'] = $filter_keyword;
        $data_response['filter_status'] = $filter_status;
        $data_response['orders'] = [];
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
                if ($product) {
                    $order_detail->product_title = $product->title;
                    $order_detail->product_thumbnail = $product->thumbnail;
                }
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

                if ($status == config('constant.ORDER_STATUS.ORDER_COMPLETE')) {
                    //Cộng vào doanh thu
                    $statistic = Statistic::query()->first(); //dùng 1 bản ghi thôi
                    if (!$statistic) {
                        $statistic = new Statistic();
                    }
                    $total_price_order = OrderDetail::query()->where('order_id', '=', $order_id)->sum('price');
                    $statistic->total_sales = $statistic->total_sales + $total_price_order;
                    $statistic->save();

                    if ($order_master->from_member) {
                        //Cộng số tiền member đã bỏ ra từ đó đến giờ để order hàng trên Diana Authentic
                        $member = AccountClient::query()->where('id', '=', $order_master->from_member)->first();
                        if ($member) {
                            $member->total_pay = $member->total_pay + $total_price_order;
                            $member->save();
                        }
                    }
                }
                return true;
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
            if ($status_current == config('constant.ORDER_STATUS.ORDER_COMPLETE')) {
//                $res['message'] = 'Không thể hủy đơn hàng vì hàng đang được giao !';
                $res['message'] = 'Không thể hủy đơn hàng vì đã hoàn thành đơn !';
            } else {
                $order_master->status = config('constant.ORDER_STATUS.ORDER_CANCLE');
                $order_master->save();

                //Cộng lại qty cho product variant vì order đã hủy vì lý do nào đó
                $order_details = OrderDetail::query()->where('order_id', '=', $order_id)->get();
                if ($order_details->count() > 0) {
                    foreach ($order_details as $order_detail) {
                        $product_variant = ProductVariant::query()->where('id', '=', $order_detail->product_variant_id)->first();
                        if ($product_variant) {
                            $product_variant->qty = $product_variant->qty + $order_detail->qty;
                            $product_variant->save();
                        }
                    }
                }

                $res['success'] = true;
            }
        }
        return response()->json($res);
    }
}
