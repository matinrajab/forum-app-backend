<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthenticationResource;
use App\Models\User;
use App\Repositories\AuthenticationRepository;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    private $authenticationRepository;

    public function __construct()
    {
        $this->authenticationRepository = new AuthenticationRepository();
    }

    public function register(RegisterRequest $request)
    {
        return $this->authenticationRepository->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->authenticationRepository->login($request);
    }
}
