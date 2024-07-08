@extends('layout')
@section('content')

<x-dashboard />

<div class="relative overflow-x-auto shadow-md sm:rounded-lg m-4">
    <form method="POST" action="/home/order/{{ $item->id }}">
        @csrf
        <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="flex flex-col p-4 col-span-1">
            <label for="name" class="text-sm text-gray-500">Name</label>
            <input type="text" name="name" id="name" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->name }}" readonly>
        </div>

        <div class="flex flex-col p-4 col-span-2">
            <label for="description" class="text-sm text-gray-500">Description</label>
            <input type="text" name="description" id="description" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->description }}" readonly>
        </div>

        <div class="flex flex-col p-4 col-span-1">
            <label for="category" class="text-sm text-gray-500">Category</label>
            <input type="text" name="category" id="category" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->category }}" readonly>
        </div>

        <div class="flex flex-col p-4 col-span-1">
            <label for="quantity" class="text-sm text-gray-500">Current Quantity</label>
            <input type="number" name="quantity" id="quantity" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->quantity }}" readonly>
        </div>

        <div class="flex flex-col p-4 col-span-1">
            <label for="quantity" class="text-sm text-gray-500">Quantity to Order</label>
            <input type="number" name="quantity" id="quantity" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" 
            required placeholder="Enter quantity here...">
        </div>
    </div>
        <div class="flex justify-end p-4 justify-center">
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded">Order</button>
        </div>


</div>





@endsection