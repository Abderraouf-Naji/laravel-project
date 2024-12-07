<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login'); // Retourne la vue du formulaire de connexion
    }

    // Gère la logique de connexion
    public function login(Request $request)
    {
        // Valide les champs du formulaire
        $request->validate([
            'email' => 'required|email', // Le champ email est requis et doit être valide
            'password' => 'required|min:6', // Le mot de passe est requis et doit contenir au moins 6 caractères
        ]);

        // Vérifie les informations d'identification
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate(); // Régénère la session pour plus de sécurité
            return redirect()->intended('dashboard'); // Redirige vers le tableau de bord
        }

        // Retourne un message d'erreur si les informations ne correspondent pas
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }

    // Gère la déconnexion
    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur
        $request->session()->invalidate(); // Invalide la session
        $request->session()->regenerateToken(); // Régénère le token CSRF

        return redirect('/'); // Redirige vers la page d'accueil
    }
}
