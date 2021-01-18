<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\ProductResource;
use App\Http\Requests\Frontend\ProductRequest;
use App\Models\Gallery;
use App\Models\Product;
use Config;
use Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view', 'products');
        $product = Product::paginate();

        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Gate::authorize('edit', 'products');
        $product = new Product();
        $result = Config::get('myConstants.action.success');
        $upload_path =  env('PRODUCT_PATH');
        try {
            // $file = $request->file('image');

            $product = Product::Create([
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'price'         => $request->input('price'),
                'cate_id'       => $request->input('cate_id'),
            ]);
            if (!empty($request->file('images'))) {
                foreach ($request->file('images') as $file) {
                    $path_img = $upload_path.$file->getClientOriginalName();
                    Gallery::Create(
                        [
                            'path'          => $path_img,
                            'product_id'    => $product->id
                        ]
                    );
                    \Storage::disk('public')->put($file->getClientOriginalName(), $file->getClientOriginalName());
                    // \Storage::putFileAs('disk', $file, $file->getClientOriginalName());
                }
            }
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
        Gate::authorize('view', 'products');
        return new ProductResource(Product::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        Gate::authorize('edit', 'products');
        $product = new Product();
        $result = Config::get('myConstants.action.success');
        $upload_path =  env('PRODUCT_PATH');
        try {
            $product = Product::findOrFail($id);
            $product ->update([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'price'=>$request->input('price'),
                'cate_id'=>$request->input('cate_id'),
            ]);

            $gallery = Gallery::findOrFail($id);
            foreach ($gallery as $g) {
                \Storage::delete('public/images/products'.$g->path);
            }
            foreach ($request->file('image') as $file) {
                $gallery ->update(
                    [
                        'path'          => $upload_path.$file->getClientOriginalName(),
                        'product_id'    => $id
                    ]
                );
                \Storage::putFileAs('public/images/products', $file, $file->getClientOriginalName());
            }
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
        Gate::authorize('edit', 'products');
        $result = Config::get('myConstants.action.success');
        try {
            Product::destroy($id);
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }

        return response()->json(null, $result);
    }
}
