

<header>
    <nav class="bg-primary px-4 py-2.5">
        <div class="flex justify-between items-center mx-auto max-w-screen-xl">
            <div class="justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="/home" class="block py-2 px-3
                        {{ request()->is('home') ? 'text-white border-b-2 border-white' : 'text-gray-100 hover:text-white hover:border-white hover:border-b-2' }}">Home</a>
                    </li>
                    <li>
                        <a href="/home/orders" class="block py-2 px-3 
                        {{ request()->is('home/orders') ? 'text-white border-b-2 border-white' : 'text-gray-100 hover:text-white hover:border-white hover:border-b-2' }}">My Orders</a>
                    </li>
                    @can('approve-item')
                    <li>
                        <a href="/home/orders/approve" class="block py-2 px-3 
                        {{ request()->is('home/orders/approve') ? 'text-white border-b-2 border-white' : 'text-gray-100 hover:text-white hover:border-white hover:border-b-2' }}">Approve</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="flex items-center lg:order-2">
                <button class="relative inline-flex">
                <svg class="w-6 h-6 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z"/>
                </svg>

                <div class="absolute inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-500 rounded-full -top-2 -end-2 right-1">20</div>

                </button>
                <form method="POST" action="/users/logout">
                    @csrf
                    <button 
                        type="submit" 
                        class="block text-sm font-medium rounded-lg py-2 pr-4 pl-3 text-white hover:bg-primary-dark"
                    >
                    Logout
                    </button>

                </form>
            </div>
        </div>
    </nav>
</header>