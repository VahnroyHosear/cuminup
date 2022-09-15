<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Deposit logs')); ?></h3>
      </div>
      <?php if(count($deposits) > 0): ?>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead class="">
            <tr>
              <th><?php echo e(__('S/N')); ?></th>
              <th><?php echo e(__('Reference ID')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Charge')); ?></th>
               <th><?php echo e(__('Total')); ?></th>
              <th><?php echo e(__('Method')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Date')); ?></th>
             
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e(++$k); ?>.</td>
                <td>#<?php echo e($val->trx); ?></td>
                <td><?php echo e($currency->symbol.number_format($val->amount-$val->charge,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
                <td><?php echo $val->gateway['name']; ?></td>
                <td><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></td>
              
                <td>
                     <?php 
                     
                    // $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
                    // dd($query);
                   // date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime($val->created_at, new DateTimeZone('Asia/Kolkata'));
//echo $date->format('Y-m-d H:i:sP') . "\n";

$date->setTimezone(new DateTimeZone('Asia/Kolkata'));
//echo $date->format('Y-m-d H:i:sP') . "\n";
 ?>
                 <?php echo e(date('Y/m/d h:i:A', strtotime($val->created_at))); ?></td>
               
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <?php else: ?>
      <center>
           <div class="col-lg-12">
              <br>
                <p class="text-center card-text mt-8"><?php echo e(__('No deposit log Found!')); ?></p>
               <h3><?php echo e(__('Let’s Create your first deposit log')); ?></h3>
             <a href="<?php echo e(url('user/transfer')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
            
          </div></center>
      <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/transactions/deposit_log.blade.php ENDPATH**/ ?>