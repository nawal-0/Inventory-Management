@extends('layout')    
@section('content')
    <div class="bg-primary">
        <nav class="flex justify-end items-center mb-4 h-11">
            
            <ul class="flex space-x-6 mr-6 text-sm text-white hover:text-black">
                <li>
                    <form method="POST" action="/users/logout">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
   
<x-actions_bar />

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Quantity</th>
                <th scope="col" class="px-6 py-3">Actions</th>

            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr class="odd:bg-white even:bg-gray-100 border-b hover:bg-indigo-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $item->name }}
                    </th>
                    <td class="px-6 py-4">{{ $item->description }}</td>
                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                    <td class="px-6 py-4">--</td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-4 text-center" colspan="3">No items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


         
@endsection

