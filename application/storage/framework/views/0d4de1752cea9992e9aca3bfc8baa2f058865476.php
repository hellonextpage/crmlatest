<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="sales_<?php echo e($sale->sale_id); ?>">
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($sale->proj_id)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($sale->actual_amt)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($sale->discount_amt)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($sale->sale_sub_total)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($sale->sale_grand_total)); ?>

    </td>
    <td class="team_col_position">
        <?php echo e(runtimeCheckBlank($sale->sold_on)); ?>

    </td>
    <td class="team_col_position">
    <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="<?php echo e(urlResource('/sales/'.$sale->sale_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_user'))); ?>"
                data-action-url="<?php echo e(urlResource('/sales/'.$sale->sale_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_user'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/sales/<?php echo e($sale->sale_id ?? ''); ?>">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/sales/components/table/ajax.blade.php ENDPATH**/ ?>