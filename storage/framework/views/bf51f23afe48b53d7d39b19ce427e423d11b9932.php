<style>
    .card-title-custom {
        position: absolute;
        top: 160px;
        bottom: 0px;
        left: 25px;
        z-index: 9;
        }
   .bravo-list-news .col-lg-4 {
        width: 235px !important;
    }
    .custom_Blog {
        height: 231px;
        overflow: hidden;
        position: relative;
        border-radius: 8px;
    }
    .main_News > .custom_href::after {
        width: calc(100% - 48px);
        height: 10px;
        border-radius: 10px 10px 0 0;
        background-color: #f5f5f5;
        content: '';
        top: 0;
        left: 24px;
        position: absolute;
    }
    .custom_Image {
        width: 100%;
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: 1;
        border-radius: 0 0 8px 8px;
        background-image: linear-gradient(180deg, rgb(0 0 0 / 0%), rgb(0 0 0 / 80%));
        padding: 77px 12px 12px;
    }
    .main_News > .custom_href::before {
        width: 205px !important;
        height: 10px;
        border-radius: 10px 10px 0 0;
        background-color: #dcdcdc;
        content: '';
        top: 10px;
        left: 14px;
        position: absolute;
    }
    .main_News {
        width: 100%;
        display: inline-block;
    }
    </style>
<?php $translation = $row->translate(); ?>

<?php if($style == 'style_5'): ?>
    <a href="<?php echo e($row->getDetailUrl()); ?>" class="blogCard -type-2 d-block bg-white rounded-4 shadow-4">
        <div class="blogCard__image">
            <div class="ratio ratio-1:1 rounded-4">
                <?php if($row->image_id): ?>
                    <?php if(!empty($disable_lazyload)): ?>
                        <img class="img-ratio js-lazy" src="#" data-src="<?php echo e(get_file_url($row->image_id,'medium')); ?>" alt="<?php echo e($translation->name ?? ''); ?>">
                    <?php else: ?>
                        <?php echo get_image_tag($row->image_id,'medium',['class'=>'img-ratio js-lazy','alt'=>$row->title]); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="px-20 py-20">
            <h4 class="text-dark-1 text-16 lh-18 fw-500"><?php echo clean($translation->title); ?></h4>
            <div class="text-light-1 text-15 lh-14 mt-10"><?php echo e(display_date($row->updated_at)); ?></div>
        </div>
    </a>
<?php elseif(!in_array($style,['style_2','style_4','style_6'])): ?>
    <div class="item-news main_News">
        <a href="<?php echo e($row->getDetailUrl()); ?>" class="blogCard custom_href -type-1 d-block ">
            <div class="blogCard__image custom_Blog">
                <div class="ratio ratio-4:3 rounded-4 rounded-8 custom_Image" style="width:215px;height:250px;">
                    <?php if($row->image_id): ?>
                        <?php if(!empty($disable_lazyload)): ?>
                            <img class="img-ratio js-lazy" src="#" data-src="<?php echo e(get_file_url($row->image_id,'medium')); ?>" alt="<?php echo e($translation->name ?? ''); ?>">
                        <?php else: ?>
                            <?php echo get_image_tag($row->image_id,'medium',['class'=>'img-ratio js-lazy','alt'=>$row->title]); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-20 custom_Description">
                <h4 class="text-white text-18 fw-700 card-title-custom" style="font-size:16px !important;"><?php echo clean($translation->title); ?></h4>
                <!-- <div class="text-light-1 text-15 lh-14 mt-5"><?php echo e(display_date($row->updated_at)); ?></div> -->
            </div>
        </a>
    </div>
<?php elseif($style == 'style_4'): ?>
    <a href="<?php echo e($row->getDetailUrl()); ?>" class="blogCard -type-3 ">
        <div class="blogCard__image rounded-4">
            <?php if($row->image_id): ?>
                <?php if(!empty($disable_lazyload)): ?>
                    <img class="object-cover size-130 js-lazy" src="#" data-src="<?php echo e(get_file_url($row->image_id,'medium')); ?>" alt="<?php echo e($translation->name ?? ''); ?>">
                <?php else: ?>
                    <?php echo get_image_tag($row->image_id,'medium',['class'=>'object-cover size-130 js-lazy','alt'=>$row->title]); ?>

                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="blogCard__content px-50 pb-30 lg:px-20 pb-20">
            <h4 class="<?php if(!$k): ?> text-26 <?php else: ?> text-18 <?php endif; ?> lg:text-18 fw-600 lh-16 text-white"><?php echo clean($translation->title); ?></h4>
            <div class="text-15 lh-14 text-white mt-10"><?php echo e(display_date($row->updated_at)); ?></div>
        </div>
    </a>
<?php elseif($style == 'style_6'): ?>
    <a href="<?php echo e($row->getDetailUrl()); ?>" class="row y-gap-20 items-center news-item">
        <div class="col-md-auto col-xs-12">
            <?php if($row->image_id): ?>
                <?php if(!empty($disable_lazyload)): ?>
                    <img class="size-250 size-mb-100 rounded-4" src="#" data-src="<?php echo e(get_file_url($row->image_id,'medium')); ?>" alt="<?php echo e($translation->name ?? ''); ?>">
                <?php else: ?>
                    <?php echo get_image_tag($row->image_id,'medium',['class'=>'size-250 size-mb-100 rounded-4 js-lazy','alt'=>$row->title]); ?>

                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="col">
            <div class="text-15 text-light-1"><?php echo e(display_date($row->updated_at)); ?></div>
            <h4 class="text-22 fw-600 text-dark-1 mt-10"><?php echo clean($translation->title); ?></h4>
            <p class="mt-10"><?php echo clean(\Illuminate\Support\Str::words($row->content,15,'')); ?></p>
        </div>
    </a>
<?php else: ?>
<a href="<?php echo e($row->getDetailUrl()); ?>" class="blogCard -type-1 d-block ">
    <div class="blogCard__image">
        <div class="ratio ratio-1:1 rounded-4 rounded-8">
            <?php if($row->image_id): ?>
                <?php if(!empty($disable_lazyload)): ?>
                    <img class="img-ratio js-lazy" src="#" data-src="<?php echo e(get_file_url($row->image_id,'medium')); ?>" alt="<?php echo e($translation->name ?? ''); ?>">
                <?php else: ?>
                    <?php echo get_image_tag($row->image_id,'medium',['class'=>'img-ratio js-lazy','alt'=>$row->title]); ?>

                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-20 ">
        <h4 class="text-dark-1 text-18 fw-500"><?php echo clean($translation->title); ?></h4>
        <div class="text-light-1 text-15 lh-14 mt-5"><?php echo e(display_date($row->updated_at)); ?></div>
    </div>
</a>
<?php endif; ?>
<?php /**PATH C:\Users\ADMIN\Documents\projects\RoamnFlyGitHub\roamnfly\themes/GoTrip/News/Views/frontend/blocks/list-news/loop.blade.php ENDPATH**/ ?>