<!--ALL THIRD PART JAVASCRIPTS-->
<script src="nextpagecrm/public/vendor/js/vendor.footer.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--nextloop.core.js-->
<script src="nextpagecrm/public/js/core/ajax.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--MAIN JS - AT END-->
<script src="nextpagecrm/public/js/core/boot.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--EVENTS-->
<script src="nextpagecrm/public/js/core/events.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--CORE-->
<script src="nextpagecrm/public/js/core/app.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--BILLING-->
<script src="nextpagecrm/public/js/core/billing.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--project page charts-->
<?php if(@config('visibility.projects_d3_vendor')): ?>
<script src="nextpagecrm/public/vendor/js/d3/d3.min.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<script src="nextpagecrm/public/vendor/js/c3-master/c3.min.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<?php endif; ?>

<!--form builder-->
<?php if(@config('visibility.web_form_builder')): ?>
<script src="nextpagecrm/public/vendor/js/formbuilder/form-builder.min.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<script src="nextpagecrm/public/js/webforms/webforms.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<?php endif; ?><?php /**PATH D:\xamppNew\htdocs\nextpagecrm\application\resources\views/layout/footerjs.blade.php ENDPATH**/ ?>