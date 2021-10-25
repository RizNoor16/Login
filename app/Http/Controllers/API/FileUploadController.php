<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Validator;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
 
       $validator = Validator::make($request->all(),[ 
              'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg|max:2048',
        ]);   
 
        if($validator->fails()) {          
            
            return response()->json(['error'=>$validator->errors()], 401);                        
         }  
 
  
        if ($file = $request->file('file')) {
         //  die ($file);
            $file_path = $file->store('public/files');
            $file_name = $file->getClientOriginalName();

            //store your file into directory and db
            $save = new File();
            $save->title = $request->title;
            $save->file_name = $file_name;
            $save->file_path = $file_path;
            $save->description = $request->description;
            $save->save();
            //die($save);
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" =>  $save
            ]);
  
        }
    }
}