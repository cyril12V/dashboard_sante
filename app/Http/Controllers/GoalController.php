<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;

class GoalController extends Controller
{
    // Affiche le tableau de bord des objectifs
    public function showDashboard()
    {
        $user = Auth::user();
        $goals = Goal::where('user_id', $user->id)->get();
        return view('goals.dashboard', compact('goals'));
    }

    // Affiche le formulaire de création d'un nouvel objectif
    public function create()
    {
        return view('goals.create');
    }

    // Enregistre un nouvel objectif
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'step_goal' => 'required|numeric|min:1000|max:50000',
            'status' => 'required|in:in_progress,achieved',
        ]);

        $validated['user_id'] = Auth::id(); // Lier l'objectif à l'utilisateur connecté

        Goal::create($validated); // Créer l'objectif dans la base de données

        return redirect()->route('goals.dashboard')->with('success', 'Objectif créé avec succès.');
    }

    // Affiche le formulaire d'édition pour un objectif existant
    public function edit(Goal $goal)
    {
        if ($goal->user_id !== Auth::id()) {
            return redirect()->route('goals.dashboard')->with('error', 'Vous ne pouvez pas modifier cet objectif.');
        }

        return view('goals.show', compact('goal'));
    }

    // Met à jour un objectif existant
    public function update(Request $request, Goal $goal)
    {
        if ($goal->user_id !== Auth::id()) {
            return redirect()->route('goals.dashboard')->with('error', 'Vous ne pouvez pas modifier cet objectif.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'step_goal' => 'required|numeric|min:1000|max:50000',
            'status' => 'required|in:in_progress,achieved',
        ]);

        $goal->update($validated); // Mettre à jour l'objectif

        return redirect()->route('goals.dashboard')->with('success', 'Objectif mis à jour avec succès.');
    }

    // Supprime un objectif
    public function destroy(Goal $goal)
    {
        if ($goal->user_id !== Auth::id()) {
            return redirect()->route('goals.dashboard')->with('error', 'Vous ne pouvez pas supprimer cet objectif.');
        }

        $goal->delete(); // Supprimer l'objectif

        return redirect()->route('goals.dashboard')->with('success', 'Objectif supprimé avec succès.');
    }
}
