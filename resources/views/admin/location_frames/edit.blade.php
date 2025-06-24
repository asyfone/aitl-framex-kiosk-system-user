@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Frames for {{ $location->name }}</h1>
            <a href="{{ route('admin.location-frames.index') }}" class="text-indigo-600 hover:text-indigo-900">Back to Configuration</a>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.location-frames.update', $location) }}" method="POST" class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">Select Frames</label>
                    <div class="mt-1">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($frames as $frame)
                                <label class="relative flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 {{ in_array($frame->id, old('frames', $locationFrames)) ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200' }}">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="frames[]" value="{{ $frame->id }}"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                                {{ in_array($frame->id, old('frames', $locationFrames)) ? 'checked' : '' }}>
                                            <div class="ml-3 flex items-center">
                                                @if($frame->image_path)
                                                    <img src="{{ asset('storage/' . $frame->image_path) }}" alt="{{ $frame->name }}"
                                                        class="h-10 w-10 rounded object-cover">
                                                @else
                                                    <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.707-4.707a1 1 0 011.414 0L16 16m-2-2l1.586-1.586a1 1 0 011.414 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">{{ $frame->name }}</p>
                                                    <p class="text-xs text-gray-500">{{ $frame->category }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @error('frames')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
