<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ImpersonateController extends Controller
{
    public function index()
    {
        auth()->guard('web')->logout();

        return redirect(route('admin.users'));
    }

    public function store(Request $request)
    {
        auth()->guard('web')->loginUsingId(Arr::get($request->validate(['user_id' => 'required|exists:users,id']), 'user_id'));

        return redirect(route('home'));
    }
}
