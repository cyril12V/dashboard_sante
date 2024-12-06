@extends('layouts.main')

@section('title', 'Modifier Activité Physique')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0">Modifier Activité Physique</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('activities.update', $activity->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="activity_type">Type d'Activité :</label>
                    <input type="text" id="activity_type" name="activity_type" class="form-control" value="{{ $activity->activity_type }}" required>
                </div>
                <div class="form-group">
                    <label for="duration">Durée (minutes) :</label>
                    <input type="number" id="duration" name="duration" class="form-control" value="{{ $activity->duration }}" required>
                </div>
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" class="form-control" value="{{ $activity->date }}" required>
                </div>
                <button type="submit" class="btn btn-success">Mettre à Jour</button>
            </form>
        </div>
    </div>
</div>
@endsection
