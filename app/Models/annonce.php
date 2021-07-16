<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annonce extends Model
{
    use HasFactory;

    protected $table = "annonces";

    protected $fillable = [
        'titre',
        'type_annonce',
        'pays',
        'ville',
        'adresse',
        'localisation_geo',
        'superficie',
        'prix',
        'nombre_chambre',
        'nombre_salon',
        'description',
        'etage',
        'etat_bien',
        'special',
        'meuble',
        'user_id',
        'categorie_annonce_id'
    ];

}
