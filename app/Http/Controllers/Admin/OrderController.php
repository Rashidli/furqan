<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::query()->with('customer','items.product')->withCount('items')->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::with('customer', 'items')->withCount('items')->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {

        $order->update(['status' => $request->input('status')]);

        return redirect()->route('orders.index')->with('message', 'Status dəyişdirildi');
    }

}
