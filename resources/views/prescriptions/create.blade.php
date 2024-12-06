@extends('layouts.main')

@section('title', 'Ajouter une Prescription')

@section('content')
<div class="container mt-4">
    <h2>Ajouter une Prescription</h2>

    <form action="{{ route('prescriptions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="medication_name">Nom du Médicament</label>
            <input type="text" class="form-control" id="medication_name" name="medication_name" required>
        </div>

        <div class="form-group">
            <label for="dosage">Rythme de la Prise</label>
            <input type="text" class="form-control" id="dosage" name="dosage" required>
        </div>

        <div class="form-group">
            <label for="start_date">Date de Début</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="form-group">
            <label for="end_date">Date de Fin</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Ajouter la Prescription</button>
    </form>
</div>
@endsection
