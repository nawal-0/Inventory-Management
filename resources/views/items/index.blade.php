@extends('layout')    
@section('content')

<x-navbar />
   
<x-actions_bar />

@if (session('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
    class="fixed top-5 left-1/2 transform -translate-x-1/2 rounded-lg bg-primary-dark text-white px-40 py-3">
    <p>
      {{session('message')}}
    </p>
  </div>
@endif

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 with-larasort">
            <tr>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">@sortableLink('name','Name')</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">@sortableLink('category','Category')</th>
                <th scope="col" class="px-6 py-3">@sortableLink('quantity','Quantity')</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr class="odd:bg-slate-50 even:bg-gray-100 border-b hover:bg-indigo-200 border border-gray-200">
                    <td class="px-6 py-4">
                        <img class="w-14 md:block"
                            src={{asset('/storage/' . $item->image )}} alt="" />
                            
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $item->name }}
                    </th>
                    <td class="px-6 py-4">{{ $item->description }}</td>
                    <td class="px-6 py-4">{{ $item->category }}</td>
                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                    <td class="px-6 py-4">
                        <a href="/home/edit/{{ $item->id }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                        <span class="mx-1">|</span>
                        <a href="/home/order/{{ $item->id }}" class="font-medium text-blue-600 hover:underline">Order</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-4 text-center" colspan="6">No items found.</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>

</div>
<div class="mt-4 p-4">
    {{$items->links()}}
</div>

<x-item_modal modalId="edit-modal" buttonId="closed" formAction="/home/edit/" fileId="image" :id="session('it')"/>

<script>
    // create modal
    const $target = document.getElementById('edit-modal');
    const modals = new Modal($target);

    // document.getElementById('btn').addEventListener('click', () => {
    //     modals.toggle();
    // });
    @if (session('it')) {
        modals.show();
    }
    @endif

    document.getElementById('closed').addEventListener('click', () => {
        modals.hide();
    });
    
</script>

@endsection

