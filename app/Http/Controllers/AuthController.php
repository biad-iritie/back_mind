<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;
//use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
//use Tymon\JWTAuth\JWTAuth;
/* use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory; */
//use JWTFactory;
use JWTAuth;
//use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
//use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function register(UserRequest $request)
    {
        try{
            $user = User::create([
                'type_user_id' => $request->type_user_id,
                'nom_user' => $request->nom_user,
                'password' => bcrypt($request->password),
                'prenom_user' => $request->prenom_user,
                'numero_user' => $request->numero_user,
                'email' => $request->email,
            ]);
            
            //$token = auth()->login($user);
    
            $token = JWTAuth::fromUser($user);
            //return response()->json(compact('user','token'),201);
            return $this->respondWithToken(
                0,
                "Le compte crée avec succès",
                $token,
                $user,
                201
            );
        }catch(QueryException $e){
            return response()->json([
                'Désolé aucune suite'
            ]);
        } 
        
        /* return response()->json([
            'data' => new UserResource($user) ,
            'code' => 0
        ]); */
    }

    public function login(Request $request)
    {
        $code = null;
        $code_http = null;
        $msg = null;
        $token = null;
        $user = null;
        //$request->pwd_user = bcrypt($request->pwd_user);
        $credentials = $request->only(['password', 'email']);
        //$credentials = array('email_user' => $request->email_user, 'pwd_user' => bcrypt($request->pwd_user));


        try {
                
                 
                //dd($token);
            if (!$token = JWTAuth::attempt($credentials)) {
                $code = 1;
                $msg = "L'email ou le mot de passe est incorrect";
                
                    /* return $this->respondWithToken(1,
                    "L'email ou le mot de passe est incorrect",
                    $token,null,201); */
                    
                    //return response()->json(['error' => 'Unauthorized'], 401);
            } else {
                $code = 0;
                $code_http = 201;
            }
            //dd($credentials['email']);
            $user = User::where('email','=',$credentials['email'])->firstOrFail();
                 
                //$user = User::find();
                //$user = JWTAuth::authenticate('Bearer'+$token);
        } catch (JWTException $e) {
            $code = 2;
            $code_http = 401;
                /* return response()->json([
                    'data' => null,
                    'code' => 2,
                    'message' => null,
                    //'error' => 'could_not_create_token'
                ],401); */
                //return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return $this->respondWithToken($code, $msg, $token, $user, $code_http);
    }
    public function getAuthUser()
    {
        //dd($request->token);
        
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            
    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        
        //$token = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json(['token_expired','new' => $token], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

    }

    return response()->json(compact('user'));
    }
    protected function respondWithToken($code, $msg = null, $token = null, $user = null, $code_http = null)
    {

        //var_dump($token);
        return response()->json([
            'code' => $code,
            'message' => $msg,
            'user' => $user ,
            'token' => $token,
            'token_type' => 'Bearer',
            //'expires_in' =>  auth()->factory()->getTTL() * 60
        ]);
    }
}
