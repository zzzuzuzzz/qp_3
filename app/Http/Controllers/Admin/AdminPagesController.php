<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminPagesController extends Controller
{
    public function index()
    {
        return view('pages.admin.home_admin_page');
    }
}
