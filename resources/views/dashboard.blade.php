@extends('layouts.main')

@section('title', 'Tableau de Bord Santé')

@section('content')


    <!-- Bienvenue Utilisateur -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bonjour, {{ Auth::user()->name }} !</h1>
        
        <!-- Bouton pour modifier les informations de santé -->
        <a href="{{ route('dashboard.settings') }}" class="btn btn-sm btn-warning shadow-sm">
            <i class="fas fa-edit fa-sm text-white-50"></i> Modifier les Informations
        </a>
    
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Télécharger le Rapport
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Section de Statistiques de Santé -->
    <div class="row">
        <!-- Dernière Consultation Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Dernière Consultation</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboard->last_consultation ?? 'N/A' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fréquence Cardiaque Moyenne Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Fréquence Cardiaque Moyenne</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboard && is_numeric($dashboard->average_heart_rate) ? $dashboard->average_heart_rate : 'N/A' }} BPM</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Objectif de Pas Quotidien -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Objectif de Pas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $dashboard && is_numeric($dashboard->daily_step_goal) ? $dashboard->daily_step_goal : 'N/A' }} / 10,000
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-walking fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Qualité du Sommeil -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Qualité du Sommeil</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $dashboard && is_numeric($dashboard->sleep_quality) ? $dashboard->sleep_quality : 'N/A' }} h
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des Progrès -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <!-- Card Progrès Hebdomadaire -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Progrès Hebdomadaire</h6>
                    <!-- Icône d'aide générale -->
                    <i class="fas fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" title="Cette section montre votre progrès hebdomadaire sur divers objectifs de santé."></i>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold d-flex align-items-center">
                        Étapes Complétées
                        <span class="float-right ml-auto">{{ $dashboard && is_numeric($dashboard->daily_step_goal) ? round($dashboard->daily_step_goal / 10000 * 100, 2) : 'N/A' }}%</span>
                        <!-- Icône d'information pour Étapes Complétées -->
                        <i class="fas fa-info-circle text-info ml-2" data-toggle="tooltip" data-placement="top" title="Cet objectif suit le nombre de pas effectués sur une base quotidienne par rapport à votre objectif de 10 000 pas."></i>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $dashboard && is_numeric($dashboard->daily_step_goal) ? $dashboard->daily_step_goal / 10000 * 100 : 0 }}%" aria-valuenow="{{ $dashboard && is_numeric($dashboard->daily_step_goal) ? $dashboard->daily_step_goal / 10000 * 100 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <h4 class="small font-weight-bold d-flex align-items-center">
                        Objectif de Sommeil
                        <span class="float-right ml-auto">{{ $dashboard && is_numeric($dashboard->sleep_quality) ? round($dashboard->sleep_quality * 100 / 8, 2) : 'N/A' }}%</span>
                        <!-- Icône d'information pour Objectif de Sommeil -->
                        <i class="fas fa-info-circle text-primary ml-2" data-toggle="tooltip" data-placement="top" title="Votre objectif de sommeil vise à atteindre 8 heures de sommeil par nuit."></i>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $dashboard && is_numeric($dashboard->sleep_quality) ? $dashboard->sleep_quality * 100 / 8 : 0 }}%" aria-valuenow="{{ $dashboard && is_numeric($dashboard->sleep_quality) ? $dashboard->sleep_quality * 100 / 8 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
    </div>
    @if($hasOngoingTreatment)
    <div class="notification-red-blink" id="notification">
        <br>
        <p>Vous avez un traitement en cours ! N'oubliez pas de suivre vos prescriptions.</p>
        <button class="btn btn-success btn-sm" id="treatment-done">Traitement pris</button>
        <a href="{{ route('prescriptions.index')}}" class="btn btn-info btn-sm" id="more-info">Plus d'infos</a>
        <span class="close-btn" id="close-btn">&times;</span>
    </div>
@endif

<style>
    .notification-red-blink {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: red;
        color: white;
        padding: 15px;
        border-radius: 5px;
        z-index: 2;
    }

    .close-btn {
        font-size: 20px;
        color: white;
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
    }

    #notification {
        display: none;
    }

    .btn-info {
        margin-left: 10px;
    }
</style>

<script>
    document.getElementById('treatment-done').addEventListener('click', function() {
        document.getElementById('notification').style.display = 'none';
    });

    document.getElementById('close-btn').addEventListener('click', function() {
        document.getElementById('notification').style.display = 'none';
    });

    // Afficher la notification si traitement en cours
    @if($hasOngoingTreatment)
        document.getElementById('notification').style.display = 'block';
    @endif
</script>


    <!-- Résultats de l'Évaluation de Santé -->
    @if(isset($healthAssessment))
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Résultats de l'Évaluation de Santé</h6>
        </div>
        <div class="card-body text-center">
            @php
                $imcColor = 'text-success';
                $imcMessage = '';
                if ($healthAssessment['imc'] < 18.5) {
                    $imcColor = 'text-warning';
                    $imcMessage = 'IMC inférieur à la normale, consultez un professionnel de santé.';
                } elseif ($healthAssessment['imc'] >= 18.5 && $healthAssessment['imc'] <= 24.9) {
                    $imcColor = 'text-success';
                    $imcMessage = 'IMC normal. Continuez à maintenir un mode de vie sain !';
                } elseif ($healthAssessment['imc'] >= 25 && $healthAssessment['imc'] <= 29.9) {
                    $imcColor = 'text-warning';
                    $imcMessage = 'IMC indique un surpoids. Pensez à une alimentation équilibrée et à l\'exercice.';
                } else {
                    $imcColor = 'text-danger';
                    $imcMessage = 'IMC indique une obésité. Consultez un professionnel de santé.';
                }
            @endphp

            <h2 class="font-weight-bold {{ $imcColor }}">IMC : {{ $healthAssessment['imc'] }}</h2>
            <p class="{{ $imcColor }}">{{ $imcMessage }}</p>
            <p class="text-muted">Évaluation réalisée le : {{ \Carbon\Carbon::parse($healthAssessment['created_at'])->format('d/m/Y') }}</p>
            <a href="{{ route('health.assessment.form') }}" class="btn btn-primary">Refaire un test</a>
        </div>
    </div>
    @else
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Évaluation de Santé</h6>
        </div>
        <div class="card-body text-center">
            <p class="text-muted">Vous n'avez pas encore fait votre évaluation de santé. Cliquez sur le bouton ci-dessous pour commencer.</p>
            <a href="{{ route('health.assessment.form') }}" class="btn btn-primary">Faire le Test</a>
        </div>
    </div>
    @endif
@endsection