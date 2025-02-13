<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RDV extends Model
{
    use HasFactory;

    protected $table = 'rendez_vous';

    protected $fillable = [
        'nom_client',
        'heures',
        'prix',
        'date_time',
        'poney_1',
        'poney_2',
        'poney_3',
        'poney_4',
    ];
}
