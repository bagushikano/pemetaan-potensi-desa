<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Admin;

class LoginController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request)
    {
        if(Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->with('message', 'Email atau Password Anda Salah');
        }
    }

    public function logout()
    {
        Auth::guard()->logout();

        return redirect()->route('login_page');
    }

}
