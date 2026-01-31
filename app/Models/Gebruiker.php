<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gebruiker extends Model
{
    protected $table = 'gebruikers';

    // omdat jij gebruikt maakt  'aangemaakt_op' inplaats van created_at
    public $timestamps = false;

    protected $fillable = [
        'gebruikersnaam',
        'wachtwoord',
        'naam',
        'rol',
        'klas',
        'geblokkeerd',
    ];

    protected $hidden = ['wachtwoord'];

    public function inschrijvingen()
    {
        return $this->hasMany(Inschrijving::class, 'student_id');
    }
}
