<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $list_products = Product::all();
//        dd($list_products->toArray());
        return view('front.home',
            [
                'list_products' => $list_products
            ]
        );
    }
}
