<?php

namespace App\Http\Controllers;

use App\Model\Front\OrderDetail;
use App\Model\Front\OrderMaster;
use App\Model\Product;
use App\Model\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $user = Auth::user();
            $statistic = Statistic::query()->first();

            //số order hoàn thành
            $count_order_complete = OrderMaster::query()->where('status', '=', config('constant.ORDER_STATUS.ORDER_COMPLETE'))->count();
            $count_order_cancle = OrderMaster::query()->where('status', '=', config('constant.ORDER_STATUS.ORDER_CANCLE'))->count();
            $data_response = [];
            $data_response['user'] = $user;
            $data_response['statistic'] = $statistic;
            $data_response['count_order_complete'] = $count_order_complete;
            $data_response['count_order_cancle'] = $count_order_cancle;

            //sản phẩm đc xem nhiều nhất
            $product_top_view = Product::query()->orderBy('total_view', 'desc')->first();
            if ($product_top_view) $data_response['product_top_view'] = $product_top_view;

            //sản phẩm đc order nhiều nhất
            $product_top_order = DB::select('SELECT product_id, COUNT(product_id) AS count
                                FROM order_detail
                                GROUP BY product_id
                                ORDER BY count DESC
                                LIMIT 1;');
            if ($product_top_order) $data_response['product_top_order'] = $product_top_order[0];

            //sản phẩm có doanh thu cao nhất
            $product_top_sales = DB::select('SELECT order_detail.product_id,SUM(order_detail.price) AS total_sales
                                                    FROM order_detail
                                                    inner JOIN order_master ON order_master.id = order_detail.order_id
                                                    WHERE order_master.status = 4
                                                    GROUP BY product_id
                                                    ORDER BY total_sales DESC
                                                    LIMIT 1');
            if ($product_top_sales) {
                $product_top_sales_info = Product::query()->find($product_top_sales[0]->product_id);
                $data_response['product_top_sales'] = $product_top_sales[0];
                $data_response['product_top_sales_info'] = $product_top_sales_info;
            };


            return view('admin.dashboard.index', $data_response);
        }

    }
}
