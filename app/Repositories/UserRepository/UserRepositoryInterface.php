<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
  public function create(array $data): ?User;
  public function getUserChats($id): ?Collection;
}