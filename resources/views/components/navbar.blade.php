

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
                @if(auth()->user()->unreadNotifications->count() == 0) 
                    <button class="relative inline-flex" data-dropdown-toggle="dropdown">
                    <svg class="w-6 h-6 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z"/>
                    </svg>
                    </button>
                @else
                    <button class="relative inline-flex" data-dropdown-toggle="dropdown">
                    <svg class="w-6 h-6 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
                        <path d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM6 6a1 1 0 0 1-.707-.293l-1-1a1 1 0 0 1 1.414-1.414l1 1A1 1 0 0 1 6 6Zm-2 4H3a1 1 0 0 1 0-2h1a1 1 0 1 1 0 2Zm14-4a1 1 0 0 1-.707-1.707l1-1a1 1 0 1 1 1.414 1.414l-1 1A1 1 0 0 1 18 6Zm3 4h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z"/>
                    </svg>
                    
                    <div class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 rounded-full -top-2 -end-2 right-2">{{auth()->user()->unreadNotifications->count()}}</div>

                    </button>
                @endif
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

{{-- Notification Dropdown --}}
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 border border-slate-300 rounded-lg shadow w-50">
    <ul class="py-2 text-sm text-gray-700">
      @forelse(auth()->user()->unreadNotifications as $notification)
        <li class="px-4 py-2 hover:bg-gray-100">
          <a href="/home/orders/readnotif/{{$notification->id}}" class="flex items-center">
            <span class="mr-2">{{ $notification->data['data'] }}</span>
          </a>
        </li>
        @empty
        <li class="px-4 py-2 hover:bg-gray-100">
            <span class="mr-2">No new notifications</span>
        </li>
      @endforelse
    </ul>
</div>