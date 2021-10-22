<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
//        Session::forget('client_login');
//        Session::forget('is_login');
        $list_products = Product::query()->where('is_publish' ,'=', 1)->get();
        $list_products_hot = Product::query()->where('is_publish' ,'=', 1)->where('is_hot', '=', config('constant.PRODUCT_IS_HOT.HOT_PRODUCT'))->take(4)->get();
//        dd($list_products_hot);
        $product_banners = Product::query()
            ->where('is_publish' ,'=', 1)
            ->where('is_hot', '=', config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER'))
            ->select(['id', 'title', 'slug', 'thumbnail', 'desc', 'content'])
            ->orderBy('position', 'asc')
            ->get();
        $data_response = [];
        if ($list_products->count() > 0) $data_response['list_products'] = $list_products;
        if ($list_products_hot->count() > 0) $data_response['list_products_hot'] = $list_products_hot;
        if ($product_banners->count() > 0) $data_response['product_banners'] = $product_banners;
        return view('front.home', $data_response);
    }

}
