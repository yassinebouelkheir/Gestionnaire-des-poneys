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
        'personnes',
        'date_time',
        'poney_1',
        'poney_2',
        'poney_3',
        'poney_4',
    ];

    public $timestamps = false;

    public function poneyOne()
    {
        return $this->belongsTo(Poney::class, 'poney_1');
    }

    public function poneyTwo()
    {
        return $this->belongsTo(Poney::class, 'poney_2');
    }

    public function poneyThree()
    {
        return $this->belongsTo(Poney::class, 'poney_3');
    }

    public function poneyFour()
    {
        return $this->belongsTo(Poney::class, 'poney_4');
    }
}
