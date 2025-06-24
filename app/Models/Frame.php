<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'status',
        'image_path',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];

    /**
     * Get the printing histories for the frame.
     */
    public function printingHistories()
    {
        return $this->hasMany(PrintingHistory::class);
    }

    /**
     * The devices that this frame is configured for.
     */
    public function devices()
    {
        return $this->belongsToMany(Device::class);
    }

    /**
     * The locations where this frame is available.
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_frame');
    }
}
