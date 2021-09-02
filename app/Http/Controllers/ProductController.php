<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index () {
        $list_product = Product::all();
        return view('admin.product.index',
            [
                'list_product' => $list_product
            ]
        );
    }

    public function add () {
        $categories = Category::query()->where('parent_id', "!=", 0)->get();
        return view('admin.product.add',compact('categories'));
    }

    public function store (Request $request) {
        $request -> validate(
            [
                'title' => "required",
                'price' => 'required'
            ],
            [
                'title' => "Title",
                'price' => 'Price'
            ]
        );
        $data = $request->input();
        if($request->file('thumbnail')){
            //Storage::delete('/public/avatars/'.$user->avatar);
            // Get filename with the extension
            $filenameWithExt = $request->file('thumbnail')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'.'.$extension;
            // Upload Image
            $path = $request->file('thumbnail')->storeAs('public/uploads', $fileNameToStore);
            //move
            $request->file('thumbnail')->move(public_path('uploads'),$filenameWithExt);
        }

        $product = new Product();
        $product->title = $data['title']?$data['title']:"";
        $product->desc = $data['desc']?$data['desc']:"";
        $product->content = $data['content']?$data['content']:"";
        $product->thumbnail = $path;
        $product->images = $data['images']?$data['images']:"";
        $product->is_publish = $data['is_publish']?$data['is_publish']:0;
        $product->category_id = $data['category_id']?$data['category_id']:0;
        $product->price = $data['price']?$data['price']:0;
        $product->save();
        return back();
    }

    public function edit ($id) {
        $product = Product::query()->find($id);
        $categories = Category::query()->where('parent_id', "!=", 0)->get(['id','title']);
        $category_accessory = Category::query()->where('title', 'LIKE', "%Phu kien%")->first();
        return view('admin.product.edit',
            [
                'product' => $product,
                'categories' => $categories,
                'category_accessory' => $category_accessory
            ]
        );
    }

    public function update (Request $request, $id) {
//        dd($request->file('thumbnail'));
        $request -> validate(
            [
                'title' => "required",
                'price' => 'required'
            ],
            [
                'title' => "Title",
                'price' => 'Price'
            ]
        );
        $data = $request->input();
        $product = Product::query()->find($id);

        $thumbnail_old = $product->thumbnail; //cbi xóa thumbnail cũ

        $product->title = $data['title']?$data['title']:"";
        $product->desc = $data['desc']?$data['desc']:"";
        $product->content = $data['content']?$data['content']:"";

        if($request->file('thumbnail')){
            //Storage::delete('/public/avatars/'.$user->avatar);
            // Get filename with the extension
            $filenameWithExt = $request->file('thumbnail')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'.'.$extension;
            // Upload Image
            $path = $request->file('thumbnail')->storeAs('public/uploads', $fileNameToStore);
            //move
            $request->file('thumbnail')->move(public_path('uploads'),$filenameWithExt);
        }

        if (isset($path) && $path) $product->thumbnail = $path;
        $product->price = $data['price']?$data['price']:0;
        $product->is_publish = $data['is_publish']?$data['is_publish']:0;
        $product->category_id = $data['category_id'];
        $product->save();

        if ($thumbnail_old) {
            $thumbnail_old = str_replace('public', '', $thumbnail_old);
            if(file_exists(public_path($thumbnail_old))){
                unlink(public_path($thumbnail_old));
            }
        }

        return back()->with('success_product', 'Cập nhật thành công');
    }

    public function delete ($id) {
        $product = Product::query()->find($id);
        if ($product) {
            $product->delete();
            return back();
        }
        return back();
    }
}
