<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\DiseaseDatabase;  // Importer la classe DiseaseDatabase
use App\Models\DiagnosticsHistory;
use Illuminate\Support\Facades\Auth;
use NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer; // Pour l'analyse NLP
use NlpTools\Documents\Document;


class DiagnosisController extends Controller
{
    /**
     * Affiche le formulaire de diagnostic.
     */
    public function showDiagnosticForm()
    {
        return view('diagnosis.form');
    }

    /**
     * Traite les symptômes soumis et retourne le diagnostic.
     */
    public function diagnose(Request $request)
    {
        $validated = $request->validate([
            'symptom_category' => 'required|string',
            'specific_symptoms' => 'required|string',
            'pain_level' => 'nullable|numeric|min:1|max:10',
            'duration' => 'nullable|string',
            'age' => 'nullable|numeric|min:0|max:150',
        ]);
    
        // Simuler une base de données des maladies (exemple simplifié)
        $diseaseDatabase = [
            'Grippe' => ['fièvre', 'toux sèche', 'maux de tête'],
            'Angine' => ['mal de gorge', 'fièvre', 'douleur'],
            'Covid-19' => ['fièvre', 'toux sèche', 'perte de goût', 'fatigue'],
            'Gastro-entérite' => ['douleur abdominale', 'diarrhée', 'nausée'],
        ];
    
        // Déterminer la maladie la plus probable
        $mostProbableDiagnosis = 'Inconnu';
        $inputSymptom = strtolower($validated['specific_symptoms']);
        $matches = [];
    
        foreach ($diseaseDatabase as $disease => $symptoms) {
            if (in_array($inputSymptom, array_map('strtolower', $symptoms))) {
                $matches[] = $disease;
            }
        }
    
        if (count($matches) > 0) {
            $mostProbableDiagnosis = implode(', ', array_unique($matches));
    
            // Enregistrer l'historique
            DiagnosticsHistory::create([
                'user_id' => auth()->id(),
                'disease_name' => $mostProbableDiagnosis,
                'symptoms' => json_encode([$inputSymptom]),
                'diagnosed_at' => now(),
            ]);
        }
    
        $diagnosisMessage = "La maladie la plus probable est : $mostProbableDiagnosis. Veuillez consulter un professionnel de santé pour confirmation.";
    
        return view('diagnosis.result', compact('diagnosisMessage'));
    }
}    