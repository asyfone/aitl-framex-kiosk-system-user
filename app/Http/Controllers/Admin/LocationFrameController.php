<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Frame;
use Illuminate\Http\Request;

class LocationFrameController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $locations = Location::with(['frames', 'devices'])->latest()->paginate(10);
        return view('admin.location_frames.index', compact('locations'));
    }

    public function edit(Location $location)
    {
        $frames = Frame::all();
        $locationFrames = $location->frames->pluck('id')->toArray();
        return view('admin.location_frames.edit', compact('location', 'frames', 'locationFrames'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'frames' => 'required|array',
            'frames.*' => 'exists:frames,id',
        ]);

        $location->frames()->sync($request->frames);

        return redirect()->route('admin.location-frames.index')
            ->with('success', 'Frame configuration updated successfully.');
    }

    public function toggleConfigStatus(Request $request, Location $location)
    {
        $location->update([
            'is_config_active' => $request->has('is_config_active'),
        ]);

        return redirect()->route('admin.location-frames.index')
            ->with('success', 'Location configuration status updated successfully.');
    }
}
