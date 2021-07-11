<?php

namespace App\Http\Controllers;

use App\Models\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\UploadedFile;
use Redirect,Response,File;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), 
              [ 
                'annonce_id' => 'required',
                'images_0' => 'mimes:png,jpg,jpeg|max:2300',
                'images_1' => 'mimes:png,jpg,jpeg|max:2300',
                'images_2' => 'mimes:png,jpg,jpeg|max:2300',
                'images_3' => 'mimes:png,jpg,jpeg|max:2300',
                'images_4' => 'mimes:png,jpg,jpeg|max:2300',
                'images_5' => 'mimes:png,jpg,jpeg|max:2300',
                'images_6' => 'mimes:png,jpg,jpeg|max:2300',
                'images_7' => 'mimes:png,jpg,jpeg|max:2300',
             ]); 

             if ($validator->fails()) {          
                return response()->json(['error'=>$validator->errors()], 400);                        
             }     
        $files = [];
        $names = [];
        // if($request->hasfile('images'))
        //  {
            foreach($request->allFiles() as $file)
            {
                $name = time().rand(1,100).'-'.$file->getClientOriginalName();
                $file->move(public_path('/uploads'), $name);  
                $files[] = 'uploads/'. $name;
                $names[] = $file->getClientOriginalName();
               
             }

          

        //  } else {
        //     return response()->json([
        //         'message' => 'files missing'
        //     ], 401);
        // }


        $date = date("Y/m/d");
        foreach ($files as $index=>$media){
            $medias= new media();
            $medias->titre = $names[$index];
            $medias->chemin = $media;
            $medias->annonce_id = $request->annonce_id;
            $medias->date_upload = $date;
            $medias->created_at =$date;
            $medias->updated_at =$date;
            $medias->save();
        }

        return response()->json([
            'data'=> $files,
            'message' => 'fichiers enregistré'
        ]);

        // return back()->with('success', 'Data Your files has been successfully added');

        // return response()->json([
        //     'data' => $filename,
        //     'message' => 'file saved succesfly!'
        // ]);
    }
}
