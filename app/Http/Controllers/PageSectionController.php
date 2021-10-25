<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageSection;
use Validator;
use App\Models\CmsPage;
use DB;

class PageSectionController extends Controller
{
    //Fetch Records
    public function getPageSection($pageId)
    {
        if (PageSection::where('page_id', $pageId)->exists()) {
            $cms_pages = DB :: table('cms_pages')
            ->select('cms_pages.id','cms_pages.title','cms_pages.slug')
            ->where('id', $pageId)
            ->get();
            $page_section = DB::table('page_section')
            ->where('page_id',$pageId)
            ->get();
           
            return response()->json(array(
                'status' => 200,
                'page_type' => $cms_pages,
                'page_section'=> $page_section
               
            ));
            
          } else {
           //return response in json formate
            return response()->json([
              "message" => "content not found"
            ], 404);
          }
       
    }
    
    public function storePageSectionInfo(Request $request, $pageId)
    {
        //Stored data
        $validator = Validator::make($request->all(),[ 
        'image' => 'required|mimes:png,jpg,jpeg,bmp|max:2048',
        ]);   

            if($validator->fails()) {          
             return response()->json(['error'=>$validator->errors()], 401);                        
            }  
            if ($image = $request->file('image')) {
                //  die ($file);
                //$request->image->move(public_path('/public/files'),$image);
                // print_r($image);
                $image_path = $image->store('public/files');
                $image = $image->getClientOriginalName();
                //store your file into directory and db
                $save = new PageSection();
                $save->page_id = $pageId;
                $save->title = $request->title;
                $save->image = $image;
                $save->image_path = $image_path;
                $save->description = $request->description;
                $save->section = $request->section;
                $save->save();
                //die($save);
                return response()->json([
                    "success" => true,
                    "message" => "File successfully uploaded",
                    "file" =>  $save
                ]);
                }
    }

    public function getCmsType(){
      //  $cms_type = CmsPage::all();
        $cms_type = CmsPage::where('id', '>', 0)->simplePaginate(1);
        return response($cms_type,200);
    }
    
}
