@extends('layouts.app')

@section('title')
    Modifier la Note
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4 shadow-sm p-3 rounded bg-white">Modifier la Note</h2>

    <form action="{{ route('notes.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $note->title }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $note->content }}</textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $note->date }}">
            @error('date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Heure</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ $note->time }}">
            @error('time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour la Note</button>
    </form>
</div>
@endsection
