<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Valider les champs de connexion
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenter de se connecter avec les informations fournies
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            return redirect()->intended('/dashboard');
        }

        // Retourner avec une erreur si les informations de connexion sont incorrectes
        return back()->withErrors([
            'email' => 'Les informations d’identification sont incorrectes.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
