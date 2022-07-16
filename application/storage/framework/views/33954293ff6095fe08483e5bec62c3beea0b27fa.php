<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">    
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.name'))); ?> (<?php echo e(config('system.settings_system_currency_symbol')); ?>)</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="name" name="name"
                    value="<?php echo e($appointmenttype->name  ?? ''); ?>">
            </div>
        </div>       
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.is_active'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="status" name="status">
                    <option value="">Select Status</option>
                    <option value="1" <?php if(isset($appointmenttype) && $appointmenttype->status==1): ?> selected <?php endif; ?>>Active</option>
                    <option value="0" <?php if(isset($appointmenttype) && $appointmenttype->status==0): ?> selected <?php endif; ?>>Inactive</option>
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
</div><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/appointmenttype/modals/add-edit-inc.blade.php ENDPATH**/ ?>