<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Config;
use App\Http\Resources\RoleResource;
use DB;
use Gate;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view', 'roles');
        $role = Role::paginate();
        return RoleResource::collection($role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('edit', 'roles');
        $role = new Role();
        $result = Config::get('myConstants.action.success');
        try {
            // create new role
            $role = Role::create([
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
            ]);

            // create new permission for this role
            if ($permission = $request->input('permission')) {
                foreach ($permission as $per_id) {
                    DB::table('role_permission')->insert([
                        'role_id'       => $role->id,
                        'permission_id' => $per_id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response(new RoleResource($role, $result));
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
        Gate::authorize('view', 'roles');
        return response(new RoleResource(Role::findOrFail($id)));
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
        Gate::authorize('edit', 'roles');
        $role = new Role();
        $result = Config::get('myConstants.action.success');
        try {
            // update role infomation
            $role =  $role::findOrFail($id);
            $role ->update([
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
            ]);
            // delete old permission
            DB::table('role_permission')->where('role_id', $role->id)->delete();
            // create new permission for this role
            if ($permission = $request->input('permission')) {
                foreach ($permission as $per_id) {
                    DB::table('role_permission')->insert([
                        'role_id'       => $role->id,
                        'permission_id' => $per_id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response(new RoleResource($role, $result));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('edit', 'roles');
        $role = new Role();
        $result = Config::get('myConstants.action.success');
        try {
            // delete old permission
            DB::table('role_permission')->where('role_id', $id)->delete();
            // delete this role
            $role = $role::destroy($id);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return response()->json(null, $result);
    }
}
