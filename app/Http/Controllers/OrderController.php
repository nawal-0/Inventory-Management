<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\OrderStatus;

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

    // cancel an order
    public function cancel($id) {
        $order = Order::find($id);
        $order['status'] = 'cancelled';
        $order->save();
        return back()->with('message', 'Order cancelled successfully');
    }

    public function delete($id) {
        $order = Order::find($id);
        $order->delete();
        return back()->with('message', 'Order deleted successfully');
    }

    public function approveview() {
        $orders = Order::where('status', 'pending')->with('item')->with('user')->latest()->paginate(10);
        return view('orders.approve', ['orders' => $orders]);
    }

    public function approve($id) {
        $order = Order::find($id);
        $order['status'] = 'approved';
        $order->save();

        $order->user->notify(new OrderStatus($order));
        return back()->with('message', 'Order approved');
    }

    public function reject($id) {
        $order = Order::find($id);
        $order['status'] = 'rejected';
        $order->save();

        $order->user->notify(new OrderStatus($order));
        return back()->with('message', 'Order rejected');
    }

    public function readnotif($id) {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        $notification->markAsRead();
        return redirect('/home/orders');
    }

    public function readallnotif() {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }

}
