<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $orders = Order::all();
        return view('orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }


    public function show(Order $order)
    {
        return view('orders.view')
            ->with('order', $order);
    }


    public function edit(Order $order)
    {
        return view('orders.edit')
            ->with('order', $order)
            ->with('statuses', \App\Enum\OrderStatus::cases());
    }


    public function update(Request $request, Order $order)
    {
        $validated = \Validator::validate($request->input(), [
            'status' => [
                'required',
                new Enum(\App\Enum\OrderStatus::class)
            ]
        ]);

        $order->update($validated);
        return redirect()->route('orders.edit', $order)->with('message', 'Order updated');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect(route('orders.index'));
    }
}
