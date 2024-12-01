<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-circle.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .card-header {
            background-color: black;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .card-header img {
            filter: invert(100%) brightness(200%);
        }

        .btn-primary {
            background-color: black;
            border-color: #495057;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #343a40;
            border-color: #343a40;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .form-check-label {
            font-weight: 500;
        }

        .text-danger {
            font-size: 0.875rem;
        }

        .card-footer a {
            color: #495057;
            font-weight: 500;
            text-decoration: none;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-center p-4 fs-1">
                    <img src="{{ asset('assets/img/logo-horizontal.png') }}" class="img-fluid" alt="Task Manager">
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mb-0">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
                    </div>
                </div>

                <div class="card-footer text-center">
                   <p>Développé par : <a class="text-decoration-none" href="https://github.com/Abderraouf-Naji" target="_blank">Naji Abderraouf</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
