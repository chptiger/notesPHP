<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Exception;
use \Illuminate\Support\Facades\Hash;
/**
 * Class GamessController
 * @package App\http\controllers
 */

class UsersController extends Controller
{
    /**
     * GET /users
     * @return array
     */
    public function index()
    {

        try{
            return User::all();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * GET /users/{id}
     * @return mixed
     */
    public function show($id)
    {
        try {
            return  User::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'User not found'
                ]], 404);
        }
    }


    /**
     * POST /users
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users'
        ]);

        try {
            $user = $request->all();
            $user['password']=Hash::make($user['password']);
            User::create($user);
        } catch (\Exception $e) {
            dd(get_class($e));
        }
        return response()->json(['created' => true], 201);
    }

    /**
     * PUT /users/{id}
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id) {
        if($request->has('password')){
            $this->validate($request, [
                'password' => 'required|min:8'
            ]);
        }
        if($request->has('email')){
            $this->validate($request, [
                'email' => 'required|email|unique:users'
            ]);
        }

        try {

            $user = User::findOrFail($id);
            if($request->has('password')){
                $nuser = $request->all();
                $nuser['password']=Hash::make($nuser['password']);
                $user->fill($nuser);
                $user->save();
//                return $user;
            }else{
                $user->fill($request->all());
                $user->save();
//                return $user;
            }

        } catch (\Exception $e) {
           dd($e->getMessage());
        }
        return $user;
    }

    /**
     * DELETE /users/{id}
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
            'error' => [
                'message' => 'User not found'
            ] ], 404);
        }
        $user->delete();
        return response(null, 204);
    }
}