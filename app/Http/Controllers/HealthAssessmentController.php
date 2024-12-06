<?php

namespace App\Http\Controllers;

use App\Models\HealthAssessment;
use Illuminate\Http\Request;

class HealthAssessmentController extends Controller
{
    public function index()
    {
        $healthAssessment = HealthAssessment::where('user_id', auth()->id())->first();
        return view('dashboard', compact('healthAssessment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'age' => 'required|numeric|min:0|max:150',
            'poids' => 'required|numeric|min:0|max:500',
            'taille' => 'required|numeric|min:0|max:300',
            'rhesus' => 'required|string',
            'allergies' => 'nullable|string',
        ]);

        // Calcul de l'IMC
        $taille_en_metres = $validated['taille'] / 100;
        $imc = $validated['poids'] / ($taille_en_metres * $taille_en_metres);
        $validated['imc'] = round($imc, 2);
        $validated['user_id'] = auth()->id();

        HealthAssessment::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return redirect()->route('dashboard')->with('success', 'Informations de santé mises à jour avec succès !');
    }

    public function edit()
    {
        $healthAssessment = HealthAssessment::where('user_id', auth()->id())->firstOrFail();
        return view('health.edit', compact('healthAssessment'));
    }

    public function update(Request $request)
    {
        $healthAssessment = HealthAssessment::where('user_id', auth()->id())->firstOrFail();
        // Même validation et logique que store()
        // ...
        return redirect()->route('dashboard')->with('success', 'Informations de santé mises à jour avec succès !');
    }
    public function create()
{
    return view('health.assessment_form');
}

}