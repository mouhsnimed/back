<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class illustration extends Model
{
    use HasFactory;

    protected $table = "illustrations";

    protected $fillable = [
        'titre',
        'type',
        'chemin',
        'vote_like',
        'vote_dislike',
        'shooter_id'
    ];
}
