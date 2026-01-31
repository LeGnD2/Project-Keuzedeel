<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inschrijving extends Model
{
    protected $table = 'inschrijvingen';

    // You are NOT using created_at / updated_at
    public $timestamps = false;
    
    protected $fillable = [
        'student_id',
        'keuzedeel_id',
        'status',
    ];

    /**
     * Een inschrijving van naar een student (gebruiker)
     */
    public function student()
    {
        return $this->belongsTo(Gebruiker::class, 'student_id');
    }

    /**
     * Een inschrijving van naar een keuzedeel
     */
    public function keuzedeel()
    {
        return $this->belongsTo(Keuzedeel::class, 'keuzedeel_id');
    }
}
