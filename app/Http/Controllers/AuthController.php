<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


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
            // Rediriger l'utilisateur vers la page du cart
            return redirect()->route('cart.index'); // Assurez-vous que la route 'cart.index' existe
        }

        // Rediriger l'utilisateur avec un message d'erreur si les informations sont incorrectes
        return redirect()->back()->with('error', 'Les informations de connexion sont incorrectes.');
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

         User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);



        return redirect()->intended('cart.index');
    }



    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}

