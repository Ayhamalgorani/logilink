<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function worker(): HasMany
    {
        return $this->HasMany(Worker::class);
    }

    public function worker_form(): HasMany
    {
        return $this->HasMany(WorkerForm::class);
    }

    public function orders(): HasMany
    {
        return $this->HasMany(Order::class);
    }

}
