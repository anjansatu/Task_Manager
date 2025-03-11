<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ssn;
use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderHistory')->get();
        return view('orders.index', compact('orders'));
    }

    // public function create()
    // {
    //     $ssns = Ssn::all();
    //     return view('user.order.create', compact('ssns'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'amount' => 'required|numeric',
            'ssn_id' => 'required',
        ]);

        $ssn = Ssn::findOrFail($request->ssn_id)->where('first_name', 'last_name', 'address', 'zip', 'ssn', 'dob', 'year', 'country')->first();

        $order = Order::create([
            'user_id' => $request->user_id,
            'order_id' => uniqid('ORD-'),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        OrderHistory::create([
            'order_id' => $order->id,
            'first_name' => $ssn->first_name,
            'last_name' => $ssn->last_name,
            'address' => $ssn->address,
            'city' => $ssn->city,
            'state' => $ssn->state,
            'zip' => $ssn->zip,
            'ssn' => $ssn->ssn,
            'dob' => $ssn->dob,
            'year' => $ssn->year,
            'country' => $ssn->country,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

}
