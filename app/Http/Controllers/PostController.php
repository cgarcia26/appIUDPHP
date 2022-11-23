<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;

class PostController extends Controller
{
    public function allPost()
    { 
        try {
            
            $post = Post::all()->toArray();

            return response()->json(
                [
                'code' => 200,
                'status' => 'ok',
                'data' =>$post
                ]
                );

        } catch (Exception $th) {

            $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $th
                ]
                );
        }
    }

    public function findPostId($id)
    { 
        try {
            
            $post = Post::find($id);

            return response()->json(
                [
                'code' => 200,
                'status' => 'ok',
                'data' =>$post
                ]
                );

        } catch (Exception $th) {

            $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $th
                ]
                );
        }
    }

    public function store(Request $request )
    {
        try {
            
            Post::create($request->all());

            return response()->json(
                [
                'code' => 201,
                'status' => 'ok',
                'data' => $request->all(),
                ]
                );

        } catch (Exception $th) {

            $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $th
                ]
                ); 
        }
    }

    public function update(Request $request, $id)
    {
        try {
            
            $post = Post::find($id);

            if(description){
                $post-> description = $request->description;
                $post-> save();
            }
            //$post-> name = $request->name;
            $post-> description = $request->description;
            //$post-> state = $request->state;
            //$post-> content = $request->content;
            //$post-> category_id = $request->category_id; 
       
            $post-> save();

            return response()->json(
                [
                'code' => 201,
                'status' => 'ok',
                'data' => $post,
                ]
                );

        } catch (Exception $th) {

            $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $th
                ]
                ); 
        }
    }

    public function destroy($id)
    {
        try {
         
            $post = Post::find($id);
        
            $post-> delete();
            
            return response()->json(
                [
                'code' => 204,
                'status' => 'success'
                ]
                );

        } catch (Exception $th) {
            
            $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $th
                ]
                ); 
        }
    }

}
