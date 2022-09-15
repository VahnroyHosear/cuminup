<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="text-right">
              <a href="<?php echo e(route('open.ticket')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Create Ticket')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="row">
      <?php if(count($ticket)>0): ?>
       <div class="card">
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Ticket ID')); ?></th>
               <th><?php echo e(__('Ticket For')); ?></th>
              <th><?php echo e(__('Subject')); ?></th>
              <th><?php echo e(__('Trx Ref')); ?></th>
              <th><?php echo e(__('Priority')); ?></th>
               <th><?php echo e(__('Status')); ?></th>
             <th><?php echo e(__('Created')); ?></th>
              <!--th><?php echo e(__('Updated')); ?></th-->
              <th><?php echo e(__('Action')); ?></th>
             
            </tr>
          </thead>
          <tbody>  
        <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <td><?php echo e(++$k); ?></td>
                <td><?php echo e($val->ticket_id); ?></td>
                 <td><?php echo e($val->type); ?></td>
                <td><?php echo e($val->subject); ?></td>
                <td><?php if($val->ref_no==null): ?><?php echo e(__('Not submitted')); ?> <?php else: ?> <?php echo e($val->ref_no); ?> <?php endif; ?></td>
                <td><?php echo e($val->priority); ?></td>
                <td> <?php if($val->status==0): ?> <span class="badge badge-pill badge-success"><?php echo e(__('Open')); ?></span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-danger"><?php echo e(__('Closed')); ?></span> <?php elseif($val->status==2): ?> <span class="badge badge-pill badge-warning"><?php echo e(__('Resolved')); ?></span> <?php endif; ?>
                            </td>
               <td><?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></td>
                <!--td><?php echo e(date("h:i:A j, M Y", strtotime($val->updated_at))); ?></td-->
                <td><a href="<?php echo e(url('/')); ?>/user/reply-ticket/<?php echo e($val->id); ?>" class="btn btn-sm btn-neutral"><?php echo e(__('Reply')); ?></a>
                      <!--a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></a--></td>
            </tr>     
          <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-body p-0">
                          <div class="card bg-white border-0 mb-0">
                              <div class="card-header">
                                  <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this will also be deleted')); ?></span>
                              </div>
                              <div class="card-body px-lg-5 py-lg-5 text-right">
                                  <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                  <a  href="<?php echo e(route('ticket.delete', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
      <?php else: ?>
      <!--div class="col-md-12">
        <p class="text-center text-muted card-text mt-8">No Support Ticket Found</p>
        <center><img src="<?php echo e(url('/')); ?>/asset/profile/nodata.png" width="30%"></center>
      </div-->
       <center>
           <div class="col-lg-12">
              <br>
                <p class="text-center card-text mt-8"><?php echo e(__('No Support Ticket Found!')); ?></p>
               <h3><?php echo e(__('Let’s Create your first support ticket')); ?></h3>
             <a href="<?php echo e(route('open.ticket')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
            
          </div></center>
      <?php endif; ?>
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/support/index.blade.php ENDPATH**/ ?>