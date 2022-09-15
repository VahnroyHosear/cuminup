<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <?php if(count($invoice)>0): ?> 
                <a href="<?php echo e(route('user.add-invoice')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Create invoice')); ?></a> 
              <?php else: ?>
                <a href="<?php echo e(route('user.add-invoice')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Create Your First Invoice')); ?></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">  
      <div class="col-md-12">
        <div class="row"> 
          <?php if(count($invoice)>0): ?> 
        <div class="card">
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Payment URL')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Product Type')); ?></th>
              <th><?php echo e(__('Name')); ?></th>
               <th><?php echo e(__('Email')); ?></th>
              <th><?php echo e(__('Price')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
              <th><?php echo e(__('Action')); ?></th> 
             
            </tr>
          </thead>
          <tbody>  
           <?php $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$k); ?></td>
                <td><a class="btn-icon-clipboard text-primary" data-clipboard-text="<?php echo e(route('view.invoice', ['id' => $val->ref_id])); ?>" title="Copy"><?php echo e(__('Copy URL')); ?></a></td>
                <td> <?php if($val->status==1): ?>
                          
                          <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> <?php echo e(__('Paid')); ?></span>
                          <span class="badge badge-pill badge-primary"><?php echo e(__('Charge')); ?>: <?php echo e($currency->symbol.number_format($val->charge,2)); ?></span>
                        <?php elseif($val->status==0): ?>
                          <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                    
                        <?php endif; ?>
                            </td>
                <td><?php echo e($val->item); ?></td>
                 <td><?php echo e($val->customer_name); ?></td>
                  <td><?php echo e($val->email); ?></td>
                <td><?php if($val->total==null): ?> Not fixed <?php else: ?> <?php echo e($currency->symbol.number_format($val->total,2)); ?> <?php endif; ?></td>
                <td><?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></td>
               <?php if($val->status==0): ?> <td>
                        <a data-toggle="modal" data-target="#modal-formx<?php echo e($val->id); ?>" class="btn btn-sm btn-primary" href="javascript:void;" title="Edit Amount"><i class="fa fa-pencil"></i> <?php echo e(__('Edit')); ?></a>
                        <a href="<?php echo e(route('reminder.invoice', ['id' => $val->id])); ?>" class="btn btn-sm btn-neutral" title="Send Reminder"><i class="fa fa-clock-o"></i> <?php echo e(__('Resend')); ?></a>
                        <a href="<?php echo e(route('paid.invoice', ['id' => $val->id])); ?>" class="btn btn-sm btn-success" title="Mark as paid"><i class="fa fa-check"></i> <?php echo e(__('Mark as Paid')); ?></a>
                       
                        <!--a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a--></td> <?php else: ?> <td><?php echo e(__('NA')); ?></td> <?php endif; ?>
            </tr> 
            
              <div class="modal fade" id="modal-formx<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0"><?php echo e(__('Edit Invoice')); ?></h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="<?php echo e(route('update.invoice')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                  </div>
                                  <input type="hidden" name="id" value="<?php echo e($val->id); ?>"> 
                                  <input type="number" step="any" name="amount" value="<?php echo e($val->amount); ?>" class="form-control" required="">
                                </div>
                              </div>
                            </div>                       
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Quantity')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="quantity" value="<?php echo e($val->quantity); ?>" class="form-control" required="">
                                </div>
                              </div>
                            </div>                        
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Tax')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="tax" maxlength="10" value="<?php echo e($val->tax); ?>" class="form-control">
                                  <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                  </span>
                                </div>
                              </div>
                            </div>                      
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Discount')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="discount" maxlength="10" value="<?php echo e($val->discount); ?>" class="form-control">
                                  <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                  </span>
                                </div>
                              </div>
                            </div>                           
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2" for="exampleDatepicker"><?php echo e(__('Due Date')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                  </span>
                                  <input type="text" class="form-control datepicker" name="due_date" value="<?php echo e($val->due_date); ?>" required>
                                </div>
                              </div>
                            </div>                
                            <div class="text-right">
                              <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-header">
                                      <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this invoice will also be deleted')); ?></span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                      <a  href="<?php echo e(route('delete.invoice', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
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
            <p style="background: #fff; padding: 10px; border-radius: 7px;">Let’s Create your first Invoice!.</p>
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col" style="text-align:center">
                    <img src="<?php echo e(url('asset/profile/nodata.png')); ?>" width="30%">
                  </div>
                 
                </div>
                
              </div>
            </div>
          </div-->
          <center><div class="col-md-12">
              <br>
             
                <p class="text-center card-text mt-4"><?php echo e(__('Send a customisable invoice to your customers in a few clicks, We will email them link to quickly and securely pay online.')); ?></p>
               <h3><?php echo e(__('Let’s Create your first Invoice')); ?></h3>
              <a href="<?php echo e(url('user/add-invoice')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
            
          </div></center>
          <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-md-12">
          <?php echo e($invoice->links()); ?>

          </div>
        </div>
      </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                <?php echo e(__('Statistics')); ?>

                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> <?php echo e(__('Received')); ?></span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($received)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle"><?php echo e(__('Pending')); ?></span><br>
                  <span class="surtitle "><?php echo e(__('Total')); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($pending)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div> 
        <?php $__currentLoopData = $paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->email); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Total')); ?>: <?php echo e($currency->symbol.number_format($val->total)); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Due date')); ?>: <?php echo e(date("h:i:A j, M Y", strtotime($val->due_date))); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Payment link')); ?> <button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(url('/')); ?>/user/view-invoice/<?php echo e($val->ref_id); ?>" title="Copy"><i class="fa fa-copy"></i></button></p>
                  <?php if($val->status==1): ?>
                    <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo e(__('Paid')); ?></span>
                  <?php elseif($val->status==0): ?>
                    <span class="badge badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                    
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/invoice/index.blade.php ENDPATH**/ ?>