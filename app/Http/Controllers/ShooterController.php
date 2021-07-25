<?php

namespace App\Http\Controllers;

use App\Models\shooter;
use Illuminate\Http\Request;
use App\http\Resources\ShooterRessource;
use Exception;

class ShooterController extends Controller
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
            $illustration = shooter::join('users','users.id','=','shooters.user_id')
                                     ->paginate(6,['shooters.id as id_shooter','users.id as id_user','users.*','shooters.*']);            

            return ShooterRessource::collection($illustration);
        }         
        catch(Exception $ex)
        {
            return new ShooterRessource([$ex->getMessage()]);
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
     * @param  \App\Models\shooter  $shooter
     * @return \Illuminate\Http\Response
     */
    public function show(shooter $shooter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shooter  $shooter
     * @return \Illuminate\Http\Response
     */
    public function edit(shooter $shooter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shooter  $shooter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shooter $shooter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shooter  $shooter
     * @return \Illuminate\Http\Response
     */
    public function destroy(shooter $shooter)
    {
        //
    }
}
