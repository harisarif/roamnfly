<section class="masthead -type-9">
    <div class="masthead-slider js-masthead-slider-9">
        <div class="swiper-wrapper">

            <?php $__currentLoopData = $list_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($item['bg_image'])): ?>
                    <?php $img_url = get_file_url($item['bg_image'],'full') ?>
                    <div class="swiper-slide">
                        <div class="masthead__bg bg-dark-3">
                            <img src="<?php echo e($img_url); ?>" alt="image">
                        </div>

                        <div class="container">
                            <div class="row justify-center">
                                <div class="col-xl-9">
                                    <div class="text-center">
                                        <div class="text-white fw-500 uppercase mb-10"><?php echo e($item['sub_title']); ?></div>
                                        <h1 class="text-80 lg:text-60 sm:text-40 text-white"><?php echo clean($item['title']); ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <div class="masthead-slider__nav -prev">
            <button class="button py-10 js-prev">
                <span class="h-1 w-48 bg-white"></span>
            </button>
        </div>

        <div class="masthead-slider__nav -next">
            <button class="button py-10 js-next">
                <span class="h-1 w-48 bg-white"></span>
            </button>
        </div>
    </div>

    <a href="<?php echo e($scroll_down_id ?? '#secondSection'); ?>" class="masthead__scroll">
        <div class="d-flex items-center">
            <div class="text-white lh-15 text-right mr-10">
                <div class="fw-500"><?php echo e(__("Scroll Down")); ?></div>
                <div class="text-15"><?php echo e(__("to discover more")); ?></div>
            </div>

            <div class="-icon">
                <div></div>
                <div></div>
            </div>
        </div>
    </a>

    <div class="container">
        <div class="mainSearch-wrap bg-white shadow-1">
            <!--Search Form-->
            <?php echo $__env->make('Boat::frontend.layouts.search.form-search',['style' => 'boat_carousel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--End Search Form-->
        </div>
    </div>
</section>
<?php /**PATH /home/u510181259/domains/roamnfly.com/public_html/themes/GoTrip/Boat/Views/frontend/blocks/form-search-boat/index.blade.php ENDPATH**/ ?>