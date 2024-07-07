<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index(Request $request)
    {   
        $query = Item::query();
        $items_list = Item::all();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $items_list = $query->get();
        return view('items', ['items' => $items_list]);
    }

    public function new(Request $request)
    {
        // dd($request->all());
        $newItem = $request->validate([
            'name' => ['required', Rule::unique('items')],
            'category' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $item = Item::create($newItem);
        // return redirect('/home')->with('message', 'Item created successfully');
        return back()->with('message', 'Item created successfully');
    }

    public function edit($id, Request $request)
    {
        $item = Item::find($id);

        $request->validate([
            'name' => ['required', Rule::unique('items')->ignore($item->id)],
            'category' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $item->name = $request->input('name');
        $item->category = $request->input('category');
        $item->description = $request->input('description');
        $item->quantity = $request->input('quantity');

        $item->save();



        
    }

    

}
