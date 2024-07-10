<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create($id) {
        $item = Item::find($id);
        return view('orders.create', ['item' => $item]);
    }

}
