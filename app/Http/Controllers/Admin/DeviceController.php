<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

   public function index(Request $request)
{
    $search = $request->input('search'); // search keyword
    
    $query = Device::with('location')->latest();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
               ->orWhere('phone', 'like', "%{$search}%")
               ->orWhereHas('location', function ($query) use ($search) {
                   $query->where('name', 'like', "%{$search}%");
               });
        });
    }
  
    $devices = $query->paginate(10)->appends(['search' => $search]);

    return view('admin.devices.index', compact('devices', 'search'));
}



    public function create()
    {
        $locations = Location::where('is_active', true)->get();
        return view('admin.devices.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $location = Location::findOrFail($request->location_id);
        $date = Carbon::now()->format('Ymd');
        $locationSlug = Str::slug($location->name);

        $lastDevice = Device::where('location_id', $location->id)
                            ->where('device_id', 'like', "D-{$date}-{$locationSlug}-%")
                            ->orderByDesc('device_id')
                            ->first();

        $sequenceNumber = 1;
        if ($lastDevice) {
            $parts = explode('-', $lastDevice->device_id);
            $lastSequenceNumber = (int) end($parts);
            $sequenceNumber = $lastSequenceNumber + 1;
        }

        $paddedSequenceNumber = str_pad($sequenceNumber, 5, '0', STR_PAD_LEFT);

        $data['device_id'] = "D-{$date}-{$locationSlug}-{$paddedSequenceNumber}";

        Device::create($data);

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device created successfully.');
    }

    public function edit(Device $device)
    {
        $locations = Location::where('is_active', true)->get();
        return view('admin.devices.edit', compact('device', 'locations'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'device_id' => ['required', 'string', 'max:255', Rule::unique('devices')->ignore($device->id)],
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $device->update($data);

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device deleted successfully.');
    }
}
