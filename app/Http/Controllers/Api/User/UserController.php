<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\WorkerProfileResource;
use App\Models\Favorite;
use App\Models\Service;
use App\Models\Worker;
use App\Traits\AppResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use AppResponse;

    public function getUserProfile(): JsonResponse
    {
        return $this->success(new UserProfileResource(auth()->user()));
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

    public function getFavorite()
    {
        $favorite = Auth::user()->favorite;
        return $this->success(WorkerProfileResource::collection($favorite));
    }

    public function editFavorite(Worker $worker): JsonResponse
    {
        $favorite = Favorite::where('worker_id', $worker->id)->first();

        $message = '';
        if ($favorite) {
            $favorite->delete();
            $message = 'worker removed from favorites';
        } else {
            Favorite::query()->create(['user_id' => auth()->user()->id, 'worker_id' => $worker->id]);
            $message = 'worker added to favorites';
        }

        return $this->success(true, $message);
    }

}