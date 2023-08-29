<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Models\OTP;
use  App\Models\User;
use App\Traits\shortCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\RecoverAccountEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ContributorAuthentication extends Controller
{
    use shortCode;

    // Sign Up Endpoint
    public function sign_up(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
            "description" => "required",
            "linkedin_url" => "required|url",
        ]);

        // Create a new user with validated data
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_code' => $this->runCode(),  // Generate and assign a user code
            'user_uuid' => Str::uuid(),  // Generate and assign a UUID
            'user_type' => 'contributor',
            'description' => $request->description,
            'linkedin_url' => $request->linkedin_url,
            'name' => $request->first_name . ' ' . $request->last_name,
        ]);

        $user = User::where('email', $request->email)->first();

        // Return a response using the make_response method
        return $this->make_response($user);
    }

    // Login Endpoint
    public function login(Request $request)
    {
        // Validate the incoming request data using a custom error message for email existence
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

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Check if the provided password matches the hashed password in the database
            if (Hash::check($request->password, $user->password)) {
                return $this->make_response($user, 200);  // Return a successful response using make_response
            } else {
                $validator->errors()->add('password', 'Incorrect credentials');
                return response()->json(['errors' => $validator->errors()], 422);
            }
        } else {
            $validator->errors()->add('email', 'User does not exist');
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }

    // get_profile
    public function get_profile(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return response()->json([
                "name" => $user->name,
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "description" => $user->description,
                "linkedin_url" => $user->linkedin_url,
            ]);
        } else {
            return response()->json([
                "msgErr" => "User not found"
            ]);
        }
    }


    public function update_profile(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'description' => $request->description,
                'linkedin_url' => $request->linkedin_url,
            ]);

            return response()->json([
                "msg" => "Profile has been updated successfully",
            ]);
        } else {
            return response()->json([
                "msgErr" => "User not found"
            ]);
        }
    }

    // logout
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            // Revoke all tokens...
            $user->tokens()->delete();

            return response()->json([
                "msg" => "User has been logged out successfully"
            ]);
        } else {
            return response()->json([
                "msgErr" => "User not found"
            ]);
        }
    }

    private function make_response($user)
    {
        $user_type = $user->user_type;
        $tokenResult = $user->createToken($user->user_uuid);
        $accessToken = $tokenResult->plainTextToken;

        $response = [
            'token' => $accessToken,
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'user_type' => $user_type,
        ];

        return response($response, 200);
    }






    public function change_password(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|confirmed',
            'current_password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        if (!Hash::check($request->current_password, $user->password)) {

            $validator->errors()->add('current_password', 'Password did not match');
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $request['password'] = Hash::make($request['password']);

        $user->update($request->all());
        return response(['msg' => 'Password updated successfully'], 200);
    }

    // forgot_password
    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $user->otp()->delete();

                $otp_code = $this->runOtp();

                $create_otp = $user->otp()->create([
                    'otp_code' => $otp_code,
                    'otp_type' => 'forgot_password'
                ]);

                Mail::to($user->email)
                    ->send(new RecoverAccountEmail($otp_code, $user->name));

                return response()->json(['msg' => 'Verfication code has been sent successfully', 'email' => $request->email]);
            } else {

                $validator->errors()->add('email', "Account doesn't exists ");
                return response()->json(['errors' => $validator->errors()], 422);
            }
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => $exception->getMessage()]);
        }
    }

    public function verify_recover_account_otp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'  => 'required'
        ], [
            'email.required' => 'This field is required',
            'email.email' => 'Please enter a valid email address',
            'otp.required' => 'This field is required',
        ]);

        try {
            $check = OTP::where('user_email', $request->email)
                ->where('otp_code', $request->otp)->first();

            if ($check) {
                return response()->json(['msg' => 1, 'code' => $request->otp, 'email' => $request->email]);
            } else {
                return 0;
            }
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => $exception->getMessage()]);
        }
    }

    public function update_password_after_verify_recover_account_otp(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email',
            'otp'  => 'required'
        ], [
            'email.required' => 'This field is required',
            'email.email' => 'Please enter a valid email address',
            'otp.required' => 'This field is required',
            'password.required' => 'This field is required',
            'password.confirmed' => 'Password does not match',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        try {
            $check = OTP::where('user_email', $request->email)
                ->where('otp_code', $request->otp)->first();

            if ($check) {

                User::where('email', $request->email)->update([
                    'password' => bcrypt($request->password),
                ]);

                OTP::where('user_email', $request->email)
                    ->where('otp_code', $request->otp)->delete();

                return response()->json(['msg' => 'Account password has been updated successfully']);
            } else {
                return response()->json(['msgErr' => "Invalid code"]);
            }
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => $exception->getMessage()]);
        }
    }

    public function runOtp()
    {
        return substr(str_pad(rand(0, '9' . round(microtime(true))), 15, "0", STR_PAD_LEFT), 9);
    }
}
