<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $user = Auth::user();
            return view('admin.dashboard.index', ['user' => $user]);
        }

    }
}
