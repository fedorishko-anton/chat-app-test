@extends('layouts.app')

@section('title', 'Chat')

@section('content')
    <div class="flex justify-between space-x-4">
        <div>
            @if(isset($users) && count($users) > 0)
                <div class="flex flex-col space-x-4 space-y-4">
                    @foreach($users as $user)
                        <a class="bg-gray-100 rounded-sm p-2" href="{{route('chat.single', $user)}}">{{ $user->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No users found.</p>
            @endif
        </div>
    </div>

@endsection