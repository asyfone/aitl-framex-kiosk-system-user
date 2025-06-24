<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrameController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $query = Frame::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }

        $frames = $query->latest()->paginate(10);

        return view('admin.frames.index', compact('frames'));
    }

    public function create()
    {
        return view('admin.frames.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('frames', 'public');
            $data['image_path'] = $path;
        }

        Frame::create($data);

        return redirect()->route('admin.frames.index')
            ->with('success', 'Frame created successfully.');
    }

    public function edit(Frame $frame)
    {
        return view('admin.frames.edit', compact('frame'));
    }

    public function update(Request $request, Frame $frame)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($frame->image_path) {
                Storage::disk('public')->delete($frame->image_path);
            }

            $path = $request->file('image')->store('frames', 'public');
            $data['image_path'] = $path;
        }

        $frame->update($data);

        return redirect()->route('admin.frames.index')
            ->with('success', 'Frame updated successfully.');
    }

    public function destroy(Frame $frame)
    {
        if ($frame->image_path) {
            Storage::disk('public')->delete($frame->image_path);
        }

        $frame->delete();

        return redirect()->route('admin.frames.index')
            ->with('success', 'Frame deleted successfully.');
    }
}
