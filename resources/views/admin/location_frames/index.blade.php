@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Location Frame Configuration</h1>
            <p class="mt-2 text-sm text-gray-700">Manage which frames are available at each location and their active status.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Location Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Device IDs</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Associated Frames</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Config Status</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($locations as $location)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $location->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @forelse($location->devices as $device)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2 mb-2">
                                                {{ $device->device_id }}
                                            </span>
                                        @empty
                                            <span class="text-gray-400">No devices assigned</span>
                                        @endforelse
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-500">
                                        @forelse($location->frames as $frame)
                                            <div class="inline-flex items-center mr-2 mb-2">
                                                @if($frame->image_path)
                                                    <img src="{{ asset('storage/' . $frame->image_path) }}" alt="{{ $frame->name }}"
                                                        class="h-6 w-6 rounded object-cover mr-1">
                                                @else
                                                    <div class="h-6 w-6 rounded bg-gray-200 flex items-center justify-center mr-1">
                                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.707-4.707a1 1 0 011.414 0L16 16m-2-2l1.586-1.586a1 1 0 011.414 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $frame->pivot->is_active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $frame->name }}
                                                    @if(!$frame->pivot->is_active)
                                                        <span class="ml-1 text-gray-500">(inactive)</span>
                                                    @endif
                                                </span>
                                            </div>
                                        @empty
                                            <span class="text-gray-400">No frames configured</span>
                                        @endforelse
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if($location->devices->isNotEmpty())
                                            <form action="{{ route('admin.location-frames.toggle-config-status', $location) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <label for="config-status-toggle-{{ $location->id }}" class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="config-status-toggle-{{ $location->id }}" class="sr-only peer" name="is_config_active" value="1" {{ $location->is_config_active ? 'checked' : '' }} onchange="this.form.submit()">
                                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                                    <span class="ml-3 text-sm font-medium text-gray-900">{{ $location->is_config_active ? 'Active' : 'Inactive' }}</span>
                                                </label>
                                            </form>
                                        @else
                                            <span class="text-gray-400">Add device first to activate</span>
                                        @endif
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        @if($location->devices->isNotEmpty())
                                            <a href="{{ route('admin.location-frames.edit', $location) }}" class="text-indigo-600 hover:text-indigo-900">Edit Frames</a>
                                        @else
                                            <span class="text-gray-400">Add device first</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-4 text-sm text-gray-500 text-center">No locations found for configuration</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $locations->links() }}
    </div>
</div>
@endsection
