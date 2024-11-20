<?php

namespace App\Data;

class DiseaseDatabase
{
    public static function getDatabase()
    {
        return [
            'Grippe' => [
                'symptomes' => ['fièvre' => 3, 'toux' => 2, 'maux de tête' => 2, 'fatigue' => 3],
                'description' => "Infection virale commune causant fièvre, toux et fatigue.",
            ],
            'Covid-19' => [
                'symptomes' => ['fièvre' => 4, 'toux' => 3, 'difficulté à respirer' => 5, 'perte de goût' => 4, 'douleurs musculaires' => 3],
                'description' => "Infection respiratoire causée par le coronavirus, pouvant causer une large gamme de symptômes.",
            ],
            'Angine' => [
                'symptomes' => ['mal de gorge' => 4, 'fièvre' => 3, 'douleurs musculaires' => 2, 'difficulté à avaler' => 3],
                'description' => "Inflammation des amygdales souvent causée par une infection bactérienne.",
            ],
            'Asthme' => [
                'symptomes' => ['respiration sifflante' => 5, 'difficulté à respirer' => 4, 'toux' => 2, 'oppression thoracique' => 3],
                'description' => "Maladie chronique affectant les voies respiratoires, entraînant des épisodes de difficulté respiratoire.",
            ],
            'Sinusite' => [
                'symptomes' => ['douleurs faciales' => 3, 'nez bouché' => 4, 'maux de tête' => 3, 'fatigue' => 2],
                'description' => "Inflammation des sinus souvent associée à des douleurs faciales et une congestion nasale.",
            ],
            'Gastroentérite' => [
                'symptomes' => ['nausée' => 4, 'vomissements' => 3, 'diarrhée' => 5, 'maux de ventre' => 3],
                'description' => "Inflammation de l'estomac et des intestins provoquant des nausées, vomissements et diarrhées.",
            ],
            'Anémie' => [
                'symptomes' => ['fatigue' => 4, 'essoufflement' => 3, 'pâleur' => 3, 'maux de tête' => 2],
                'description' => "Réduction du nombre de globules rouges entraînant une fatigue et une faiblesse.",
            ],
            'Diabète' => [
                'symptomes' => ['soif excessive' => 4, 'urination fréquente' => 4, 'perte de poids' => 3, 'fatigue' => 2],
                'description' => "Maladie chronique qui affecte la régulation de la glycémie.",
            ],
            'Hypertension' => [
                'symptomes' => ['maux de tête' => 3, 'essoufflement' => 2, 'douleur thoracique' => 4, 'vertiges' => 2],
                'description' => "Pression artérielle élevée pouvant mener à des complications cardiovasculaires.",
            ],
            'Dépression' => [
                'symptomes' => ['tristesse persistante' => 5, 'manque d\'énergie' => 4, 'troubles du sommeil' => 3, 'perte d\'intérêt' => 4],
                'description' => "Trouble de santé mentale caractérisé par une perte d'intérêt et une tristesse persistante.",
            ],
            'Migraine' => [
                'symptomes' => ['maux de tête' => 4, 'nausée' => 3, 'sensibilité à la lumière' => 3, 'vomissement' => 2],
                'description' => "Céphalée sévère caractérisée par une douleur pulsatile souvent accompagnée de nausées.",
            ],
            'Pneumonie' => [
                'symptomes' => ['fièvre' => 4, 'toux' => 3, 'difficulté à respirer' => 4, 'douleurs thoraciques' => 3, 'frissons' => 2],
                'description' => "Infection des poumons causée par des bactéries, virus ou champignons.",
            ],
            'Otite' => [
                'symptomes' => ['mal d\'oreille' => 4, 'fièvre' => 3, 'diminution de l\'audition' => 2, 'irritabilité' => 2],
                'description' => "Inflammation de l'oreille moyenne, souvent douloureuse.",
            ],
            'Arthrite' => [
                'symptomes' => ['douleurs articulaires' => 4, 'gonflement' => 3, 'raideur' => 3, 'difficulté à bouger' => 3],
                'description' => "Inflammation des articulations entraînant douleur et raideur.",
            ],
            'Hypothyroïdie' => [
                'symptomes' => ['fatigue' => 4, 'gain de poids' => 3, 'peau sèche' => 2, 'dépression' => 2],
                'description' => "Condition causée par une production insuffisante d'hormones thyroïdiennes.",
            ],
            // Ajouter encore plus de maladies...
        ];
    }
}
