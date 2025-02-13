<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poney extends Model
{
    use HasFactory;

    protected $table = 'poneys';

    protected $fillable = [
        'nom',
        'heures_max',
        'heures',
    ];

    public $timestamps = false;
}
