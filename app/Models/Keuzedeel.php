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
        'inschrijvingen',
        'status'
    ];
}