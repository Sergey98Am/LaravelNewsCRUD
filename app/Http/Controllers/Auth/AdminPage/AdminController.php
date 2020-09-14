<?php

namespace App\Http\Controllers\Auth\AdminPage;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function AdminHome(){
        return view('auth.admin-page.admin_home');
    }
}
