@extends('layouts.main')

@section('title', 'Formulaire de Diagnostic Complet')

@section('content')

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulaire de Diagnostic de Symptômes</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('diagnosis.diagnose') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="symptoms_description">Décrivez vos symptômes :</label>
                    <textarea id="symptoms_description" name="symptoms_description" class="form-control" rows="5" required placeholder="Entrez vos symptômes ici..."></textarea>
                </div>
                <div class="form-group">
                    <label for="pain_level">Niveau de douleur (1-10) :</label>
                    <input type="number" id="pain_level" name="pain_level" class="form-control" min="1" max="10" placeholder="1 (faible) - 10 (sévère)">
                </div>
                <div class="form-group">
                    <label for="duration">Durée des symptômes :</label>
                    <input type="text" id="duration" name="duration" class="form-control" placeholder="Par exemple : 2 jours, 1 semaine">
                </div>
                <div class="form-group">
                    <label for="age">Âge :</label>
                    <input type="number" id="age" name="age" class="form-control" min="0" max="150" placeholder="Entrez votre âge">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Soumettre</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
