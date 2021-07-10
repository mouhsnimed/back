<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function store(Request $request) {
        // $filename = time().$uploadedFiles->getClientOriginalName();
        $validator = Validator::make($request->all(), 
              [ 
                'annonce_id' => 'required',
                'images' => 'required|mimes:png,jpg,jpeg|max:2300',
             ]); 

             if ($validator->fails()) {          
                return response()->json(['error'=>$validator->errors()], 401);                        
             }     
        $files = [];
        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('uploads'), $name);  
                $files[] = $name;  
            }

            return response()->json([
                'data' => $files,
                'message' => 'fichiers enregistré'
            ]);

         } else {
            return response()->json([
                'message' => 'files missing'
            ], 401);
        }


        // $file= new File();
        // $file->filenames=json_encode($data);
        // $file->save();


        // return back()->with('success', 'Data Your files has been successfully added');

        // return response()->json([
        //     'data' => $filename,
        //     'message' => 'file saved succesfly!'
        // ]);
    }
}
