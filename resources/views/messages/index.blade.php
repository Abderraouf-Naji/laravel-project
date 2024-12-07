@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Messages</h1>
    <ul class="list-group">
        @foreach ($messages as $message)
            <li class="list-group-item">
                <strong>{{ $message['sender'] }}</strong>: {{ $message['content'] }}
                <a href="{{ route('messages.show', $message['id']) }}" class="btn btn-sm btn-primary float-end">Voir</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
