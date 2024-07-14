@extends('layout')    
@section('content')

<x-navbar />
   
<div class="bg-white sm:rounded-lg mx-4">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        {{--search--}}
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="search" name="search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" 
                    placeholder="Search..."
                    value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <div class="flex justify-end space-x-4 items-end">
            {{--add item--}}
            
            <!-- Modal button -->
            <button id="add_item_btn" class="bg-primary font-medium text-sm text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
                Add Item
            </button>
            <x-item_modal modalId="modal" buttonId="close_btn" formAction="/home/add" fileId="image1"/>

        </div> 
    </div>   
</div>


@if (session('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
    class="fixed top-5 left-1/2 transform -translate-x-1/2 rounded-lg bg-primary-dark text-white px-40 py-3">
    <p>
      {{session('message')}}
    </p>
  </div>
@endif


<!-- Display items table -->
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
    {{-- {{$items->links()}} --}}
    {!! $items->appends(Request::except('page'))->render() !!}
</div>

<x-item_modal modalId="edit-modal" buttonId="closed" formAction="/home/edit/" fileId="image" :id="session('it')"/>

<script>
    // create modals
    const $targetEdit = document.getElementById('edit-modal');
    const modalEdit = new Modal($targetEdit);

    const $targetAdd = document.getElementById('modal');
    const modalAdd  = new Modal($targetAdd);

    // buttons
    document.getElementById('add_item_btn').addEventListener('click', () => {
        modalAdd.toggle();
    });

    document.getElementById('close_btn').addEventListener('click', () => {
        modalAdd.hide();
    });

    document.getElementById('closed').addEventListener('click', () => {
        modalEdit.hide();
    });

    // show if validation errors
    const errors = @json($errors->new->all());
    console.log(errors);
    if (errors.length > 0) {
        modalAdd.show();
        
    }

    @if (session('it')) {
        modalEdit.show();
    }
    @endif

    
</script>

@endsection

