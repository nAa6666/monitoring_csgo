<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('GET')){
            return view('admin.login');
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $user = User::where('email', $request->input('email'))->first();
            Auth::login($user, true);
            return redirect()->route('admin.home');
        }

        return redirect()->back()->withErrors(['Неверный логин или пароль']);
    }
}
