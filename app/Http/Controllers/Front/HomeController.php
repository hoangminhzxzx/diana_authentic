<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $list_products = Product::query()->where('is_publish' ,'=', 1)->get();
        $product_banner = Product::query()
            ->where('is_hot', '=', config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER'))
            ->select(['id', 'title', 'slug', 'thumbnail'])
            ->first();
        $data_response = [];
        if ($list_products->count() > 0) $data_response['list_products'] = $list_products;
        if ($product_banner) $data_response['product_banner'] = $product_banner;
        return view('front.home', $data_response);
    }

}
