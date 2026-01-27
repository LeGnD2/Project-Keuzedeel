<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Check if user exists in database
        $gebruiker = DB::table('gebruikers')
            ->where('gebruikersnaam', $request->username)
            ->first();

        if ($gebruiker && Hash::check($request->password, $gebruiker->wachtwoord)) {
            // Check if user is blocked
            if ($gebruiker->geblokkeerd == 1) {
                return back()->withErrors(['error' => 'Je account is geblokkeerd.']);
            }

            // Login successful - store user info in session
            Session::put('user_id', $gebruiker->id);
            Session::put('gebruikersnaam', $gebruiker->gebruikersnaam);
            Session::put('naam', $gebruiker->naam);
            Session::put('rol', $gebruiker->rol);

            // Redirect to home page
            return redirect()->route('home');
        }

        // Login failed
        return back()->withErrors(['error' => 'Gebruikersnaam of wachtwoord is onjuist.']);
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}