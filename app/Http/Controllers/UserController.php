<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function store(Request $request)
    {
        $userDetails=$request->all();

        $this->userRepository->createUser($userDetails);
    }


    public function show(Request $request)
    {
        $userId = $request->route('userId');

        $user = $this->userRepository->getUserById($userId);

        if (empty($user)) {
            return back();
        }

         return $user;
    }

}
