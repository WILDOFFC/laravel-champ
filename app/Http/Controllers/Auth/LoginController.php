<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                "message" => "Invalid data",
                "errors" => [
                    "email" => "Invalid data"
                ]
            ], 422);
        };

        return response()->json(["token"=>$user->createToken('auth')->plainTextToken]);
    }
}
