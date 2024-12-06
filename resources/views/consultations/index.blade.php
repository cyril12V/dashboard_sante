@extends('layouts.main')

@section('title', 'Historique des Consultations')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Historique des Consultations</h2>
        <a href="{{ route('consultations.create') }}" class="btn btn-primary">Ajouter une Consultation</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($consultations->isEmpty())
        <p>Aucune consultation trouvée. Ajoutez une nouvelle consultation pour commencer.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Médecin</th>
                    <th>Prescription</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $consultation)
                    <tr>
                        <td>{{ $consultation->date }}</td>
                        <td>{{ $consultation->doctor_name }}</td>
                        <td>{{ $consultation->prescription ?? 'N/A' }}</td>
                        <td>{{ $consultation->notes ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
