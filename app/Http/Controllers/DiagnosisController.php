<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Validation des données soumises par le formulaire
        $validated = $request->validate([
            'symptoms_description' => 'required|string',
        ]);

        // Base de données fictive des maladies
        $diseaseDatabase = [
            'Grippe' => ['fièvre', 'toux sèche', 'maux de tête'],
            'Angine' => ['mal de gorge', 'fièvre', 'douleur'],
            'Covid-19' => ['fièvre', 'toux sèche', 'perte de goût', 'fatigue'],
            'Gastro-entérite' => ['douleur abdominale', 'diarrhée', 'nausée'],
            'Bronchite' => ['toux', 'fatigue', 'maux de gorge'],
            'Pneumonie' => ['fièvre', 'toux', 'difficulté à respirer'],
            'Migraine' => ['maux de tête', 'sensibilité à la lumière', 'nausée'],
            'Sinusite' => ['maux de tête', 'congestion nasale', 'douleur faciale'],
            'Rhinopharyngite' => ['toux', 'écoulement nasal', 'maux de gorge'],
            'Varicelle' => ['éruption cutanée', 'fièvre', 'fatigue'],
            // Autres maladies peuvent être ajoutées ici
        ];

        // Recherche de la maladie la plus probable
        $mostProbableDiagnosis = 'Inconnu';
        $inputSymptom = strtolower($validated['symptoms_description']);
        $matches = [];

        // Recherche des correspondances
        foreach ($diseaseDatabase as $disease => $symptoms) {
            if (in_array($inputSymptom, array_map('strtolower', $symptoms))) {
                $matches[] = $disease;
            }
        }

        // Si des correspondances ont été trouvées, afficher la maladie
        if (count($matches) > 0) {
            $mostProbableDiagnosis = implode(', ', array_unique($matches));
        }

        // Si aucune correspondance n'est trouvée, afficher un message générique
        if ($mostProbableDiagnosis == 'Inconnu') {
            $mostProbableDiagnosis = 'Aucun diagnostic trouvé';
        }

        // Message de diagnostic
        $diagnosisMessage = "La maladie la plus probable est : $mostProbableDiagnosis. Veuillez consulter un professionnel de santé pour confirmation.";

        // Retourne la vue avec le message de diagnostic
        return view('diagnosis.result', compact('diagnosisMessage'));
    }
}
