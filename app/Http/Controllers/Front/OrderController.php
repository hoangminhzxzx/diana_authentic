<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Front\OrderDetail;
use App\Model\Front\OrderMaster;
use App\Model\Product;
use App\Model\ProductVariant;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function insertOrder(Request $request) {
        $response = ['success' => false];
        $data = $request->input();

        //validate
        $mess_error = $this->validateOrder($data);
        if (count($mess_error) > 0) {
            //chưa required, trả mess về client
            $response['mess_error'] = $mess_error;
            return response()->json($response);
        } else {
            //xử lý địa chỉ của khách hàng trước khi save vào order master
            $customer_province = DB::table('provinces')->where('id', '=', intval($data['province']))->first()->name;
            $customer_district = DB::table('districts')->where('id', '=', intval($data['district']))->first()->name;
            $customer_ward = DB::table('wards')->where('id', '=', intval($data['ward']))->first()->name;
            $customer_address_street_plus = $data['address_street_plus'] ? $data['address_street_plus'] : '';

            $merge_address = trim($customer_address_street_plus . ' ' . $customer_ward . ', '. $customer_district . ', ' . $customer_province);

            //đã chọn đủ trường, send order thôi nào !
            $order_master = new OrderMaster();
            $order_master->order_code = $this->generateCode();
            $order_master->customer_name = $data['name'];
            $order_master->customer_phone = $data['phone'];
            $order_master->address = $merge_address;
            $order_master->email = $data['email'];
            $order_master->note = (isset($data['note']) && $data['note']) ? $data['note'] : '';
            $order_master->status = 1; //status 1 : đặt hàng. 2 : hoàn thành, 3 : hủy

            $total_price = intval(str_replace('.', '', Cart::total()));
            $order_master->total_price = $total_price;

            //check xem có phải member Diana Authentic order hàng không
            if ($request->session()->has('client_login')) {
                //đã login
                $order_master->is_member = 1;

                $info_account = $request->session()->get('client_login');
                $order_master->from_member = $info_account['id'];
            }

            $order_master->save();

            $data_items = Cart::content();
            foreach ($data_items as $item) {
                //save order detail
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order_master->id;
                $order_detail->product_id = $item->id;
                $order_detail->qty = $item->qty;
                $order_detail->color = $item->options->color ? $item->options->color : '';
                $order_detail->size = $item->options->size ? $item->options->size : '';
                $order_detail->price = $item->qty * $item->price;
                $order_detail->product_variant_id = $item->options->product_variant_id;
                $order_detail->save();

                //update product lên best seller - cái này là minh làm láu cá xíu
                $product = Product::query()->find($order_detail->product_id);
                if ($product) {
                    $product->is_best_sell = 1;
                    $product->save();
                }

                // Trừ số lượng sản phẩn ở trong hệ thống kho
                $product_variant = ProductVariant::query()->find($order_detail->product_variant_id);
                if ($product_variant) {
                    $new_qty = $product_variant->qty - $order_detail->qty;
                    $product_variant->qty = $new_qty;
                    if ($new_qty == 0) {
                        $product_variant->is_out_stock = 1; //nếu số lượng về 0 => trả về trạng thái hết hàng is_out_stock = 1
                    }
                    $product_variant->save();
                }
            }
//            die();

            Cart::destroy();
            $response['success'] = true;
            $response['redirect'] = route('client.thank.you');
            $response['redirect_home'] = route('homeFront');
            return response()->json($response);
        }
    }

    protected function validateOrder($data) {
        $mess = [];

        //check xem chọn tỉnh/thành phố, quận/huyện, phường/xã
        if (!array_key_exists('province', $data)) {
            $mess['province'] = 'Tỉnh/Thành phố không được để trống';
        }
        if (!array_key_exists('district', $data)) {
            $mess['district'] = 'Quận/Huyện không được để trống';
        }
        if (!array_key_exists('ward', $data)) {
            $mess['ward'] = 'Phường/Xã không được để trống';
        }

        foreach ($data as $key => $item) {
            if (in_array($key, ['name', 'email', 'phone', 'province', 'district', 'wards'])) {
                if ($item == null) {
                    $mess[$key] = 'Không được để trống';
                }
            }
        }
        return $mess;
    }

    public function thankYou() {
        return view('front.thank');
    }

    public function generateCode() {
        $str = $this->generateRandomString(6);
        $order_code = '#DA' . $str;

//        $model = new BaseModel('product');
//        $product = $model->where('code', $codeProduct)->get()->getRow();
//        if (!empty($product)) {
//            $codeProduct = $this->generateCode();
//        }

        $order_master = OrderMaster::query()->where('order_code', '=', $order_code)->first();
        if ($order_master) {
            $order_code = $this->generateCode();
        }
        return $order_code;
    }

    protected function generateRandomString($length = 5) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
