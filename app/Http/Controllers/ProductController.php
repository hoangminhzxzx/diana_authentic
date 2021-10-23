<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use App\Model\ProductOption;
use App\Model\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function index (Request $request) {
        $title = $request->query('filter_keyword');
        $filer_status = $request->query('filter_status');
        $list_product = Product::query()
            ->when($title, function (Builder $query, $title) {
                return $query->where('title', 'like', '%' . $title . '%');
            })
            ->when($filer_status, function (Builder $query, $filer_status) {
                return $query->where('is_publish', '=', ($filer_status == 'off') ? 0 : 1);
            })
            ->paginate(20);

        return view('admin.product.index',
            [
                'list_product' => $list_product,
                'filter_keyword' => $title,
                'filter_status' => $filer_status
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
                'price' => 'required',
                'category_id' => 'required'
            ],
            [
                'title' => "Title",
                'price' => 'Price',
                'category_id' => 'Danh mục cha'
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
            $path = $this->changePathUpload($path);
            //move
//            $request->file('thumbnail')->move(public_path('uploads'),$fileNameToStore);
        }

//        $arr_image = [];
//        $arr_image[] = $path;

        $product = new Product();
        $product->title = $data['title']?$data['title']:"";
        $product->desc = $data['desc']?$data['desc']:"";
        $product->content = $data['content']?$data['content']:"";
        $product->thumbnail = (isset($path) && $path) ? $path : '';
//        $product->images = json_encode($arr_image);
        $product->is_publish = $data['is_publish']?$data['is_publish']:0;
        $product->category_id = $data['category_id']?$data['category_id']:0;
        $product->price = $data['price']?$data['price']:0;
        $product->slug = Str::slug($data['title'], '-');
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
            $path = $this->changePathUpload($path);
            //move
//            $request->file('thumbnail')->move(public_path('uploads'),$fileNameToStore);

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
//        if ($data['is_hot'] == config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER')) {
//            $product_hot_current = Product::query()->where('is_hot', '=', 2)->first();
//            if ($product_hot_current) {
//                $product_hot_current->is_hot = 1;
//                $product_hot_current->save();
//            }
//        }

        $product->price = $data['price']?$data['price']:0;
        $product->is_publish = $data['is_publish']?$data['is_publish']:0;
        $product->category_id = $data['category_id'];
//        $product->is_hot = $data['is_hot'];
        $product->slug = Str::slug($data['title'], '-');
        $product->save();

        return back()->with('success_product', 'Cập nhật thành công');
    }

    public function delete (Request $request) {
        $res = ['success' => false];
        $id = intval($request->input('id'));
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
            //xóa file thumbnail
            if ($product->thumbnail) {
                $path_thumb = $product->thumbnail;
                $path_thumb = str_replace('public', '', $path_thumb);
                if (file_exists(public_path($path_thumb))) {
                    unlink(public_path($path_thumb));
                }
            }

            $product->delete();

            //delete product option, product variants
            ProductOption::query()->where('product_id', '=', $product->id)->delete();
            ProductVariant::query()->where('product_id', '=', $product->id)->delete();

            $res['success'] = true;
        }
        return response()->json($res);
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
            $path = $this->changePathUpload($path);
            //move
//            $request->file('file')->move(public_path('uploads'),$fileNameToStore); //bỏ cái này vì nó sinh ra ở dòng trên rồi
            $arr_image = [];
            if (isset($product->images) && $product->images) {
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

    protected function changePathUpload($path) { //chuyển về 1 file ở trong stoage/uploads vì nó đang bị sinh ra ở 2 nơi
        $path = str_replace('public/uploads', 'public/storage/uploads', $path);
        return $path;
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

    public function configProduct() {
        $products = Product::all();
        $data_response = [];
        if ($products->count() > 0) {
            $data_response['products'] = $products;
        }
        return view('admin.product.config_product', $data_response);
    }
    public function configProductStore(Request $request) {
        //cho phép tối đa 2 sản phẩm lên hot nhất
        $res = ['success' => false];
        $data = $request->input();
        $product_id = intval($data['product_id']);
        $product = Product::query()->find($product_id);
        if ($product) {
            $product_hot_banners = Product::query()->where('is_hot', '=', config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER'))->get();
            if ($product->is_hot != config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER')) {
                //hiển thị selected
                $product->is_hot = config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER');

                //-- trường hợp chưa có sản phẩm hot banner nào --------------
                if ($product_hot_banners->count() == 0) {
                    $product->position = 1;
                }
                //--- truờng hợp đã có 1 sản phẩm hot banner từ trước --------
                if ($product_hot_banners->count() == 1) {
                    $product->position = 2;
                }
                //--- trường hợp đã có 2 sản phẩm hot banner từ trước -----
                if ($product_hot_banners->count() == 2) {
                    foreach ($product_hot_banners as $item) {
                        if ($item->position == 2) $product_second_hot_banner_cur = $item;
                    }
                    $product->position = 2;

                    $product_second_hot_banner_cur->position = 0;
                    $product_second_hot_banner_cur->is_hot = config('constant.PRODUCT_IS_HOT.HOT_PRODUCT');
                    $product_second_hot_banner_cur->save();

                    $res['product_down'] = $product_second_hot_banner_cur;
                }
                $res['text'] = 'Selected';
                $res['position'] = $product->position;
            } else {
                //hiển thị select
                $product->is_hot = config('constant.PRODUCT_IS_HOT.HOT_PRODUCT');
                $res['text'] = 'Select';
            }

            $product->save();
            $res['success'] = true;
        }

        return response()->json($res);
    }

    public function configChangePosition(Request $request) {
        $res = ['success' => false];
        $product_id = intval($request->input('product_id'));
        $product = Product::query()->find($product_id);
        if ($product) {
            $position_1 = $product->position;
            $product_hot_banner_rest = Product::query()->where('id', '!=', $product_id)->where('is_hot', '=', 2)->first(); //sản phẩm hot banner thứ 2 mà ko click
            if ($product_hot_banner_rest) { //có 2 sản phẩm hot tính cả sp vừa click
                $position_2 = $product_hot_banner_rest->position;
                $product->position = $position_2;
                $product->save();

                $product_hot_banner_rest->position = $position_1;
                $product_hot_banner_rest->save();

                $res['position_product_rest'] = $product_hot_banner_rest->position;
                $res['product_rest_id'] = $product_hot_banner_rest->id;
                $res['case'] ='here 1';
            } else { //chỉ có 1 sản phẩm vừa click là sản phẩm hot thôi
                if ($product->position == 1) $product->position = 2;
                if ($product->position == 2) $product->position = 1;
                $product->save();
                $res['case'] = 'here 2';
            }
            $res['position_product_this'] = $product->position;
            $res['success'] = true;
        } else {
            $res['mess'] = 'Sản phẩm không tồn tại hoặc Diana Authentic đang bị lỗi';
        }

        return response()->json($res);
    }

    public function setPublish(Request $request) {
        $res = ['success' => false];
        $data_request = $request->input();
        $product = Product::query()->find(intval($data_request['product_id']));
        if ($product) {
            $product->is_publish = intval($data_request['is_publish']);
            $product->save();

            if ($product->is_publish == 0) {
                $text_response = 'Đã vô hiệu hóa';
            } else {
                $text_response = 'Đã kích hoạt';
            }
            $res['success'] = true;
            $res['text_response'] = $text_response;
        }
        return response()->json($res);
    }
}
