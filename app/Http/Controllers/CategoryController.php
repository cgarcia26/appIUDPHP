<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CategoryController extends Controller
{

    public function allCategory()
    { 
        
        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {
            
            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));

            $category = Category::all()->toArray();

            return response()->json(
                [
                'code' => 200,
                'status' => 'ok',
                'data' =>$category
                ]
                );

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

    public function findCategoryId($id)
    { 

        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {

            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $category = Category::find($id);

            return response()->json(
                [
                'code' => 200,
                'status' => 'ok',
                'data' =>$category
                ]
                );

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

            Category::create($request->all());

            return response()->json(
                [
                'code' => 201,
                'status' => 'ok',
                'data' => $request->all(),
                ]
                );

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

    public function destroy($id)
    {

        $jwt = substr($request->header('Authorization', 'token <token>'), 7);

        try {

            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
         
            $category = Category::find($id);
        
            $category->delete();
            
            return response()->json(
                [
                'code' => 204,
                'status' => 'success'
                ]
                );

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
