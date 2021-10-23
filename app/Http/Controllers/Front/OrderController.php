<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Front\OrderDetail;
use App\Model\Front\OrderMaster;
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
            $order_master->customer_name = $data['name'];
            $order_master->customer_phone = $data['phone'];
            $order_master->address = $merge_address;
            $order_master->email = $data['email'];
            $order_master->note = (isset($data['note']) && $data['note']) ? $data['note'] : '';
            $order_master->status = 1; //status 1 : đặt hàng. 2 : hoàn thành, 3 : hủy
            $order_master->total_price = intval(Cart::total()) * 1000;
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

                // Trừ số lượng sản phẩn ở trong hệ thống kho
                $product_variant = ProductVariant::query()->find($order_detail->product_variant_id);
                if ($product_variant) {
                    $new_qty = $product_variant->qty - $order_detail->qty;
                    $product_variant->qty = $new_qty;
                    if ($new_qty == 0) {
                        $product_variant->is_out_stock = 1; //nếu số lượng về 0 => trả về trạng thái hết hàng is_out_stock = 1
                    }
                    $product_variant->save();

                    //check xem các variant khác còn hàng ko, nếu hết hàng luôn thì sẽ update status mới cho bản ghi product

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
}
