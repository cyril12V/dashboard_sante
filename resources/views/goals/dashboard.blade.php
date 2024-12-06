@extends('layouts.main')

@section('title', 'Tableau de Bord des Objectifs')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Mes Objectifs Personnels</h4>
        <a href="{{ route('goals.create') }}" class="btn btn-primary">Créer un Nouvel Objectif</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($goals->isEmpty())
                <p>Aucun objectif trouvé. Cliquez sur "Créer un Nouvel Objectif" pour en ajouter un.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Objectif </th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($goals as $goal)
                            <tr>
                                <td>{{ $goal->title }}</td>
                                <td>{{ $goal->description }}</td>
                                <td>{{ $goal->step_goal }}</td>
                                <td>{{ $goal->status == 'in_progress' ? 'En cours' : 'Atteint' }}</td>
                                <td>
                                    <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
