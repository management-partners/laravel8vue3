<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Hash;
use Config;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Models\Role;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * check login infomation.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $role = Role::find($user->role_id);
            $token = $user->createToken($role->name)->accessToken;

            return [ 'token' => $token ];
        }
        return response(['error'=> 'Invalid Cedentials!'], Response::HTTP_UNAUTHORIZED);
    }
    /**
         * regiter user infomation into system.
         *
         * @param  Request $request
         * @return \Illuminate\Http\Response
         */
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $result = Config::get('myConstants.action.success');
        try {
            $user = $user::Create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return response()->json($user, $result);
    }
}
