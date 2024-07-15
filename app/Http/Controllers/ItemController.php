<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(Request $request)
    {   
        return view('items.index', ['items' => Item::latest()->filter(request(['search']))->autosort()->paginate(10)]);
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
        $newItem['image'] = $filepath;

        $item = Item::create($newItem);
        // return redirect('/home')->with('message', 'Item created successfully');
        return redirect('/home')->with('message', 'Item added successfully');
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
        // if ($currentImage && Storage::disk('public')->exists($currentImage)) {
        //     Storage::disk('public')->delete($currentImage);
        // }

        $item->image = $newImagePath;
        $item->save();
        return back()->with('message', 'Item updated successfully');
    }


    

    

}
