<?php

// FavoriteController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('favorites.index'); // La vue à afficher
    }
}

