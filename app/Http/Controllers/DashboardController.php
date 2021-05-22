<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard');
    }
    public function adminArea() {
        if(Auth::user()->hasRole('administrator')) {
            return view('adminArea');
        }
    }

    public function becomeUser() {
        if(Auth::user()->hasRole('administrator')) {
            Auth::user()->detachRole('admin'); 
            Auth::user()->attachRole('user'); 
            return view('profile');
        }
    }
    
    public function userArea() {
        if(Auth::user()->hasRole('user')) {
            return view('profile');
        }
    }

    public function becomeAdmin() {
        if(Auth::user()->hasRole('user')) {
            return view('adminArea');
        }
    }
}
