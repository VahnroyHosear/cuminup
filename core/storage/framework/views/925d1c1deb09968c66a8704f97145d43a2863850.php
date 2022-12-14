<?php $__env->startSection('content'); ?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

</head>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#single-charge" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Single Charge')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="single-charge" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Create New Payment Link')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Single Charge allows you to create payment links for your customers, Transaction Charge is <?php echo e($set->single_charge); ?>% per transaction</span>

                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('submit.singlecharge')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Payment link name')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                        </span>
                                        <input type="number" class="form-control" name="amount" placeholder="0.00" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </span>
                                    </div>
                                    <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                </div>
                            </div>  
                        </div>  
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Description')); ?><span class="text-danger">*</span></label>
                          <input type="text" name="test_234" id="descript_input" style="visibility: hidden;" required>
                           <br><span id="description_error" style="color:red;margin-left:15px;"></span>
                          <div class="col-lg-12">
                              <textarea type="text" name="description" rows="4" class="tinymce form-control" id="description_id"></textarea>
                          </div>
                        </div>   
                        <hr>             
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Redirect after payment  - Optional')); ?></label>
                          <div class="col-lg-12">
                              <input type="text" name="redirect_url" class="form-control" placeholder="https://google.com" >
                          </div>
                        </div> 
                        <div class="text-center">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details" id="submit_btn_id" onclick="CheckForm()"><?php echo e(__('Create link')); ?></button>
                        </div>         
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>         
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">  
          <?php if(count($links)>0): ?>
            
             <div class="card">
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Payment URL')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Product Type')); ?></th>
              <th><?php echo e(__('Price')); ?></th>
              <th><?php echo e(__('Date')); ?></th>
             <!--th><?php echo e(__('Updated')); ?></th-->
             <th><?php echo e(__('Action')); ?></th>
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$k); ?></td>
                <td><a class="btn-icon-clipboard text-primary" data-clipboard-text="<?php echo e(route('scview.link', ['id' => $val->ref_id])); ?>" title="Copy"><?php echo e(route('scview.link', ['id' => $val->ref_id])); ?></a></td>
                <td> <?php if($val->active==1): ?>
                                <span class='badge badge-pill badge-success' ><?php echo e(__('Activate')); ?></span>
                            <?php else: ?>
                                <span class='badge badge-pill badge-danger' ><?php echo e(__('Disable')); ?></span>
                            <?php endif; ?>
                            </td>
                <td><?php echo e($val->name); ?></td>
                <td><?php if($val->amount==null): ?> Not fixed <?php else: ?> <?php echo e($currency->symbol.number_format($val->amount,2)); ?> <?php endif; ?></td>
                <td><?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></td>
                <!--td><?php echo e(date("h:i:A j, M Y", strtotime($val->updated_at))); ?></td-->
               <td>      <button type="button" class="btn btn-sm btn-neutral mr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-left">
                            <?php if($val->active==1): ?>
                                <a class='dropdown-item' href="<?php echo e(route('sclinks.unpublish', ['id' => $val->id])); ?>"><?php echo e(__('Disable')); ?></a>
                            <?php else: ?>
                                <a class='dropdown-item' href="<?php echo e(route('sclinks.publish', ['id' => $val->id])); ?>"><?php echo e(__('Activate')); ?></a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo e(route('user.sclinkstrans', ['id' => $val->id])); ?>"><?php echo e(__('Transactions')); ?></a>
                           
                            <a class="dropdown-item" data-toggle="modal" data-target="#edit<?php echo e($val->id); ?>" href="#"><?php echo e(__('Edit')); ?></a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href=""><?php echo e(__('Delete')); ?></a>
                          </div></td>
            </tr>    
            <div class="modal fade" id="edit<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0"><?php echo e(__('Edit Payment Link')); ?></h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="<?php echo e(route('update.sclinks')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                              <div class="col-lg-6">
                                  <label class="col-form-label col-lg-12"><?php echo e(__('Payment link name')); ?><span class="text-danger">*</span></label>
                                  <div class="col-lg-12">
                                      <input type="text" name="name" class="form-control" value="<?php echo e($val->name); ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                                  <div class="col-lg-12">
                                      <div class="input-group">
                                          <span class="input-group-prepend">
                                              <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                          </span>
                                          <input type="number" class="form-control" name="amount" value="<?php echo e($val->amount); ?>" placeholder="0.00">
                                          <span class="input-group-append">
                                              <span class="input-group-text">.00</span>
                                          </span>
                                      </div>
                                      <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                  </div>
                              </div>  
                            </div>  
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12"><?php echo e(__('Description')); ?><span class="text-danger">*</span></label>
                             
                              <div class="col-lg-12">
                                  <textarea type="text" name="description" rows="4" class="form-control tinymce"><?php echo e($val->description); ?></textarea>
                              </div>
                            </div>   
                            <hr>             
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12"><?php echo e(__('Redirect after payment  - Optional')); ?></label>
                              <div class="col-lg-12">
                                  <input type="text" name="redirect_url" class="form-control" value="<?php echo e($val->redirect_link); ?>" placeholder="https://google.com" >
                              </div>
                            </div>  
                            <input type="hidden" name="id" value="<?php echo e($val->id); ?>">                                     
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
                                      <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this payment link will also be deleted')); ?></span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                      <a  href="<?php echo e(route('delete.user.link', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
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
          <?php else: ?>
          <center><div class="col-md-12">
              <br>
                <p class="text-center card-text mt-8"><?php echo e(__('No payment url found!')); ?></p>
               <h3><?php echo e(__('Create your first payment url')); ?></h3>
              <a data-toggle="modal" data-target="#single-charge" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
          </div></center>
         
          <?php endif; ?>
        </div> 
        <div class="row">
          <div class="col-md-12">
          <?php echo e($links->links()); ?>

          </div>
        </div>
      </div> 
    </div>
<?php $__env->stopSection(); ?>

<script>
  function CheckForm()
{
    if(tinyMCE.get('description_id').getContent().length == 0)
    {
        $('#description_error').html('Required field missing!');
        $("#descript_input").val('');
        //$("#submit_btn_id").attr("disabled", true);
        //$('#submit_btn_id').prop('');
    } else {
        $("#descript_input").val('1');
        $('#description_error').html('');
    }
    
}

</script>

<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/link/sc.blade.php ENDPATH**/ ?>