@extends('layout')
@section('content')

<x-navbar />

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4 mt-4">
    <table class="w-full text-sm text-center text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">Request No.</th>
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
                    <td class="px-6 py-4">{{ $order->id }}</td>
                    <td class="px-6 py-4 flex justify-center">
                        <img class="w-14 md:block"
                            src={{asset('/storage/' . $order->item->image )}} alt="" />
                            
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $order->item->name }}
                    </th>
                    <td class="px-6 py-4">{{ $order->quantity }}</td>
                    <td class="px-6 py-4">{{ $order->order_date }}</td>
                    <td class="px-6 py-4">{{ $order->status }}</td>
                    <td class="px-6 py-4">
                        <a href="/home/orders/delete/{{ $order->id }}" class="block p-2 text-sm font-medium rounded-lg text-white bg-red-500 hover:bg-red-900">
                            {{ ($order->status == "pending") ? "Cancel" : "Delete" }}</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-4 text-center" colspan="7">No orders found.</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>

</div>

<div class="mt-4 p-4">
    {{$orders->links()}}
</div>

@endsection