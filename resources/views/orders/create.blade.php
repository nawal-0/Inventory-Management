@extends('layout')
@section('content')

{{-- <x-navbar /> --}}

<header>
    <nav class="bg-primary px-4 py-2.5">
        <div class="flex justify-between items-center mx-auto max-w-screen-xl">
            <div class="justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="/home" class="block py-2 px-3 text-gray-100 hover:text-white rounded-lg py-2 pr-4 pl-3 hover:bg-primary-dark"><- Back</a>
                    </li>
                    
                </ul>
            </div>
            
    </nav>
</header>

<div class="flex place-content-center">
<div class="relative overflow-x-auto border border-slate-200 shadow-lg w-3/4 sm:rounded-lg m-4">
    <h3 class="text-lg font-semibold text-gray-900 p-4">
        Order Item
    </h3>
    <form method="POST" action="/home/order/{{ $item->id }}">
        @csrf
    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="flex flex-col px-4 col-span-1">
            <label for="name" class="text-sm text-gray-900">Name</label>
            <input type="text" name="name" id="name" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->name }}" disabled readonly>
        </div>

        <div class="flex flex-col px-4 col-span-1 items-center">
            <img class="w-1/4" src={{asset('/storage/' . $item->image )}} alt="" />
        </div>

        <div class="flex flex-col px-4 col-span-2">
            <label for="description" class="text-sm text-gray-900">Description</label>
            <input type="text" name="description" id="description" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->description }}" disabled readonly>
        </div>

        <div class="flex flex-col px-4 col-span-1">
            <label for="category" class="text-sm text-gray-900">Category</label>
            <input type="text" name="category" id="category" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->category }}" disabled readonly>
        </div>

        <div class="flex flex-col px-4 col-span-1">
            <label for="quantity" class="text-sm text-gray-900">Current Quantity</label>
            <input type="number" name="quantity" id="quantity" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" value="{{ $item->quantity }}" disabled readonly>
        </div>
        
        <div class="flex flex-col p-4 col-span-1">
            <label for="quantity" class="text-sm text-gray-900">Quantity to Order</label>
            <input type="number" name="quantity" id="quantity" class="bg-gray-100 border border-gray-300 p-2 rounded mt-2" 
            required placeholder="Enter quantity...">
        </div>
    </div>
        <div class="flex justify-end p-4 justify-center">
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded">Order</button>
        </div>
    </form>
</div>
</div>




@endsection