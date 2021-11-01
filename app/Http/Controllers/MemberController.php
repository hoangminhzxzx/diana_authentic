<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Front\AccountClient;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class MemberController extends Controller
{
    public function index (Request $request) {
        $keyword = $request->query('filter_keyword');

        $members = AccountClient::query()
            ->when($keyword, function (Builder $query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%');
            })
            ->paginate(15);
        $data_response = [];
        $data_response['keyword'] = $keyword;
        if ($members->count() > 0) $data_response['members'] = $members;
        return view('admin.member.index', $data_response);
    }

//    public function detail($id) {
//        $member = AccountClient::query()->find($id);
//        if ($member) {
//            return view('')
//        }
//    }
}
