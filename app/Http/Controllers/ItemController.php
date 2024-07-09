<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index(Request $request)
    {   
        //$query = Item::query();
        $items_list;

        if ($request->has('search')) {
            // $query->where('name', 'like', '%' . $request->input('search') . '%');
            $items_list = Item::where('name', 'like', '%' . $request->input('search') . '%')->sortable()->paginate(10);
        } else {
            $items_list = Item::sortable()->paginate(10);
        }

        //$items_list = Item::$query->get()
        return view('items', ['items' => $items_list]);
    }

    public function new(Request $request)
    {
        // dd($request->all());
        $newItem = $request->validateWithBag('new', [
            'name' => ['required', Rule::unique('items')],
            'category' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $item = Item::create($newItem);
        // return redirect('/home')->with('message', 'Item created successfully');
        return back()->with('message', 'Item created successfully');
    }

    public function editview($id, Request $request)
    {
        //dd($id);
        $item = Item::find($id);
        return back()->with('it', $item);
    }

    public function edit($id, Request $request)
    {
        //dd($id);
        $item = Item::find($id);
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('items')->ignore($item->id)],
            'category' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('it', $item)->withErrors($validator, 'edit');
        }

        $item->name = $request->input('name');
        $item->category = $request->input('category');
        $item->description = $request->input('description');
        $item->quantity = $request->input('quantity');

        $item->save();
        return back()->with('message', 'Item updated successfully');
    }

    public function order($id, Request $request)
    {
        $item = Item::find($id);
        return view('order', ['item' => $item]);
    }

    

    

}
