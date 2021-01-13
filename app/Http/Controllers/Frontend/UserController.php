<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserRequest;
use App\Http\Resources\Frontend\UserResource;
use App\Models\Frontend\User;
use Hash;
use Auth;
use Config;
use Gate;

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
        Gate::authorize('view', 'users');
        $lstUsr = User::with('role')->paginate();
        return UserResource::collection($lstUsr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        Gate::authorize('edit', 'users');
        $user = new User();
        $result = Config::get('myConstants.action.success');
        try {
            $user = $user::Create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'role_id'=>$request->input('role_id'),
                'password'=>Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return response(new UserResource($user, $result));
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
        Gate::authorize('view', 'users');
        $user = User::with('role')->findOrFail($id);
        return  new UserResource($user);
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
        Gate::authorize('edit', 'users');
        $user = new User();
        $result = Config::get('myConstants.action.success');
        try {
            $user =  $user::findOrFail($id);
            $user ->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'role_id'=>$request->input('role_id'),
                'password'=>Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return  response(new UserResource($user, $result));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('edit', 'users');
        $result = Config::get('myConstants.action.success');
        try {
            User::destroy($id);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return response()->json(null, $result);
    }

    /**
     * get profile user.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        $user = Auth::user();

        return (new UserResource($user))->additional([
            'data' => [
                'permission' => $user->permission()
            ]
        ]);
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
            $user ->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return  response(new UserResource($user, $result));
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
            $user ->update([
                'password'          =>Hash::make($request->input('password')),
                'password_confirm'  =>Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return  response(new UserResource($user, $result));
    }
}
