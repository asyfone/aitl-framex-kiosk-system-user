<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceAuthController extends Controller
{
    /**
     * Authenticate device using device ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string',
        ]);

        $device = Device::where('device_id', $request->device_id)->first();

        if ($device) {
            // Device found, authentication successful
            return response()->json([
                'message' => 'Authentication successful',
                'device' => $device,
            ], 200);
        } else {
            // Device not found, authentication failed
            return response()->json([
                'message' => 'Authentication failed: Invalid device ID',
            ], 401);
        }
    }
}
