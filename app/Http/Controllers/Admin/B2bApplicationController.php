<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class B2bApplicationController extends Controller
{
    public function index()
    {
        return view('admin.applications.index');
    }
}
