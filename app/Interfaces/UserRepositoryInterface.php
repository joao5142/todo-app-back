<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{

    public function getUserById($userId);
    public function createUser($userDetails);

}
