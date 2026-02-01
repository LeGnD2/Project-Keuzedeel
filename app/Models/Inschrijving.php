<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inschrijving extends Model
{
    protected $table = 'inschrijvingen';
    
    public $timestamps = false; // Jouw database heeft geen created_at/updated_at
    
    protected $fillable = [
        'student_id',
        'keuzedeel_id',
        'status'
    ];
    
    // Relatie naar keuzedeel
    public function keuzedeel()
    {
        return $this->belongsTo(Keuzedeel::class, 'keuzedeel_id');
    }
}