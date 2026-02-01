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
        // Check login
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $studentId = session('user_id');
        $keuzedeelId = $request->keuzedeel_id;

        DB::transaction(function () use ($studentId, $keuzedeelId) {

            $keuzedeel = Keuzedeel::lockForUpdate()->findOrFail($keuzedeelId);

            // VOL = VOL

            if ($keuzedeel->status === 'gesloten' ||
                $keuzedeel->inschrijvingen >= $keuzedeel->max_studenten) {

                $keuzedeel->update(['status' => 'gesloten']);
                redirect()->route('vol')->send();
                exit;
            }

            // Controleer of student dit keuzedeel al heeft afgerond

                $heeftAfgerond = Inschrijving::where('student_id', $studentId)
                ->where('keuzedeel_id', $keuzedeelId)
                ->where('status', 'afgerond')
                ->exists();

if ($heeftAfgerond) {
    return redirect()->route('home')
        ->with('error', 'Je hebt dit keuzedeel al afgerond en kunt je niet opnieuw inschrijven.');
}

            // Voorkom dubbele inschrijving
            $bestaatAl = Inschrijving::where('student_id', $studentId)
                ->where('keuzedeel_id', $keuzedeelId)
                ->exists();

            if ($bestaatAl) {
                redirect()->route('home')->send();
                exit;
            }

            // Inschrijving opslaan
            Inschrijving::create([
                'student_id' => $studentId,
                'keuzedeel_id' => $keuzedeelId,
                'status' => 'ingeschreven',
                'inschrijf_datum' => now(),
            ]);

            // Teller verhogen
            $keuzedeel->increment('inschrijvingen');

            // Sluit automatisch als vol
            if ($keuzedeel->inschrijvingen >= $keuzedeel->max_studenten) {
                $keuzedeel->update(['status' => 'gesloten']);
            }
        });

        return redirect()->route('home')->with('success', 'Je bent ingeschreven!');
    }
}
