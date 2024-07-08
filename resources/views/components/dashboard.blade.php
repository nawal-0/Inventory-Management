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