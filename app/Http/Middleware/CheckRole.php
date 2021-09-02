<?php

namespace App\Http\Middleware;

use App\Model\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id_auth = Auth::user()->id;
        $user_login = User::query()->find($id_auth);
        $pivot = DB::table('role_user')->where('user_id', '=', $id_auth)->get('role_id');
        foreach ($pivot as $item) {
            $roles_user_login[] = $item->role_id;
        }
        if (in_array(1, $roles_user_login)) {
            return $next($request);
        } else {
            return response('Bạn chưa đủ quyền', 401);
        }

    }
}
