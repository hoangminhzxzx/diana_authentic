<?php

namespace App\Http\Controllers;

use App\Model\Front\OrderMaster;
use App\Model\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $user = Auth::user();
            $statistic = Statistic::query()->first();

            //số order hoàn thành
            $count_order_complete = OrderMaster::query()->where('status', '=', config('constant.ORDER_STATUS.ORDER_COMPLETE'))->count();
            $data_response = [];
            $data_response['user'] = $user;
            $data_response['statistic'] = $statistic;
            $data_response['count_order_complete'] = $count_order_complete;

            return view('admin.dashboard.index', $data_response);
        }

    }
}
