@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 shadow-sm p-3 rounded bg-white">Modifier le fichier</h2>
        <div class="card border-0 shadow-sm m-auto" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du fichier</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $file->name }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Choisir un fichier (Laissez vide pour garder le fichier actuel)</label>
                        <input type="file" name="file" id="file" class="form-control">
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type de fichier</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="project" {{ $file->type == 'project' ? 'selected' : '' }}>Projet</option>
                            <option value="docs" {{ $file->type == 'docs' ? 'selected' : '' }}>Documents</option>
                            <option value="txt" {{ $file->type == 'txt' ? 'selected' : '' }}>Texte</option>
                            <option value="code" {{ $file->type == 'code' ? 'selected' : '' }}>Code</option>
                            <option value="image" {{ $file->type == 'image' ? 'selected' : '' }}>Image</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection
