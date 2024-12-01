@extends('layouts.app')

@section('title')
    Ajouter une Note
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4 shadow-sm p-3 rounded bg-white">Ajouter une Note</h2>
        <div class="card border-0 shadow-sm m-auto" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('notes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu</label>
                        <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Heure</label>
                        <input type="time" name="time" id="time" class="form-control">
                        @error('time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter la Note</button>
                </form>
            </div>
        </div>
    </div>
@endsection
