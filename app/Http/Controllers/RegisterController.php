<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('register');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'gebruikersnaam' => 'required|min:3|max:100',
            'naam' => 'required|max:255',
            'wachtwoord' => 'required|min:6|confirmed',
            'klas' => 'required|max:50',
        ]);

        // Check if username already exists
        $exists = DB::table('gebruikers')
            ->where('gebruikersnaam', $request->gebruikersnaam)
            ->exists();

        if ($exists) {
            return back()->withErrors(['gebruikersnaam' => 'Deze gebruikersnaam is al in gebruik.'])->withInput();
        }

        // Insert new user into database
        DB::table('gebruikers')->insert([
            'gebruikersnaam' => $request->gebruikersnaam,
            'wachtwoord' => Hash::make($request->wachtwoord),
            'naam' => $request->naam,
            'rol' => 'student', // Default role
            'klas' => $request->klas,
            'geblokkeerd' => 0,
            'aangemaakt_op' => now()
        ]);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Account succesvol aangemaakt! Je kunt nu inloggen.');
    }
}