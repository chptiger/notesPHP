<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:8',
            'email' => 'required|email'
        ]);

        try {

            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['error'=>'user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['error'=>'token_expired'], 401);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['error'=>'token_invalid'], 401);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['error'=>'token_absent:'.$e->getMessage()], 401);

        }catch(\Exception $e){
            dd($e->getMessage());
        }
        return response()->json(compact('token'));
    }

    /**
     * {post}
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {
      try{
        if(\JWTAuth::invalidate(\JWTAuth::getToken()))
//          if($this->jwt->parseToken()->invalidate())
        {
          return response()->json(['success'=>'Logout Successfully'], 200);
        }
      }catch(\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e){
        return response()->json(['error'=>'Token alrealdy been blacklisted'], 500);
      }catch(\Exception $e){
        dd($e->getMessage());
        }

    }

}
