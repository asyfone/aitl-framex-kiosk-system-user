<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Frames</h1>
        <a href="<?php echo e(route('admin.frames.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Add New Frame
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.frames.index')); ?>" method="GET" class="mb-4">
        <input 
            type="text" 
            name="search" 
            placeholder="Search by name or category…" 
            value="<?php echo e(request('search')); ?>"
            class="px-4 py-2 border rounded-md shadow-sm mr-2">
        <button 
            type="submit" 
            class="px-4 py-2 bg-indigo-600 text-gray-100 rounded-md">
            Search
        </button>
        
    </form>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $frames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $frame): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li>
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <?php if($frame->image_path): ?>
                                    <img src="<?php echo e(Storage::url($frame->image_path)); ?>" alt="<?php echo e($frame->name); ?>" class="h-12 w-12 rounded-lg object-cover">
                                <?php else: ?>
                                    <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No image</span>
                                    </div>
                                <?php endif; ?>
                                <div class="ml-4">
                                    <h2 class="text-lg font-medium text-gray-900"><?php echo e($frame->name); ?></h2>
                                    <p class="text-sm text-gray-500"><?php echo e($frame->category); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-lg font-medium text-gray-900">$<?php echo e(number_format($frame->price, 2)); ?></span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($frame->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                    <?php echo e($frame->status ? 'Active' : 'Inactive'); ?>

                                </span>
                                <div class="flex space-x-2">
                                    <a href="<?php echo e(route('admin.frames.edit', $frame)); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="<?php echo e(route('admin.frames.destroy', $frame)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this frame?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="px-4 py-4 sm:px-6 text-center text-gray-500">
                    No frames found.
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="mt-4">
        <?php echo e($frames->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\6.3.25\frameX-kiosk-system-admin\resources\views/admin/frames/index.blade.php ENDPATH**/ ?>