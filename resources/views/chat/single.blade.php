@extends('layouts.app')

@section('title', 'Chat')

@section('content')
    <div class="text-xl font-bold mb-4">
        Chat with: <span>{{ $receiver->name }}</span>
    </div>
    <div class="flex justify-between space-x-4">
        <div class="w-full space-y-4">
            <div id="messages-container"
                 class="h-96 space-y-2 overflow-y-scroll p-4 rounded-lg ring-1 ring-gray-300 bg-gray-100">
                @foreach ($messages as $message)
                    <div class="flex {{ $message->is_my_message ? 'justify-end' : 'justify-start' }}">
                        <div class="p-2 {{ $message->is_my_message ? 'bg-blue-600' : 'bg-green-600' }} text-white rounded-lg max-w-xs">
                            {{ $message->text }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                <form method="POST" id="send-message">
                    <div class="flex justify-center space-x-4">
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id  }}">
                        <input
                                id="text"
                                type="text"
                                placeholder="Start typing..."
                                required
                                name="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                   @error('email') border-red-500 @enderror"
                        >
                        <button type="submit" class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-colors duration-200">
                            Send
                        </button>
                    </div>
                    <div id="error" class="text-red-700"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    window.Laravel = {
        senderId: {{ auth()->id() }},
        receiverId: {{ $receiver->id }}
    };
</script>

@vite('resources/js/chat-user.js')