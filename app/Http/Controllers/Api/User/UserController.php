<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\WorkerProfileResource;
use App\Models\Favorite;
use App\Models\Service;
use App\Models\Worker;
use App\Traits\AppResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AppResponse;

    public function getUserProfile(): JsonResponse
    {
        return $this->success(new UserProfileResource(auth()->user()));
    }

    public function getFavorite()
    {
        $favorite = Auth::user()->favorite;

        return $this->success($favorite);
    }

    public function editFavorite(Request $request): JsonResponse
    {
        $data = $request->validate([
            'id' => 'required',
        ]);

        $favorite = Favorite::where('worker_id', $data['id'])->first();
        $message = '';

        if ($favorite) {
            $favorite->delete();
            $message = 'worker removed from favorites';
        } else {
            Favorite::query()->create(['user_id' => auth()->user()->id, 'worker_id' => $data['id']]);
            $message = 'worker added to favorites';
        }

        return $this->success(true, $message);
    }

    public function deleteAcount(Request $request)
    {
        $data = $request->validate([
            'password' => 'required_without:email',
        ]);
        $user = auth()->user();
        if (!Hash::check($data['password'], $user->password)) {
            return $this->success(false,'worng password');
        } else {
            auth()->user()->delete();

            return $this->success(true, 'acount deleted');

        }

    }

    public function updateUserInfo(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required_without:password|email|unique:users,email',
            "gender" => "required|in:male,female,other",
            "birth_date" => "required|date",
            'phone_number' => 'required|regex:/^07[789]\d{7}$/',
            'location' => 'required',
            'password' => 'required_without:email|min:6|confirmed',
        ]);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        auth()->user()->update($data);
        return $this->success(true, 'user info updated');
    }
}
