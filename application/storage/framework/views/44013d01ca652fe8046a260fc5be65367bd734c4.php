<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
	<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.aptmnt_id'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="aptmnt_id" name="aptmnt_id">
                    <option value="">Select Appointment</option>
                    <?php $__currentLoopData = $appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($app->aptmnt_id); ?>" <?php if(isset($salespayment) && $salespayment->aptmnt_id==$app->aptmnt_id): ?> selected <?php endif; ?>><?php echo e($app->aptmnt_id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.pay_schedl_sub_total'))); ?> (<?php echo e(config('system.settings_system_currency_symbol')); ?>)</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="pay_schedl_sub_total" name="pay_schedl_sub_total"
                    value="<?php echo e($salespayment->pay_schedl_sub_total  ?? ''); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.pay_schedl_tax'))); ?> (<?php echo e(config('system.settings_system_currency_symbol')); ?>)</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="pay_schedl_tax" name="pay_schedl_tax"
                    value="<?php echo e($salespayment->pay_schedl_tax  ?? ''); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.pay_schedl_grand_total'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="pay_schedl_grand_total" name="pay_schedl_grand_total"
                    value="<?php echo e($salespayment->pay_schedl_grand_total  ?? ''); ?>">
            </div>
        </div>
		
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.payment_schedled_on'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="payment_schedled_on" name="payment_schedled_on"
                    value="<?php echo e($salespayment->payment_schedled_on  ?? ''); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.payment_due_date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="payment_due_date" name="payment_due_date"
                    value="<?php echo e($salespayment->payment_due_date  ?? ''); ?>">
            </div>
        </div>
		

        

        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.is_active'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_active" name="is_active">
                    <option value="">Select Status</option>
                    <option value="1" <?php if(isset($salespayment) && $salespayment->is_active==1): ?> selected <?php endif; ?>>Active</option>
                    <option value="0" <?php if(isset($salespayment) && $salespayment->is_active==0): ?> selected <?php endif; ?>>Inactive</option>
                </select>
            </div>
        </div>
        <!--/#[edit] city-->

         <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/salespayment/modals/add-edit-inc.blade.php ENDPATH**/ ?>