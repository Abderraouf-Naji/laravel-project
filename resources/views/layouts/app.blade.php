<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Gestionnaire des Projets</title>
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-circle.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;1,300;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            background-color: rgb(241 245 249);
            font-family: "Noto Sans", sans-serif !important; 
        }

        .btn {
            padding: .25rem .5rem !important;
            font-size: .875rem !important;
        }

        .sidebar {
            width: 250px;
            background-color: black;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar .nav-link {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #495057;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #495057;
            border-radius: 0.25rem;
        }

        .sidebar .nav-link .bi {
            margin-right: 10px;
        }

        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .topnav {
            flex-shrink: 0;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .navbar-brand {
            font-weight: bold;
            color: #343a40;
        }

        .navbar-nav .nav-link {
            color: #343a40;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .card {
            border: none;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        footer {
            background-color: #ffffff;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
            flex-shrink: 0;
        }

        main {
            flex-grow: 1;
        }
    </style>
</head>

<body>

<div class="sidebar d-flex flex-column p-3">
    <h4 class="mb-4 text-center">
        <a href="{{ route('dashboard') }}">
            <img style="filter: invert(100%) brightness(200%);" src="{{ asset('assets/img/logo-circle-horizontal.png') }}" class="img-fluid" width="100%" alt="Gestionnaire de Projets">
        </a>
    </h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-house-door"></i> Accueil
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                <i class="bi bi-folder"></i> Projets
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('routines*') ? 'active' : '' }}" href="{{ route('routines.index') }}">
                <i class="bi bi-calendar-check"></i> Routines
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('notes*') ? 'active' : '' }}" href="{{ route('notes.index') }}">
                <i class="bi bi-sticky"></i> Notes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('reminders*') ? 'active' : '' }}" href="{{ route('reminders.index') }}">
                <i class="bi bi-bell"></i> Rappels
            </a>
        </li>
        <li class="nav-item">
    <a class="nav-link {{ request()->is('favorites*') ? 'active' : '' }}" href="{{ route('favorites.index') }}">
        <i class="bi bi-star-fill"></i> Favoris
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('search*') ? 'active' : '' }}" href="{{ route('search.index') }}">
        <i class="bi bi-search"></i> Recherche
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('messages*') ? 'active' : '' }}" href="{{ route('messages.index') }}">
        <i class="bi bi-envelope-fill"></i> Messages
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('settings*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
        <i class="bi bi-gear-fill"></i> Paramètres
    </a>
</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('statistics*') ? 'active' : '' }}" href="{{ route('statistics.index') }}">
                <i class="bi bi-bar-chart-fill"></i> Statistiques
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </a>

            <!-- Formulaire caché pour la déconnexion -->
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>

    <div class="content d-flex flex-column">
    <header class="topnav mb-4 bg-black text-light shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Affichage de la date et heure actuelle (à gauche) -->
            <span class="d-none d-lg-block text-light" id="currentDateTime" 
                  style="font-size: 1.5rem;">
            </span>

            <!-- Logo ou lien vers le tableau de bord (centré) -->
            <div class="text-center mx-auto">
                <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}" 
                   style="font-size: 2.5rem; color: white; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);">
                    Gestionnaire de Projets
                </a>
            </div>

            <!-- Bouton pour le mode sombre et menu utilisateur (à droite) -->
            <div class="d-flex align-items-center">
                <button id="themeToggle" class="btn btn-outline-light me-3">
                    <i class="fas fa-sun" id="themeIcon"></i>
                    <span id="themeText">Mode clair</span>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2rem;">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Se déconnecter</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>




        <main>
            @yield('content')
        </main>




        <footer class="mt-auto py-4 text-center bg-black text-light">
    <div class="container">
        <div class="row">
            <!-- Informations sur les droits -->
            <div class="col-md-6 mb-3 mb-md-0">
                <span>&copy; {{ date('Y') }} <strong>Gestionnaire de Projets</strong></span>
                <p class="small">Tous droits réservés.</p>
            </div>

            <!-- Liens sociaux -->
            <div class="col-md-6">
                <p class="mb-2">Suivez-moi sur :</p>
                <a href="https://github.com/Abderraouf-Naji" target="_blank" class="text-light me-2" aria-label="GitHub">
                    <i class="bi bi-github" style="font-size: 1.2rem;"></i>
                </a>
                <a href="https://www.linkedin.com/in/naji-abderraouf-a3a367309/" target="_blank" class="text-light me-2" aria-label="LinkedIn">
                    <i class="bi bi-linkedin" style="font-size: 1.2rem;"></i>
                </a>
                <a href="https://twitter.com/AbderraoufNaji" target="_blank" class="text-light" aria-label="Twitter">
                    <i class="bi bi-twitter" style="font-size: 1.2rem;"></i>
                </a>
            </div>
        </div>
        <!-- Script pour les thèmes -->
        <script src="{{ asset('js/theme.js') }}"></script>
    </div>
</footer>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateDateTime() {
            const now = new Date();
            const dayNames = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
            const day = dayNames[now.getDay()];
            const date = now.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
            const time = now.toLocaleTimeString();

            document.getElementById('currentDateTime').innerText = `${day}, ${date} ${time}`;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>

</html>
