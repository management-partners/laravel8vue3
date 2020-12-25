<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Config;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate();

        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $result = Config::get('myConstants.action.success');
        try {
            $file = $request->file('image');
            $product = Product::Create([
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'image'         => '/images/product/'.$file->getFilename(),
                'price'         => $request->input('price'),
                'cate_id'       => $request->input('cate_id'),
            ]);
            \Store::putFileAs('image', $file, $file->getFilename());
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return response(new ProductResource($product, $result));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
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
        $product = new Product();
        $result = Config::get('myConstants.action.success');
        try {
            $product = Product::findOrFail($id);
            $product ->update([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'image'=>$request->input('image'),
                'price'=>$request->input('price'),
                'cate_id'=>$request->input('cate_id'),
            ]);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response(new ProductResource($product, $result));
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
            Product::destroy($id);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return response()->json(null, $result);
    }
}
