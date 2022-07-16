<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
        
       
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.aptmnt_on'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="aptmnt_on" name="aptmnt_on"
                    value="<?php echo e($appointments->aptmnt_on  ?? ''); ?>">
            </div>
        </div>

       
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.status'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="status" name="status">
                    <option value="">Select Status</option>
                    <option value="1" >Completed</option>
                    <option value="2">Reschedule</option>
                    <option value="3">Rejected</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.cmnts_after_aptmnt'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="cmnts_after_aptmnt" name="cmnts_after_aptmnt"
                    value="<?php echo e($appointments->cmnts_after_aptmnt  ?? ''); ?>">
            </div>
        </div>
        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.aptmnt_positivity_rate'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="aptmnt_positivity_rate" name="aptmnt_positivity_rate"
                    value="<?php echo e($appointments->aptmnt_positivity_rate  ?? ''); ?>">
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
</div><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/appointments/modals/edit.blade.php ENDPATH**/ ?>