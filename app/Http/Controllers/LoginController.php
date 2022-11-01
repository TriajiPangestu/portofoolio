<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __constract() {
        $this->middleware('Auth')->except('logout');
    }

    public function index() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->intended('admin.dashboard');
        }

    return back()->withErrors([
        'email' => 'Email atau Password salah',
        ])->onlyInput('email');

    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}