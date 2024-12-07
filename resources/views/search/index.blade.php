


@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ route('search.index') }}" method="GET">
    <input type="text" name="query" placeholder="Rechercher..." class="form-control">
    <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
</form>
</div>
@endsection