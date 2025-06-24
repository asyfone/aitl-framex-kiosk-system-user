<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationFrameApiController extends Controller
{
    /**
     * Get location frame configurations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $locations = Location::with('frames:frames.id,frames.name,frames.category,frames.price,frames.image_path')
            ->whereHas('frames') // Only return locations that have frames configured
            ->get(['locations.id', 'locations.name']); // Select specific location fields

        return response()->json($locations);
    }
}
