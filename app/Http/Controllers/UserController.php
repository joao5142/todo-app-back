<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function store(StoreUserRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($validated) {
                $userDetails = $request->all();
                $userDetails['password'] = Hash::make($userDetails['password']);

                $createdUser = $this->userRepository->createUser($userDetails);

                return response()->json(['message' => 'Usuario criado com sucesso', 'success' => true, 'user' => $createdUser]);
            } else {
                return '$validated';
            }
        } catch (Exception $err) {

            return response()->json(['error' => $err->getMessage()], 401);
        }
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
