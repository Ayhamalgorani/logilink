<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkerForm extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'birth_date' => "datetime:Y-m-d",
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function worker_files(): HasMany
    {
        return $this->hasMany(WorkerFile::class);
    }
}
