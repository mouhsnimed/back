<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonResource;
use App\Models\person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::paginate(10);
        return PersonResource::collection($persons);
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
        $person = new Person();
        $person->nom = $request->nom;
        $person->prenoms = $request->prenoms;
        $person->email = $request->email;
        $person->numero = $request->numero;
        $person->type = $request->type;
        $person->password = bcrypt($request->password);

        if($person->save())
        {
            return new PersonResource($person);
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
        $person = Person::findOrfail($id);
        return new PersonResource($person);
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
        $person = Person::findOrfail($id);
        $person->nom = $request->nom;
        $person->prenoms = $request->prenoms;
        $person->email = $request->email;
        $person->numero = $request->numero;
        $person->type = $request->type;
        $person->password = $request->password;
        if($person->save())
        {
            return new PersonResource($person);
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
        $person = Person::findOrfail($id);
        if($person->delete())
        {
            return new PersonResource($person);
        }
    }
}
