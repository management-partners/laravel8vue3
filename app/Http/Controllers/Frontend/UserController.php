<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Frontend\UserRequest;
use App\Models\User;
use Hash;
use Auth;
use Config;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return User::all();
        return User::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return User::findOrFail($id);
        return  response()->json(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = new User();
        $result = Config::get('myConstants.action.success');
        try {
            $user =  $user::findOrFail($id);
            $user ->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        
        return  response()->json($user, $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = new User();
        $result = Config::get('myConstants.action.success');
        try {
            $user = $user::destroy($id);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        
        return response()->json(null, $result);
    }

    /**
     * get profile user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user($id)
    {
        return response()->json(Auth::user());
    }

    /**
     * update user infomation.
     *
     * @param UpdateInfoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = Auth::user();
        $result = Config::get('myConstants.action.success');
        try {
            $user =  $user::findOrFail($id);
            $user ->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        
        return  response()->json($user, $result);
    }

    /**
     * update password of user infomation.
     *
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $result = Config::get('myConstants.action.success');
        try {
            $user =  $user::findOrFail($id);
            $user ->update([
                'password'          =>Hash::make($request->input('password')),
                'password_confirm'  =>Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        
        return  response()->json($user, $result);
    }
}
