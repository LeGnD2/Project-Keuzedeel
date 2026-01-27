<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Toon admin dashboard met alle keuzedelen
    public function dashboard()
    {
        // Check if user is admin
        if (!session()->has('user_id') || session('rol') !== 'beheerder') {
            return redirect()->route('login')->withErrors(['error' => 'Je moet admin zijn om deze pagina te bekijken.']);
        }

        $keuzedelen = DB::table('keuzedelen')->orderBy('aangemaakt_op', 'desc')->get();
        
        return view('admin.dashboard', compact('keuzedelen'));
    }

    // Toon formulier om nieuw keuzedeel toe te voegen
    public function create()
    {
        if (!session()->has('user_id') || session('rol') !== 'beheerder') {
            return redirect()->route('login');
        }

        return view('admin.create-keuzedeel');
    }

    // Sla nieuw keuzedeel op
    public function store(Request $request)
    {
        if (!session()->has('user_id') || session('rol') !== 'beheerder') {
            return redirect()->route('login');
        }

        $request->validate([
            'titel' => 'required|max:255',
            'beschrijving' => 'required',
            'eisen' => 'required|max:255',
            'max_studenten' => 'required|integer|min:1|max:100',
        ]);

        DB::table('keuzedelen')->insert([
            'titel' => $request->titel,
            'beschrijving' => $request->beschrijving,
            'eisen' => $request->eisen,
            'max_studenten' => $request->max_studenten,
            'inschrijvingen' => 0,
            'status' => 'open',
            'aangemaakt_op' => now()
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Keuzedeel succesvol toegevoegd!');
    }

    // Toon formulier om keuzedeel te bewerken
    public function edit($id)
    {
        if (!session()->has('user_id') || session('rol') !== 'beheerder') {
            return redirect()->route('login');
        }

        $keuzedeel = DB::table('keuzedelen')->where('id', $id)->first();

        if (!$keuzedeel) {
            return redirect()->route('admin.dashboard')->withErrors(['error' => 'Keuzedeel niet gevonden.']);
        }

        return view('admin.edit-keuzedeel', compact('keuzedeel'));
    }

    // Update keuzedeel
    public function update(Request $request, $id)
    {
        if (!session()->has('user_id') || session('rol') !== 'beheerder') {
            return redirect()->route('login');
        }

        $request->validate([
            'titel' => 'required|max:255',
            'beschrijving' => 'required',
            'eisen' => 'required|max:255',
            'max_studenten' => 'required|integer|min:1|max:100',
            'status' => 'required|in:open,gesloten',
        ]);

        DB::table('keuzedelen')
            ->where('id', $id)
            ->update([
                'titel' => $request->titel,
                'beschrijving' => $request->beschrijving,
                'eisen' => $request->eisen,
                'max_studenten' => $request->max_studenten,
                'status' => $request->status,
            ]);

        return redirect()->route('admin.dashboard')->with('success', 'Keuzedeel succesvol bijgewerkt!');
    }

    // Verwijder keuzedeel
    public function destroy($id)
    {
        if (!session()->has('user_id') || session('rol') !== 'beheerder') {
            return redirect()->route('login');
        }

        DB::table('keuzedelen')->where('id', $id)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Keuzedeel succesvol verwijderd!');
    }
}