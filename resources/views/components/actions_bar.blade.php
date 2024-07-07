
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
            
            <!-- Main modal -->
            <div id="modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Add New Item
                            </h3>
                            <button id="close_btn" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- body -->
                        <form class="p-4 md:p-5" method="POST" action="/home/add">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type item name" required="">
                                    @error('name')
                                        <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Item Description</label>
                                    <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write description here" required=""></textarea>                    
                                    @error('description')
                                        <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                                    @enderror
                                </div>
                                
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                    <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                        <option selected="">Select category</option>
                                        @foreach(\App\Models\Item::getCategories() as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="0" required="">
                                    @error('quantity')
                                        <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-primary hover:bg-primary-dark focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center0">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                Add new item
                            </button>
                        </form>
                    </div>
                </div>
            </div> 

        </div> 
    </div>   
</div>

<script>
    // create modal
    const $targetEl = document.getElementById('modal');
    const modal = new Modal($targetEl);

    document.getElementById('add_item_btn').addEventListener('click', () => {
        modal.toggle();
    });

    document.getElementById('close_btn').addEventListener('click', () => {
        modal.hide();
    });

    // show if validation errors
    const errors = @json($errors->all());
    if (errors.length > 0) {
        console.log(errors);
        modal.show();
        
    }
</script>