<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
