<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Afficher la liste des messages
    public function index()
    {
        // Exemple de données (remplacez par des données issues de la base)
        $messages = [
            ['id' => 1, 'sender' => 'Alice', 'content' => 'Bonjour, comment ça va ?'],
            ['id' => 2, 'sender' => 'Bob', 'content' => 'N’oublie pas notre réunion à 15h.'],
        ];

        return view('messages.index', compact('messages'));
    }

    // Afficher un message spécifique
    public function show($id)
    {
        // Exemple de données (remplacez par une recherche dans la base)
        $message = ['id' => $id, 'sender' => 'Alice', 'content' => 'Bonjour, comment ça va ?'];

        return view('messages.show', compact('message'));
    }
}
