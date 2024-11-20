@extends('layouts.main')

@section('title', 'Modifier Enregistrement de Sommeil')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0">Modifier Enregistrement de Sommeil</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sleep.update', $sleepRecord->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="hours_slept">Heures de Sommeil :</label>
                    <input type="number" id="hours_slept" name="hours_slept" class="form-control" min="1" max="24" value="{{ $sleepRecord->hours_slept }}" required>
                </div>
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" class="form-control" value="{{ $sleepRecord->date }}" required>
                </div>
                <button type="submit" class="btn btn-success">Mettre à Jour</button>
            </form>
        </div>
    </div>
</div>
@endsection
