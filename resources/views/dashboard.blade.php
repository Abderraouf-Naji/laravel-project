@extends('layouts.app')
@section('title')
    Tableau de bord
@endsection
@section('content')
    <div class="container">
        <h2>Bienvenue sur votre tableau de bord</h2>
        <p>Ceci est votre espace où vous pouvez gérer vos tâches, routines, notes et fichiers.</p>
        
        <div class="row mb-4">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Tâches</h5>
                        <p class="card-text flex-grow-1">Vous avez <strong>{{ $tasksCount }}</strong> tâches en attente.</p>
                        <a href="{{ route('projects.index') }}" class="btn btn-primary mt-auto">Voir les Tâches</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Routines</h5>
                        <p class="card-text flex-grow-1">Vous avez <strong>{{ $routinesCount }}</strong> routines prévues aujourd'hui.</p>
                        <a href="{{ route('routines.index') }}" class="btn btn-primary mt-auto">Voir les Routines</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Notes</h5>
                        <p class="card-text flex-grow-1">Vous avez <strong>{{ $notesCount }}</strong> notes enregistrées.</p>
                        <a href="{{ route('notes.index') }}" class="btn btn-primary mt-auto">Voir les Notes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Fichiers</h5>
                        <p class="card-text flex-grow-1">Vous avez <strong>{{ $filesCount }}</strong> fichiers.</p>
                        <a href="{{ route('files.index') }}" class="btn btn-primary mt-auto">Voir les Fichiers</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Tâches récentes</h5>
                        <ul class="list-group flex-grow-1">
                            @foreach($recentTasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $task->title }}
                                    <span class="badge bg-primary rounded-pill">{{ $task->status == 'to_do' ? 'À Faire' : 'En Cours' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Routines du jour</h5>
                        <ul class="list-group flex-grow-1">
                            @foreach($todayRoutines as $routine)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $routine->title }}
                                    <span class="badge bg-primary rounded-pill">{{ $routine->frequency }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Notes récentes</h5>
                        <ul class="list-group flex-grow-1">
                            @foreach($recentNotes as $note)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $note->title }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Rappels à venir</h5>
                        <ul class="list-group flex-grow-1">
                            @foreach($upcomingReminders as $reminder)
                                <li class="list-group-item d-flex justify-content-between align-items-center {{ $reminder->date->isToday() ? 'bg-warning' : ($reminder->date->isPast() ? 'bg-danger' : 'bg-success') }}">
                                    {{ $reminder->title }}
                                    <span class="badge bg-primary rounded-pill">{{ $reminder->date->format('d M') }} {{ $reminder->time ? $reminder->time->format('H:i') : '' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
