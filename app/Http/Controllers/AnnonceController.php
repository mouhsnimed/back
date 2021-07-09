<?php

namespace App\Http\Controllers;

use App\Models\annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnonceController extends Controller
{
    
    public function add(Request $request) {
        $validator = validator::make($request->all(),[
            'titre' => 'required',
            'type_annonce' => 'required',
            'ville' => 'required',
            'adresse' => 'required',
            'localisation_geo' => 'required',
            'superficie' => 'required',
            'prix' => 'required',
            'nombre_chambre' => 'required',
            'nombre_bain' => 'required',
            'nombre_salon' => 'required',
            'description' => 'required',
            'etage' => 'required',
            'etat_bien' => 'required',
            'meuble' => 'required',
            'categorie_annonce_id' => 'required',
        ]);

        if($validator->fails())
        {
           $messages = $validator->messages();
            return response()->json([
                'message'=>$messages,
               ], 400);        
        }

        $annonce = new annonce();
        $annonce->titre = $request->titre;
        $annonce->type_annonce =$request->type_annonce;
        $annonce->ville =$request->ville;
        $annonce->adresse =$request->adresse;
        $annonce->localisation_geo =$request->localisation_geo;
        $annonce->superficie =$request->superficie;
        $annonce->prix =$request->prix;
        $annonce->prix =$request->prix;
        $annonce->nombre_chambre =$request->nombre_chambre;
        $annonce->nombre_bain =$request->nombre_bain;
        $annonce->nombre_salon =$request->nombre_salon;
        $annonce->description =$request->description;
        $annonce->etage =$request->etage;
        $annonce->etat_bien =$request->etat_bien;
        $annonce->meuble =$request->meuble;
        $annonce->categorie_annonce_id =$request->categorie_annonce_id;
        // default value
        $annonce->user_id = Auth::user()->id;
        $annonce->date_annonce =date("Y/m/d");
        $annonce->created_at =date("Y/m/d");
        $annonce->updated_at =date("Y/m/d");
        $annonce->pays ='maroc';
        $annonce->special ='special';


        // save data
        $annonce->save();

        return response()->json([
            'status_code' => 200,
            'message' => 'Annonce created'
        ]);

    }
}
