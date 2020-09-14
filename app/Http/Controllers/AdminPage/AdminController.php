<?php

namespace App\Http\Controllers\AdminPage;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function AdminHome(){
        return view('admin-page.admin_home');
    }
}
