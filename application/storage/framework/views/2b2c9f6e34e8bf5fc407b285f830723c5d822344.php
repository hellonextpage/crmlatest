<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
	<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.customer_id'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="customer_id" name="customer_id">
                    <option value="">Select Users</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php if(isset($sales) && $sales->customer_id==$user->id): ?> selected <?php endif; ?>><?php echo e($user->first_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
		
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.project'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="proj_id" name="proj_id">
                    <option value="">Select Project</option>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($project->project_id); ?>" <?php if(isset($sales) && $sales->project_id==$project->project_id): ?> selected <?php endif; ?>><?php echo e($project->project_title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.inventory_id'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="inventory_id" name="inventory_id">
                    <option value="">Select Inventory</option>
                    <?php $__currentLoopData = $inventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($inv->inventory_id); ?>" <?php if(isset($sales) && $sales->customer_id==$inv->inventory_id): ?> selected <?php endif; ?> ><?php echo e($inv->inventory_id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.plot_villa_flat_no'))); ?> (<?php echo e(config('system.settings_system_currency_symbol')); ?>)</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="actual_amt" name="actual_amt"
                    value="<?php echo e($sales->actual_amt  ?? ''); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.discount_amt'))); ?> (<?php echo e(config('system.settings_system_currency_symbol')); ?>)</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="discount_amt" name="discount_amt"
                    value="<?php echo e($sales->discount_amt  ?? ''); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.sale_sub_total'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="sale_sub_total" name="sale_sub_total"
                    value="<?php echo e($sales->sale_sub_total  ?? ''); ?>">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.sale_tax'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="sale_tax" name="sale_tax"
                    value="<?php echo e($sales->sale_tax  ?? ''); ?>">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.sale_grand_total'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="sale_grand_total" name="sale_grand_total"
                    value="<?php echo e($sales->sale_grand_total  ?? ''); ?>">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.sold_on'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="sold_on" name="sold_on"
                    value="<?php echo e($sales->sold_on  ?? ''); ?>">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.sold_by'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="sold_by" name="sold_by">
                    <option value="">Select Users</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php if(isset($sales) && $sales->sold_by==$user->id): ?> selected <?php endif; ?> ><?php echo e($user->first_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.sale_status'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="sale_status" name="sale_status">
                    <option value="">Select Status</option>
                    <option value="1" <?php if(isset($sales) && $sales->sale_status==1): ?> selected <?php endif; ?>>Ongoing</option>
                    <option value="0" <?php if(isset($sales) && $sales->sale_status==0): ?> selected <?php endif; ?>>Completed</option>
                </select>
            </div>
        </div>
		
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.payment_status'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="payment_status" name="payment_status">
                    <option value="">Select Status</option>
                    <option value="1" <?php if(isset($sales) && $sales->payment_status==1): ?> selected <?php endif; ?>>Ongoing</option>
                    <option value="0" <?php if(isset($sales) && $sales->payment_status==0): ?> selected <?php endif; ?>>Completed</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.comments'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="comments" name="comments"
                    value="<?php echo e($sales->comments  ?? ''); ?>">
            </div>
        </div>
        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.is_active'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_active" name="is_active">
                    <option value="">Select Status</option>
                    <option value="1" <?php if(isset($sales) && $sales->is_active==1): ?> selected <?php endif; ?>>Active</option>
                    <option value="0" <?php if(isset($sales) && $sales->is_active==0): ?> selected <?php endif; ?>>Inactive</option>
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
</div><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/sales/modals/add-edit-inc.blade.php ENDPATH**/ ?>