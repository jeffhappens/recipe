<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }
    public function login_post(Request $request) {
        $username = $request->get('username');
        $password = $request->get('password');
        if(!\Auth::attempt(['username' => $username, 'password' => $password])) {
            return 'invalid';
        }
        return redirect('/');
    }
    public function logout() {
        \Auth::logout();
        return redirect('/');
    }
}
