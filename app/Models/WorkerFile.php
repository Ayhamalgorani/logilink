<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkerFile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function worker_form(): BelongsTo
    {
        return $this->belongsTo(WorkerForm::class);
    }
}
