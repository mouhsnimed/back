<?php

namespace App\Http\Controllers;

use App\Models\illustration;
use Illuminate\Http\Request;
use App\Http\Resources\IllustrationRessource;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class IllustrationController extends Controller
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
            $illustration = illustration::join('shooters','shooters.id','=','illustrations.shooter_id')
                                        ->join('users','users.id','=','shooters.user_id')
                                        ->paginate(6,['shooters.id as id_shooter', 'users.id as id_user','users.*','shooters.*','illustrations.*']);            

            return IllustrationRessource::collection($illustration);
        }         
        catch(Exception $ex)
        {
            return new IllustrationRessource([$ex->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        try 
        {                       
            $illustration = illustration::join('shooters','shooters.id','=','illustrations.shooter_id')
            ->join('users','users.id','=','shooters.user_id')
            ->Where("titre", "like","%{$request->search_text}%")
            ->orwhere("nom", "like","%{$request->search_text}%")            
            ->orwhere("prenoms", "like", "%{$request->search_text}%")            
            ->orderby("illustrations.id")->paginate(6); 
            return illustrationRessource::Collection($illustration);
            // return new illustrationRessource($request);
        }         
        catch(Exception $ex)
        {
            return new illustrationRessource([$ex->getMessage()]);
        }
    }


    public function vote(Request $request,$id)
    {
        try {

            $illustration = illustration::findorfail($id);
            if($request->likeFor == true)
            {
                $illustration->vote_like++;
            }
            else
            {
                $illustration->vote_dislike++;
            }

            if ($illustration->save()) 
            {
                return new IllustrationRessource($illustration);
            } 
            else 
            {
                return new IllustrationRessource(["error"]);
            }
        } catch (Exception $ex) 
        {
            return new IllustrationRessource(["error"]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\illustration $illustration  
     * @return \Illuminate\Http\Response
     */
    public function show(illustration $illustration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\illustration $illustration 
     * @return \Illuminate\Http\Response
     */
    public function edit(illustration $illustration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\illustration $illustration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,illustration $illustration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\illustration $illustration
     * @return \Illuminate\Http\Response
     */
    public function destroy(illustration $illustration)
    {
        //
    }
}
