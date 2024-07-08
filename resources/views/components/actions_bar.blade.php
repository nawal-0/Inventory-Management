
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
            <x-item_modal modalId="modal" buttonId="close_btn" formAction="/home/add"/>

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