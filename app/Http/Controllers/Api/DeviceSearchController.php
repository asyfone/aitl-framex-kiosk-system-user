<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceSearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string',
        ]);

        $device = Device::with('location')->where('device_id', $request->device_id)->first();

        if ($device) {
            return response()->json([
                'success' => true,
                'data' => $device,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Device not found',
            ], 404);
        }
    }
}

