@extends('layouts.main')

@section('title', 'Ajouter une Activité Physique')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Ajouter une Activité Physique</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('activities.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="activity_type">Type d'Activité :</label>
                    <input type="text" id="activity_type" name="activity_type" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="duration">Durée (en minutes) :</label>
                    <input type="number" id="duration" name="duration" class="form-control" min="1" max="180" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Ajouter Activité</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
