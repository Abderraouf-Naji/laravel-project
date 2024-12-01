@extends('layouts.app')
@section('title')
    Créer une Tâche
@endsection
@section('content')
    <div class="container">
        <h2 class="mb-4">Créer une Tâche</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Date d'échéance</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
                @error('due_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priorité</label>
                <select name="priority" id="priority" class="form-select" required>
                    <option value="low">Basse</option>
                    <option value="medium">Moyenne</option>
                    <option value="high">Haute</option>
                </select>
                @error('priority')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Créer la Tâche</button>
        </form>
    </div>
@endsection
