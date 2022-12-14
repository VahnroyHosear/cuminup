<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Create Ticket')); ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('submit-ticket')); ?>" method="post" enctype="multipart/form-data" >
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Subject')); ?></label>
                            <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                <input type="text" name="subject" class="form-control" required="">
                                </div>
                            </div>
                        </div>                       
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Reference')); ?> </label>
                            <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                <input type="text" name="ref_no" class="form-control" placeholder="Transaction reference number">
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Priority')); ?></label>
                            <div class="col-lg-10">
                                <select class="form-control select" name="priority" required>
                                    <option  value="Low"><?php echo e(__('Low')); ?></option>
                                    <option  value="Medium"><?php echo e(__('Medium')); ?></option> 
                                    <option  value="High"><?php echo e(__('High')); ?></option>  
                                </select>
                            </div>
                        </div>                      
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Type')); ?></label>
                            <div class="col-lg-10">
                                <select class="form-control select" name="type" required>
                                    <option  value="Virtual Card"><?php echo e(__('Virtual Card')); ?></option>
                                    <option  value="Subscription"><?php echo e(__('Subscription')); ?></option>
                                    <option  value="Money Transfer"><?php echo e(__('Money Transfer')); ?></option> 
                                    <option  value="Request Money"><?php echo e(__('Request Money')); ?></option>  
                                    <option  value="Settlement"><?php echo e(__('Settlement')); ?></option>  
                                    <option  value="Store"><?php echo e(__('Store')); ?></option>  
                                    <option  value="Single Charge"><?php echo e(__('Single Charge')); ?></option>  
                                    <option  value="Donation"><?php echo e(__('Donation')); ?></option>  
                                    <option  value="Invoice"><?php echo e(__('Invoice')); ?></option>  
                                    <option  value="Charges"><?php echo e(__('Charges')); ?></option>  
                                    <option  value="Bank Transfer"><?php echo e(__('Bank transfer')); ?></option>  
                                    <option  value="Deposit"><?php echo e(__('Deposit')); ?></option>  
                                    <option  value="Others"><?php echo e(__('Others')); ?></option>  
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Details')); ?></label>
                            <div class="col-lg-10">
                                <textarea name="details" class="form-control" rows="6" required placeholder="Description"></textarea>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Select a file')); ?> <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileLang" name="image[]" multiple required>
                                    <label class="custom-file-label" for="customFileLang"><?php echo e(__('Choose Media')); ?></label>
                                    <small>Format supported: PDF, JPG, JPEG, PNG files,
Max Size: 10MB.</small>
                                </div> 
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/support/new.blade.php ENDPATH**/ ?>