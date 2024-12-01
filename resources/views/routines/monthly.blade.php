@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 shadow-sm p-3 rounded bg-white">Routines Mensuelles</h2>

    <div class="row">
        @forelse($monthlyRoutines as $routine)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $routine->title }}</h5>
                        <p class="card-text">{{ $routine->description }}</p>
                        <p class="card-text"><strong>Mois :</strong> 
                            {{ implode(', ', array_map(function($month) {
                                return DateTime::createFromFormat('!m', $month)->format('F');
                            }, json_decode($routine->months, true) ?? [])) }}
                        </p>
                        <p class="card-text"><strong>Heure :</strong> {{ $routine->start_time }} - {{ $routine->end_time }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('routines.edit', $routine->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('routines.destroy', $routine->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette routine ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Aucune routine mensuelle trouvée.</p>
        @endforelse
    </div>
</div>
@endsection
