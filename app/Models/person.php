<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class person extends Model
{
    use HasFactory,Notifiable,HasApiTokens;

    protected $table = "persons";

    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'numero',
        'type',
        'password'
    ];
}
