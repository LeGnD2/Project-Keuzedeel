<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Keuzedeel;
use App\Models\Inschrijving;

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
