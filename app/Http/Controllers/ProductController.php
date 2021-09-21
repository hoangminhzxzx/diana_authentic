<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

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
            $fileNameToStore = $filename.'-'.self::quickRandom().'.'.$extension;
            // Upload Image
            $path = $request->file('thumbnail')->storeAs('public/uploads', $fileNameToStore);
            //move
            $request->file('thumbnail')->move(public_path('uploads'),$fileNameToStore);
        }

//        $arr_image = [];
//        $arr_image[] = $path;

        $product = new Product();
        $product->title = $data['title']?$data['title']:"";
        $product->desc = $data['desc']?$data['desc']:"";
        $product->content = $data['content']?$data['content']:"";
        $product->thumbnail = $path;
//        $product->images = json_encode($arr_image);
        $product->is_publish = $data['is_publish']?$data['is_publish']:0;
        $product->category_id = $data['category_id']?$data['category_id']:0;
        $product->price = $data['price']?$data['price']:0;
        $product->save();
//        return back();
        return redirect()->route('admin.product.edit', ['id' => $product->id]);
    }

    public function edit ($id) {
        $product = Product::query()->find($id);
        if ($product) {
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
    }

    public function update (Request $request, $id) {
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
            $fileNameToStore = $filename.'-'.self::quickRandom().'.'.$extension;
            // Upload Image
            $path = $request->file('thumbnail')->storeAs('public/uploads', $fileNameToStore);
            //move
            $request->file('thumbnail')->move(public_path('uploads'),$fileNameToStore);

            //xóa thumbnail cũ
            $thumbnail_old = $product->thumbnail; //cbi xóa thumbnail cũ
            if ($thumbnail_old) {
                $thumbnail_old = str_replace('public', '', $thumbnail_old);
                if(file_exists(public_path($thumbnail_old))){
                    unlink(public_path($thumbnail_old));
                }
            }
        }

        if (isset($path) && $path) {
            $product->thumbnail = $path;
        }

        //xử lý nếu is_hot == 2 thì sẽ chỉ có sản phẩm này bằng 2 thôi, sản phẩm khác đã là 2 thì chuyển về 1
        $product_hot_current = Product::query()->where('is_hot', '=', 2)->first();
        if ($product_hot_current) {
            $product_hot_current->is_hot = 1;
            $product_hot_current->save();
        }

        $product->price = $data['price']?$data['price']:0;
        $product->is_publish = $data['is_publish']?$data['is_publish']:0;
        $product->category_id = $data['category_id'];
        $product->is_hot = $data['is_hot'];
        $product->save();

        return back()->with('success_product', 'Cập nhật thành công');
    }

    public function delete ($id) {
        $product = Product::query()->find($id);
        if ($product) {
            //xóa các file ảnh
            if ($product->images) {
                $path_images = json_decode($product->images);
                if ($path_images) {
                    foreach ($path_images as $path_image) {
                        $path_image = str_replace('public', '', $path_image);
                        if (file_exists(public_path($path_image))) {
                            unlink(public_path($path_image));
                        }
                    }
                }
            }

            $product->delete();
            return back();
        }
        return back();
    }

    public function uploadImageDZ(Request $request) {
        $res = ['success' => false];
        $data_request = $request->input();

        $product = Product::query()->find($data_request['id']);
        if($request->file('file')){
            //Storage::delete('/public/avatars/'.$user->avatar);
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'-sticky-'.self::quickRandom().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/uploads', $fileNameToStore);
            //move
            $request->file('file')->move(public_path('uploads'),$fileNameToStore);

            $arr_image = [];
            if ($product && $product->images) {
                $arr_image = json_decode($product->images, true);
            }
            $arr_image[] = $path;
            $product->images = json_encode($arr_image);
            $product->save();

            $res['success'] = true;
            $res['path_image'] = $path;
            return response()->json($res);
        }
    }

    public function removeImageSingle(Request $request) {
        $res= ['success' => false];
        $data = $request->input();
        $product = Product::query()->find($data['product_id']);
        if ($product) {
            if ($product->images) {
                $arr_image = json_decode($product->images, true);
                $key_image_in_arr = array_search($data['path'], $arr_image);
                $real_path_image = $arr_image[$key_image_in_arr];

                //bỏ đi phần tử image muốn xóa và save lại
                unset($arr_image[$key_image_in_arr]);
                $product->images = json_encode($arr_image);
                $product->save();

                //xóa ảnh trong bộ nhớ
                $path_remove = str_replace('public', '', $real_path_image);
                if(file_exists(public_path($path_remove))){
                    unlink(public_path($path_remove));
                }

                $res['success'] = true;
                return response()->json($res);
            }
        }
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function uploadImageTinymce(Request $request) {
        dd($request->input());
    }
}
