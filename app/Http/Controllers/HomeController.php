<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all keuzedelen from database
        $keuzedelen = DB::table('keuzedelen')->get();

        return view('home', ['keuzedelen' => $keuzedelen]);
    }

    public function enroll(Request $request)
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->route('login')
                ->with('error', 'Je moet ingelogd zijn om in te schrijven.');
        }

        $keuzedeel_id = $request->input('keuzedeel_id');
        $user_id = session('user_id');

        // Check if keuzedeel exists
        $keuzedeel = DB::table('keuzedelen')
            ->where('id', $keuzedeel_id)
            ->first();

        if (!$keuzedeel) {
            return back()->with('error', 'Keuzedeel niet gevonden.');
        }

        // Check if already enrolled (FIXED: student_id)
        $already_enrolled = DB::table('inschrijvingen')
            ->where('student_id', $user_id)
            ->where('keuzedeel_id', $keuzedeel_id)
            ->first();

        if ($already_enrolled) {
            return back()->with('error', 'Je bent al ingeschreven voor dit keuzedeel.');
        }

        // Check if keuzedeel is closed
        if ($keuzedeel->status === 'gesloten') {
            return back()->with('error', 'Dit keuzedeel is gesloten voor inschrijvingen.');
        }

        // Check if keuzedeel is full
        if ($keuzedeel->inschrijvingen >= $keuzedeel->max_studenten) {
            return back()->with('error', 'Dit keuzedeel is vol.');
        }

        // Create enrollment (ALL COLUMN NAMES FIXED)
        DB::table('inschrijvingen')->insert([
            'student_id' => $user_id,
            'keuzedeel_id' => $keuzedeel_id,
            'status' => 'ingeschreven',
            'inschrijf_datum' => now()
        ]);

        // Update keuzedeel inschrijvingen count
        DB::table('keuzedelen')
            ->where('id', $keuzedeel_id)
            ->increment('inschrijvingen');

        return back()->with(
            'success',
            'Je bent succesvol ingeschreven voor ' . $keuzedeel->titel
        );
    }
}
