<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
class UserAuthController extends Controller
{
    function login() {
        return view('auth.login');
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));
        $user->attachRole('administrator');
        if(event(new Registered($user))) {    
            $request->session()->put('user', $user);
            return redirect(RouteServiceProvider::HOME);          
        } else {
            return redirect(RouteServiceProvider::HOME);
        }


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

    function changeRole(Request $request, $id) {
        $user = User::find($id);
        $user->save([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->attachRole($request->role_id);
        return redirect()->route('profile');
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


