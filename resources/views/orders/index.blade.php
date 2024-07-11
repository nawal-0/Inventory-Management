@extends('layout')
@section('content')

<x-navbar />

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4 mt-4">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Quantity Ordered</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="odd:bg-slate-50 even:bg-gray-100 border-b hover:bg-indigo-200 border border-gray-200">
                    <td class="px-6 py-4">
                        <img class="w-14 md:block"
                            src={{asset('/storage/' . $order->image )}} alt="" />
                            
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $order->name }}
                    </th>
                    <td class="px-6 py-4">{{ $order->quantity }}</td>
                    <td class="px-6 py-4">{{ $order->order_date }}</td>
                    <td class="px-6 py-4">{{ $order->status }}</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-red-600 hover:underline">Cancel</a>
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