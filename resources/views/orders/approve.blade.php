@extends('layout')
@section('content')

<x-navbar />

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4 mt-4">
    <table class="w-full text-sm text-center text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">User</th>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Quantity Requested</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="odd:bg-slate-50 even:bg-gray-100 border-b hover:bg-indigo-200 border border-gray-200">
                    <td class="px-6 py-4">
                        {{ $order->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        <img class="w-14 md:block"
                            src={{asset('/storage/' . $order->item->image )}} alt="" />
                            
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $order->item->name }}
                    </th>
                    <td class="px-6 py-4">{{ $order->quantity }}</td>
                    <td class="px-6 py-4">{{ $order->order_date }}</td>
                    <td class="px-6 py-4 flex mt-4 justify-center">
                        <a href="/home/orders/approve/{{ $order->id }}">
                        <svg class="w-6 h-6 stroke-current hover:stroke-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                        </svg>
                        </a>

                        <a href="/home/orders/reject/{{ $order->id }}">
                            <svg class="w-6 h-6 stroke-current hover:stroke-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-4 text-center" colspan="6">No orders found.</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
</div>

@endsection