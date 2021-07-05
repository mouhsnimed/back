<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
         $validator = validator::make($request->all(),[
             'nom' => 'required',
             'prenom' => 'required',
             'numero' => 'required',
             'type' => 'required',
             'email' => 'required|email|unique:users',
             'password' => 'required'
         ]);

         if($validator->fails())
         {
            $messages = $validator->messages();
             return response()->json([
                 'status_code' => 400,
                 'message'=>$messages,
                ]);        
         }

         $user = new User();
         $user->nom = $request->nom;
         $user->prenom =$request->prenom;
         $user->email =$request->email;
         $user->numero =$request->numero;
         $user->type =$request->type;
         $user->password = bcrypt($request->password);
         $user->save();

         return response()->json([
             'status_code' => 200,
             'message' => 'user created'
         ]);
    }

    public function login(Request $request)
    {
        $validator = validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status_code' => 400,
                'message'=>'Bad Request'
               ]);        
        }

        $credentials = request(['email','password']);
        
        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'login or password incorrect '
            ], 400);
        }

        $user = User::where('email',$request->email)->first();
        $tokenResult = $user->createtoken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'token' => $tokenResult
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Token deleted'
        ]);
    }
}