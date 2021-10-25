<?php
namespace App\Http\Controllers\API;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Content::all();
        return response($content,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

       //$content = new Content(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>    'required|max:255',
            'image_url' =>  'required',
            'image_name'=> 'required',
            'description' => 'required'
        ]);
        $content = new Content;
        $content->title  = $request->title;
        $content->image_url = $request->image_url;
        $content->image_name = $request->image_name;
        $content->description =  $request->description;
        
        $content->save();
      
        return response()->json($content);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Content::where('id', $id)->exists()) {
            $content = Content::where('id', $id)->get()->toJson();
            return response($content, 200);
          } else {
            return response()->json([
              "message" => "content not found"
            ], 404);
          }
       
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
        if (Content::where('id', $id)->exists()) {
            $content = Content::find($id);
            $content->title = is_null($request->title) ? $content->title : $request->title;
            $content->image_url = is_null($request->image_url) ? $content->image_url : $request->image_url;
            $content->image_name = is_null($request->image_name) ? $content->image_name : $request->image_name;
            $content->description = is_null($request->description) ? $content->description : $request->description;
            $content->save();
    
            return response()->json([
                "message" => "Data updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
            
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
        //
    }


}
