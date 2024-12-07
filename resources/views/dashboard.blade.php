@extends('layouts.app')
@section('title')
    Tableau de bord
@endsection
@section('content')
    <div class="container py-4">
    <h2 >Bienvenue sur votre tableau de bord</h2>
    <p>Ceci est votre espace où vous pouvez gérer vos projets, tâches, routines et notes.</p>

        <!-- Section des statistiques principales -->
        <div class="row text-center mb-5">
            <div class="col-md-3">
                <div class="card shadow h-100 bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Projets</h5>
                        <p class="card-text display-4">{{ $projectsCount }}</p>
                        <a href="{{ route('projects.index') }}" class="btn btn-light btn-sm">Voir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow h-100 bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tâches</h5>
                        <p class="card-text display-4">{{ $tasksCount }}</p>
                        <a href="{{ route('projects.index') }}" class="btn btn-light btn-sm">Voir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow h-100 bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Routines</h5>
                        <p class="card-text display-4">{{ $routinesCount }}</p>
                        <a href="{{ route('routines.index') }}" class="btn btn-light btn-sm">Voir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow h-100 bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Notes</h5>
                        <p class="card-text display-4">{{ $notesCount }}</p>
                        <a href="{{ route('notes.index') }}" class="btn btn-light btn-sm">Voir</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section des listes interactives -->
        <div class="row">
            <!-- Tâches récentes -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Tâches Récentes</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            <span class="badge {{ $task->status == 'to_do' ? 'bg-warning' : 'bg-success' }}">
                                                {{ $task->status == 'to_do' ? 'À Faire' : 'En Cours' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Routines du jour -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Routines du Jour</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($todayRoutines as $routine)
                                <li class="list-group-item d-flex justify-content-between">
                                    {{ $routine->title }}
                                    <span class="badge bg-info">{{ $routine->frequency }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Notes récentes -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">Notes Récentes</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($recentNotes as $note)
                                <li class="list-group-item">{{ $note->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Rappels à venir -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-warning text-white">
                        <h5 class="card-title mb-0">Rappels à Venir</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($upcomingReminders as $reminder)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $reminder->title }}
                                    <span class="badge {{ $reminder->date->isToday() ? 'bg-warning' : ($reminder->date->isPast() ? 'bg-danger' : 'bg-success') }}">
                                        {{ $reminder->date->format('d M') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
