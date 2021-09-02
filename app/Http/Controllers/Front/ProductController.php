<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductOption;
use App\Model\ProductVariant;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
//use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    public function detailProduct($id) {
        $product = Product::query()->find($id);
        $productVariants = ProductVariant::query()->where('product_id', '=', $id)->get();
        $list_variants = [];
        foreach ($productVariants as $productVariant) {
            $list_variants['colors'][] = $productVariant->color;
            $list_variants['sizes'][] = $productVariant->size;
        }
        if ($product) {
            return view('front.product.detail',
                [
                    'product' => $product,
                    'list_variants' => $list_variants
                ]
            );
        }
    }
//    public function detailStep1 ($id) {
//        $product = Product::query()->find($id);
//        $productVariants = ProductVariant::query()->where('product_id', '=', $id)->get();
//        $list_variants = [];
//        foreach ($productVariants as $productVariant) {
//            $list_variants['colors'][] = $productVariant->color;
//            $list_variants['sizes'][] = $productVariant->size;
//        }
//
//        return view('front.product_detail_step_1',
//            [
//                'product' => $product,
//                'list_variants' => $list_variants
//            ]
//        );
//    }

    public function chooseColor(Request $request, $id) {
        $data = $request->input();
        $size_name_choose = ProductOption::query()->find($data['size_id']);
        $product = Product::query()->find($id);
        $option_colors = ProductVariant::query()->where('size_id', '=', $data['size_id'])->get();
        return response()->json(
            [
                'success' => true,
                'product' => $product,
                'colors' => $option_colors,
                'redirect' => route('client.product.detail.step2', ['id' => $product->id, 'size_id' => $size_name_choose->id])
            ]
        );
    }

//    public function detailStep2($id, $size_id) {
//        $product = Product::query()->find($id);
//        $variants = ProductVariant::query()->where('size_id', '=', $size_id)->get();
//        $option_colors = [];
//        foreach ($variants as $variant) {
//            $option_colors[] = $variant->color;
//        }
//        $size_name_choose = ProductOption::query()->find($size_id);
//        return view('front.product_detail_step_2',
//            [
//                'product'=>$product,
//                'option_colors'=>$option_colors,
//                'size_name_choose' => $size_name_choose
//            ]
//        );
//    }

    public function addToCart(Request $request) {
//        dd(Cart::content());
        $request->validate(
            [
                'color' => 'required'
            ], [],
            [
                'color' => 'Màu sản phẩm'
            ]
        );
        $data = $request->input();
        $variantProduct = ProductVariant::query()->where('size_id', '=', $data['size'])->where('color_id', '=', $data["color"])->first();
        $color = ProductOption::query()->find($data['color']);
        $size = ProductOption::query()->find($data['size']);
        $product = $variantProduct->product;
        $options = [
            'size' => $size->name,
            'color' => $color->name,
            'thumbnail' => $product->thumbnail
        ];
        $addToCart = Cart::add($product->id, $product->title, $data['qty'], $product->price, 0, $options);
        if ($addToCart) {
            return redirect()->route('client.cart');
        }
//        Cart::destroy();
//        dd(Cart::content());
//        dd($product);
//        return $this->renderCartInfo();
    }

    public function renderCartInfo() {
        return view('front.cart_info');
    }

    public function removeProduct($rowId) {
        if ($rowId) {
            Cart::remove($rowId);
        }
        if (Cart::count() > 0) {
            return back();
        } else {
            return redirect()->route('homeFront');
        }
    }

    public function updateQty(Request $request,$rowId) {
        $data = $request->input();
        if ($data['qty']) {
            Cart::update($rowId, $data['qty']);
            $qtyNewItem = Cart::get($rowId)->qty;
            $priceItem = Cart::get($rowId)->price;
            $totalCart = Cart::total();
            return response()->json(['success' => true, 'qtyNewItem' => $qtyNewItem, 'totalCart' => $totalCart, 'priceItem' => $priceItem]);
        }
    }

    public function checkOutGet() {
        return view('front.checkout');
    }
}
