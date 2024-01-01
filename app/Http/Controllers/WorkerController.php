<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WorkerFormResource;
use App\Models\Order;
use App\Models\User;
use App\Models\WorkerForm;
use App\Traits\AppResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $data =  $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:worker_forms',
            'phone_number' => 'required|regex:/^07[789]\d{7}$/|unique:worker_forms',
            'service' => 'required',
            "gender" => "required|in:male,female",
            "birth_date" => "required|date",
            'location' => 'required',
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
            "location" => $data['location'],
            "is_terms_agreed" => $data['terms'],
        ]);
        return $this->success(new WorkerFormResource($message), 'Form has been sent');

    }

    public function orders()
    {
        return $this->success(OrderResource::collection(Order::all()));
    }
}
