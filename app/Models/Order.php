<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'json',
        'date' => "datetime:Y-m-d",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'order_id');
    }
}