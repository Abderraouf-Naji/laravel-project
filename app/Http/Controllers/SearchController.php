<?php

// SearchController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        // Ajoutez ici la logique pour effectuer la recherche
        return view('search.index', ['results' => []]); // Envoyez les résultats
    }
}
