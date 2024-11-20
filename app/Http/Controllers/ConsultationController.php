<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    // Afficher l'historique des consultations
    public function index()
    {
        $consultations = Auth::user()->consultations()->orderBy('date', 'desc')->get();
        return view('consultations.index', compact('consultations'));
    }

    // Afficher le formulaire d'ajout de consultation
    public function create()
    {
        return view('consultations.create');
    }

    // Enregistrer une nouvelle consultation
    public function store(Request $request)
    {
        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'date' => 'required|date',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        Consultation::create([
            'user_id' => Auth::id(),
            'doctor_name' => $request->doctor_name,
            'date' => $request->date,
            'prescription' => $request->prescription,
            'notes' => $request->notes,
        ]);

        return redirect()->route('consultations.index')->with('success', 'Consultation ajoutée avec succès.');
    }
}
