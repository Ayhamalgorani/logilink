<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WorkerFormResource;
use App\Models\Offer;
use App\Models\Offers;
use App\Models\Order;
use App\Models\User;
use App\Models\WorkerForm;
use App\Traits\AppResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    use AppResponse;

    public function workerLogin(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])
            ->where('is_worker', 1)
            ->first();

        if ($user && Hash::check($fields['password'], $user->password)) {
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
        return $this->unauthorized(__("Normal User accounts are not allowed to log in."));
    }

    public function workerForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'required|integer',
            'email' => 'required|string|unique:worker_forms',
            'phone_number' => 'required|regex:/^07[789]\d{7}$/|unique:worker_forms',
            'service' => 'required',
            'nationality' => 'required|string',
            "gender" => "required|in:male,female",
            "birth_date" => "required|date",
            'terms' => 'required|accepted',
        ]
            , [
                'email.required' => 'email required.',
                'email.unique' => 'this email is already used.',
            ]
        );

        $message = WorkerForm::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "phone_number" => $data['phone_number'],
            "service_id" => $data['service'],
            "gender" => $data['gender'],
            "birth_date" => $data['birth_date'],
            "country_id" => $data['location'],
            "nationality" => $data['nationality'],
            "is_terms_agreed" => $data['terms'],
        ]);
        return $this->success(new WorkerFormResource($message), 'Form has been sent');

    }

    public function orders()
    {
        $user = auth()->user();

        if ($user->is_worker) {
            $orders = $user->orders;
            return $this->success(OrderResource::collection($orders));
        } else {
            return $this->success(['you are in user account']);
        }

    }

    public function getOffers()
    {
        
        $user = auth()->user();
        if ($user->is_worker) {
            $offer = $user->offers;
            return $this->success(OfferResource::collection($offer));
        } else {
            return $this->success(['you are in user account']);
        }

    }

    public function offers(Request $request, $id)
    {
        $existingOrder = Offer::query()
            ->where('user_id', auth()->user()->id)
            ->where('order_id', $id)
            ->first();

        if ($existingOrder) {
            return $this->success('You already gave this order a PRICE');
        }

        $unActiveOrders = Order::query()
            ->where(function ($query) {
                $query->where('status', 'like', 'active')
                    ->orWhere('status', 'like', 'finish');
            })
            ->first();

        if ($unActiveOrders) {
            return $this->success('This order is finish or Someone made an offer');
        }

        $data = $request->validate([
            'price' => 'required|integer',
        ]);

        $order = Order::findOrFail($id);

        $conflictingOrders = Offer::whereHas('orders', function ($query) use ($order) {
            $query->where('date', $order->date)
                ->where('time', $order->time);
        })->where('user_id', auth()->user()->id)->exists();

        if ($conflictingOrders) {
            return $this->success('You cannot make an offer for orders at the same time and date.');
        }

        $offer = Offer::query()->create([
            'user_id' => auth()->user()->id,
            'order_id' => $id,
            'price' => $data['price'],
        ]);

        return $this->success(new OfferResource($offer));
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $file->store('public/files');
        return $this->success(asset('storage/files') . '/' . $file->hashName());
    }

    public function workerFile(Request $request, $id)
    {
        $data = $request->validate([
            "file" => "required",
        ]);
        $workerForm = WorkerForm::findOrFail($id);

        $workerForm->update([
            'file' => $data['file'],
        ]);
        return $this->success(new WorkerFormResource($workerForm));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'images' => 'required|image',
        ]);

        $image = $request->file('images');
        $image->store('images', 'public');

        return $this->success(asset('storage/images') . '/' . $image->hashName());

    }

    public function workerImage(Request $request, $id)
    {
        $data = $request->validate([
            "image" => "required",
        ]);
        $workerForm = WorkerForm::findOrFail($id);

        $workerForm->update([
            'image' => $data['image'],
        ]);
        return $this->success(new WorkerFormResource($workerForm));
    }

   

}
