<?php $__env->startSection('content'); ?>

<div class="main-content payment">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-5">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h4 class="form-text text-xl text-uppercase text-white">
              <?php echo e(__('Invoice id')); ?> #<?php echo e($invoice->invoice_no); ?>

              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-7">
        
          <div class="card card-profile bg-white border-0 mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($merchant->image); ?>" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col-8">
                      <a href="javascript:void;" onclick="window.print();" class="btn btn-sm btn-success"><i class="fa fa-print"></i> <?php echo e(__('Print')); ?></a>
                    </div>
                    <div class="col-4 text-right">
                      <?php if($invoice->status==1): ?>
                        <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo e(__('Paid')); ?></span>
                      <?php elseif($invoice->status==0): ?>
                        <span class="badge badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                    
                      <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <div class="my-4">
                    <span class="surtitle"><?php echo e(__('FROM')); ?> <?php echo e($invoice->user->email); ?></span><br>
                    <span class="surtitle "><?php echo e(__('TO')); ?> <?php echo e($invoice->customer_name); ?><?php echo e('('); ?><?php echo e($invoice->email); ?><?php echo e(')'); ?></span>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="my-4">
                    <span class="surtitle "><?php echo e(__('SENT ON')); ?> <?php echo e($invoice->sent_date); ?></span><br>
                    <span class="surtitle "><?php echo e(__('DUE DATE')); ?> <?php echo e($invoice->due_date); ?></span>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <div class="my-4">
                    <span class="surtitle "><?php echo e(__('INVOICE ITEM')); ?></span><br>
                    <span class="surtitle "><?php echo e(__('QUANTITY')); ?></span><br>
                    <span class="surtitle "><?php echo e(__('AMOUNT')); ?></span><br>
                    <?php if($invoice->notes!=null): ?>
                    <span class="surtitle "><?php echo e(__('NOTES')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="my-4">
                    <span class="surtitle "><?php echo e($invoice->item); ?></span><br>
                    <span class="surtitle "><?php echo e($invoice->quantity); ?></span><br>
                    <span class="surtitle "><?php echo e($currency->symbol.$invoice->amount); ?></span><br>
                    <?php if($invoice->notes!=null): ?>
                    <span class="surtitle "><?php echo e($invoice->notes); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <div class="my-4">
                    <span class="surtitle "><?php echo e(__('SUBTOTAL')); ?></span><br>
                    <span class="surtitle "><?php echo e(__('DISCOUNT')); ?></span></br>
                    <span class="surtitle "><?php echo e(__('TAX')); ?></span><br>
                     <span class="surtitle "><?php echo e(__('CHARGE')); ?></span>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="my-4">
                    <span class="surtitle "><?php echo e($currency->symbol.number_format($invoice->amount*$invoice->quantity,2)); ?></span><br>
                    <span class="surtitle ">- <?php echo e($currency->symbol.number_format($invoice->amount*$invoice->quantity*$invoice->discount/100)); ?> (<?php echo e($invoice->discount); ?>%)</span><br>
                    <span class="surtitle ">+ <?php echo e($currency->symbol); ?><?php echo e(($invoice->amount*$invoice->quantity*$invoice->tax/100)); ?> (<?php echo e($invoice->tax); ?>%)</span><br>
                    <span class="surtitle ">+ <?php echo e($currency->symbol); ?><?php echo e(($invoice->charge)); ?> (<?php echo e($set->invoice_charge); ?>%)</span>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <div class="my-4">
                    <span class="surtitle"><?php echo e(__('TOTAL')); ?></span>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="my-4">
                    <span class="surtitle "><?php echo e($currency->symbol.number_format($total+$invoice->charge,2)); ?></span>
                  </div>
                </div>
              </div>    
              <?php if($invoice->status==0): ?>   
              <form role="form" action="<?php echo e(route('process.invoice')); ?>" method="post" id="modal-details"> 
                <?php echo csrf_field(); ?>          
                <input type="hidden" value="<?php echo e($invoice->ref_id); ?>" name="link">
                <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="accordion" id="accordionExample">
                                                <h3 class="mb-0" style="padding: 15px;">Select a Payment Method <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>

                          <div class="card bg-white border-0 mb-0">
                            <!--Pay with Card-->
                            <div class="card-header" id="headingOne">
                              <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h4 class="mb-0">Card</h4>
                              </div>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                <form action="<?php echo e(route('process.invoice')); ?>" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($stripe->val1); ?>" id="payment-form">
                                  <?php echo csrf_field(); ?>
                                  <div class="form-group row">
                                    <div class="col-xs-12 col-md-12 form-group required">
                                      <input type="text" class="form-control input-lg custom-input" name="cardNumber" placeholder="*Debit/Credit Card Number" minlength="16" maxlength="16" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" autocomplete="off" required autofocus size="20"/>
                                    </div>                                  
                                    <div class="col-xs-12 col-md-12 form-group required">
                                      <input type="email" class="form-control input-lg custom-input" name="email" placeholder="*Email Address" autocomplete="off" required autofocus/>
                                    </div>
                                    <div class="col form-group required">
                                      <input type="text" class="form-control input-lg custom-input" name="first_name" placeholder="*First Name" autocomplete="off" required autofocus/>
                                    </div>                                  
                                    <div class="col form-group required">
                                      <input type="text" class="form-control input-lg custom-input" name="last_name" placeholder="*Last Name" autocomplete="off" required autofocus/>
                                    </div>
                                  </div> 
                                  <div class='form-group row'>
                                    <div class='col form-group cvc'>
                                      <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='*CVC' type='text' minlength="3" maxlength="3" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-month' name="cardM" placeholder='*MM' minlength="2" maxlength='2' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year' name="cardY" placeholder='*YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    </div>
                                  </div>			
                                  <input type="hidden" value="card" name="type">  	                
                                  <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Pay')); ?> <span id="cardresult"></span></button><br>
                                    <img src="<?php echo e(url('/')); ?>/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                                  </div>
                                  
                                </form>
                              </div>
                            </div>
                            <!--Account Balance-->
                            <hr>
                            <div class="card-header" id="headingTwo">
                                <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  <h4 class="mb-0">Pay with Account</h4>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body text-center">
                                <?php if(Auth::guard('user')->check()): ?>
                                  <form method="post" role="form" action="<?php echo e(route('process.invoice')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <h4 class="mb-0">Account Balance</h4>
                                    <h1 class="mb-1 text-muted"><?php echo e($currency->symbol.number_format($user->balance)); ?></h1>
                                    <input type="hidden" value="account" name="type">
                                    <input type="hidden" value="<?php echo e($invoice->ref_id); ?>" name="link">
                                    <div class="text-center">
                                      <button type="submit" onclick="second_modal()" class="btn btn-neutral btn-sm">Pay now</button>
                                    </div>
                                  </form>
                                <?php else: ?>
                                  <?php
                                    Session::put('oldLink', url()->current());
                                  ?>
                                  <h3 class="mb-3 text-muted">Login to Complete Transfer</h3>
                                  <a href="<?php echo e(route('login')); ?>" class="btn btn-neutral btn-sm">Login</a>
                                <?php endif; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" data-toggle="modal" data-target="#fund" class="btn btn-success my-4"><?php echo e(__('Pay')); ?></button>
                </div>
              </form>
              <?php endif; ?>  
              <div class="text-center">
                  <p class="paragraph small">If you have any questions, contact
                      <a href="mailto:<?php echo e($merchant->email); ?>"><?php echo e($merchant->email); ?></a>
                  </p>
              </div>
              <div class="text-center">
                <?php if($merchant->facebook!=null): ?>
                  <a href="<?php echo e($merchant->facebook); ?>"><i class="sn fab fa-facebook"></i></a>   
                <?php endif; ?> 
                <?php if($merchant->twitter!=null): ?>                      
                  <a href="<?php echo e($merchant->twitter); ?>"><i class="sn fab fa-twitter"></i></a>
                <?php endif; ?>      
                <?php if($merchant->linkedin!=null): ?>                     
                  <a href="<?php echo e($merchant->linkedin); ?>"><i class="sn fab fa-linkedin"></i></a> 
                <?php endif; ?>     
                <?php if($merchant->instagram!=null): ?>                        
                  <a href="<?php echo e($merchant->instagram); ?>"><i class="sn fab fa-instagram"></i></a>   
                <?php endif; ?> 
                <?php if($merchant->youtube!=null): ?>                          
                  <a href="<?php echo e($merchant->youtube); ?>"><i class="sn fab fa-youtube"></i></a>  
                <?php endif; ?>                          
              </div>     
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('paymentlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/invoice/view.blade.php ENDPATH**/ ?>