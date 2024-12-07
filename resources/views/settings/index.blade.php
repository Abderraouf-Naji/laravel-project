@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Paramètres</h1>
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="theme" class="form-label">Thème</label>
            <select name="theme" id="theme" class="form-control">
                <option value="clair" {{ $settings['theme'] == 'clair' ? 'selected' : '' }}>Clair</option>
                <option value="sombre" {{ $settings['theme'] == 'sombre' ? 'selected' : '' }}>Sombre</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notifications" class="form-label">Notifications</label>
            <input type="checkbox" name="notifications" id="notifications" {{ $settings['notifications'] ? 'checked' : '' }}>
        </div>

        <div class="mb-3">
            <label for="language" class="form-label">Langue</label>
            <select name="language" id="language" class="form-control">
                <option value="fr" {{ $settings['language'] == 'fr' ? 'selected' : '' }}>Français</option>
                <option value="en" {{ $settings['language'] == 'en' ? 'selected' : '' }}>Anglais</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </form>
</div>
@endsection
