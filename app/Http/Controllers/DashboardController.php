<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('');  
    }
    public function adminArea() {
        if(Auth::user()->hasRole('administrator')) {
            return view('adminArea');
        }
    }

    public function profile() {
        if(Auth::user()) {
            return view('profile');
        }
    }

    
}
