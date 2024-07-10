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
        return view('items', ['items' => Item::latest()->filter(request(['search']))->paginate(10)]);
    }

    public function new(Request $request)
    {
        // dd($request->all());
        $newItem = $request->validateWithBag('new', [
            'name' => ['required', Rule::unique('items')],
            'category' => 'required',
            'description' => 'required',
            'image' => ['required', 'mimes:jpeg,png,jpg', 'max:2048'],
            'quantity' => 'required|numeric',
        ]);

        $filepath =  $request->file('image')->store('items', 'public');
        //dd($filepath);
        $newItem['image'] = $filename;

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
            'image' => ['required', 'mimes:jpeg,png,jpg', 'max:2048'],
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('it', $item)->withErrors($validator, 'edit');
        }

        $item->name = $request->input('name');
        $item->category = $request->input('category');
        $item->description = $request->input('description');
        $item->quantity = $request->input('quantity');

        $currentImage = $item->image;
        $newImagePath = $request->file('image')->store('items', 'public');

        // delete the old image
        if ($currentImage && Storage::disk('public')->exists($currentImage)) {
            Storage::disk('public')->delete($currentImage);
        }

        $item->image = $newImagePath;
        $item->save();
        return back()->with('message', 'Item updated successfully');
    }

    public function order($id, Request $request)
    {
        $item = Item::find($id);
        return view('order', ['item' => $item]);
    }

    

    

}
