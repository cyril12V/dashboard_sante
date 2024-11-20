@extends('layouts.main')

@section('title', 'Paramètres du Profil')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Paramètres du Profil</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nom -->
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Informations médicales -->
        <div class="form-group">
            <label for="medical_info">Informations médicales</label>
            <textarea name="medical_info" class="form-control">{{ old('medical_info', $user->medical_info) }}</textarea>
        </div>

        <!-- Image de profil -->
        <div class="form-group">
            <label for="profile_image">Image de profil</label>
            @if($user->profile_image)
                <img src="{{ Storage::url($user->profile_image) }}" alt="Image de profil" class="img-thumbnail" style="width: 150px;">
            @endif
            <input type="file" name="profile_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
