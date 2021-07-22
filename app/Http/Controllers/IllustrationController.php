<?php

namespace App\Http\Controllers;

use App\Models\illustration;
use Illuminate\Http\Request;
use App\Http\Resources\IllustrationRessource;
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
            $illustration = illustration::paginate(6);
            return IllustrationRessource::collection($illustration);
        }         
        catch(Exception $ex)
        {
            return new IllustrationRessource(['error']);
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
