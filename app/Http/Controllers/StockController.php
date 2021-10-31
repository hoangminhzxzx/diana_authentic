<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    public function index() {
        $list_stock = Stock::all();
        $data_response = [];
        $data_response['list_stock'] = $list_stock;
        return view('admin.stock.index', $data_response);
    }

    public function store (Request $request) {
        $res = ['success' => false];
        $data_request = $request->input();
        $validated = $request->validate(
            [
                'input' => 'required|integer',
                'total_price' => 'required|integer'
            ],[],
            [
                'input' => 'Số lượng hàng nhập vào',
                'total_price' => 'Tổng tiền lấy hàng'
            ]
        );
        if (!$validated) {
            $res['errors'] = $validated['errors'];
        } else {
            $stock = new Stock();
            $stock->input = intval($data_request['input']);
            $stock->total_price = intval($data_request['total_price']);
            $stock->note = $data_request['note'];
            $stock->save();

            $res['html'] = view('admin.stock.row_stock_ajax', [
                'stock' => $stock
            ])->toHtml();

            $res['stock_id'] = $stock->id;
            $res['success'] = true;
        }
        return response()->json($res);
    }

    public function edit(Request $request, $id) {
        $stock = Stock::query()->find($id);
        if ($stock) {
            return view('admin.stock.edit', [
                'stock' => $stock
            ]);
        }
    }

    public function update(Request $request, $id) {
        $request->validate(
            [
                'input' => 'required|integer',
                'total_price' => 'required|integer'
            ],[],
            [
                'input' => 'Số lượng hàng nhập vào',
                'total_price' => 'Tổng tiền lấy hàng'
            ]
        );

        $stock = Stock::query()->find($id);
        if ($stock) {
            $stock->input = intval($request->input('input'));
            $stock->total_price = intval($request->input('total_price'));
            $stock->note = $request->input('note');
            $stock->save();
            return redirect()->route('admin.stock.index')->with('status', 'Cập nhật thành công');
        }
    }

    public function delete(Request $request, $id) {
        $stock = Stock::query()->find($id);
        if ($stock) {
            //xóa hết ảnh của nó trong folder bill_images
            if ($stock->images) {
                $path_images = json_decode($stock->images);
                if ($path_images) {
                    foreach ($path_images as $path_image) {
                        $path_image = str_replace('public', '', $path_image);
                        if (file_exists(public_path($path_image))) {
                            unlink(public_path($path_image));
                        }
                    }
                }
            }

            if ($stock->delete()) {
                return back()->with('status', 'Xoá thành công');
            }
        }
    }

    public function uploadImageDZ(Request $request) {
        $res = ['success' => false];
        $data_request = $request->input();

//        $product = Product::query()->find($data_request['id']);
        $record_stock = Stock::query()->find($data_request['id']);

        if($request->file('file')){
            //Storage::delete('/public/avatars/'.$user->avatar);
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'-'.date('Y-m-d').'-'.'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/uploads/bill_images', $fileNameToStore);
            $path = $this->changePathUpload($path);
            //move
//            $request->file('file')->move(public_path('uploads'),$fileNameToStore); //bỏ cái này vì nó sinh ra ở dòng trên rồi
            $arr_image = [];
            if (isset($record_stock->images) && $record_stock->images) {
                $arr_image = json_decode($record_stock->images, true);
            }

            $arr_image[] = $path;
            if ($record_stock) {
                $record_stock->images = json_encode($arr_image);
                $record_stock->save();
            }

            $res['success'] = true;
            $res['path_image'] = $path;
            $res['stock_id'] = $record_stock->id;

            $res['html'] = view('admin.stock.images_stock_ajax', [
                'stock' => $record_stock
            ])->toHtml();
            return response()->json($res);
        }
    }

    public function removeImageSingle(Request $request) {
        $res= ['success' => false];
        $data = $request->input();
        $stock = Stock::query()->find($data['stock_id']);
        if ($stock) {
            if ($stock->images) {
                $arr_image = json_decode($stock->images, true);
                $key_image_in_arr = array_search($data['path'], $arr_image);
                $real_path_image = $arr_image[$key_image_in_arr];

                //bỏ đi phần tử image muốn xóa và save lại
                unset($arr_image[$key_image_in_arr]);
                $stock->images = json_encode($arr_image, true);
                $stock->save();

                //xóa ảnh trong bộ nhớ
                $path_remove = str_replace('public', '', $real_path_image);
                if(file_exists(public_path($path_remove))){
                    unlink(public_path($path_remove));
                }

                $res['stock_id'] = $stock->id;
                $res['src_image'] = url('/public'.$path_remove);
                $res['success'] = true;
                return response()->json($res);
            }
        }
    }

    protected function changePathUpload($path) { //chuyển về 1 file ở trong stoage/uploads vì nó đang bị sinh ra ở 2 nơi
        $path = str_replace('public/uploads', 'public/storage/uploads', $path);
        return $path;
    }
}
