<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductOption;
use App\Model\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function store(Request $request) {
//        dd($request->input());
        $res = ['success' => false];
        $request->validate(
            [
                'color_hex' => 'required',
                'color_name' => 'required',
                'size' => 'required',
                'qty' => 'required'
            ],
            [],
            [
                'color_hex' => 'Color Hex',
                'color_name' => 'Coler Name',
                'size' => 'Size',
                'qty' => 'Số lượng'
            ]
        );
        $data = $request->input();

        $color = ProductOption::query()->where('product_id', '=', $data['product_id'])->where('type', '=', config('constant.PRODUCT_OPTION_TYPE.COLOR'))
            ->where('name', '=', trim($data['color_name']))->where('value', '=', trim($data['color_hex']))->first();
        if (!$color) {
            $color = new ProductOption();
            $color->product_id = $data['product_id'];
            $color->type = config('constant.PRODUCT_OPTION_TYPE.COLOR');
            $color->name = $data['color_name'];
            $color->value = $data['color_hex'];
            $color->save();
        }

        $size = ProductOption::query()->where('product_id', '=', $data['product_id'])->where('type', '=', config('constant.PRODUCT_OPTION_TYPE.SIZE'))
            ->where('name', '=', trim($data['size']))->where('value', '=', trim($data['size']))->first();
        if (!$size) {
            $size = new ProductOption();
            $size->product_id = $data['product_id'];
            $size->type = config('constant.PRODUCT_OPTION_TYPE.SIZE');
            $size->name = $data['size'];
            $size->value = $data['size'];
            $size->save();
        }

        $product_variant = ProductVariant::query()->where('product_id', '=', $data['product_id'])->where('color_id', '=', $color->id)
            ->where('size_id', '=', $size->id)->first();
        if (!$product_variant) {
            $product_variant = new ProductVariant();
        }
        $product_variant->product_id = $data['product_id'];
        $product_variant->color_id = $color->id;
        $product_variant->size_id = $size->id;
//        $product_variant->price = $data['price'];
        $product_variant->qty = $data['qty'];
        $product_variant->save();

        $res['success'] = true;
        $res['html'] = view('admin.product.row_variant_ajax', [
            'item' => $product_variant
        ])->toHtml();

        return response()->json($res);
    }

    public function storeAss(Request $request) {
        $request->validate(
            [
                'price' => 'required|integer'
            ],
            [],
            [
                'price' => 'Price'
            ]
        );
        $data = $request->input();
        $product_variant_ass = new ProductVariant();
        $product_variant_ass->product_id = $data['product_id'];
        $product_variant_ass->price = $data['price'];
        $product_variant_ass->save();
        return back()->with('success_variant', 'Thêm thành công');
    }

    public function edit($idVariant) {
        $variant = ProductVariant::query()->find($idVariant);
        $product = $variant->product;
        return view('admin.variant.edit',
            [
                'variant' => $variant,
                'product' => $product

            ]
        );
    }

    public function update(Request $request, $id) {
        $request->validate(
            [
                'color_hex' => 'required',
                'color_name' => 'required',
                'size' => 'required',
//                'price' => 'required|integer'
            ],
            [],
            [
                'color_hex' => 'Color Hex',
                'color_name' => 'Coler Name',
                'size' => 'Size',
//                'price' => 'Price'
            ]
        );

        $data = $request->input();

        $color = ProductOption::query()->where('product_id', '=', $data['product_id'])->where('type', '=', config('constant.PRODUCT_OPTION_TYPE.COLOR'))
            ->where('name', '=', trim($data['color_name']))->where('value', '=', trim($data['color_hex']))->first();
        if (!$color) {
            $color = new ProductOption();
            $color->product_id = $data['product_id'];
            $color->type = config('constant.PRODUCT_OPTION_TYPE.COLOR');
            $color->name = $data['color_name'];
            $color->value = $data['color_hex'];
            $color->save();
        }

        $size = ProductOption::query()->where('product_id', '=', $data['product_id'])->where('type', '=', config('constant.PRODUCT_OPTION_TYPE.SIZE'))
            ->where('name', '=', trim($data['size']))->where('value', '=', trim($data['size']))->first();
        if (!$size) {
            $size = new ProductOption();
            $size->product_id = $data['product_id'];
            $size->type = config('constant.PRODUCT_OPTION_TYPE.SIZE');
            $size->name = $data['size'];
            $size->value = $data['size'];
            $size->save();
        }

        $product_variant = ProductVariant::query()->find($id);
        $product_variant->product_id = $data['product_id'];
        $product_variant->color_id = $color->id;
        $product_variant->size_id = $size->id;
//        $product_variant->price = $data['price'];
        $product_variant->qty = $data['qty'];
        if ($data['qty'] > 0) {
            $product_variant->is_out_stock = 0;
        }
        $product_variant->save();
        return redirect("admin/product/edit/$product_variant->product_id")->with('status_update_variant', 'Cập nhật thành công');
    }

    public function delete ($id) {
        $variant = ProductVariant::query()->find($id);
        if ($variant){
            $variant->delete();
        }
        return back()->with('status_delete_variant', 'Xóa thành công');
    }
}
