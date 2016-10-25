<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\JWTAuth;
use App\User;

class JwtMiddleware
{
    /**
     * if token provided
     * 1. verify token with operator's API to get user profile;
     * 2. check if player exists in our db, if not, save it first
     * 3. generate a jwt stored at player side(cookie? localStorage? sessionStorage?)
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     protected $jwt;

     public function __construct(JWTAuth $jwt)
     {
         $this->jwt = $jwt;
     }
    public function handle($request, Closure $next)
    {
      try{
        if($user=\JWTAuth::parseToken()->authenticate())//get all user info from token, put user info into $request
        {
            $request->user = $user;
          return $next($request);
        }
      }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['error'=>'token_expired'.$e->getMessage()], 401);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['error'=>'token_invalid'.$e->getMessage()], 401);

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['error'=>'token_absent:'.$e->getMessage()], 401);

      }

    }
}
