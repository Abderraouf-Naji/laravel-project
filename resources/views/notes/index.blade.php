@extends('layouts.app')

@section('title')
    Notes
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center bg-white shadow-sm p-3 rounded mb-4">
        <h2>Notes</h2>
        <a href="{{ route('notes.create') }}" class="btn btn-primary">Ajouter une Note</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($notes as $note)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $note->title }}</h5>
                        <p class="card-text">{{ Str::limit($note->content, 150) }}</p>
                        <p class="card-text"><strong>Date:</strong> {{ $note->date }}</p>
                        <p class="card-text"><strong>Heure:</strong> {{ $note->time }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucune note trouvée.</p>
        @endforelse
    </div>
</div>
@endsection
