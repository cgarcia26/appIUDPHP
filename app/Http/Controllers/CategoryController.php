<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CategoryController extends Controller
{

    public function allCategory(Request $request)
    { 
        
        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {
            
            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1 || $payloadA[0]->rol_id == 2 || $payloadA[0]->rol_id == 3) {

            $category = Category::all()->toArray();

                return response()->json(
                    [
                    'code' => 200,
                    'status' => 'ok',
                    'data' =>$category
                    ]
                    );

            }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            }    

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

    public function findCategoryId(Request $request, $id)
    { 

        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {

            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1 || $payloadA[0]->rol_id == 2 || $payloadA[0]->rol_id == 3) {

            $category = Category::find($id);

                return response()->json(
                    [
                    'code' => 200,
                    'status' => 'ok',
                    'data' =>$category
                    ]
                    );
            }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            }      

        } catch (\Exception $th) {

            $error =  $th->getMessage();

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

        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {
            
            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1) {

            Category::create($request->all());

                return response()->json(
                    [
                    'code' => 201,
                    'status' => 'ok',
                    'data' => $request->all(),
                    ]
                    );

            }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            } 

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

        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {

            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1) {

            $category = Category::find($id);

            $category->description = $request->description;
       
            $category->save();

                return response()->json(
                    [
                    'code' => 201,
                    'status' => 'ok',
                    'data' => $category,
                    ]
                    );

            }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            } 

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

        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {

            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
         
            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1) {

            $category = Category::find($id);
        
            $category->delete();
            
                return response()->json(
                    [
                    'code' => 204,
                    'status' => 'success'
                    ]
                    );

            }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario no autorizado'
                    ]
                );
            } 

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
