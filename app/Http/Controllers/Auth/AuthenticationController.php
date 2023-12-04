<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthenticationResource;
use App\Repositories\AuthenticationRepository;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    private $authenticationRepository;

    public function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authenticationRepository->register($request);
        return new AuthenticationResource($user);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authenticationRepository->login($request);
        return $user ? new AuthenticationResource($user) : $this->createResponse('Invalid credentials');
    }

    public function logout(Request $request)
    {
        $this->authenticationRepository->logout($request);
        return $this->createResponse('Logout success');
    }
}
