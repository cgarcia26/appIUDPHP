<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;

class CategoryController extends Controller
{

    public function allCategory()
    { 
        try {
            
            $category = Category::all()->toArray();

            return response()->json(
                [
                'code' => 200,
                'status' => 'ok',
                'data' =>$category
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

    public function findCategoryId($id)
    { 
        try {
            
            $category = Category::find($id);

            return response()->json(
                [
                'code' => 200,
                'status' => 'ok',
                'data' =>$category
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
            
            Category::create($request->all());

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
            
            $category = Category::find($id);

            $category-> description = $request->description;
       
            $category-> save();

            return response()->json(
                [
                'code' => 201,
                'status' => 'ok',
                'data' => $category,
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
         
            $category = Category::find($id);
        
            $category-> delete();
            
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
