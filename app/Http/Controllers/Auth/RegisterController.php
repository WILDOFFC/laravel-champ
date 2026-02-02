<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request): JsonResponse
    {
        User::create([
            'email'=>$request->email,
            'name'=> $request->name,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json(["success" => true], 201);
    }
}
