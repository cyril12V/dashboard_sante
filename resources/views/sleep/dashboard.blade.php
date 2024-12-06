@extends('layouts.main')

@section('title', 'Tableau de Bord du Sommeil')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm mb-4 border-0 rounded-lg">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0">Tableau de Bord du Sommeil</h4>
            <a href="{{ route('sleep.create') }}" class="btn btn-outline-light btn-sm float-right">Ajouter une Entrée de Sommeil</a>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <!-- Graphique du Sommeil -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5>Heures de Sommeil</h5>
                            <canvas id="sleepLineChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Historique des Heures de Sommeil avec Modification et Suppression -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5>Historique du Sommeil</h5>
                            @if($sleepRecords->isEmpty())
                                <p class="text-muted">Aucune entrée de sommeil trouvée. Veuillez en ajouter une.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($sleepRecords as $sleepRecord)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <span>{{ \Carbon\Carbon::parse($sleepRecord->date)->format('d M, Y') }} </span> 
                                                <span class="badge badge-primary">{{ $sleepRecord->hours_slept }} heures</span>
                                            </div>
                                            <div>
                                                <a href="{{ route('sleep.edit', $sleepRecord->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                <form action="{{ route('sleep.destroy', $sleepRecord->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?')">Supprimer</button>
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

            <!-- Conseils et Calculateur de Cycle de Sommeil -->
            <div class="mt-4">
                <h5>Conseils de Sommeil Personnalisés :</h5>
                <div class="alert alert-warning p-4 rounded-lg shadow-sm">
                    @php
                        $averageSleep = $sleepRecords->avg('hours_slept');
                    @endphp
                    @if($averageSleep < 7)
                        Vous dormez en moyenne moins de 7 heures par nuit. Essayez d'établir une routine régulière et d'éviter les écrans avant de dormir.
                    @else
                        Félicitations, vous dormez suffisamment ! Essayez de maintenir ce rythme pour rester en bonne santé.
                    @endif
                </div>

                <div class="mt-4">
                    <h5>Calculateur de Cycle de Sommeil :</h5>
                    <div class="card border-0 shadow-sm p-4">
                        <div class="form-group">
                            <label for="wake_up_time">Heure à laquelle vous souhaitez vous réveiller :</label>
                            <input type="time" id="wake_up_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sleep_hours">Combien d'heures souhaitez-vous dormir :</label>
                            <input type="number" id="sleep_hours" class="form-control" min="1" max="12" placeholder="Entrez les heures de sommeil souhaitées">
                        </div>
                        <button id="calculateBedTime" class="btn btn-primary">Calculer l'Heure de Coucher</button>
                        <div id="suggestedBedTime" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('sleepLineChart').getContext('2d');
    var sleepDates = {!! json_encode($sleepDates) !!};
    var sleepHours = {!! json_encode($sleepHours) !!};

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: sleepDates,
            datasets: [{
                label: 'Heures de Sommeil',
                data: sleepHours,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('calculateBedTime').addEventListener('click', function() {
        var wakeUpTime = document.getElementById('wake_up_time').value;
        var sleepHours = parseInt(document.getElementById('sleep_hours').value);
        
        if (wakeUpTime && sleepHours) {
            var wakeTime = new Date('1970-01-01T' + wakeUpTime + 'Z');
            wakeTime.setHours(wakeTime.getHours() - sleepHours);
            var suggestedBedTime = wakeTime.toTimeString().slice(0, 5);
            document.getElementById('suggestedBedTime').innerHTML = '<strong>Heure de coucher suggérée :</strong> ' + suggestedBedTime;
        } else {
            alert('Veuillez entrer une heure de réveil et une durée de sommeil.');
        }
    });
</script>
@endsection
