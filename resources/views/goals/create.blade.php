@extends('layouts.main')

@section('title', 'Créer un Nouvel Objectif')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Créer un Nouvel Objectif</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('goals.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Titre de l'objectif :</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="step_goal">Objectif  :</label>
                    <input type="number" name="step_goal" id="step_goal" class="form-control" min="1000" max="50000" required>
                </div>
                <div class="form-group">
                    <label for="status">Statut :</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="in_progress">En cours</option>
                        <option value="achieved">Atteint</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection
