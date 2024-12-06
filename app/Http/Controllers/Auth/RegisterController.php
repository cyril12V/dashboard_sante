<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        // Validation du formulaire d'inscription
        $this->validator($request->all())->validate();

        // Création de l'utilisateur
        $user = $this->create($request->all());

        // Déclenchement de l'événement d'enregistrement
        event(new Registered($user));

        // Redirection après inscription
        return redirect()->route('login')->with('success', 'Votre compte a été créé. Veuillez vous connecter.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8', // Minimum de 8 caractères
                'confirmed', // Confirmation du mot de passe
                'regex:/[A-Z]/', // Doit contenir au moins une majuscule
                'regex:/[a-z]/', // Doit contenir au moins une minuscule
                'regex:/[0-9]/', // Doit contenir au moins un chiffre
                'regex:/[@$!%*?&]/', // Doit contenir au moins un caractère spécial
            ],
        ]);
    }
}
