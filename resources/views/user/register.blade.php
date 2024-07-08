@extends('layout')
@section('content')

<div class="flex flex-row items-center justify-start h-screen">
    <div class="bg-primary h-full w-1/2 place-content-center" >
        <h1 class="text-center text-wrap text-4xl text-white uppercase">Inventory <br/> Management <br/> System</h1>
        
    </div>

    <div class="mx-4 w-1/2">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto justify-items-center items-center">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">Register</h2>
                <p class="mb-4">Create an account</p>
            </header>

            <form method="POST" action="/users">
                @csrf
                <x-form_entry label="Name" type="text" name="name" />
                <x-form_entry label="Email" type="email" name="email"/>
                <x-form_entry label="Password" type="password" name="password"/>
                <x-form_entry label="Confirm Password" type="password" name="password_confirmation"/>

                <div class="mb-6">
                    <button
                        type="submit"
                        class="bg-primary text-white rounded py-2 px-4 hover:bg-primary-dark"
                    >
                        Sign Up
                    </button>
                </div>

                <div class="mt-8">
                    <p>Already have an account?
                        <a href="/" class="text-primary">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection