<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Models\OTP;
use  App\Models\User;
use App\Traits\shortCode;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\AccountCreation;
use App\Mail\RecoverAccountEmail;
use App\Http\Controllers\Controller;
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
            "description" => "required",
            "linkedin_url" => "required|url",
        ], [
            'linkedin_url.required' => 'This field is required',
            'linkedin_url.url' => 'Please include a complete URL e.g https://www.linkedin.com/in/john-doe/',
        ]);

        try {
            // Create a new user with validated data
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make(12345678),
                'user_code' => $this->runCode(),  // Generate and assign a user code
                'user_uuid' => Str::uuid(),  // Generate and assign a UUID
                'user_type' => 'contributor',
                'description' => $request->description,
                'linkedin_url' => $request->linkedin_url,
                'name' => $request->first_name . ' ' . $request->last_name,
            ]);

            $user = User::where('email', $request->email)->first();

            Mail::to($user->email)
                ->send(new AccountCreation($user));

            Notification::create([
                'notification_title' => 'Account Request',
                'notification_description' => 'There is a new account request.',
                'type' => 'account_creation',
            ]);

            // Return a response using the make_response method
            return response()->json([
                'msg' => 'Your request has been submitted successfully. You will be notified through email once your account is approved.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
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

        try {
            // Find the user by email
            $user = User::where('email', $request->email)->first();

            if ($user->status == 1) {
                $validator->errors()->add('email', 'Your account is not active');
                return response()->json(['errors' => $validator->errors()], 422);
            }

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
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    // get_profile
    public function get_profile(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                return response()->json([
                    "name" => $user->name,
                    "email" => $user->email,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "description" => $user->description,
                    "linkedin_url" => $user->linkedin_url,
                    "avatar" => $user->avatar ? baseURL($user->avatar) : '',
                ]);
            } else {
                return response()->json([
                    "msgErr" => "User not found"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }


    public function update_profile(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                $avatar = $user->avatar;
                if ($request->avatar)
                    $avatar = imageUploader($request->avatar, $user->user_code);

                $user->update([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'description' => $request->description,
                    'linkedin_url' => $request->linkedin_url,
                    'avatar' => $avatar,
                ]);

                return response()->json([
                    "msg" => "Profile has been updated successfully",
                    "data" => $this->make_response($user)->original
                ]);
            } else {
                return response()->json([
                    "msgErr" => "User not found"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    // logout
    public function logout(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
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
            'avatar' => $user->avatar ? baseURL($user->avatar) : '',
        ];

        return response($response, 200);
    }






    public function change_password(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            "password" => "required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_!@#$%^&*()-+=]).*$/",
            "password_confirmation" => "required|same:password",
        ], [
            'password.required' => 'This field is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.regex' => 'Correct password format: (Mixed Alphabet & number)',
            'current_password.required' => 'This field is required',
            'password_confirmation.required' => 'This field is required',
            'password_confirmation.same' => 'Password does not match',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        try {
            if (!Hash::check($request->current_password, $user->password)) {

                $validator->errors()->add('current_password', 'Current password does not match');
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $request['password'] = Hash::make($request['password']);

            $user->update($request->all());
            return response(['msg' => 'Password updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
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
            $user = User::where('email', $request->email)->where('user_type', 'contributor')->first();

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
                ->where('otp_code', $request->otp)
                ->where('created_at', '>=', \Carbon\Carbon::now()->subMinutes(2))
                ->first();

            if ($check) {
                return response()->json(['msg' => 1, 'code' => $request->otp, 'email' => $request->email]);
            } else {
                return response()->json(['msgErr' => "Invalid code or code has been expired"]);
            }
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => $exception->getMessage()]);
        }
    }

    public function update_password_after_verify_recover_account_otp(Request $request)
    {
        $request->validate([
            "password" => "required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_!@#$%^&*()-+=]).*$/",
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
                ->where('otp_code', $request->otp)
                ->first();

            if ($check) {

                User::where('email', $request->email)->update([
                    'password' => bcrypt($request->password),
                ]);

                OTP::where('user_email', $request->email)
                    ->where('otp_code', $request->otp)->delete();

                return response()->json(['msg' => 'Account password has been updated successfully']);
            } else {
                return response()->json(['msgErr' => "Invalid code or code has been expired"]);
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
