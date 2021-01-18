<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;
use Config;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = Category::paginate();
        return CategoryResource::collection($cate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cate = new Category();
        $result = Config::get('myConstants.action.success');
        try {
            $cate = Category::Create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'role_id'=>$request->input('role_id'),
                'password'=>Hash::make($request->input('password')),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return response(new CategoryResource($cate, $result));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate = Category::findOrFail($id);
        return  new CategoryResource($cate);
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
        $cate = new Category();
        $result = Config::get('myConstants.action.success');
        try {
            $cate =  Category::findOrFail($id);
            $cate ->update([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return  response(new CategoryResource($cate, $result));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Config::get('myConstants.action.success');
        try {
            Category::destroy($id);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return response()->json(null, $result);
    }
}
