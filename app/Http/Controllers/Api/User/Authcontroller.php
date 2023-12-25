<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\AppResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    use AppResponse;

    public function login(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($fields)) {
            $user = Auth::user();
            $userNot = User::query()->where('id', auth()->id())->get();

            return $this->success([
                'user' => new UserResource($user),
                'token' => $user->createToken('app-token')->plainTextToken,
                'otp' => 1234,

            ], __("User Logged in successfully"));
        } else {
            try {
                $user = User::query()->where("email", $fields['email'])->firstOrFail();
            } catch (\Exception $e) {
                return $this->unauthorized(__("Email or password wrong"));
            }
        }
        return $this->unauthorized(__("Email or password wrong"));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            "gender" => "required|in:male,female,other",
            "birth_date" => "required|date",
            'phone' => 'required|regex:/^07[789]\d{7}$/',
            'location' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|accepted',
        ]
            , [
                'email.required' => 'email required.',
                'email.unique' => 'this email is already used.',
                'password.confirmed' => 'password does not match.',
            ]
        );

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone,
            'location' => $request->location,
            'password' => Hash::make($request->password),
            'is_terms_agreed' => true,
        ]);
        $user->save();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('app-token')->plainTextToken,
        ], 'User has been registered');
    }

    public function logout(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'onesignal' => 'nullable',
        ]);
        if (isset($fields['onesignal'])) {
            auth()->user()->devices()->where('onesignal_id', $fields['onesignal'])->delete();
        }
        auth()->user()->devices()->delete();
        $request->user()->currentAccessToken()->delete();
        return $this->success(true, __("Logout successfully"));
    }

    public function changePassword(Request $request)
    {

        $data = $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        auth()->user()->update(['password' => Hash::make($data['password'])]);
        return $this->success(true, 'User Password Changed');
    }

    public function getUser(User $user)
    {

        return $this->success($user);
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required_without:password|email|exists:users,email',
            'password' => 'required_without:email|min:6|confirmed',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return $this->success(false, 'user info updated');
        }

        $user->password = Hash::make($data['password']);
        $user->save();
        return $this->success(true, 'user info updated');    
    }
    


}