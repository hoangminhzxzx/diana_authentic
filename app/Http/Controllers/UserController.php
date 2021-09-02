<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        $users = User::query()->get();
        return view('admin.user.index',
            [
                'users' => $users
            ]
        );
    }

    public function add() {
        $roles = Role::all();
        return view('admin.user.add',
            [
                'roles' => $roles
            ]
        );
    }

    public function store(Request $request) {
        $data = $request->input();
        $request->validate(
            [
                'username' => 'required|min:5',
                'password' => 'required|min:5',
                'role_id' => 'required',
            ],
            [],
            [
                'username' => 'Username',
                'password' => 'Password',
                'role_id' => 'Role'
            ]
        );
//        dd($data['role_id']);
        $user = new User();
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->save();
        $user->roles()->sync($data['role_id'], false);
        return back()->with('status_add_user', 'Thêm user thành công');;
    }

    public function edit($id) {
        //chỉ có thể chỉnh sửa chính bản thân và editor
        //get những thằng user chỉ có quyên editor mà ko có quyền admin

        //---- Check những thằng editor
        $is_editor = false;
        $user = User::query()->find($id);
        foreach ($user->roles as $role) {
            $temp[] = $role;
        }
        if (count($temp) == 1) {
            foreach ($temp as $t) {
                if ($t->id == 2) {        //--
                    $is_editor = true;    //--
                }                         //--
            }                             //--
        }                                 //--
        //------------------------------------

        $roles = Role::all();
        if ($id == Auth::user()->id || $is_editor == true) {
            return view('admin.user.edit',
                [
                    'user' => $user,
                    'roles' => $roles
                ]
            );
        } else {
            return "Bạn không có quyền chỉnh sửa admin khác";
        }
    }

    public function update (Request $request, $id) {
        $data = $request->input();
        $request->validate(
            [
                'username' => 'required|min:5',
                'password' => 'required|min:5',
                'role_id' => 'required',
            ],
            [],
            [
                'username' => 'Username',
                'password' => 'Password',
                'role_id' => 'Role'
            ]
        );
        $user = User::query()->find($id);
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->save();
        $user->roles()->sync($data['role_id'], false);
        return redirect()->route('admin.user.list')->with('status_update_user', 'Cập nhật user thành công');
    }

    public function delete($id) {
        //---- Check những thằng editor -----//
        $is_editor = false;
        $user = User::query()->find($id);
        foreach ($user->roles as $role) {
            $temp[] = $role;
        }
        if (count($temp) == 1) {
            foreach ($temp as $t) {
                if ($t->id == 2) {        //--
                    $is_editor = true;    //--
                }                         //--
            }                             //--
        }                                 //--
        //------------------------------------

        $user = User::query()->find($id);
        if ($id != Auth::user()->id && $is_editor == true) {
            //Xóa trong zone này đc
            if ($user) {
                $user->delete();
                return back()->with('status_delete_user', 'Xóa user editor thành công');
            }
        } elseif ($id == Auth::user()->id) {
            return "Bạn không thể tự xóa bản thân khỏi DA";
        } else {
            return "Bạn không có quyền xóa admin khác";
        }
    }
}
