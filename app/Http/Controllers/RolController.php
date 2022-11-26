<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Firebase\JWT\Key;

class RolController extends Controller
{
    public function allRol(Request $request)
    {      
      
        $jwt = substr($request->header('Authorization', 'token <token>'), 7);
        
        try {
            
            JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 1 || $payloadA[0]->rol_id == 2) {

                $rol = Rol::all()->toArray();

                return response()->json(
                    [
                    'code' => 200,
                    'status' => 'ok',
                    'data' =>$rol
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
