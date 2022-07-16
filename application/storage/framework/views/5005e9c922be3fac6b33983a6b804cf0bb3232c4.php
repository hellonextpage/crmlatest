<?php $__currentLoopData = $appointmenttype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="appointmenttype_<?php echo e($apt->aptmnt_type_id); ?>">
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($apt->name)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($apt->created_on)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($apt->status)); ?>

    </td>
    <td class="team_col_position">
    <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="<?php echo e(urlResource('/appointmenttype/'.$apt->aptmnt_type_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_user'))); ?>"
                data-action-url="<?php echo e(urlResource('/appointmenttype/'.$apt->aptmnt_type_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_user'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/appointmenttype/<?php echo e($apt->aptmnt_type_id ?? ''); ?>">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/appointmenttype/components/table/ajax.blade.php ENDPATH**/ ?>