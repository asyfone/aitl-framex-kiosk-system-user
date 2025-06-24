<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationFrameApiController extends Controller
{
    /**
     * Get frames for a specific device ID
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFramesByDeviceId(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string'
        ]);

        $device = Device::where('device_id', $request->device_id)->first();

        if (!$device) {
            return response()->json([
                'message' => 'Invalid device ID',
                'status' => 'error'
            ], 404);
        }

        $location = $device->location;

        if (!$location || !$location->is_config_active) {
            return response()->json([
                'message' => 'Location configuration is not active',
                'status' => 'error'
            ], 403);
        }

        $frames = $location->frames()
            ->wherePivot('is_active', true)
            ->select('frames.id', 'frames.name', 'frames.image_path', 'frames.price', 'location_frame.is_active')
            ->get();

        return response()->json([
            'message' => 'Frames retrieved successfully',
            'status' => 'success',
            'data' => [
                'location' => $location->name,
                'frames' => $frames
            ]
        ], 200);
    }
}
