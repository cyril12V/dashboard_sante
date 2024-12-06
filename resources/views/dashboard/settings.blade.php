@extends('layouts.main')

@section('title', 'Paramètres de Santé')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Paramètres de Santé</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modifier vos Informations de Santé</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf

                    <div class="form-group">
                        <label for="daily_step_goal">Objectif de Pas Quotidien</label>
                        <input type="number" class="form-control @error('daily_step_goal') is-invalid @enderror"
                               id="daily_step_goal" name="daily_step_goal"
                               value="{{ old('daily_step_goal', $dashboard->daily_step_goal) }}"
                               min="0" max="50000">
                        @error('daily_step_goal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sleep_quality">Objectif de Sommeil (heures)</label>
                        <input type="number" class="form-control @error('sleep_quality') is-invalid @enderror"
                               id="sleep_quality" name="sleep_quality" step="0.5"
                               value="{{ old('sleep_quality', $dashboard->sleep_quality) }}"
                               min="1" max="24">
                        @error('sleep_quality')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_consultation">Dernière Consultation</label>
                        <input type="date" class="form-control @error('last_consultation') is-invalid @enderror"
                               id="last_consultation" name="last_consultation"
                               value="{{ old('last_consultation', $dashboard->last_consultation ? date('Y-m-d', strtotime($dashboard->last_consultation)) : '') }}">
                        @error('last_consultation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="average_heart_rate">Fréquence Cardiaque Moyenne (BPM)</label>
                        <input type="number" class="form-control @error('average_heart_rate') is-invalid @enderror"
                               id="average_heart_rate" name="average_heart_rate"
                               value="{{ old('average_heart_rate', $dashboard->average_heart_rate) }}"
                               min="40" max="200">
                        @error('average_heart_rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Enregistrer les Modifications
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection