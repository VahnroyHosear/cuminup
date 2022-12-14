<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Subscriptions List')); ?></h3>
      </div>
      <?php if(count($sub) > 0): ?>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Plan')); ?></th>
              <th><?php echo e(__('Reference ID')); ?></th>
              <th><?php echo e(__('Expiring Date')); ?></th>
              <th><?php echo e(__('Renewal')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e(++$k); ?>.</td>
                <td><?php if($val->plan['amount']==null): ?><?php echo e($currency->symbol.$val->amount); ?> <?php else: ?> <?php echo e($currency->symbol.$val->plan['amount']); ?> <?php endif; ?></td>
                <td><?php echo e($val->plan['name']); ?></td>
                <td>#<?php echo e($val->ref_id); ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->expiring_date))); ?></td>
                <td><?php if($val->times>0 && $val->status==1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <?php else: ?>
       <center><div class="col-md-12">
              <br>
                <p class="text-center card-text mt-5"><?php echo e(__('No subscriptions found!')); ?></p>
               
              <!--a data-toggle="modal" data-target="#single-charge" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a-->
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
          </div></center>
      <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/plans/subscription.blade.php ENDPATH**/ ?>