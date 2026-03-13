<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

  public function create(array $data): ?User
  {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
  }
  
  public function getUserChats($id): ?Collection
  {
    return User::whereKeyNot($id)->get();
  }
}
