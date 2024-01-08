<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\WorkerFileResource;
use App\Http\Resources\WorkerFormResource;
use App\Http\Resources\WorkerProfileResource;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use App\Models\WorkerFile;
use App\Models\WorkerForm;
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
    public function getCountries()
    {
        return $this->success(CountryResource::collection(Country::all()));
    }

    public function getSettings()
    {
        return $this->success(SettingsResource::collection(Setting::all()));
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

    public function getNotification()
    {
        return $this->success(NotificationResource::collection(Notification::all()));
    }



}