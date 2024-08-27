<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Gère la connexion des utilisateurs.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Authentifier l'utilisateur
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Rediriger l'utilisateur vers la page d'accueil ou la page précédente
            return redirect()->route('cart.index');
        }

        // Rediriger l'utilisateur avec un message d'erreur si les informations sont incorrectes
        return redirect()->back()->with('error', 'Les informations de connexion sont incorrectes.');
    }

    /**
     * Gère la déconnexion des utilisateurs.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('auth/login')->with('success', 'Déconnecté avec succès.');
    }

    /**
     * Affiche le tableau de bord administrateur.
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return view('admin.dashboard'); // Remplacez par la vue du tableau de bord administrateur
        }

        return redirect('/')->with('error', 'Accès non autorisé.');
    }
    public function showReservations()
{
   // Vérifier si l'utilisateur est authentifié
   if (!Auth::check()) {
    return redirect('auth/login')->with('error', 'Vous devez être connecté pour voir vos réservations.');
}

// Récupérer les réservations de l'utilisateur connecté
$reservations = Auth::user()->reservations()->whereIn('status', ['confirmed', 'pending', 'cancelled'])->get();

return view('user.reservations', compact('reservations'));

}
}
