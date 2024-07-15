

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