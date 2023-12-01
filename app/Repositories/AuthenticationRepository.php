<?php

namespace App\Repositories;

use App\Http\Resources\AuthenticationResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationRepository
{
    public function register($request)
    {
        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($userData);
        return new AuthenticationResource($user);
    }

    public function login($request)
    {
        $user = User::whereUsername($request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }
        return new AuthenticationResource($user);
    }
}
