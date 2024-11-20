@extends('layouts.main')

@section('title', 'Tableau de Bord des Activités Physiques')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm mb-4 border-0 rounded-lg">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0">Tableau de Bord des Activités Physiques</h4>
            <a href="{{ route('activities.create') }}" class="btn btn-outline-light btn-sm float-right">Ajouter une Activité</a>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <!-- Graphique en Camembert -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5>Répartition des Activités</h5>
                            <canvas id="activityPieChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Historique des Activités avec Modification et Suppression -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5>Historique des Activités</h5>
                            @if($activities->isEmpty())
                                <p class="text-muted">Aucune activité trouvée. Veuillez ajouter une activité.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($activities as $activity)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $activity->activity_type }}</strong> ({{ $activity->duration }} min) 
                                                <span class="text-muted">{{ \Carbon\Carbon::parse($activity->date)->format('d M, Y') }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">Supprimer</button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommandations Personnalisées -->
            <div class="mt-4">
                <h5>Recommandations Personnalisées :</h5>
                <div class="alert alert-info p-4 rounded-lg shadow-sm">
                    @php
                        $totalActivityMinutes = $activities->sum('duration');
                    @endphp
                    @if($totalActivityMinutes < 150)
                        <strong>Attention :</strong> Votre activité physique hebdomadaire est en dessous du minimum recommandé (150 minutes). Essayez d'inclure une activité modérée chaque jour, comme la marche ou le jogging !
                    @else
                        <strong>Bravo !</strong> Vous atteignez l'objectif de 150 minutes d'activité par semaine. Continuez comme ça !
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('activityPieChart').getContext('2d');
    var activityLabels = {!! json_encode($activities->pluck('activity_type')) !!};
    var activityDurations = {!! json_encode($activities->pluck('duration')) !!};

    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: activityLabels,
            datasets: [{
                label: 'Durée des Activités (minutes)',
                data: activityDurations,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endsection
