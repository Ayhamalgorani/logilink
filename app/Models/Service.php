<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    public function worker(): HasMany
    {
        return $this->HasMany(Worker::class);
    }
    
    public function worker_form(): HasMany
    {
        return $this->HasMany(WorkerForm::class);
    }
}