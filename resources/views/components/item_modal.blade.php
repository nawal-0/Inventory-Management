@props(['modalId', 'buttonId', 'formAction', 'fileId', 'id' => null])

<!-- Main modal -->
<div id={{ $modalId }} tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    {{ $id ? "Edit Item" : "Add New Item" }}
                </h3>
                <button id={{ $buttonId }} type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- body -->
            <form class="p-4 md:p-5" method="POST" action= {{ $id ? $formAction . $id->id : $formAction}} enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" 
                        placeholder="Type item name" required="" value="{{ $id ? $id->name : old('name')}}">
                        @error('name', $id ? 'edit' : 'new')
                            <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Upload Item Image</label>
                        <input  type="file" name="image" id={{ $fileId }} class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
                        @if ($id)
                            <img id="preview1" class="block w-1/4 mt-5 border border-gray-300" src="{{asset('storage/' . $id->image)}}" alt="Preview" />
                        @else
                            <img id="preview2" src="#" alt="Preview" class="hidden w-1/4 mt-5 border border-gray-300">
                        @endif
                       
                        @error('image', $id ? 'edit' : 'new')
                            <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Item Description</label>
                        <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Write description here" required="">{{ $id ? $id->description : old('description')}}</textarea>                    
                        @error('description', $id ? 'edit' : 'new')
                            <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                        <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option selected="">Select category</option>
                            @foreach(\App\Models\Item::getCategories() as $category)
                            <option value="{{ $category }}" {{ ($id && $id->category == $category) ? 'selected' : ""}}>{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category', $id ? 'edit' : 'new')
                            <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" 
                        placeholder="0" required="" value={{ $id ? $id->quantity : old('quantity')}}>
                        @error('quantity', $id ? 'edit' : 'new')
                            <label class="text-red-500 text-xs mt-1">{{ $message }}</label>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary hover:bg-primary-dark focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center0">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    {{ $id ? "Update Item" : "Add New Item" }}
                </button>
            </form>
        </div>
    </div>
</div> 

<script>
    document.getElementById('image').addEventListener('change', function() {
        previewImage1(this);
    });

    document.getElementById('image1').addEventListener('change', function() {
        previewImage2(this);
    });

    function previewImage1(input, item) {
        var preview = document.getElementById('preview1');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImage2(input) {
        var preview = document.getElementById('preview2');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>