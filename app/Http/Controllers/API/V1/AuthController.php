<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\BearerToken;
use App\Models\User;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::create($data);

        $token = $user->createToken('Personal Access Token');
        return BearerToken::make($token);
    }

    public function login(LoginRequest $request)
    {
        if (auth('web')->attempt($request->validated())) {
            /** @var User $user */
            $user = User::whereEmail($request->email)->first();
            return BearerToken::make($user->createToken('Personal Access Token'));
        }
       return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);

    }
}
