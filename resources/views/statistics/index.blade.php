@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <!-- Répartition des Tâches -->
        <div class="col-md-3">
            <h3>Répartition des Tâches</h3>
            <canvas id="tasksDistributionChart"></canvas>
        </div>

        <!-- Tâches par Utilisateur -->
        <div class="col-md-6">
            <h3>Tâches par Utilisateur</h3>
            <canvas id="tasksByUserChart"></canvas>
        </div>

        <!-- Complétion des Tâches -->
        <div class="col-md-3">
            <h3>Complétion des Tâches</h3>
            <canvas id="taskCompletionChart"></canvas>
        </div>

        <!-- Progrès des Tâches par Statut -->
        <div class="col-md-6">
            <h3>Progrès des Tâches par Statut</h3>
            <canvas id="tasksStatusChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Données pour le graphique "Répartition des Tâches"
    const tasksByStatus = @json($tasksByStatus);
    const tasksDistributionData = {
        labels: tasksByStatus.map(task => task.status === 'to_do' ? 'À Faire' :
                                       task.status === 'in_progress' ? 'En Cours' :
                                       task.status === 'completed' ? 'Complétées' : 'Inconnu'),
        datasets: [{
            label: 'Répartition des Tâches',
            data: tasksByStatus.map(task => task.count),
            backgroundColor: ['#007bff', '#ffc107', '#28a745', '#6c757d'],
            borderColor: ['#007bff', '#ffc107', '#28a745', '#6c757d'],
            borderWidth: 1
        }]
    };

    // Initialisation du graphique pour "Répartition des Tâches"
    new Chart(document.getElementById('tasksDistributionChart'), {
        type: 'pie',
        data: tasksDistributionData
    });

    // Données pour le graphique "Tâches par Utilisateur"
    const tasksByUser = @json($tasksByUser);
    const tasksByUserData = {
        labels: tasksByUser.map(task => 'Utilisateur ' + task.user_id), // Adaptation selon vos données
        datasets: [{
            label: 'Tâches par Utilisateur',
            data: tasksByUser.map(task => task.count),
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            borderWidth: 1
        }]
    };

    // Initialisation du graphique pour "Tâches par Utilisateur"
    new Chart(document.getElementById('tasksByUserChart'), {
        type: 'bar',
        data: tasksByUserData
    });

    // Données pour le graphique "Complétion des Tâches"
    const tasksCompletion = @json($tasksCompletion);
    const tasksCompletionData = {
        labels: ['Complétées', 'En Cours'],
        datasets: [{
            label: 'Complétion des Tâches',
            data: [tasksCompletion, @json($tasksInProgress)],
            backgroundColor: ['#28a745', '#ffc107'],
            borderColor: ['#28a745', '#ffc107'],
            borderWidth: 1
        }]
    };

    // Initialisation du graphique pour "Complétion des Tâches"
    new Chart(document.getElementById('taskCompletionChart'), {
        type: 'doughnut',
        data: tasksCompletionData
    });

    // Données pour le graphique "Progrès des Tâches par Statut"
    const tasksStatus = ['to_do', 'in_progress', 'completed'];
    const tasksStatusCounts = tasksStatus.map(status => tasksByStatus.filter(task => task.status === status).reduce((count, task) => count + task.count, 0));

    const tasksStatusData = {
        labels: tasksStatus.map(status => status === 'to_do' ? 'À Faire' :
                                       status === 'in_progress' ? 'En Cours' :
                                       status === 'completed' ? 'Complétées' : 'Inconnu'),
        datasets: [{
            label: 'Progrès des Tâches par Statut',
            data: tasksStatusCounts,
            backgroundColor: ['#007bff', '#ffc107', '#28a745'],
            borderColor: ['#007bff', '#ffc107', '#28a745'],
            borderWidth: 1
        }]
    };

    // Initialisation du graphique pour "Progrès des Tâches par Statut"
    new Chart(document.getElementById('tasksStatusChart'), {
        type: 'bar',
        data: tasksStatusData
    });
</script>
@endsection
