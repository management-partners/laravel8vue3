<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Frontend\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Config;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::paginate();
        return OrderResource::collection($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = new Order();
        $result = Config::get('myConstants.action.success');
        try {
            $order= Order::created([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'email'=>$request->input('email'),
                'post_code'=>$request->input('post_code'),
                'address'=>$request->input('address'),
                'tel'=>$request->input('tel'),
                'mobile'=>$request->input('mobile'),
                'mobile'=>$request->input('mobile'),
            ]);
            $orderDetail = $request->input('order_detail');
            foreach ($orderDetail as $odUpdate) {
                OrderDetail::created(
                    [
                        'product_name' => $odUpdate->product_name,
                        'product_description' => $odUpdate->product_description,
                        'product_image' => $odUpdate->product_image,
                        'price' => $odUpdate->price,
                        'quantity' => $odUpdate->quantity,
                    ]
                );
            }
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response(new OrderResource($order, $result));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OrderResource(Order::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $order = new Order();
        $result = Config::get('myConstants.action.success');
        try {
            $order = Order::findOrFail($id);
            $order ->update([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'email'=>$request->input('email'),
                'post_code'=>$request->input('post_code'),
                'address'=>$request->input('address'),
                'tel'=>$request->input('tel'),
                'mobile'=>$request->input('mobile'),
                'mobile'=>$request->input('mobile'),
            ]);
            $orderDateil = $request->input('order_detail');
            $locaOrderDetail = OrderDetail::where('order_id', $id);
            foreach ($locaOrderDetail as $od) {
                foreach ($orderDateil as $odUpdate) {
                    if ($od->id == $odUpdate->id) {
                        $od->update(
                            [
                                'product_name' => $odUpdate->product_name,
                                'product_description' => $odUpdate->product_description,
                                'product_image' => $odUpdate->product_image,
                                'price' => $odUpdate->price,
                                'quantity' => $odUpdate->quantity,
                            ]
                        );
                    } else {
                        $orDetail = OrderDetail::findOrFail($od->id);
                        $orDetail ->delete();
                    }
                }
            }
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response(new OrderResource($order, $result));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = new Order();
        $result = Config::get('myConstants.action.success');
        try {
            Order::find($id)->destroy();
        } catch (\Exception $e) {
            $result = Config::get('myConstants.action.fail');
        }
        return  response(null, $result);
    }
    public function exportCSV()
    {
        $headers=[
            "Content-type"          => "text/csv",
            "Content-Disposition"   => "attachment; filename=Order.csv",
            "Pragma"                => "no-cache",
            "Cache-Control"         => "must-revalidate, post-check=0, pre-check=0",
            "Expires"               => 0,
        ];
        $callback = function () {
            $orders = Order::all();
            $file = fopen('php://output', 'w');
            // create header file
            fputcsv($file, ['Order ID', 'Order Name', 'Email', 'Post Code', 'Address', 'Tel', 'Mobile', 'Product Name', ' Quantity', 'Price', 'Total']);
            // create content file
            foreach ($orders as $order) {
                fputcsv($file, [$order->id, $order->name,  $order->email,  $order->post_code,  $order->address,  $order->tel,  $order->mobile, '', ' ', '', '']);
                foreach ($order->orderDetail as $detail) {
                    fputcsv($file, ['', '',  '',  '',  '',  '',  '', $detail->product_name,  $detail->quantity,  $detail->price,  $detail->total]);
                }
            }
            fclose($file);
        };
        return \Response::stream($callback, 200, $headers);
    }
}
