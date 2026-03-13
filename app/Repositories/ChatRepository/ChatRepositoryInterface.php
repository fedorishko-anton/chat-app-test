<?php

namespace App\Repositories\ChatRepository;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface ChatRepositoryInterface
{
  public function getMessagesByUserId(int $id): ?Collection;
  public function sendMessage(array $message, int $senderId): Message;
}