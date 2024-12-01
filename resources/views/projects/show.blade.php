@extends('layouts.app')

@section('title')
    {{ $project->name }} - Détails du Projet
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4 shadow-sm p-3 rounded bg-white text-center"> {{ $project->name }}</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->name }}</h5>
                        <p class="card-text">{{ $project->description }}</p>
                        <p class="card-text"><strong>Date de début :</strong>
                            {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}</p>
                        <p class="card-text"><strong>Date de fin :</strong>
                            {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}</p>
                        <p class="card-text"><strong>Statut :</strong>
                            {{ $project->status == 'pending' ? 'En attente' : ($project->status == 'on_going' ? 'En cours' : 'Terminé') }}
                        </p>
                        <p class="card-text"><strong>Budget :</strong> ${{ $project->budget }}</p>

                        <h5 class="mt-4">Progression du projet</h5>
                        @php
                            $totalTasks = $project->tasks->count();
                            $completedTasks = $project->tasks->where('status', 'completed')->count();
                            $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                        @endphp
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;"
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                {{ round($progress) }}%</div>
                        </div>

                        <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Retour aux Projets</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title"> Membres de l'Équipe </h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addMemberModal"> <i class="bi bi-plus-circle"></i> </button>
                        </div>

                        <div class="row">
                            @foreach ($teamMembers as $user)
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <p class="card-title fw-bolder">{{ $user->name }}</p>
                                                    <p class="card-text">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter un membre de l'équipe -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Ajouter un membre à l'équipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.addMember') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Sélectionner un utilisateur</label>
                            <select class="form-select" name="user_id" id="">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ajouter le membre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
