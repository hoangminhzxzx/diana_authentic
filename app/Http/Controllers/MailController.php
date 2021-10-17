<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Front\AccountClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function testMail() {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];

        Mail::to('chimhotveovon@gmail.com')->send(new \App\Mail\MyTestMail($details));
        dd('Email is sent');
    }

    public function restartPasswordClient(Request $request) {
        $res = ['success' => false];
        $data = $request->input();
        //validate
        $validated = $request->validate(
            [
                'emailReg' => 'required|email:rfc,dns'
            ],
            [],
            [
                'emailReg' => 'Email'
            ]
        );
        if (!$validated) {
//            dd($validated);
            $res['errors'] = $validated['errors'];
        }

        //check toàn bộ email của các client đã đăng kỹ, xem có email nào giông email gửi request ko
        $account_client = AccountClient::query()->where('email', '=', $data['emailReg'])->first();
        if (!$account_client) {
            $res['error_isset_email'] = 'Email này chưa từng được đăng ký vào hệ thống Diana Authentic';
            $res['success'] = false;
        } else {
            $email_gen = md5($account_client->email);
            $password_old_gen = md5($account_client->password);

            $link_restore_password = url('/cap-nhat-mat-khau/' . $email_gen . '/' . $password_old_gen);
            $details = [
                'link_restore_password' => $link_restore_password
            ];
//            view('emails.restart_password_client', [
//                'link_restore_password' => $link_restore_password
//            ]);

//            dd($email_gen, $password_old_gen);
//            Mail::to('hoangminhzxzx@gmail.com')->send(new \App\Mail\restartPasswordClient($details)); //dev local
            Mail::to($data['emailReg'])->send(new \App\Mail\restartPasswordClient($details));

            $res['success'] = true;
            $res['mess_send'] = $account_client->username . ' kiểm tra email nhé, Diana Authentic sẽ gửi mail khôi phục mật khẩu ngay thôi !';
        }

        return response()->json($res);
    }

    public function updatePasswordNewFromEmail($key, $reset) {
        $data_response = [];
        $account_client = DB::select("SELECT * FROM account_clients WHERE MD5(email) = " . "'". $key ."'" ." AND MD5(PASSWORD) ="."'".$reset."'"." ");
//        dd($account_client);
        if ($account_client) {
            $data_response['account_client'] = $account_client[0];
            return view('front.account.change_password_restore', $data_response);
        }
    }
}
