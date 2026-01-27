<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return response()->json($user, 201);
    }

    public function update(UserRequest $request, int $id)
    {
        $user = $this->userService->updateUser($id, $request->validated());
        return response()->json($user);
    }

    public function show(int $id)
    {
        $user = $this->userService->getUser($id);
        return response()->json($user);
    }
}
