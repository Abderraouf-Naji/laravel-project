<?php


namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // Répartition des tâches par statut
        $tasksByStatus = Task::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();

        // Tâches par utilisateur
        $tasksByUser = Task::selectRaw('user_id, count(*) as count')
            ->groupBy('user_id')
            ->get();

        // Complétion des tâches
        $tasksCompletion = Task::selectRaw('status, count(*) as count')
            ->where('status', 'completed')
            ->count();

        // Tâches en cours
        $tasksInProgress = Task::selectRaw('status, count(*) as count')
            ->where('status', 'in_progress')
            ->count();

        return view('statistics.index', compact('tasksByStatus', 'tasksByUser', 'tasksCompletion', 'tasksInProgress'));
    }
}
