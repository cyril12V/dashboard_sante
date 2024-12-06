@extends('layouts.main')

@section('title', 'Résultat du Diagnostic')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Résultat du Diagnostic</h4>
        </div>
        <div class="card-body">
            <p>{{ $diagnosisMessage }}</p>
            <a href="{{ route('diagnosis.form') }}" class="btn btn-secondary">Faire un nouveau diagnostic</a>
        </div>
    </div>
</div>
@endsection
