

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
        <div class="flex justify-end space-x-4">
            {{--add item--}}
            <div>
                <button class="bg-primary font-medium text-sm text-white px-4 py-2 rounded-lg hover:bg-primary-dark">
                    Add Item
                </button>
            </div>

            {{--sort--}}
            <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
                <!-- Toggle Button -->
                <button type="button" @click="isOpen = ! isOpen" 
                    class="inline-flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-lg bg-primary px-4 py-2 text-sm 
                    font-medium text-white tracking-wide hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 
                    focus-visible:outline-slate-800" aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" 
                    @keydown.down.prevent="openedWithKeyboard = true" :aria-expanded="isOpen || openedWithKeyboard">
                    Sort
                    <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>        
                </button>
                <!-- Dropdown Menu -->
                <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" class="z-50 absolute top-11 right-0 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-xl border border-slate-300 bg-slate-100 py-1.5" role="menu">
                    <a href="#" class="bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-800/5 hover:text-black focus-visible:bg-slate-800/10 focus-visible:text-black focus-visible:outline-none" role="menuitem">None</a>
                    <a href="#" class="bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-800/5 hover:text-black focus-visible:bg-slate-800/10 focus-visible:text-black focus-visible:outline-none" role="menuitem">A-Z</a>
                    <a href="#" class="bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-800/5 hover:text-black focus-visible:bg-slate-800/10 focus-visible:text-black focus-visible:outline-none" role="menuitem">Z-A</a>
                    <a href="#" class="bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-800/5 hover:text-black focus-visible:bg-slate-800/10 focus-visible:text-black focus-visible:outline-none" role="menuitem">Quantity (Low-High)</a>
                    <a href="#" class="bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-800/5 hover:text-black focus-visible:bg-slate-800/10 focus-visible:text-black focus-visible:outline-none" role="menuitem">Quantity (High-Low)</a>
                </div>
            </div>
        
    



        
        </div> 
    </div>   
</div>