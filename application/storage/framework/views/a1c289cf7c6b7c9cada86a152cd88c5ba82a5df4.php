<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Telecaller</th>
                    <th>Ongoing</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->first_name); ?></td>
                    <td><?php echo e($user->total); ?></td>
                    <td><input type="text" class="form-control form-control-sm " id="user_id" name="user_id<?php echo e($user->id); ?>"
                    value="" placeholder="Enter Number Of Leads To Be Assigned"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
       
    </div>
</div><?php /**PATH D:\xamppNew\htdocs\crm\application\resources\views/pages/appointments/modals/add-edit-inc.blade.php ENDPATH**/ ?>