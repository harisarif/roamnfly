<?php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
?>

<?php if(!empty($languages) && setting_item('site_enable_multi_lang')): ?>
    <li class="language-dropdown menu-item-has-children">
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($locale == $language->locale): ?>
                <a href="#" class="is_login">
                    <span class="mr-10">
                        <?php if($language->flag): ?>
                            <span class="flag-icon flag-icon-<?php echo e($language->flag); ?>"></span>
                        <?php endif; ?>
                        <?php echo e($language->name); ?>

                    </span>
                    <i class="icon icon-chevron-sm-down"></i>
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <ul class="subnav">
            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($locale != $language->locale): ?>
                    <li>
                        <a href="<?php echo e(get_lang_switcher_url($language->locale)); ?>" class="is_login dropdown-item" style="justify-content: flex-start">
                            <?php if($language->flag): ?>
                                <span class="flag-icon flag-icon-<?php echo e($language->flag); ?>"></span>
                            <?php endif; ?>
                            <?php echo e($language->name); ?>

                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </li>
<?php endif; ?>

<?php /**PATH /home/u510181259/domains/techtrack.online/public_html/roamnfly/themes/GoTrip/Language/Views/frontend/switcher-dropdown.blade.php ENDPATH**/ ?>