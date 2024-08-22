<section class="pt-40 g-header">
    <div class="container">
        <div class="row y-gap-20 justify-between items-end">
            <div class="col-auto">
                <div class="row x-gap-20 items-center">
                    <div class="col-auto">
                        <h1 class="text-30 sm:text-25 fw-600"><?php echo e($row['name']); ?></h1>
                    </div>
                    <div class="col-auto">
                        <?php if($row['rt']): ?>
                            <?php for($i = 1; $i <= $row['rt']; $i++): ?>
                                <i class="icon-star text-10 text-yellow-1"></i>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row x-gap-20 y-gap-20 items-center">
                    <div class="col-auto">
                        <div class="d-flex items-center text-15 text-light-1">
                            <i class="icon-location-2 text-16 mr-5"></i>
                            <?php echo e($translation['ad']['adr']); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="row x-gap-15 y-gap-15 items-center">
                    <div class="col-auto">
                        <div class="text-14">
                            <?php echo e(__('From')); ?>

                            <div class="d-inline-flex justify-content-end align-baseline mt-5">
                                <div class="text-16 text-red-1 line-through mr-5"></div>
                                <div class="text-22 lh-12 fw-600"><?php echo e(format_money($row['ops']['0']['ris'][0]['pis'][0]['fc']['TF'] ?? 0)); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <a href="#hotel-rooms-form" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                            <?php echo e(__('Select Room')); ?> <div class="icon-arrow-top-right ml-15"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if(isset($row['img'])): ?>
    <?php echo $__env->make('Hotel::frontend.layouts.details.gallery2',['galleries' => $row['img']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<section class="pt-30" id="hotel-rooms">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-xl-12">
                <div class="row y-gap-40">
                    <?php if(isset($row['des'])): ?>
                        <div id="overview" class="col-12 gotrip-overview">
                            <h3 class="text-22 fw-500 pt-20"><?php echo e(__('Overview')); ?></h3>
                            <div class="description text-dark-1 text-15 mt-20">
                                <?php $__currentLoopData = json_decode($row['des']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <h6 class="font-weight-bold"><?php echo e(ucwords(str_replace('_',' ',$key))); ?>:</h6>
                                    <div class="mb-2">
                                        <?php echo e($item); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-rooms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</section>
<?php /**PATH /home/u510181259/domains/roamnfly.com/public_html/themes/GoTrip/Hotel/Views/frontend/layouts/details/hotel-detail.blade.php ENDPATH**/ ?>