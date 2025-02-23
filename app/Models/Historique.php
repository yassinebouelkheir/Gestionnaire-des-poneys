<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $table = 'historique';

    protected $fillable = [
        'nom',
        'mois',
        'année',
        'total',
        'heures',
    ];

    public $timestamps = false;
}
