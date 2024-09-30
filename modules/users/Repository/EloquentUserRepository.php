<?php

namespace Modules\users\Repository;

use Illuminate\Support\Facades\Hash;
use Modules\users\Models\User;
use Throwable;

class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * @throws Throwable
     */
    public function create($request): string
    {
        $userName = $request['username'];
        $user = User::updateOrCreate(
            ['username' => $userName],
            [
                'name' => $userName,
                'username' => $userName,
                'password' => Hash::make('123456'),
            ]);

        $userToken = $user->createToken($user->username);

        return $userToken->plainTextToken;
    }
}
