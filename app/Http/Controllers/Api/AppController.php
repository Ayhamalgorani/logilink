<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SettingsResource;
use App\Models\Service;
use App\Models\Setting;
use App\Traits\AppResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    


}