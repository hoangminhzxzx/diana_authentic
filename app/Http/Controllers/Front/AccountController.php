<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Front\AccountClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index() {
        return view('front.account.account');
    }
    public function register(Request $request) {
        $res = ['success' => false];
        $data = $request->input();
        //validate
        $validated = $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
                'email' => 'required|email:rfc,dns'
            ],
            [],
            [
                'username' => 'Username',
                'password' => 'Password',
                'email' => 'Email'
            ]
        );
        if (!$validated) {
//            dd($validated);
            $res['errors'] = $validated['errors'];
        } else {
//            dd('success');
            $account_client = new AccountClient();
            $account_client->username = $data['username'];
            $account_client->password = md5($data['password']);
            $account_client->email = $data['email'];
            $account_client->save();
            $res['success'] = true;
        }
        return response()->json($res);
    }

    public function login(Request $request) {
//        $request->session()->forget('client_login');
//        $request->session()->forget('is_login');
//        $request->session()->flush();
//        die;
//        dd($request->session()->all());
        $res = ['success' => false];
        $data = $request->input();
        //validate
        $validated = $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [],
            [
                'username' => 'Username',
                'password' => 'Password',
            ]
        );
        if (!$validated) {
            $res['errors'] = $validated['errors'];
        } else {
            $account_client = AccountClient::query()
                ->where('username', '=', $data['username'])
                ->where('password', '=', md5($data['password']))
                ->first();
            if ($account_client) {
                //set session for client
                $request->session()->put([
                    'client_login' => [
                        'username' => $account_client->username,
                        'email' => $account_client->email,
                        'id' => $account_client->id,
                        'is_login' => true
                    ]
                ]);
                $res['success'] = true;
            } else {
                $res['message_error_account'] = "Tên đăng nhập hoặc mật khẩu không chính xác";
            }
        }
        return response()->json($res);
    }

    public function logout(Request $request) {
        $res = ['success' => false];
//        dd($request->session()->all());
        Session::forget('client_login');
        $res['success'] = true;
        return response()->json($res);
    }

    public function restorePassword() {
        return view('front.account.restart_password');
    }

    public function restoreUpdatePassword(Request $request) {
        $res = ['success' => false];
        $data = $request->input();
        //validate
        $validated = $request->validate(
            [
                'password' => 'required|min:6',
                'confirm_password' => 'required'
            ],
            [],
            [
                'password' => 'Password',
                'confirm_password' => 'Confirm Password'
            ]
        );
        if (!$validated) {
//            dd($validated);
            $res['errors'] = $validated['errors'];
        } else {
            //check confirm password
            if ($data['confirm_password'] != $data['password']) {
                $res['error_confirm'] = 'Xác nhận mật khẩu sai';
                $res['success'] = false;
                return response()->json($res);
            }

            $account_client = AccountClient::query()->where('email','=', $data['email'])->where('id','=',$data['id'])->first();
            if ($account_client) {
                $account_client->password = md5($data['password']);
                $account_client->save();

                //login cho khách hàng vừa request luôn
                //set sesion for client
                $request->session()->put([
                    'client_login' => [
                        'username' => $account_client->username,
                        'is_login' => true
                    ]
                ]);
                $res['success'] = true;
            }
        }

        return response()->json($res);
    }

    public function detail(Request $request) {
        if ($request->session()->has('client_login')) {
            //đã login
            $info_account = $request->session()->get('client_login');
            $account_client = AccountClient::query()->find($info_account['id']);
            $data_response = [];

            $provinces = DB::table('provinces')->get();
            if ($account_client) {
                $data_response['account_client'] = $account_client;
                $data_response['provinces'] = $provinces;
            }
            return view('front.account.detail', $data_response);
        } else {
            //chưa login
            return redirect()->route('client.account.client')->with('status', 'Bạn chưa đăng nhập !');
        }
     }
}
