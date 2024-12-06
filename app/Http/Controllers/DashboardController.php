<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dashboard;
use App\Models\HealthAssessment;
use App\Models\Prescription;
use App\Models\Goal;
use App\Models\Activity;
use App\Models\SleepRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Si l'utilisateur n'a pas encore de tableau de bord, on en crée un par défaut
        if (!$user->dashboard) {
            $user->dashboard()->create([
                'last_consultation' => now()->subDays(30),
                'average_heart_rate' => 70,
                'daily_step_goal' => 10000,
                'sleep_quality' => '7 heures',
                'heart_rate_data' => json_encode([72, 75, 78, 77, 80, 76, 73]),
                'activity_data' => json_encode([30, 40, 30])
            ]);
        }
        
        // Récupérer les données dynamiques du tableau de bord
        $dashboard = $user->dashboard;
        
        // Récupérer l'évaluation de santé de l'utilisateur
        $healthAssessment = HealthAssessment::where('user_id', $user->id)->first();
        
        // Vérifier s'il y a des prescriptions en cours pour l'utilisateur
        $hasOngoingTreatment = Prescription::where('user_id', $user->id)
            ->where('end_date', '>', now())
            ->exists();

        // Récupérer les objectifs personnels, activités et suivi du sommeil
        $goals = Goal::where('user_id', $user->id)->get();
        $activities = Activity::where('user_id', $user->id)->get();
        $sleepRecords = SleepRecord::where('user_id', $user->id)->get();

        return view('dashboard', compact('dashboard', 'healthAssessment', 'hasOngoingTreatment', 'goals', 'activities', 'sleepRecords'));
    }

    /**
     * Affiche le formulaire de paramètres
     */
    public function showSettings()
    {
        $user = Auth::user();
        $dashboard = $user->dashboard;
        $healthAssessment = HealthAssessment::where('user_id', $user->id)->first();
        
        return view('dashboard.settings', compact('dashboard', 'healthAssessment'));
    }

    /**
     * Met à jour les paramètres du tableau de bord
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'daily_step_goal' => 'nullable|numeric|min:1000|max:50000',
            'sleep_quality' => 'nullable|numeric|min:1|max:24',
            'last_consultation' => 'nullable|date',
            'average_heart_rate' => 'nullable|numeric|min:40|max:200',
        ]);

        $user = Auth::user();
        $dashboard = $user->dashboard;

        $dashboard->update([
            'daily_step_goal' => $request->daily_step_goal ?? $dashboard->daily_step_goal,
            'sleep_quality' => $request->sleep_quality ?? $dashboard->sleep_quality,
            'last_consultation' => $request->last_consultation ?? $dashboard->last_consultation,
            'average_heart_rate' => $request->average_heart_rate ?? $dashboard->average_heart_rate,
        ]);

        return redirect()->route('settings')
            ->with('success', 'Vos paramètres ont été mis à jour avec succès.');
    }

    /**
     * Gère le questionnaire de santé
     */
    public function storeHealthAssessment(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
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

        // Créer ou mettre à jour l'évaluation de santé
        HealthAssessment::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return redirect()->route('dashboard')
            ->with('success', 'Vos informations de santé ont été enregistrées avec succès.');
    }

    /**
     * Met à jour le questionnaire de santé
     */
    public function updateHealthAssessment(Request $request)
    {
        $healthAssessment = HealthAssessment::where('user_id', auth()->id())->firstOrFail();
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|numeric|min:0|max:150',
            'poids' => 'required|numeric|min:0|max:500',
            'taille' => 'required|numeric|min:0|max:300',
            'rhesus' => 'required|string',
            'allergies' => 'nullable|string',
        ]);

        // Recalcul de l'IMC
        $taille_en_metres = $validated['taille'] / 100;
        $imc = $validated['poids'] / ($taille_en_metres * $taille_en_metres);
        $validated['imc'] = round($imc, 2);

        $healthAssessment->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Vos informations de santé ont été mises à jour avec succès.');
    }

    /**
     * Affiche les paramètres du tableau de bord
     */
    public function settings()
    {
        return $this->showSettings();
    }

    /**
     * Diagnostic basé sur les symptômes fournis
     */
    public function showDiagnosticForm()
    {
        return view('diagnosis.form');
    }

    public function diagnose(Request $request)
    {
        $validated = $request->validate([
            'symptoms' => 'required|array|min:1',
            'symptoms.*' => 'required|string',
        ]);

        // Base de données fictive pour des diagnostics basés sur les symptômes
        $diagnosisDatabase = [
            'fièvre' => 'Grippe',
            'toux' => 'Rhume',
            'maux de tête' => 'Migraine',
            'douleur abdominale' => 'Gastro-entérite',
            'fatigue' => 'Anémie',
            'douleurs articulaires' => 'Arthrite',
            'essoufflement' => 'Asthme',
            'douleur thoracique' => 'Problèmes cardiaques',
            'démangeaisons' => 'Allergie',
            'nausée' => 'Intoxication alimentaire',
        ];

        // Analyse des symptômes et détermination de la maladie la plus probable
        $mostProbableDiagnosis = 'Inconnu';
        $matches = [];

        foreach ($validated['symptoms'] as $symptom) {
            if (array_key_exists($symptom, $diagnosisDatabase)) {
                $matches[] = $diagnosisDatabase[$symptom];
            }
        }

        if (count($matches) > 0) {
            $mostProbableDiagnosis = implode(', ', array_unique($matches));
        }

        return view('diagnosis.result', compact('mostProbableDiagnosis'));
    }

}
