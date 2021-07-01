<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->nom = $request->nom;
        $user->prenoms = $request->prenoms;
        $user->email = $request->email;
        $user->numero = $request->numero;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);

        if($user->save())
        {
            return new UserResource($user);
        }
    }

    public function show(int $id)
    {
        $user = User::findOrfail($id);
        return new UserResource($user);
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrfail($id);
        $user->nom = $request->nom;
        $user->prenoms = $request->prenoms;
        $user->email = $request->email;
        $user->numero = $request->numero;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        if($user->save())
        {
            return new UserResource($request);
        }
    }

    public function delete(int $id)
    {
        $user = User::findOrfail($id);
        if($user->delete())
        {
            return new UserResource($user);
        }
    }
}