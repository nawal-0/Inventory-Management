<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // show new order form
    public function create($id) {
        $item = Item::find($id);
        return view('orders.create', ['item' => $item]);
    }

    // store new order
    public function store($id, Request $request) {
        $order = $request->validate([
            'quantity' => 'required|numeric',
        ]);

        $order['user_id'] = auth()->id();
        $order['item_id'] = $id;
        $order['status'] = 'pending';
        $order['order_date'] = now();


        Order::create($order);
        return redirect('/home')->with('message', 'Order placed successfully');
    }

    // show a user's orders
    public function index(Request $request) {
        //dd(auth()->user());
        $orders = auth()->user()->orders()->with('item')->latest()->paginate(10);
        return view('orders.index', ['orders' => $orders]);
    }

}
