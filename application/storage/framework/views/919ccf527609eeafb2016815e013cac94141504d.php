<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
    <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.user_id'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="user_id" name="user_id">
                    <option value="">Select Users</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php if(isset($usercommission) && $usercommission->user_id==$user->id): ?> selected <?php endif; ?>><?php echo e($user->first_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.sale_id'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="sale_id" name="sale_id">
                    <option value="">Select Sale</option>
                    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sale->sale_id); ?>" <?php if(isset($usercommission) && $usercommission->sale_id==$sale->sale_id): ?> selected <?php endif; ?>><?php echo e($sale->sale_id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.is_settled'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_settled" name="is_settled">
                    <option value=""></option>
                    <option value="1" <?php if(isset($usercommission) && $usercommission->is_settled==1): ?> selected <?php endif; ?>>Settled</option>
                    <option value="0" <?php if(isset($usercommission) && $usercommission->is_settled==0): ?> selected <?php endif; ?>>Un Settled</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.settled_on'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="settled_on" name="settled_on"
                    value="<?php echo e($usercommission->settled_on  ?? ''); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.commission_amt'))); ?> (<?php echo e(config('system.settings_system_currency_symbol')); ?>)</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="commission_amt" name="commission_amt"
                    value="<?php echo e($usercommission->commission_amt  ?? ''); ?>">
            </div>
        </div>

        
        

        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.is_active'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_active" name="is_active">
                    <option value="">Select Status</option>
                    <option value="1" <?php if(isset($usercommission) && $usercommission->is_active==1): ?> selected <?php endif; ?>>Active</option>
                    <option value="0" <?php if(isset($usercommission) && $usercommission->is_active==0): ?> selected <?php endif; ?>>Inactive</option>
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
</div><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/usercommission/modals/add-edit-inc.blade.php ENDPATH**/ ?>