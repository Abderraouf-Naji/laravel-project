@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modifier la Tâche</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Date d'échéance</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}">
                @error('due_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priorité</label>
                <select name="priority" id="priority" class="form-select" required>
                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Basse</option>
                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Moyenne</option>
                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Haute</option>
                </select>
                @error('priority')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour la Tâche</button>
        </form>
    </div>
@endsection
