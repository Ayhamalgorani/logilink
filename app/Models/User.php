<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $appends = ['user'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_worker' => 'boolean',
        'birth_date' => "datetime:Y-m-d",
    ];

    public function contact_us(): HasMany
    {
        return $this->hasMany(ContactUs::class);
    }

    public function favorite(): hasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function devices(): hasMany
    {
        return $this->hasMany(UserDevice::class);
    }

    public function worker(): HasOne
    {
        return $this->hasOne(Worker::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'service_id', 'service_id');
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'worker_id');
    }

    public function getRate()
    {

        if ($this->reviews->count() > 0) {
            return $this->reviews->avg('worker_rate');
        } else {
            return 0;
        }

    }

    public function getReview()
    {
        $arr = [];
        foreach ($this->reviews as $review) {

            $arr[] = ['worker_rate' => $review->worker_rate,
                'worker_review' => $review->worker_review];
        }
        return $arr;
    }
}