<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Keuzedeel;
use App\Models\Inschrijving;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $keuzedelen = Keuzedeel::all();
        return view('home', compact('keuzedelen'));
    }

public function enroll(Request $request)
{
    if (!session()->has('user_id')) {
        return redirect()->route('login');
    }

    $studentId = session('user_id');
    $keuzedeelId = $request->keuzedeel_id;

    $student = DB::table('gebruikers')->where('id', $studentId)->first();
    $keuzedeel = Keuzedeel::findOrFail($keuzedeelId);

    /*
    |--------------------------------------------------------------------------
    | 1. Student geblokkeerd?
    |--------------------------------------------------------------------------
    */
    if ($student->geblokkeerd) {
        return redirect()->route('home')
            ->with('error', 'Je account is geblokkeerd. Inschrijven is niet toegestaan.');
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Keuzedeel gesloten?
    |--------------------------------------------------------------------------
    */
    if ($keuzedeel->status === 'gesloten') {
        return redirect()->route('vol');
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Keuzedeel al afgerond?
    |--------------------------------------------------------------------------
    */
    $heeftAfgerond = Inschrijving::where('student_id', $studentId)
        ->where('keuzedeel_id', $keuzedeelId)
        ->where('status', 'afgerond')
        ->exists();

    if ($heeftAfgerond) {
        return redirect()->route('home')
            ->with('error', 'Je hebt dit keuzedeel al afgerond.');
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Al ingeschreven?
    |--------------------------------------------------------------------------
    */
    $alIngeschreven = Inschrijving::where('student_id', $studentId)
        ->where('keuzedeel_id', $keuzedeelId)
        ->exists();

    if ($alIngeschreven) {
        return redirect()->route('home')
            ->with('error', 'Je bent al ingeschreven voor dit keuzedeel.');
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Voldoet student aan eisen?
    |--------------------------------------------------------------------------
    | (simpel voorbeeld: eis = klasnaam)
    */
    if ($keuzedeel->eisen && $keuzedeel->eisen !== $student->klas) {
        return redirect()->route('home')
            ->with('error', 'Je voldoet niet aan de eisen voor dit keuzedeel.');
    }

    /*
    |--------------------------------------------------------------------------
    | 6. VOL = VOL (database lock)
    |--------------------------------------------------------------------------
    */
    DB::transaction(function () use ($studentId, $keuzedeelId) {

        $keuzedeel = Keuzedeel::lockForUpdate()->findOrFail($keuzedeelId);

        if ($keuzedeel->inschrijvingen >= $keuzedeel->max_studenten) {
            $keuzedeel->update(['status' => 'gesloten']);
            redirect()->route('vol')->send();
            exit;
        }

<<<<<<< Updated upstream
        Inschrijving::create([
            'student_id' => $studentId,
            'keuzedeel_id' => $keuzedeelId,
            'status' => 'ingeschreven',
            'inschrijf_datum' => now(),
        ]);

        $keuzedeel->increment('inschrijvingen');

        if ($keuzedeel->inschrijvingen >= $keuzedeel->max_studenten) {
            $keuzedeel->update(['status' => 'gesloten']);
        }
    });

    return redirect()->route('home')
        ->with('success', 'Je bent succesvol ingeschreven!');

}
=======
        return view('home', compact(
            'keuzedelen',
            'ingeschrevenKeuzedelen'
        ));
    }

    public function enroll(Request $request)
    {
        // Check of gebruiker ingelogd is
        if (!session()->has('user_id')) {
            return redirect()->back()->with('error', 'Je moet ingelogd zijn om in te schrijven');
        }

        // Validatie
        $request->validate([
            'keuzedeel_id' => 'required|exists:keuzedelen,id'
        ]);

        $keuzedeel = Keuzedeel::find($request->keuzedeel_id);

        // Check of keuzedeel vol is
        if ($keuzedeel->inschrijvingen >= $keuzedeel->max_studenten) {
            return redirect()->back()->with('error', 'Dit keuzedeel is vol');
        }

        // Check of al ingeschreven
        $bestaatAl = Inschrijving::where('student_id', session('user_id'))
            ->where('keuzedeel_id', $request->keuzedeel_id)
            ->exists();

        if ($bestaatAl) {
            return redirect()->back()->with('error', 'Je bent al ingeschreven voor dit keuzedeel');
        }

        // Inschrijving aanmaken
        Inschrijving::create([
            'student_id' => session('user_id'),
            'keuzedeel_id' => $request->keuzedeel_id,
            'status' => 'ingeschreven'
        ]);

        // Update aantal inschrijvingen
        $keuzedeel->increment('inschrijvingen');

        return redirect()->back()->with('success', 'Je bent succesvol ingeschreven!');
    }
>>>>>>> Stashed changes
}