<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function createUser($userDetails)
    {

        return  User::create($userDetails);
    }
}
