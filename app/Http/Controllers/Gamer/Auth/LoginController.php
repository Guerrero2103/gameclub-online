<?php

namespace App\Http\Controllers\Gamer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('gamer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('gamer')->attempt($credentials)) {
            return redirect()->intended('/gamer/dashboard');
        }

        return back()->withErrors([
            'email' => 'Ongeldige inloggegevens.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('gamer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/gamer/login');
    }
}
