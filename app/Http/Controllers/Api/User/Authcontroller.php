<?php

namespace App\Http\Controllers\Api\User;

use App\Filament\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\AppResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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

            // new LoginNotification($user, 'you logged in successfully');

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
}
