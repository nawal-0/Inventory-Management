<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {   
        if (request('search')) {
            return view('items', ['items' => Item::where('name', 'like', '%' . request('search') . '%')->get()]);
        } else {
            return view('items', ['items' => Item::all()]);
        }
        //return view('items', ['items' => Item::all()]);
    }

}
