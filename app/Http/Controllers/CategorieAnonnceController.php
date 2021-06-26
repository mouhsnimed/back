<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie_annonce;
use App\Http\Resources\CategorieAnnonceRessource;
use Exception;

class CategorieAnonnceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $categories = categorie_annonce::paginate(10);
            return CategorieAnnonceRessource::collection($categories);
        }         
        catch(Exception $ex)
        {
            return new CategorieAnnonceRessource(['error']);
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
        try
        {
            $categorie = new categorie_annonce();
            $categorie->nom = $request->nom;
    
            if($categorie->save())
            {
                return new CategorieAnnonceRessource($categorie);
            }
            else
            {
                return new CategorieAnnonceRessource(['error']);
            }
        } 
        catch(Exception $ex)
        {
            return new CategorieAnnonceRessource(['error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $categorie = categorie_annonce::findorfail($id);
        
            if(!empty($categorie))
            {
                return new CategorieAnnonceRessource($categorie);
            }
            else
            {
                return new CategorieAnnonceRessource(['No found']);
            }
        }        
        catch(Exception $ex)
        {
            return new CategorieAnnonceRessource(['error']);
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
        try
        {
            $categorie = categorie_annonce::findorfail($id);
            $categorie->nom = $request->nom;

            if($categorie->save())
            {
                return new CategorieAnnonceRessource($categorie);
            }
            else
            {
                return new CategorieAnnonceRessource(['error']);
            }
        }
        catch(Exception $ex)
        {
            return new CategorieAnnonceRessource(['error']);
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
        try
        {
            $categorie = categorie_annonce::findorfail($id);
    
            if($categorie->delete())
            {
                return new CategorieAnnonceRessource($categorie);
            }
            else
            {
                return new CategorieAnnonceRessource(['error']);
            }
        }
        catch(Exception $ex)
        {
            return new CategorieAnnonceRessource(['error']);
        }
    }
}
