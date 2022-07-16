<?php $__currentLoopData = $inventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="inventory_<?php echo e($inv->inventory_id); ?>">
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($inv->proj_id)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($inv->area)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($inv->facing)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($inv->measurements)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($inv->status)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($inv->plot_villa_flat_no)); ?>

    </td>
    <td class="team_col_position">
    <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="<?php echo e(urlResource('/inventory/'.$inv->inventory_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_user'))); ?>"
                data-action-url="<?php echo e(urlResource('/inventory/'.$inv->inventory_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_user'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/inventory/<?php echo e($inv->inventory_id ?? ''); ?>">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/inventory/components/table/ajax.blade.php ENDPATH**/ ?>