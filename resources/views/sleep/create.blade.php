@extends('layouts.main')

@section('title', 'Ajouter une Entrée de Sommeil')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Ajouter une Entrée de Sommeil</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('sleep.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="hours_slept">Heures de Sommeil :</label>
                    <input type="number" id="hours_slept" name="hours_slept" class="form-control" min="1" max="24" required>
                </div>
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Ajouter Entrée de Sommeil</button>
            </form>
        </div>
    </div>
</div>
@endsection
