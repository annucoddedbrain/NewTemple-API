<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplePost;
use App\Models\User;
use App\Models\Meta;
use Illuminate\Support\Facades\Validator;
// now write here

// annu likho yaha 


// kya likhna h

class TemplePostController extends Controller
{
    public function createPost(Request $request){ // step 1
        // $user = User::all();
        $user = User::first();


        //step 2 collect all post related data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',               
            'description' => 'required|string',
            'location' => 'required|string',
            'location_LatLng' => 'string|nullable',
            'time_table' => 'string|nullable',
            'filenames' => 'required',     
        ]);

        //step 3 check point 
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->messages()
            ]);

        }
        else
        {
            if($validator) // step 4 enter into main process 
            {
                // post table data save 
                $post = TemplePost::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'location' => $request->location,
                    'location_LatLng' => $request->location_LatLng,
                    'time_table' => $request->time_table,
                    'user_id' => $user->id,
                ]);

                // $total_files = count($request->file('filenames'));
                $total_files = [];
                foreach ($request->file('filenames') as $file) {
                    // rename & upload files to uploads folder
                    $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                    // $path = 'C:\Users\dev2c\OneDrive\Desktop\meta\uploads';  // physical address on PC level to   store data on deshtop 
                    $path = public_path() . '/uploads';    // physical address on project level to store data  
                    $file->move($path, $name);
        
                    // store in db
                    $fileUpload = new Meta();
                    $fileUpload->filenames = $name;
                    $fileUpload->path = $path;
                    $fileUpload->size = "10";
                    $fileUpload->type = $file->getClientOriginalExtension();
                    $fileUpload->user_id = $post->user_id;
                    $fileUpload->temple_post_id = $post->id;
                    $fileUpload->save();
    
                    array_push($total_files,$fileUpload);
                }
                
                // return response()->json($total_files);

                 if($post->save() && $fileUpload->save()){

                return response()->json([
                    "status" => true,
                    "message" => "User has been posted successfully.",
                    "data" => $post ,
                    "files"=> $total_files
                ]);
            } 
            else{
                return response()->json([
                    "message" => "error"
                ]);
            }

 
            }}}
        
        public function createMeta(Request $request){
        // $user = User::all();
        $user = User::first();
        $post = TemplePost::first();


        $validator = Validator::make($request->all(), [
            'filenames' => 'required|string',               
            'path' => 'required|string',
            'size' => 'required|string',
            'type' => 'required|string',
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->messages()
            ]);

        }
        else
        {
            if($validator)
            {
                $total_files = count($request->file('files'));
                $cart = [];
                foreach ($request->file('files') as $file) {
                    // rename & upload files to uploads folder
                    $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                    // $path = 'C:\Users\dev2c\OneDrive\Desktop\meta\uploads';  // physical address on PC level to   store data on deshtop 
                    $path = public_path() . '/uploads';    // physical address on project level to store data  
                    $file->move($path, $name);
        
                    // store in db
                    $fileUpload = new Meta();
                    $fileUpload->filenames = $path.$name;
                    $fileUpload->save();
    
                    array_push($cart,$fileUpload);
                }
                
                if($fileUpload->save() && $total_files==$cart){
                    return response()->json(["data"=>$cart]);
    
                    // dd($file->toArray());
                }

 
            }
        }
    }

    
    public function showDetail(){
        

        $post = TemplePost::with(['user',
            'meta',
            'meta.user',
            'comments',  
            'comments.user',  
            'comments.replies',  
            // 'comment.replies.user',  
    ])->find(1);

        
        return response()->json([
            'data' => $post
        ]);
    }
}
