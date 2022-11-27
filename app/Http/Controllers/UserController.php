<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function login(Request $request)
    {
        try {
            
            $email = $request->email;
            
            $pass = $request->password;

            $user = User::firstWhere('email', $email);

            $passBD = $user->password;

            if(Hash::check($pass, $passBD)){

                $jwt = JWT::encode([$user], env('JWT_SECRET'), 'HS256');

                return response()->json(
                    [
                    'code'=> 200,
                    'status'=> 'Ok',
                    'data'=> $user,
                    'token'=> $jwt
                    ]
                );

            }else{
                return response()->json(
                    [
                    'code'=> 401,
                    'message' => 'usuario o contraseña incorrectos'
                    ]
                );
            };

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
        try {
            
            $request->request->add([
                'password' => Hash::make($request->input('password'))
            ]);

            User::create($request->all());

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
           
            $payload = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            
            $payloadA = (array) $payload;

            if($payloadA[0]->rol_id == 2 || $payloadA[0]->rol_id == 3) {

                $pass = $request->password;

                if($payloadA[0]->id == $id) {

                    if($pass == null){

                        $user = User::find($id);
        
                        $user->update($request->all());
                    }else{
        
                        $user = User::find($id);
        
                        $request->request->add([
                            'password' => Hash::make($request->input('password'))
                        ]);
        
                        $user->update($request->all());
                    }
        
                    return response()->json(
                        [
                        'code' => 201,
                        'status' => 'ok',
                        'data' => $user,
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

            $user = User::find($id);
        
            $user->delete();
            
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
