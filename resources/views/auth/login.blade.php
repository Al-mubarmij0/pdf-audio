@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Login</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" required
                class="w-full p-2 border rounded mt-1">
        </div>

        <div>
            <label for="password" class="block font-medium">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full p-2 border rounded mt-1">
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
            Login
        </button>

        <p class="text-sm text-center mt-4">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 underline">Register</a>
        </p>
    </form>
</div>
@endsection
