<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Afficher la page des paramètres
    public function index()
    {
        // Exemple de paramètres
        $settings = [
            'theme' => 'clair',
            'notifications' => true,
            'language' => 'fr',
        ];

        return view('settings.index', compact('settings'));
    }

    // Mettre à jour les paramètres
    public function update(Request $request)
    {
        // Exemple de mise à jour (remplacez par une logique réelle)
        $updatedSettings = $request->all();
        
        return back()->with('success', 'Paramètres mis à jour avec succès.');
    }
}
