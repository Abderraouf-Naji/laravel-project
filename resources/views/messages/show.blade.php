@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Message #{{ $message['id'] }}</h1>
    <p><strong>De:</strong> {{ $message['sender'] }}</p>
    <p>{{ $message['content'] }}</p>
    <a href="{{ route('messages.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
