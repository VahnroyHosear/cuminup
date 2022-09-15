<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Request money')); ?></a>
              <!--a data-toggle="modal" data-target="#fund" href=""  class="btn btn-sm btn-success"><?php echo e(__('Topup Balance')); ?></a-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">   
        <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="accordion" id="accordionExample">
                  <div class="card bg-white border-0 mb-0">
                    <div class="card-header" id="headingOne">
                      <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="mb-0">Card</h4>
                      </div>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <form action="<?php echo e(route('card')); ?>" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($stripe->val1); ?>" id="payment-form">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <div class="col-xs-12 col-md-12 form-group required">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </div>
                                <input type="number" step="any" class="form-control" name="amount" id="cardamount" onkeyup="cardcharge()" placeholder="0.00" min="<?php echo e($stripe->minamo); ?>" required> 
                                <input type="hidden" value="<?php echo e($stripe->charge); ?>" id="charge"> 
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                            </div>
                            <div class="col form-group required">
                              <input type="number" class="form-control input-lg custom-input card-number" name="cardNumber" placeholder="Valid Card Number" min="16" autocomplete="off" required autofocus size="20"/>
                            </div>
                          </div> 
                          <div class='form-group row'>
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" required>
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-month' name="cardM" placeholder='MM' maxlength='2' type='text'>
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY' maxlength='4'type='text'>
                            </div>
                          </div>			  	                
                          <div class="text-center">
                            
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Pay')); ?> <span id="cardresult"></span></button><br>
                            <img src="<?php echo e(url('/')); ?>/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                          </div>
                          
                        </form>
                      </div>
                    </div>
                    <?php if($adminbank->status==1): ?>
                      <hr>
                      <div class="card-header" id="headingTwo">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="mb-0">Transfer</h4>
                          </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body text-center">
                          <h4 class="mb-0"><?php echo e($adminbank->bank_name); ?></h4>
                          <h1 class="mb-1 text-muted"><?php echo e($adminbank->acct_no); ?></h1>
                          <form method="post" action="<?php echo e(route('bank_transfersubmit')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                              <div class="col-lg-6 offset-lg-3">
                                <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                  </span>
                                  <input type="number" step="any" name="amount" max-length="10" class="form-control" required>
                                </div>
                              </div>
                            </div>
                            <div class="text-center">
                              <button type="submit" class="btn btn-neutral btn-sm">I'hv sent the money</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    <?php endif; ?>
                    <hr>
                    <div class="card-header" id="headingThree">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="mb-0">Crypto Currency</h4>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        <form method="post" action="<?php echo e(route('crypto')); ?>">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <div class="col-lg-8 offset-lg-2">
                              <div class="input-group">
                                <span class="input-group-prepend">
                                  <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </span>
                                <input type="number" step="any" name="amount" max-length="10" class="form-control" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-8 offset-lg-2">
                              <select class="form-control select" name="crypto" data-dropdown-css-class="bg-primary" data-fouc required>
                                  <option value='505'>Bitcoin</option>
                                  <option value='506'>Ethereum</option>
                              </select>
                            </div>
                          </div>          
                          <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Pay')); ?></button>
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
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Request money')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button-->
                    <span class="form-text text-xs">User must be a member of <?php echo e($set->site_name); ?>, Transfer charge is <?php echo e($set->transfer_charge); ?>% per transaction. Charge will be taken from money requested</span>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('submit.request')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Email')); ?></label>
                          <div class="col-lg-10">
                              <input type="email" name="email" class="form-control"  required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?></label>
                          <div class="col-lg-10">
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                              </span>
                              <input type="text" maxlength="10" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="amount" id="amount" required>
                              <span class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </span>
                            </div>
                          </div>
                        </div>                   
                        <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Request money')); ?></button>
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
        <?php if(count($request)>0): ?>
          
          <div class="card">
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Ref No')); ?></th>
              
              <th><?php echo e(__('Email')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Charge')); ?></th>
               <th><?php echo e(__('Status')); ?></th>
                <th><?php echo e(__('Action')); ?></th>
             <th><?php echo e(__('Date')); ?></th>
             
             
            </tr>
          </thead>
          <tbody> 
          <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
             
                <td><?php echo e(++$k); ?></td>
                <td>#<?php echo e($val->ref_id); ?></td>
               
                <td><?php if($val->user_id==$user->id): ?>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('To')); ?>:<?php echo e($val->email); ?></p>
                        <?php else: ?>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('From')); ?>: <?php echo e($val->receiver['email']); ?></p>
                        <?php endif; ?></td>
                <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
                <td><?php if($val->status==1): ?>
                          
                          <span class="badge badge-pill badge-primary">Charge: <?php echo e($currency->symbol.number_format($val->charge,2)); ?></span>
                          
                    <?php endif; ?>      
                    </td>
               <td><?php if($val->status==1): ?>
                          
                          <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> <?php echo e(__('Confirmed')); ?></span>
                        <?php elseif($val->status==0): ?>
                          <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>  
                         <?php else: ?>
                         <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Rejected')); ?></span>  
                        <?php endif; ?></td>
                <td><?php if($val->user_id==$user->id): ?>
                        <?php echo e(__('NA')); ?>

                        <?php else: ?>
                        <?php if($val->status != 2 && $val->status!=1 && $val->user_id != $user->id): ?>
                        <a href="<?php echo e(url('user/send_money')); ?>/<?php echo e($val->confirm); ?>" class="btn btn-sm btn-success"><?php echo e(__('Pay')); ?></a>
                        <a href="<?php echo e(url('user/reject_money')); ?>/<?php echo e($val->confirm); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Reject')); ?></a>
                        <?php else: ?>
                        <?php echo e(__('NA')); ?>

                        <?php endif; ?>
                        <?php endif; ?></td>        
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
               
               
            
            </tr>  
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          </table>
          <?php else: ?>
            <center><div class="col-md-12">
                
             <br>
              
              <p class="text-center text-muted card-text mt-8"><?php echo e(__('No Request History Found!')); ?></p>
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Start Requesting Money')); ?></a>
              <p class="text-center text-muted card-text mt-8"></p>
              <br>
         
        </div> </center>
         <?php endif; ?>
       
      </div> 
      
     </div>
     </div>
     </div>
     </div>
     <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                <?php echo e(__('Statistics')); ?>

                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> <?php echo e(__('Received')); ?></span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($sent)); ?>.00</span><br>
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
      </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/transfer/request.blade.php ENDPATH**/ ?>