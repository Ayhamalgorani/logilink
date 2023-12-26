<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\WorkerProfileResource;
use App\Models\ContactUs;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use App\Traits\AppResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    use AppResponse;

    public function getServices()
    {
        return $this->success(ServiceResource::collection(Service::all()));
    }

    public function getSettings()
    {
        return $this->success(SettingsResource::collection(Setting::all()));
    }
    
    public function getWorkersByService(Service $service): JsonResponse
    {
        $workers = Worker::whereHas('user', function ($query) use ($service) {
            $query->where('is_worker', true);
        })
            ->where('service_id', $service->id)
            ->get();

        return $this->success(WorkerProfileResource::collection($workers));
    }

    public function creatMessage(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "message" => "required",

        ]);
        $message = Auth::user()->contact_us()->create(["name" => $data['name'], "message" => $data['message']]);
        return $this->success(new ContactUsResource($message), 'message has been sent');
    }


}