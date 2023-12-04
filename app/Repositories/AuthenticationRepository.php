<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationRepository
{
    public function register($request)
    {
        $request->password = Hash::make($request->password);
        return User::create($request->all());
    }

    public function login($request)
    {
        $user = $this->getUser($request);
        return $this->isVerified($request, $user) ? $user : null;
    }

    public function getUser($request)
    {
        return User::whereUsername($request->username)->first();
    }

    public function isVerified($request, $user)
    {
        return $user && Hash::check($request->password, $user->password);
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
