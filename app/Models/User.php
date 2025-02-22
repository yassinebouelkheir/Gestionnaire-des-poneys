<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom_utilisateur', 
        'mdp',
    ];

    protected $hidden = [
        'mdp',
    ];

    protected $casts = [
        'mdp' => 'hashed',
    ];

    public $timestamps = false;
}
