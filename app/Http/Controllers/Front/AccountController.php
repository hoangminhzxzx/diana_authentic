<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Front\AccountClient;
use Illuminate\Http\Request;
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
}
