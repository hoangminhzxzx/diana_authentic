<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listProductFollowCategory($slug) {
        $category = Category::query()->where('slug', '=', $slug)->first();
        if ($category) {
            $category_title = $category->title;
            $list_category = [];
            $category_childs = $category->childs;
            $list_category[] = $category->id;
            if ($category_childs->count() > 0) {
                foreach ($category_childs as $category_child) {
                    $list_category[] = $category_child->id;
                }
            }

            $list_product = Product::query()->whereIn('category_id', $list_category)->get();
            if ($list_product->count() > 0) {
                return view('front.category.list_product',
                    [
                        'list_product' => $list_product,
                        'category_title' => $category_title
                    ]
                );
            }
        }
    }
}
