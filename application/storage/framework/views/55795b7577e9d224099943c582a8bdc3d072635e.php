<div class="card" id="team-table-wrapper" id="team-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(!$appointmenttype->isEmpty()): ?>
            <table id="team-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <th class="team_col_first_name"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_first_name" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/team?action=sort&orderby=first_name&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.name'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <th class="team_col_position"><a class="js-ajax-ux-request js-list-sorting" id="sort_position"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/team?action=sort&orderby=position&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.created'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="team_col_role"><a class="js-ajax-ux-request js-list-sorting" id="sort_role_id"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/team?action=sort&orderby=role_id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        
                        <th class="team_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a>
                        </th>
                    </tr>
                </thead>
                <tbody id="appointmenttype-view-wrapper">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.appointmenttype.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php else: ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/appointmenttype/components/table/table.blade.php ENDPATH**/ ?>