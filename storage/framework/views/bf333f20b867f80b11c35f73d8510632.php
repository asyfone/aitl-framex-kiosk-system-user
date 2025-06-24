<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Devices -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Devices</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
            <div class="p-3 rounded-md bg-yellow-100 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-0.75-3M3 13h18m-5 0a2 2 0 11-4 0 2 2 0 014 0zm0 0l.01.01M12 16l.01.01M12 7l.01.01M12 10l.01.01M12 13l.01.01M12 16l.01.01M12 19l.01.01" />
                  </svg>
            </div>
        </div>

        <!-- Total Locations -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Locations</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
            <div class="p-3 rounded-md bg-blue-100 text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657A8 8 0 1117.657 16.657z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
            </div>
        </div>

        <!-- Total Frames -->
        <a href="<?php echo e(route('admin.frames.index')); ?>" class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between hover:shadow-lg transition-shadow duration-200">
             <div>
                <p class="text-sm font-medium text-gray-500">Total Frames</p>
                <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e(\App\Models\Frame::count()); ?></p>
            </div>
            <div class="p-3 rounded-md bg-green-100 text-green-600">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.707-4.707a1 1 0 011.414 0L16 16m-2-2l1.586-1.586a1 1 0 011.414 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
            </div>
        </a>

        <!-- Total Prints -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Prints</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
            <div class="p-3 rounded-md bg-purple-100 text-purple-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12h.01" />
                  </svg>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
        <div class="space-y-4 text-gray-600">
            <p>No recent activity to display.</p>
            
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\6.3.25\frameX-kiosk-system-admin\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>