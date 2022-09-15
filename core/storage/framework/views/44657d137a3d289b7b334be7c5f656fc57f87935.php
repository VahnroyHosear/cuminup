<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Bank Accounts')); ?></h3>
        <a style="float:right;margin-top:30px!important;margin-right:20px" data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Add account')); ?></a>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Bank')); ?></th>
              <th><?php echo e(__('Name')); ?></th>
              <th><?php echo e(__('Type')); ?></th>
              <th><?php echo e(__('Account No.')); ?></th>
              <th><?php echo e(__('ABA Routing')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
              <th><?php echo e(__('Action')); ?></th>
            </tr>
          </thead>
          <tbody>  
                <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($val->acct_no)): ?>
                        <tr>
                            <td><?php echo e(++$k); ?>.</td>
                            <td><?php echo e($val->name); ?></td>
                            <td><?php echo e($val->acct_name); ?></td>
                            <td>
                                <?php if($val->status==0): ?>
                                    <a href="<?php echo e(route('bank.default', ['id' => $val->id])); ?>" class="badge badge-pill badge-danger"><?php echo e(__('Make Default')); ?></a>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-success"><?php echo e(__('Default')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($val->acct_no); ?></td>
                            <td><?php echo e($val->swift); ?></td>
                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                            <td style="display: flex;">
                                        <a data-toggle="modal" data-target="#verify-form<?php echo e($val->id); ?>" href="#" class="btn btn-sm btn-neutral"><?php echo e(__('Verify')); ?></a>
                                        <!--<a data-toggle="modal" data-target="#modal-form<?php echo e($val->id); ?>"href="#" class="btn btn-sm btn-neutral"><?php echo e(__('Edit')); ?></a>-->
                                          
                                        <?php if($val['lithic_status'] == 'DELETED'): ?>
                                            <a class="btn btn-sm btn-warning"><?php echo e(__('Disabled')); ?></a>
                                        <?php else: ?>
                                            <form action="<?php echo e(url('user/delete_bank')); ?>" method="post">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('put')); ?>

                                                <input type="hidden" name="id" value="<?php echo e($val['id']); ?>">
                                                <input type="hidden" name="state" value="DELETED">
                                                <button type="submit" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></button>
                                            </form>
                                        <?php endif; ?>
                    
                                    </div>
                                </div>
                            </td> 
                        </tr>
                    <?php endif; ?>
                    
                    <div class="modal fade" id="modal-form<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card border-0 mb-0">
                                <div class="card-header">
                                  <h3 class="mb-0"><?php echo e(__('Edit Bank')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                                </div>
                                <div class="card-body">
                                  <form role="form" action="<?php echo e(url('user/edit_bank')); ?>" method="post"> 
                                  <?php echo csrf_field(); ?>
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2"><?php echo e(__('Bank')); ?></label>
                                        <div class="col-lg-10">
                                          <input type="text" name="name" placeholder="Bank name" class="form-control" value="<?php echo e($val['name']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2"><?php echo e(__('Acct Name')); ?></label>
                                          <div class="col-lg-10">
                                        <input type="text" name="acct_name" placeholder="Account name" class="form-control" value="<?php echo e($val['acct_name']); ?>">
                                      </div>
                                    </div>                           
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2"><?php echo e(__('Account No')); ?></label>
                                          <div class="col-lg-10">
                                        <input type="number" name="acct_no" placeholder="Account number" class="form-control" value="<?php echo e($val['acct_no']); ?>">
                                        <input type="hidden" name="id" value="<?php echo e($val['id']); ?>">
                                      </div>
                                    </div>                    
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2"><?php echo e(__('Swift')); ?></label>
                                          <div class="col-lg-10">
                                        <input type="text" name="swift" placeholder="Swift code" class="form-control" value="<?php echo e($val['swift']); ?>">
                                        <input type="hidden" name="id" value="<?php echo e($val['id']); ?>">
                                      </div>
                                    </div>
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Update Acount')); ?></button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                      
                    <div class="modal fade" id="verify-form<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card border-0 mb-0">
                                <div class="card-header">
                                  <h3 class="mb-0"><?php echo e(__('Validate Bank')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                                </div>
                                <div class="card-body">
                                  <form role="form" action="<?php echo e(url('user/verify_bank')); ?>" method="post"> 
                                  <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($val['id']); ?>">
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2"><?php echo e(__('Amount 1')); ?></label>
                                        <div class="col-lg-10">
                                          <input type="text" name="amount1" placeholder="Amount 1" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2"><?php echo e(__('Amount 2')); ?></label>
                                          <div class="col-lg-10">
                                        <input type="text" name="amount2" placeholder="Amount 2" class="form-control" required>
                                      </div>
                                    </div>  
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Validate Bank')); ?></button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card border-0 mb-0">
                                <div class="card-header">
                                  <h3 class="mb-0"><?php echo e(__('Add Account')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                                </div>
                                <div class="card-body">
                                  <form role="form" action="<?php echo e(url('user/add_bank')); ?>" method="post"> 
                                  <?php echo csrf_field(); ?>
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2"><?php echo e(__('Bank')); ?></label>
                                      <div class="col-lg-10">
                                        <input type="text" name="name" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2"><?php echo e(__('Acct Name')); ?></label>
                                      <div class="col-lg-10">
                                        <input type="text" name="acct_name" class="form-control" required>
                                      </div>
                                    </div>                                                                      
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2"><?php echo e(__('Account No')); ?></label>
                                      <div class="col-lg-10">
                                        <input type="number" name="acct_no" class="form-control" required>
                                      </div>
                                    </div>                        
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2"><?php echo e(__('ABA Routing #')); ?></label>
                                      <div class="col-lg-10">
                                        <input type="text" name="swift" class="form-control" required>
                                      </div>
                                    </div>
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
      
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/bank/index.blade.php ENDPATH**/ ?>