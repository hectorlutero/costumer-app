<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserAuthController extends Controller
{
    function login() {
        return view('auth.login');
    }

    

    function check(Request $request) {
        
        $request->validate([
            "email"=>"required|email",
            "password"=>"required|min:5"
        ]);
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user', $user);
            $response['success'] = true;
            $response['msg'] = "you're logged in";
            // return response->json($response);
            return redirect()->route('dashboard');

        }  else {
            return back()->with('fail', 'Invalid credentials');
        }        
    }


    function logout (Request $request) {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    function dashboard() {
        if(Auth::check()) {
            return view('dashboard');
        }
        return view('auth.login');
    }   
}


