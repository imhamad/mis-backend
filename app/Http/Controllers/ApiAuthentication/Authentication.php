<?php

namespace App\Http\Controllers\ApiAuthentication;

use  App\Models\User;
use App\Traits\shortCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class Authentication extends Controller
{
    use shortCode;

    public function sign_up(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_code' => $this->runCode(),
            'user_uuid' => Str::uuid(),
        ]);

        return $this->make_response($user);
    }

    // login
    public function login(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ], [
            'email.exists' => 'No record found with current email'
        ]);

        if ($validator->fails()) {
            // Return the validation errors
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return $this->make_response($user, 200);
            } else {
                $validator->errors()->add('password', 'Incorrect credentials');
                return response()->json(['errors' => $validator->errors()], 422);
            }
        } else {
            $validator->errors()->add('email', 'User does not exist');
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }

    public function update_profile(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return response()->json([
                "msg" => "Profile has been updated successfully",
            ]);
        } else {
            return response()->json([
                "msg" => "User not found"
            ]);
        }
    }

    // logout
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();

            return response()->json([
                "msg" => "User has been logged out successfully"
            ]);
        } else {
            return response()->json([
                "msg" => "User not found"
            ]);
        }
    }

    private function make_response($user)
    {
        $tokenResult = $user->createToken($user->user_uuid);
        $accessToken = $tokenResult->plainTextToken;

        $response = [
            'token' => $accessToken,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];

        return response($response, 200);
    }
}
