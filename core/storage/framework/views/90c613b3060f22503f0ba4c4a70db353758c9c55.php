<?php $__env->startSection('content'); ?>
<head>
</head>    
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0"><?php echo e(__('Create invoice')); ?></h3>
            <span class="form-text text-xs">Invoice charge is <?php echo e($set->invoice_charge); ?>%, & Its Charged when invoice is paid by client. </span>
          </div>
          <div class="card-body">
            <form action="<?php echo e(route('submit.invoice')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="form-group row">
                <label class="col-form-label col-lg-2"><?php echo e(__('Item Name')); ?><span class="text-danger">*</span></label>
                <div class="col-lg-4">
                  <input type="text" name="item_name" class="form-control" placeholder="" required>
                </div>
                <label class="col-form-label col-lg-2"><?php echo e(__('Invoice No')); ?><span class="text-danger">*</span></label>
                <div class="col-lg-4">
                  <div class="input-group">
                    <span class="input-group-prepend">
                      <span class="input-group-text">#</span>
                    </span>
                    <input type="number" name="invoice_no" class="form-control" placeholder="123456" required>
                  </div>
                </div>
              </div>               
              <div class="form-group row">
                <label class="col-form-label col-lg-2"><?php echo e(__('Quantity')); ?><span class="text-danger">*</span></label>
                <div class="col-lg-4">
                  <input type="number" name="quantity" class="form-control" value="1" required>
                </div>
                <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?><span class="text-danger">*</span></label>
                <div class="col-lg-4">
                  <div class="input-group">
                    <span class="input-group-prepend">
                      <span class="input-group-text"><?php echo e($currency->symbol); ?><span class="text-danger">*</span></span>
                    </span>
                    <input type="number" class="form-control" name="amount" required>
                    <span class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </span>
                  </div>
                </div>
              </div>                             
              <div class="form-group row">
                  <label class="col-form-label col-lg-2"><?php echo e(__('Customer Name')); ?><span class="text-danger">*</span></label>
                <div class="col-lg-4">
                  <input type="text" name="customer_name" class="form-control" placeholder="" maxlength="50" required>
                </div>
                <label class="col-form-label col-lg-2"><?php echo e(__('Customer Email')); ?></label>
                <div class="col-lg-4">
                  <input type="email" name="email" class="form-control" placeholder="" required>
                </div>
                
              </div>                              
              <div class="form-group row">
                  <label class="col-form-label col-lg-2" for="exampleDatepicke"><?php echo e(__('Due Date')); ?><span class="text-danger">*</span></label>
                <div class="col-lg-4">
                  <div class='input-group date'>
                    <span class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </span>
                    <input type="text" class="form-control datepicker" name="due_date" id='datetimepicker1' value="<?php echo e(Carbon\Carbon::now()); ?>" required>
                   
                  </div>
                </div>
                <label class="col-form-label col-lg-2"><?php echo e(__('Tax')); ?></label>
                <div class="col-lg-4">
                  <div class="input-group">
                    <input type="number" name="tax" step="any" class="form-control" value="0" placeholder="" >
                    <span class="input-group-append">
                      <span class="input-group-text">%</span>
                    </span>
                  </div>
                </div>
                
              </div>
              <div class="form-group row">
              <label class="col-form-label col-lg-2"><?php echo e(__('Discount')); ?></label>
                <div class="col-lg-4">
                  <div class="input-group">
                    <input type="number" name="discount" step="any" class="form-control" placeholder="" value="0">
                    <span class="input-group-append">
                        <span class="input-group-text">%</span>
                      </span>
                  </div>
                </div>
                </div>
              <div class="form-group row">
                <label class="col-form-label col-lg-2"><?php echo e(__('Notes')); ?></label>
                <div class="col-lg-10">
                  <div class="input-group">
                    <textarea type="text" class="form-control" rows="3" placeholder="Invoice note(Optional)"  name="notes"></textarea>
                  </div>
                </div>
              </div>             
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></a>
              </div>         
            </form>
          </div>
        </div>
        <!-- /basic layout -->
      </div>
    </div>
<?php $__env->stopSection(); ?>

   
<script type="text/javascript">


        </script>

<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/invoice/create.blade.php ENDPATH**/ ?>