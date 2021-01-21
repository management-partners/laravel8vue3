<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\ChartResource;
use App\Models\Order;
use Gate;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    public function chart()
    {
        Gate::authorize('view', 'orders');
        $order = Order::query()
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, SUM(order_details.quantity*order_details.price) as total_order")
            ->groupBy('date')
            ->get();
        return ChartResource::collection($order);
    }
    public function chartForYear($year)
    {
        Gate::authorize('view', 'orders');
        $order = Order::query()
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, SUM(order_details.quantity*order_details.price) as total_order")
            ->groupBy('date')
            ->whereYear('orders.created_at', $year)
            ->get();
        
        return ChartResource::collection($order);
    }
    public function chartAllYear()
    {
        Gate::authorize('view', 'orders');
        $order = Order::query()
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y') as date")
            ->groupBy('date')
            ->get();
        return response()->json($order);
    }
}
