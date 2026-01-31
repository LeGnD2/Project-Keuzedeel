<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use App\Models\Inschrijving;

class KeuzedeelController extends Controller
{
    public function index()
    {
        // alle keuzedelen ophalen
        $keuzedelen = Keuzedeel::all();

        // keuzedelen waar de gebruiker al voor is ingeschreven
        $ingeschrevenKeuzedelen = [];

        if (session()->has('user_id')) {
            $ingeschrevenKeuzedelen = Inschrijving::where(
                'student_id',
                session('user_id')
            )->pluck('keuzedeel_id')->toArray();
        }

        return view('keuzedelen', compact(
            'keuzedelen',
            'ingeschrevenKeuzedelen'
        ));
    }
}
