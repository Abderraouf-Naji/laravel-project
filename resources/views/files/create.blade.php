@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 shadow-sm p-3 rounded bg-white">Télécharger un fichier</h2>
        <div class="card border-0 shadow-sm m-auto" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du fichier</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Choisir un fichier</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type de fichier</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="project">Projet</option>
                            <option value="docs">Documents</option>
                            <option value="txt">Texte</option>
                            <option value="code">Code</option>
                            <option value="image">Image</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Télécharger</button>
                </form>
            </div>
        </div>
    </div>
@endsection
