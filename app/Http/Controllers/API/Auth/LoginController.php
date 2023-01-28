<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Request
use App\Http\Requests\Api\Auth\LoginRequest;

// Model
use App\Models\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $token = $user->createToken('general')->plainTextToken;
        return $this->responseSuccess(200, "Login Success", ["token" => $token]);
    }
}
