<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    // Afficher la liste des prescriptions
    public function index()
    {
        $prescriptions = Auth::user()->prescriptions()->orderBy('start_date', 'asc')->get();
        return view('prescriptions.index', compact('prescriptions'));
    }

    // Afficher le formulaire pour créer une nouvelle prescription
    public function create()
    {
        return view('prescriptions.create');
    }

    // Sauvegarder une nouvelle prescription
    public function store(Request $request)
    {
        $request->validate([
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Auth::user()->prescriptions()->create($request->all());

        return redirect()->route('prescriptions.index')->with('success', 'Prescription ajoutée avec succès');
    }

    // Supprimer une prescription
    public function destroy($id)
    {
        $prescription = Prescription::findOrFail($id);
        
        if ($prescription->user_id == Auth::id()) {
            $prescription->delete();
            return redirect()->route('prescriptions.index')->with('success', 'Prescription supprimée avec succès');
        }

        return redirect()->route('prescriptions.index')->with('error', 'Vous ne pouvez pas supprimer cette prescription');
    }

    // PrescriptionController.php
public function getPrescriptions()
{
    $prescriptions = Prescription::all();
    $events = [];

    foreach ($prescriptions as $prescription) {
        $events[] = [
            'title' => $prescription->medication_name,
            'start' => $prescription->start_date,
            'end' => date('Y-m-d', strtotime($prescription->end_date . ' +1 day')), // FullCalendar n'affiche pas la date de fin, donc on ajoute un jour
            'color' => '#3788d8', // Par exemple, une couleur pour les prescriptions
        ];
    }

    return response()->json($events);
}
public function getUserPrescriptions()
{
    // Filtre les prescriptions de l'utilisateur connecté
    $prescriptions = Prescription::where('user_id', auth()->id())->get();

    // Formate les données pour FullCalendar
    $events = $prescriptions->map(function ($prescription) {
        return [
            'title' => $prescription->medication_name,
            'start' => $prescription->start_date,
            'end' => $prescription->end_date,
        ];
    });

    return response()->json($events);
}

}
