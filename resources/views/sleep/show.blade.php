@extends('layouts.main')

@section('title', 'Ajouter un Enregistrement du Sommeil')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Ajouter un Enregistrement du Sommeil</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('sleep.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="hours_slept">Heures de Sommeil :</label>
                    <input type="number" id="hours_slept" name="hours_slept" class="form-control" min="1" max="24" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
