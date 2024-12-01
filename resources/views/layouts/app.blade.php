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
                <img style="filter: invert(100%) brightness(200%);" src="{{ asset('assets/img/logo-circle-horizontal.png') }}" class="img-fluid" width="100%" alt="Gestionnaire de Tâches">
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
                <a class="nav-link {{ request()->is('files*') ? 'active' : '' }}" href="{{ route('files.index') }}">
                    <i class="bi bi-file"></i> Fichiers
                </a>
            </li>




            <li class="nav-item">
    <a class="nav-link {{ request()->is('statistics*') ? 'active' : '' }}" href="{{ route('statistics.index') }}">
        <i class="bi bi-bar-chart-fill"></i> <span>Statistiques</span>
    </a>
</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('reminders*') ? 'active' : '' }}" href="{{ route('reminders.index') }}">
                <i class="bi bi-gear-fill"></i> <span>Paramètres</span>
                </a>
            </li>
            <li class="nav-item">
    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> <span>Déconnexion</span>
    </a>

    <!-- Formulaire caché pour la déconnexion -->
    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
        @csrf
    </form>
</li>








        </ul>
    </div>
    <div class="content d-flex flex-column">
        <header class="topnav mb-4">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <span class="fw-normal" id="currentDateTime"></span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Basculer la navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <button id="themeToggle">
   <i class="fas fa-sun" id="themeIcon"></i>mode sombre
</button>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    
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
        <footer class="mt-auto py-3 text-center">
            <div class="container">
                <span class="text-muted">&copy; {{ date('Y') }} Gestionnaire de Projets | Développé par <a href="https://github.com/Abderraouf-Naji" target="_blank">Abderraouf Naji</a></span>
            </div>
            <script src="{{ asset('js/theme.js') }}"></script>

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
