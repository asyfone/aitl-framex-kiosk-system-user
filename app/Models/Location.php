<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'description',
        'is_active',
        'is_config_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_config_active' => 'boolean',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    /**
     * The frames available at this location.
     */
    public function frames()
    {
        return $this->belongsToMany(Frame::class, 'location_frame')
            ->withPivot('is_active')
            ->withTimestamps();
    }
}
