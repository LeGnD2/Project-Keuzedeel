<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuzedeel extends Model
{
    protected $table = 'keuzedelen';

    public $timestamps = false;

    protected $fillable = [
        'titel',
        'beschrijving',
        'eisen',
        'max_studenten',
        'status',
    ];

    public function inschrijvingen()
    {
        return $this->hasMany(Inschrijving::class, 'keuzedeel_id');
    }
}
