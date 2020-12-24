<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Config;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $result = Config::get('myConstants.action.success');
        try {
            $role = Role::create([
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response()->json($role, $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Role::findOrFail($id);
        return response()->json(Role::findOrFail($id));
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
        $role = new Role();
        $result = Config::get('myConstants.action.success');
        try {
            $role =  $role::findOrFail($id);
            $role ->update([
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response()->json($role, $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = new Role();
        $result = Config::get('myConstants.action.success');
        try {
            $role = $role::destroy($id);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        
        return response()->json(null, $result);
    }
}
