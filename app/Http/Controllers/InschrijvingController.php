<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inschrijving;
use App\Models\Keuzedeel;

class InschrijvingController extends Controller
{
    public function store(Request $request)
    {
        // gebruiker moet ingelogd zijn
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $studentId = session('user_id');

        $request->validate([
            'keuzedeel_id' => 'required|exists:keuzedelen,id',
        ]);

        // dubbele inschrijving voorkomen
        $exists = Inschrijving::where('student_id', $studentId)
            ->where('keuzedeel_id', $request->keuzedeel_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Je bent al ingeschreven.');
        }

        // inschrijving opslaan
        Inschrijving::create([
            'student_id' => $studentId,
            'keuzedeel_id' => $request->keuzedeel_id,
            'status' => 'ingeschreven',
        ]);

        return back()->with('success', 'Inschrijving gelukt!');
    }
}
