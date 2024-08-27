<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.contact' );
    }
    public function submit(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        // Récupérer les données du formulaire
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        // Adresse email où envoyer le message
        $to = "diopfabi03@gmail.com";
        $subject = "New Contact Form Submission";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // En-têtes de l'email
        $headers = "From: $email";

        // Envoyer l'email
        if (mail($to, $subject, $body, $headers)) {
            return redirect()->back()->with('success', 'Message envoyé avec succes!');
        } else {
            return redirect()->back()->with('error', 'Désolé, vueillez réessayer.');
        }
    }

 }

