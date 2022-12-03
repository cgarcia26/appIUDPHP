<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PostController extends Controller
{
    public function allPost(Request $request)
    { 

       // $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {
            
            /*JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1 || $payloadA[0]->rol_id == 2 || $payloadA[0]->rol_id == 3) { */

            $posts = Post::all()->toArray();

            $postData = [];
            
            foreach($posts as $post){
                $categoryName = Category::find($post['category_id'])->name;
                $userName = User::find($post['user_id'])->name;
                $newData = [
                    "id"=> $post["id"],
                    "name"=> $post["name"],
                    "description"=> $post["description"],
                    "content"=> $post["content"],
                    "state"=> $post["state"],
                    "category_id"=> $post["category_id"],
                    "user_id"=> $post["user_id"],
                    "created_at"=> $post["created_at"],
                    "updated_at"=> $post["updated_at"],
                    "categoryName"=> $categoryName,
                    "userName"=> $userName
                ];
                array_push($postData, $newData);
            }; 
                return response()->json(
                    [
                    'code' => 200,
                    'status' => 'ok',
                    'data' =>$postData
                    ]
                    );

            /*}else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            }   */  

        } catch (\Exception $th) {

            $error = $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $error
                ]
                );
        }
    }

    public function findPostId(Request $request, $id)
    { 

        //$jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {
            
           /* JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1 || $payloadA[0]->rol_id == 2 || $payloadA[0]->rol_id == 3) {*/

            $post = Post::find($id);

                return response()->json(
                    [
                    'code' => 200,
                    'status' => 'ok',
                    'data' =>$post
                    ]
                    );

            /*}else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            } */

        } catch (\Exception $th) {

            $error = $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $error
                ]
                );
        }
    }

    public function store(Request $request )
    {

        //$jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {
            
           /* JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 2 ) {*/

            Post::create($request->all());

            $post = $request->all();

                return response()->json(
                    [
                    'code' => 201,
                    'status' => 'ok',
                    'data' => $post
                    ]
                    );
            
           /* }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            } */

        } catch (\Exception $th) {

            $error = $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $error
                ]
                ); 
        }
    }

    public function update(Request $request, $id)
    {

        //$jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {

            /*JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1 || $payloadA[0]->rol_id == 2) {*/
            
            $post = Post::find($id);

            $post->update($request->all());

                return response()->json(
                    [
                    'code' => 201,
                    'status' => 'ok',
                    'data' => $post,
                    ]
                    );

            /*}else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            }*/

        } catch (\Exception $th) {

            $error = $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $error
                ]
                ); 
        }
    }

    public function destroy(Request $request, $id)
    {

       // $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {
         
            /*JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1 || $payloadA[0]->rol_id == 2) {*/

            $post = Post::find($id);
        
            $post->delete();
            
                return response()->json(
                    [
                    'code' => 204,
                    'status' => 'success'
                    ]
                    );

           /* }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            } */

        } catch (\Exception $th) {
            
            $error = $th->getMessage();

            return response()->json(
                [
                'code' => 500,
                'status' => 'error',
                'data' => $error
                ]
                ); 
        }
    }

}
