<?php

namespace App\Http\Controllers;
use App\Models\Country;

class ProfileController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        
        return view('profile',compact('countries'));
    }
}
