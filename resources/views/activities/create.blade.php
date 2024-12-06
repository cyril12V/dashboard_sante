@extends('layouts.main')

@section('title', 'Ajouter une Activité')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0">Ajouter une Activité</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('activities.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="activity_type">Type d'Activité :</label>
                    <input type="text" id="activity_type" name="activity_type" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="duration">Durée (minutes) :</label>
                    <input type="number" id="duration" name="duration" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Ajouter l'Activité</button>
            </form>
        </div>
    </div>
</div>
@endsection
