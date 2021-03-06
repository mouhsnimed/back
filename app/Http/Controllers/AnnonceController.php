<?php

namespace App\Http\Controllers;

use App\Models\annonce;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\AnnonceRessource;
use App\Models\media;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $annonces = annonce::join(
                "media",
                "media.annonce_id",
                "=",
                "annonces.id"
            )
                ->groupBy("media.annonce_id")
                ->limit(6)
                ->get(["annonces.*", "media.chemin"]);
            return response()->json($annonces);
        } catch (Exception $ex) {
            return new AnnonceRessource(["error"]);
        }
    }

    public function list()
    {
        try {
            $annonces = annonce::paginate(6);
            return AnnonceRessource::collection($annonces);
        } catch (Exception $ex) {
            return new AnnonceRessource(["error"]);
        }
    }

    public function search(Request $request)
    {
        try {
            $critere = [];
            $critere[] = ["type_annonce", "=", $request->type_annonce];
            $critere[] = [
                "categorie_annonce_id",
                "=",
                $request->categorie_annonce_id,
            ];
            $critere[] = ["ville", "=", $request->ville];

            if ($request->superficie1 != "") {
                $critere[] = ["superficie", ">=", $request->superficie1];
            }

            if ($request->superficie2 != "") {
                $critere[] = ["superficie", "<=", $request->superficie2];
            }

            if ($request->prix1 != "") {
                $critere[] = ["prix", ">=", $request->prix1];
            }

            if ($request->prix2 != "") {
                $critere[] = ["prix", "<=", $request->prix2];
            }

            if ($request->nombre_chambre != "") {
                $critere[] = ["nombre_chambre", "=", $request->nombre_chambre];
            }

            if ($request->nombre_bain != "") {
                $critere[] = ["nombre_bain", "=", $request->nombre_bain];
            }

            if ($request->nombre_salon != "") {
                $critere[] = ["nombre_salon", "=", $request->nombre_salon];
            }

            if ($request->etage != "") {
                $critere[] = ["etage", "=", $request->etage];
            }

            if ($request->meuble != "") {
                $critere[] = ["meuble", "=", $request->meuble];
            }

            $annonces = annonce::where($critere)
                ->orderby("id")
                ->paginate(6);
            return AnnonceRessource::Collection($annonces);
        } catch (Exception $ex) {
            return new AnnonceRessource([$ex->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            "titre" => "required",
            "type_annonce" => "required",
            "ville" => "required",
            "adresse" => "required",
            "localisation_geo" => "required",
            "superficie" => "required",
            "prix" => "required",
            "nombre_chambre" => "required",
            "nombre_bain" => "required",
            "nombre_salon" => "required",
            "description" => "required",
            "etage" => "required",
            "etat_bien" => "required",
            "meuble" => "required",
            "categorie_annonce_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $annonce = new annonce();
        $annonce->titre = $request->titre;
        $annonce->type_annonce = $request->type_annonce;
        $annonce->ville = $request->ville;
        $annonce->adresse = $request->adresse;
        $annonce->localisation_geo = $request->localisation_geo;
        $annonce->superficie = $request->superficie;
        $annonce->prix = $request->prix;
        $annonce->prix = $request->prix;
        $annonce->nombre_chambre = $request->nombre_chambre;
        $annonce->nombre_bain = $request->nombre_bain;
        $annonce->nombre_salon = $request->nombre_salon;
        $annonce->description = $request->description;
        $annonce->etage = $request->etage;
        $annonce->etat_bien = $request->etat_bien;
        $annonce->meuble = $request->meuble;
        $annonce->categorie_annonce_id = $request->categorie_annonce_id;
        // default value
        $annonce->user_id = Auth::user()->id;
        $annonce->date_annonce = date("Y/m/d");
        $annonce->created_at = date("Y/m/d");
        $annonce->updated_at = date("Y/m/d");
        $annonce->pays = "maroc";
        $annonce->special = "special";

        // save data
        $annonce->save();

        return response()->json([
            "id" => $annonce->id,
            "message" => "Annonce created",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $annonce = annonce::findorfail($id);
            if (!empty($annonce)) {
                $user = User::findorfail($annonce->user_id);
                // ["prix", "<=", $request->prix2];
                $medias = media::where("annonce_id", "=", $id)->get();
                return response()->json([
                    "details" => $annonce,
                    "user" => $user,
                    "medias" => $medias,
                ]);
            } else {
                return response()->json(
                    [
                        "error" => "Aucune annonce n'a ??t?? trouv??",
                    ],
                    400
                );
            }
        } catch (Exception $ex) {
            return response()->json(
                [
                    "error" => $id,
                ],
                400
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $annonce = annonce::findorfail($id);
            $annonce->titre = $request->titre;
            $annonce->type_annonce = $request->type_annonce;
            $annonce->pays = $request->pays;
            $annonce->ville = $request->ville;
            $annonce->adresse = $request->adresse;
            $annonce->localisation_geo = $request->localisation_geo;
            $annonce->superficie = $request->superficie;
            $annonce->prix = $request->prix;
            $annonce->nombre_chambre = $request->nombre_chambre;
            $annonce->nombre_bain = $request->nombre_bain;
            $annonce->nombre_salon = $request->nombre_salon;
            $annonce->description = $request->description;
            $annonce->etage = $request->etage;
            $annonce->etat_bien = $request->etat_bien;
            $annonce->special = $request->special;
            $annonce->meuble = $request->meuble;
            $annonce->user_id = $request->user_id;
            $annonce->categorie_annonce_id = $request->categorie_annonce_id;

            if ($annonce->save()) {
                return new AnnonceRessource($annonce);
            } else {
                return new AnnonceRessource(["error"]);
            }
        } catch (Exception $ex) {
            return new AnnonceRessource(["error"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $annonce = annonce::findorfail($id);
            if ($annonce->delete()) {
                return new AnnonceRessource($annonce);
            } else {
                return new AnnonceRessource(["error"]);
            }
        } catch (Exception $ex) {
            return new AnnonceRessource([$ex]);
        }
    }

    public function myAnnonces()
    {
        $myannonce = annonce::join(
            "media",
            "media.annonce_id",
            "=",
            "annonces.id"
        )
            ->where("user_id", Auth::user()->id)
            ->groupBy("media.annonce_id")
            ->get(["annonces.*", "media.chemin"]);
        return response()->json($myannonce);
    }
}
