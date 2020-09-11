<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(LoginRequest $request)
    {
        $isAdmin = [
            'email' => $request->email, 
            'password' => $request->password,
            'role_id' => config('constains.is_admin'),
        ];
        $isUser = [
            'email' => $request->email, 
            'password' => $request->password,
            'role_id' => config('constains.is_user'),
        ];
        if (Auth::attempt($isAdmin)) {
            return redirect()->route('admin.users');
        } elseif (Auth::attempt($isUser)) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
    
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
