@extends('layouts.main')

@section('title', 'Modifier un Objectif')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Modifier l'objectif</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('goals.update', $goal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titre de l'objectif :</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $goal->title }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ $goal->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="step_goal">Objectif :</label>
                    <input type="number" name="step_goal" id="step_goal" class="form-control" min="1000" max="50000" value="{{ $goal->step_goal }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Statut :</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="in_progress" {{ $goal->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                        <option value="achieved" {{ $goal->status == 'achieved' ? 'selected' : '' }}>Atteint</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection
