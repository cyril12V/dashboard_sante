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
                    <label for="symptoms_description">Sélectionnez un symptôme :</label>
                    <select id="symptoms_description" name="symptoms_description" class="form-control" required>
                        <option value="">Sélectionnez un symptôme...</option>
                        <option value="fièvre">Fièvre</option>
                        <option value="toux sèche">Toux sèche</option>
                        <option value="maux de tête">Maux de tête</option>
                        <option value="douleur abdominale">Douleur abdominale</option>
                        <option value="fatigue">Fatigue</option>
                        <option value="perte de goût">Perte de goût</option>
                        <option value="nausée">Nausée</option>
                        <option value="diarrhée">Diarrhée</option>
                        <option value="mal de gorge">Mal de gorge</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pain_level">Niveau de douleur (1-10) :</label>
                    <select id="pain_level" name="pain_level" class="form-control" required>
                        <option value="">Sélectionnez le niveau de douleur...</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="duration">Durée des symptômes :</label>
                    <select id="duration" name="duration" class="form-control" required>
                        <option value="">Sélectionnez la durée...</option>
                        <option value="quelques heures">Quelques heures</option>
                        <option value="quelques jours">Quelques jours</option>
                        <option value="une semaine">Une semaine</option>
                        <option value="plusieurs semaines">Plusieurs semaines</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="age">Âge :</label>
                    <input type="number" id="age" name="age" class="form-control" min="0" max="150" placeholder="Entrez votre âge" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success">Soumettre</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
