@extends('layouts.app')

@section('title')
    Projets
@endsection

@section('content')
    <div class="container">
        <!-- En-tête de la page avec le titre et le bouton Ajouter un projet -->
        <div class="d-flex justify-content-between align-items-center bg-white mb-4 shadow-sm p-3 rounded">
            <h2>Projets</h2>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Ajouter un projet</a>
        </div>

        <!-- Affichage des messages de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des projets -->
        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Informations sur le projet -->
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text">
                                <strong>Status:</strong> 
                                {{ $project->status == 'pending' ? 'En attente' : ($project->status == 'on_going' ? 'En cours' : 'Terminé') }}<br>
                                <strong>Date limite:</strong> 
                                @if($project->end_date && $project->end_date->isFuture())
                                    {{ $project->end_date->diffForHumans() }}
                                @else
                                    <span class="text-danger">Date limite dépassée</span>
                                @endif
                            </p>
                            <!-- Boutons d'actions -->
                            <a href="{{ route('projects.tasks.index', $project->id) }}" class="btn btn-primary"> <i class="bi bi-list"></i> </a>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary"> <i class="bi bi-eye"></i> </a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning"> <i class="bi bi-pencil-square"></i> </a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')"> <i class="bi bi-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
