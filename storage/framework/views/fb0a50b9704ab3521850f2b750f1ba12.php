<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Frames for <?php echo e($location->name); ?></h1>
            <a href="<?php echo e(route('admin.location-frames.index')); ?>" class="text-indigo-600 hover:text-indigo-900">Back to Configuration</a>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <form action="<?php echo e(route('admin.location-frames.update', $location)); ?>" method="POST" class="space-y-6 p-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">Select Frames</label>
                    <div class="mt-1">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $frames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $frame): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="relative flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 <?php echo e(in_array($frame->id, old('frames', $locationFrames)) ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200'); ?>">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="frames[]" value="<?php echo e($frame->id); ?>"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                                <?php echo e(in_array($frame->id, old('frames', $locationFrames)) ? 'checked' : ''); ?>>
                                            <div class="ml-3 flex items-center">
                                                <?php if($frame->image_path): ?>
                                                    <img src="<?php echo e(asset('storage/' . $frame->image_path)); ?>" alt="<?php echo e($frame->name); ?>"
                                                        class="h-10 w-10 rounded object-cover">
                                                <?php else: ?>
                                                    <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.707-4.707a1 1 0 011.414 0L16 16m-2-2l1.586-1.586a1 1 0 011.414 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900"><?php echo e($frame->name); ?></p>
                                                    <p class="text-xs text-gray-500"><?php echo e($frame->category); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php $__errorArgs = ['frames'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\6.3.25\frameX-kiosk-system-admin\resources\views/admin/location_frames/edit.blade.php ENDPATH**/ ?>