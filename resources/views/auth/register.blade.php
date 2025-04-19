@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Register</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium">Name</label>
            <input type="text" name="name" id="name" required
                class="w-full p-2 border rounded mt-1">
        </div>

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

        <div>
            <label for="password_confirmation" class="block font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="w-full p-2 border rounded mt-1">
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">
            Register
        </button>

        <p class="text-sm text-center mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a>
        </p>
    </form>
</div>
@endsection
