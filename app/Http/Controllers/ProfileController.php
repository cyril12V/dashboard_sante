<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'medical_info' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->medical_info = $request->medical_info;

        if ($request->hasFile('profile_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }
            // Enregistrer la nouvelle image
            $path = $request->file('profile_image')->store('profile_images');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil mis à jour avec succès');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Supprimer toutes les données associées à l'utilisateur
        $user->activities()->delete();
        $user->goals()->delete();
        $user->sleepRecords()->delete();
        $user->consultations()->delete();
        $user->prescriptions()->delete();

        // Supprimer l'image de profil si elle existe
        if ($user->profile_image) {
            Storage::delete($user->profile_image);
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Rediriger vers la page d'accueil avec un message de succès
        return redirect('/')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}
