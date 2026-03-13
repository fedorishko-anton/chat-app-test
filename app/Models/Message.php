<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;


class Message extends Model
{
    use Notifiable;
  
    protected $fillable = [
      'sender_id',
      'receiver_id',
      'text'
    ];
    protected $appends = ['is_my_message'];
    
    public function sender()
    {
      return $this->belongsTo(User::class, 'sender_id');
    }
    
    public function receiver()
    {
      return $this->belongsTo(User::class, 'receiver_id');
    }
  
    #[Scope]
    protected function currentChatMessages(Builder $query,$userId): void
    {
      $query
        ->where(function (Builder $query) use ($userId) {
          $query->where('sender_id', auth()->id())->where('receiver_id', $userId);;
        })
        ->orWhere(function (Builder $query) use ($userId) {
          $query->where('sender_id', $userId)->where('receiver_id', auth()->id());;
        });
    }
  
    protected function isMyMessage(): Attribute
    {
      return Attribute::make(
        get: fn () => $this->sender_id === auth()->id(),
      );
    }
}
