<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdmin;
use App\Models\Admin;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,admin')->only(['edit', 'update']);
    }

    public function index()
    {
        return view('admin.admins.index');
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(UpdateAdmin $request, Admin $admin)
    {
        $admin->update($request->validated());

        return redirect(route('admin.home'))->with(['success' => 'Your profile updated successfully']);
    }
}
