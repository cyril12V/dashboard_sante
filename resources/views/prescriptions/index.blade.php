@extends('layouts.main')

@section('title', 'Traitement & Prescription')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Traitement & Prescription</h2>
        <div>
            <a href="{{ route('prescriptions.create') }}" class="btn btn-primary">
                Ajouter une Prescription
            </a>
           <!-- <button id="enable-notifications" class="btn btn-secondary ml-2">
                Activer les Notifications -->
            </button>
        </div>
    </div>

    @if($prescriptions->isEmpty())
        <p>Aucune prescription trouvée. Cliquez sur "Ajouter une Prescription" pour commencer.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom du Médicament</th>
                    <th>Rythme de la Prise</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prescriptions as $prescription)
                    <tr>
                        <td>{{ $prescription->medication_name }}</td>
                        <td>{{ $prescription->dosage }}</td>
                        <td>{{ $prescription->start_date }}</td>
                        <td>{{ $prescription->end_date }}</td>
                        <td>
                            <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Calendrier des prescriptions -->
    <div id="calendar" class="mt-5"></div>
</div>



<!-- Ajout des fichiers CSS et JS de FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

<!-- Script pour initialiser FullCalendar -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr', // Langue française
            events: function(fetchInfo, successCallback, failureCallback) {
                // Requête AJAX vers la route JSON
                $.ajax({
                    url: '{{ route("prescriptions.json") }}', // Cette route renvoie les prescriptions de l'utilisateur connecté
                    method: 'GET',
                    success: function(data) {
                        successCallback(data);
                    },
                    error: function() {
                        alert("Erreur lors de la récupération des prescriptions !");
                        failureCallback();
                    }
                });
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventColor: '#3788d8', // Couleur des événements par défaut
        });
        calendar.render();
    });
</script>

@endsection
