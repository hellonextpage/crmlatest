<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="appointments_<?php echo e($app->aptmnt_id); ?>">
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($app->aptmnt_on)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($app->lead_firstname)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($app->lead_phone)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($app->name)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($app->aptmnt_mode)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($app->first_name)); ?>

    </td>
    <td class="team_col_position">
    <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="<?php echo e(urlResource('/appointment/'.$app->aptmnt_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_user'))); ?>"
                data-action-url="<?php echo e(urlResource('/appointment/'.$app->aptmnt_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_user'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/appointment/<?php echo e($app->aptmnt_id ?? ''); ?>">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/appointments/components/table/ajax.blade.php ENDPATH**/ ?>