<?php

namespace App\Services;

use App\BO\UserBO;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function __construct(private UserBO $userBO) {}

    public function createUser(array $data)
    {
        $user = $this->userBO->createUser($data);
        Cache::forget("user_{$user->id}");
        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        $user = $this->userBO->updateUser($id, $data);
        Cache::forget("user_{$id}");
        return $user;
    }

    public function getAllUsers() {
       return $this->userBO->getAllUsers();
        // We store the collection for 1 hour (3600 seconds)
        // return Cache::remember('users_all', 3600, function() {
        //     return $this->userBO->getAllUsers();
        // });
    }
}
