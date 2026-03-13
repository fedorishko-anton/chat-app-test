@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <form method="POST" class="m-auto max-w-sm" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <input
                    id="name"
                    type="text"
                    required
                    placeholder="Name"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
               @error('name') border-red-500 @enderror"
            >

            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-4">
            <input
                    id="email"
                    type="email"
                    placeholder="Email"
                    required
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
               @error('email') border-red-500 @enderror"
            >

            @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <input
                    id="password"
                    type="password"
                    placeholder="Password"
                    required
                    name="password"
                    value="{{ old('password') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
               @error('password') border-red-500 @enderror"
            >

            @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <button
                type="submit"
                class="w-full cursor-pointer bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md
           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-colors duration-200"
        >
            Register
        </button>

    </form>
@endsection