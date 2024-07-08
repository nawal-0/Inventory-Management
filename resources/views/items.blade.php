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
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Quantity</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr class="odd:bg-slate-50 even:bg-gray-100 border-b hover:bg-indigo-200 border border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $item->name }}
                    </th>
                    <td class="px-6 py-4">{{ $item->description }}</td>
                    <td class="px-6 py-4">{{ $item->category }}</td>
                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                    <td class="px-6 py-4">
                        <a href="/home/edit/{{ $item->id }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                        <span class="mx-1">|</span>
                        <a href="#" class="font-medium text-blue-600 hover:underline">Order</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-4 text-center" colspan="3">No items found.</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>

</div>
<div class="mt-4 p-4">
    {{$items->links()}}
</div>

<x-item_modal modalId="edit-modal" buttonId="closed" formAction="/home/edit/" :id="session('it')"/>

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

    // show if validation errors
    const err = @json($errors->all());
    if (errors.length > 0) {
        console.log(errors);
        modals.show();
        
    }
</script>

@endsection

