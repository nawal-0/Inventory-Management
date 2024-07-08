@extends('layout')
@section('content')

<div class="flex flex-row items-center justify-start h-screen">
    <div class="bg-primary h-full w-1/2 place-content-center" >
        <h1 class="text-center text-wrap text-4xl text-white uppercase">Inventory <br/> Management <br/> System</h1>
        
    </div>

    <div class="mx-4 w-1/2">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto justify-items-center items-center">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">Log In</h2>
            </header>

            <form method="POST" action="/users/login">
                @csrf
                <x-form_entry label="Email" type="email" name='email' />
                <x-form_entry label="Password" type="password" name='password'/>

                <div class="mb-6">
                    <button
                        type="submit"
                        class="bg-primary text-white rounded py-2 px-4 hover:bg-primary-dark"
                    >
                        Sign In
                    </button>
                </div>

                <div class="mt-8">
                    <p>
                        Don't have an account?
                        <a href="/register" class="text-primary">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection