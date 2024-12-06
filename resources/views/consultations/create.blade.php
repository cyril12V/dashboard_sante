@extends('layouts.main')

@section('title', 'Ajouter une Consultation')

@section('content')
<div class="container mt-4">
    <h2>Ajouter une Consultation</h2>
    <form action="{{ route('consultations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="doctor_name">Nom du Médecin</label>
            <input type="text" class="form-control" id="doctor_name" name="doctor_name" required>
        </div>
        <div class="form-group">
            <label for="date">Date de la Consultation</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="prescription">Prescription</label>
            <textarea class="form-control" id="prescription" name="prescription" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter la Consultation</button>
    </form>
</div>
@endsection
