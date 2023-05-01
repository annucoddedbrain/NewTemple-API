<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\TempleComment;
use App\Models\TemplePost;
use App\Models\User;

class TempleCommentController extends Controller
{
    public function createComment(Request $request){
        $user = User::all()->find(2);
        $post = TemplePost::all()->find(2);

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
            // 'post_id' => 'required',
            // 'user_id' => 'required',
            'parent_id' => 'nullable',
            'rating' => 'required|min:1|max:5|integer'
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
                $comment = TempleComment::create([
                    'user_id' => $user->id,
                    'temple_post_id' => $post->id,
                    'comment' => $request->comment,
                    'rating' => $request->rating,
                    'parent_id' => $request->parent_id
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "User has been Comment successfully.",
                    "data" =>   $comment 
                ]);
            } 
            else{
                return response()->json([
                    "message" => "error"
                ]);
            }

 
        }
    }



    public function getAllCommentByPost_id(Request $request){
        
        $comment = TemplePost::with([
            'user',
            'posts'
        ])->get();

        
        return response()->json([
            'data' => $comment
        ]);
        
    }


}