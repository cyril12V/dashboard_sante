@extends('layouts.main')

@section('title', 'Questionnaire de Santé')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Questionnaire de Santé</h6>
    </div>
    <div class="card-body">
        @if(session('health_status'))
            <div class="alert {{ session('health_status')[0] }}">
                {{ session('health_status')[1] }}
            </div>
        @endif

        <form action="{{ route('health.assessment') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="age">Âge</label>
                    <input type="number" class="form-control @error('age') is-invalid @enderror" 
                           id="age" name="age" value="{{ old('age') }}" required>
                    @error('age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="poids">Poids (kg)</label>
                    <input type="number" step="0.1" class="form-control @error('poids') is-invalid @enderror" 
                           id="poids" name="poids" value="{{ old('poids') }}" required>
                    @error('poids')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="taille">Taille (cm)</label>
                    <input type="number" class="form-control @error('taille') is-invalid @enderror" 
                           id="taille" name="taille" value="{{ old('taille') }}" required>
                    @error('taille')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rhesus">Groupe Sanguin + Rhésus</label>
                    <select class="form-control @error('rhesus') is-invalid @enderror" 
                            id="rhesus" name="rhesus" required>
                        <option value="">Choisir...</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    @error('rhesus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="allergies">Liste des Allergies</label>
                    <textarea class="form-control @error('allergies') is-invalid @enderror" 
                              id="allergies" name="allergies" rows="2">{{ old('allergies') }}</textarea>
                    @error('allergies')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Analyser ma santé</button>
        </form>
    </div>
</div>
@endsection
