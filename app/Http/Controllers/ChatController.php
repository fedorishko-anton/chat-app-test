<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use App\Repositories\ChatRepository\ChatRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatController extends Controller
{
  public function __construct(
    private UserRepositoryInterface $userRepository,
    private ChatRepositoryInterface $chatRepository
  ){}
  
  public function showAllChats(Request $request){
    $users =  $this->userRepository->getUserChats(Auth::id());
    
    return view('chat.main',compact('users'));
  }
  
  public function showUserChat(Request $request, User $receiver){
    $messages = $this->chatRepository->getMessagesByUserId($receiver->id);

    return view('chat.single', compact('messages','receiver'));
  }
  
  public function sendMessage(SendMessageRequest $request, User $receiver){
    $messageData = $request->validated();
    $message = $this->chatRepository->sendMessage($messageData, auth()->id());
    
    return response()->json($message);
  }
  
}
