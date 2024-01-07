<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserProfileResource;
use App\Models\Favorite;
use App\Models\Offer;
use App\Models\Offers;
use App\Models\Order;
use App\Models\Review;
use App\Traits\AppResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            return $this->success(false, 'worng password');
        } else {
            auth()->user()->delete();

            return $this->success(true, 'acount deleted');

        }

    }

    public function updateUserInfo(Request $request)
    {
        $data = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email',
            "gender" => "in:male,female,other",
            "birth_date" => "date",
            'phone_number' => 'regex:/^07[789]\d{7}$/',
            'location' => 'string',
            'password' => 'min:6|confirmed',
        ]);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        auth()->user()->update($data);
        return $this->success(true, 'user info updated');
    }

    public function orderImages(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        $paths = [];
    
        foreach ($request->file('images') as $image) {
            $path = $image->store('images', 'public');
            $paths[] = asset('storage/' . $path);
        }
    
        return $this->success($paths);

    }

    public function orders(Request $request, $id)
    {
        $user = auth()->user();

        $existingOrder = Order::query()
            ->where('user_id', auth()->user()->id)
            ->where('service_id', $id)
            ->first();

        if (!$user->is_worker) {
            if ($existingOrder) {
                return $this->success('You can only place one order for this service.');
            }

            $data = $request->validate([
                "location" => 'required|string',
                "date" => "required|date",
                "time" => "required",
                "description" => 'required|string',
                "images" => 'required',
            ]);

            $order = Order::query()->create([
                'user_id' => auth()->user()->id,
                'service_id' => $id,
                'location' => $data['location'],
                'date' => $data['date'],
                'time' => $data['time'],
                'description' => $data['description'],
                'images' => $data['images'],
            ]);

            return $this->success(new OrderResource($order));
        }
        return $this->success(['you are in worker account']);
    }

    public function offers()
    {
        $order = Order::with('offers')->first();

        $user = auth()->user();

        if (!$user->is_worker) {
            if ($order) {
                $offers = $order->offers;
                return $this->success(OfferResource::collection($offers));
            } else {
                return $this->success([]);
            }
        }
        return $this->success('you are in the worker account');
    }

    public function rating(Request $request)
    {
        $data = $request->validate([
            'offer_id' => 'required',
            'worker_rate' => 'required|integer',
            'worker_review' => 'required|string',
        ]);

        $offer = Offer::find($data['offer_id']);
        if (!$offer->review) {

            Review::create(
                [
                    'user_id' => auth()->user()->id,
                    'worker_id' => $offer->user_id,
                    'worker_rate' => $data['worker_rate'],
                    'offer_id' => $data['offer_id'],
                    'worker_review' => $data['worker_review'],
                ]
            );

        } else {
            $offer->review->worker_rate = $data['worker_rate'];
            $offer->review->worker_review = $data['worker_review'];
            $offer->review->save();
        }

        return $this->success(null);

    }

    public function confirmOrder($id): JsonResponse
    {
        $order = Order::findOrFail($id);

        // Check if the order is not already confirmed
        if ($order->status !== 'active') {
            $order->update(['status' => 'active']);

            return $this->success([$order,'Order confirmed successfully']);

        }

        return $this->success(['Order is already confirmed']);
    }
    
    public function finishOrder($id): JsonResponse
    {
        $order = Order::findOrFail($id);

        // Check if the order is not already confirmed
        if ($order->status !== 'finish') {
            $order->update(['status' => 'finish']);

            return $this->success([$order,'Order finish successfully']);

        }

        return $this->success(['Order is already Finished']);
    }
    
}