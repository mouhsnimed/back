<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('user')->get();

        return view('user.index', ['users' => $users]);
    }

    public function store()
    {
        $users = DB::table('user')->get();

        return view('user.index', ['users' => $users]);
    }

    public function show(int $IdUser)
    {
        // return $article;
    }

    public function update(Request $request, int $IdUser)
    {
        // $article->update($request->all());

        // return response()->json($article, 200);
    }

    public function delete(int $IdUser)
    {
        // $article->delete();

        return response()->json(null, 204);
    }
}