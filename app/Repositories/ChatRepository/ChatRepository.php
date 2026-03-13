<?php

namespace App\Repositories\ChatRepository;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class ChatRepository implements ChatRepositoryInterface
{

  public function create(array $data): ?Message
  {
      return Message::create($data);
  }
  
  public function getMessagesByUserId(int $id): ?Collection
  {
    return Message::currentChatMessages($id)->get();
  }
  
  public function sendMessage(array $message, int $senderId): Message
  {
    $message = Message::create([
      'sender_id' => $senderId,
      ...$message
    ]);
    
    broadcast(new MessageSent($message));
    
    return $message;
  }
}
