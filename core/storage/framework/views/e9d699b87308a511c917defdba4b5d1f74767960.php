<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Merchant Logs')); ?></h3>
      </div>
      <?php if(count($ext) > 0): ?>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Name')); ?></th>
              <th><?php echo e(__('From')); ?></th>
              <th><?php echo e(__('IP Address')); ?></th>
              <th><?php echo e(__('Type')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Charge')); ?></th>
              <th><?php echo e(__('Reference ID')); ?></th>
              <th><?php echo e(__('Payment Type')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
              <th><?php echo e(__('updated')); ?></th>
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $ext; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $fff=App\Models\Merchant::wheremerchant_key($val->merchant_key)->first();
            ?>
              <tr>
                <td><?php echo e(++$k); ?>.</td>
                <td><?php echo e($fff->name); ?></td>
                <td><?php if($val->user_id!=null): ?> <?php echo e($val->sender->first_name.' '.$val->sender->last_name); ?> [<?php echo e($val->sender->email); ?>] <?php else: ?> <?php echo e($val->first_name.' '.$val->last_name); ?> [<?php echo e($val->email); ?>] <?php endif; ?></td>
                <td><?php echo e($val->ip_address); ?></td>
                <td><?php if($val->sender_id==$user->id): ?> Paid <?php else: ?> Received <?php endif; ?></td>
                <td><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></td>
                <td><?php echo e($currency->symbol.$val->amount); ?></td>
                <td><?php if($val->user_id==$user->id || $val->charge==null): ?> - <?php else: ?> <?php echo e($currency->symbol.$val->charge); ?> <?php endif; ?></td>
                <td><?php echo e($val->reference); ?></td>
                <td><?php echo e($val->payment_type); ?> <?php if($val->payment_type=='card'): ?> - XXXX XXXX XXXX <?php echo e(substr($val->card_number, 12)); ?> <?php endif; ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
       <?php else: ?>
      <center>
           <div class="col-lg-12">
              <br>
                <p class="text-center card-text mt-5"><?php echo e(__('No transaction Found!')); ?></p>
               <!--h3><?php echo e(__('Let’s Create your first transaction')); ?></h3>
             <a href="<?php echo e(url('user/invoice')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a-->
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
            
          </div></center>
      <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/transactions/transaction.blade.php ENDPATH**/ ?>