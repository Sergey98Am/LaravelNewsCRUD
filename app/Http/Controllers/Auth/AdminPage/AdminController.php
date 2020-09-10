<?php

namespace App\Http\Controllers\Auth\AdminPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminHome(){
        return view('auth.admin-page.admin_home');
    }
}
