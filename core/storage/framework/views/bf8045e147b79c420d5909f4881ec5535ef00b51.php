<head>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

  
    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>  
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php $__env->startSection('content'); ?>
<?php
$paypalGatewayDetails = DB::table('gateways')->where('id',507)->first();

?>
<head>
       <style>
.overlay_2{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("https://ewallet.xpay.mv/public/uploads/banner/Ajax_loader.gif") center no-repeat;
        border-radius: 15px;
    }
   
    body.loading{
        overflow: hidden;   
    }
    
    body.loading .overlay_2{
        display: block;
    }

</style>
</head>
<div class="overlay_2" id="overlay_2"></div>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <!--a data-toggle="modal" data-target="#modal-formx" href="#" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Send money')); ?></a-->
              <button data-toggle="modal" data-target="#fund"   class="btn btn-sm btn-success"><?php echo e(__('Load Fund to Your Account')); ?></button>
            </div>
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
                    <h3 class="mb-0" style="padding: 15px;">Select a Payment Method <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    
                  <div class="card bg-white border-0 mb-0">
                    <div class="card-header" id="headingOne">
                      <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="row">
                        <div class="col-sm-2"><!--i class="fa fa-credit-card-alt fa-2x" aria-hidden="true" style="color:blue"></i-->
                        <img src="<?php echo e(url('/')); ?>/asset/images/visa_1.png" width="100%">
                        </div>      
                        <div class="col-sm-9">
                           
                             <h3 class="mb-0">Visa/Mastercard</h3>
                            <!--h4 class="mb-0">Instant small amounts</h4>
                            <span style="font-size:0.8rem">Use any Visa or Mastercard Debit/Credit card  to make a small investments.</span-->
                           
                        </div>
                    </div>    
                      </div>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                        <div>    
                       
                           <!--span>Card Details</span-->
                           
                           
                         <div class="form-group row">
                            <div class="col-xs-12 col-md-12 form-group required">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </div>
                                <input type="text" step="any" class="form-control" name="amount" id="cardamount" onchange="cardcharge()" maxlength="10" placeholder="0.00" max="<?php echo e($stripe->maxamo); ?>" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"> 
                                <input type="hidden" value="<?php echo e($stripe->charge); ?>" id="charge"> 
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                              <span id="cardamount_error" style="color:red"></span>
                               <span>Recommended Amount </span>
                              <br>
                             
                              <center>&nbsp;<span class="badge badge-pill badge-default formItem" style="font-size:14px;cursor:pointer" onclick="recommendedAmount(this.id)" id="100"><?php echo e($currency->symbol); ?><?php echo e(number_format(100)); ?></span> &nbsp; <span class="badge badge-pill badge-default formItem" style="font-size:14px;cursor:pointer" onclick="recommendedAmount(this.id)" id="200"><?php echo e($currency->symbol); ?><?php echo e(number_format(200)); ?></span> &nbsp; <span class="badge badge-pill badge-default" style="font-size:14px;cursor:pointer" onclick="recommendedAmount(this.id)" id="300"><?php echo e($currency->symbol); ?><?php echo e(number_format(300)); ?></span><br><br><span class="badge badge-pill badge-default" style="font-size:14px;cursor:pointer" onclick="recommendedAmount(this.id)" id="500"><?php echo e($currency->symbol); ?><?php echo e(number_format(500,)); ?></span> &nbsp;<span class="badge badge-pill badge-default" style="font-size:14px;cursor:pointer" onclick="recommendedAmount(this.id)" id="700"><?php echo e($currency->symbol); ?><?php echo e(number_format(700,)); ?></span> &nbsp; <span class="badge badge-pill badge-default" style="font-size:14px;cursor:pointer" onclick="recommendedAmount(this.id)" id="1000"><?php echo e($currency->symbol); ?><?php echo e(number_format(1000,)); ?></span>
                              </center>
                              </br>
                             
                             
                              <center><small>Transaction Fees(%): <?php echo e($currency->symbol); ?><span id="cardresult">0.00</span></small></center>
                            </div>
                           
                          </div>
                          <center> <div class="text-center">
                            <button type="button" class="btn btn-success" id="next_button_id" onclick="checkWalletLimit()"><?php echo e(__('Proceed')); ?>   </button><br>
                            <!--img src="<?php echo e(url('/')); ?>/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;"-->
                          </div></center>
                          
                         </div> 
                         
                         <div id="2ndStep" style="display:none"> 
<span id="payment_msg" style="color:green"></span>

        

      <div id="messages" role="alert" style="display: none;"></div>
      <br>
                         <?php if(!empty($list_saved_cards)): ?>
                     <form action="<?php echo e(route('recollect_cvc')); ?>" method="POST" id="cvc_form_id">
                        <?php echo csrf_field(); ?>
                         <span><?php echo e(__('Your saved cards')); ?></span>
                        <table class="table table-striped" >
                            &nbsp;&nbsp;
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Card Type')); ?></th>
                                <th><?php echo e(__('Last 4 Digit')); ?></th>
                                <th><?php echo e(__('Expire')); ?></th>
                            </tr>
                        <tbody> 
                       
                       
                        <?php $__currentLoopData = $list_saved_cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr>
                             <span id="cvv_error" style="color:red"></span>
                        <td>
                            <input type="radio"  name="payment_method" style="-webkit-appearance: auto;" onclick="radioValueFunction(this.value)" value="<?php echo e($cardDetails->id); ?>" id="<?php echo e($cardDetails->id); ?>">
                        &nbsp;&nbsp;
                        <input type="text" name="recollect_cvc<?php echo e($cardDetails->id); ?>" size="6" class="cvc_class" Placeholder="CVC" id="cvv_input_<?php echo e($cardDetails->id); ?>" style="display:none;" >
                       
                        </td>
                        <td><?php echo e($cardDetails->card->brand); ?></td>
                        <td><?php echo e($cardDetails->card->last4); ?></td>
                         
                          <td><?php echo e($cardDetails->card->exp_month); ?>/<?php echo e($cardDetails->card->exp_year); ?></td>
                        </tr>
                       
                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="payment_intent_cvc" value="" id="payment_intent_id_cvc">
                       <input type="hidden" name="payment_secert" value="" id="secert_id_cvc">
                        </tbody>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--span><input type="radio" name="selected_card" style="-webkit-appearance: auto;" onclick="radioValueFunction(this.value)" value="new"> <?php echo e(__('Add Debit/Credit/ATM Card')); ?></span-->

                        </table>
                         <!--div class="col form-group row required" style="display:none;" id="cvc_recollect_div">
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" size="6" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                        </div-->
                         <center> <div class="text-center">
                         <button class="btn btn-success" style="display:none;" id="cvvc_collect_id"><?php echo e(__('Pay')); ?>  </button><br>
                         </div></center>
                        
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_method" style="-webkit-appearance: auto;" onclick="radioValueFunction(this.value)" value="new">
                         <span>Add New Card</span>
                     
                        </form>
                       <?php endif; ?>
                      <br>
                      
                        <form action="<?php echo e(route('card')); ?>" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($stripe->val1); ?>">

                       <?php echo csrf_field(); ?>


                      <span id="add_new_card">
                            <div class="col form-group row required">
                              <input type="text" class="form-control input-lg custom-input card-number" name="cardNumber" id="stripe_cardno" placeholder="Debit/Credit Card Number*" minlength="16" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="16" autocomplete="off" required autofocus size="20"/>
                            </div>
                          
                          <div class='form-group row' id="add_new_card2">
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC*' type='text' id="stripe_cvc" minlength="3" maxlength="3" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-month' name="cardM" placeholder='MM*' minlength="2" maxlength='2' type='text' id="stripe_cardm" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY*' minlength="4" maxlength='4'type='text' id="stripe_cardy" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                          </div>
                         <div class="text-center">
                         <label class="switch">
                          <input type="checkbox" name="save_for_future">
                          <span class="slider round"></span> 
                        </label>
                        <p>Save card</p>
                         </div> 
                          <!--span>Billing Address</span>
                              <div class='row'>
                            <div class='col-sm-6'>
                              <input autocomplete='off' class='form-control' name="user_name"  placeholder='Full Name' type='text' required >
                            </div>
                            <div class='col-sm-6'>
                              <input class='form-control' placeholder='Email'  name="user_email" type='text' required>
                            </div>
                            
                          </div>
                          <br>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <input autocomplete='off' class='form-control'  placeholder='Address' type='text' name='user_address' required >
                            </div>
                            <div class='col-sm-6'>
                              <input class='form-control' placeholder='City' name="user_city" type='text' required>
                            </div>
                            
                          </div>
                            <br>
                            <div class='form-group row'>
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="user_state" placeholder='State' type='text' required >
                            </div>
                            <div class='col form-group expiration required'>
                                <select class="form-control" name="user_country">
                                    <option>Select Country</option>
                                    <?php foreach($countries as $country){?>
                                    <option value="<?=$country->iso_code?>"><?= $country->name ?></option>
                                    <?php }?>
                                </select>    
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-year' name="user_zipcode" placeholder='Zip Code' maxlength='7' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            
                          </div>
                          <div class="form-group required">
                              <textarea placeholder="Description" name="user_description"  class="form-control" required ></textarea>
                            </div-->
                            <input type="hidden" name="payment_intent" id="payment_intent_id" value="">	
                             <input type="hidden" name="payment_secert" id="secert_id" value="">	
                           <center> <div class="text-center">
                               <input type="hidden" id="browser_client_secret" value=""> 
                            <button class="btn btn-success" type="submit" id="stripe_submit_button_id"><?php echo e(__('Pay')); ?>  </button><br>
                            <!--img src="<?php echo e(url('/')); ?>/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;"-->
                          </div></center>
                          </span>
                        </form>
                        </div>
                      </div>
                    </div>
                   
                    <!--PAYPAL START-->
                     <hr>
                    <div class="card-header" id="headingFour">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <div class="row">
                        <div class="col-sm-2">
                            <img src="<?php echo e(url('/')); ?>/asset/images/paypal.png" width="90%">
<!--i class="fa fa-paypal fa-2x" aria-hidden="true" style="color:blue"></i-->
</div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">PayPal</h3>
                            <!--h4 class="mb-0">Instant large amounts</h4>
                            <span style="font-size:0.8rem">Use Your PayPal account to instantly Add Fund.</span-->
                        </div>
                    </div>  
                          </div>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body text-center">
                          <!--h4 class="mb-0"><?php echo e($adminbank->bank_name); ?></h4>
                          <h1 class="mb-1 text-muted"><?php echo e($adminbank->acct_no); ?></h1-->
                          <form action="<?php echo e(route('paypal')); ?>" role="form" method="post">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <div class="col-xs-12 col-md-12 form-group required">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </div>
                                <input type="text" step="any" class="form-control" name="amount" id="paypalamount_id" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10" onchange="chechCharge()"  placeholder="0.00" min="<?php echo e($stripe->minamo); ?>" required> 
                                <input type="hidden" value="<?php echo e($stripe->charge); ?>" id="charge"> 
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                               
                              </div>
                              <p style="margin-left:-80%;">Fees:<span id="fees_amount_id">0.00</span></p>
                               <span id="paypalamount_id_error" style="color:red"></span>
                            </div>
                            
                          </div> 
                         	
                         	</style>
                          <div class="text-center">
                              <div id="paypal-button-container"></div>
                            <!--button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Pay')); ?> <span id="cardresult"></span></button--><br>
                          </div>
                          
                        </form>
                        </div>
                      </div>
                    <!--END PAYPAL-->
                    <?php if($adminbank->status==1): ?>
                      <hr>
                      <div class="card-header" id="headingTwo">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           <div class="row">
                        <div class="col-sm-2">
<!--i class="fa fa-university fa-2x" aria-hidden="true" style="color:blue"></i-->
<img src="<?php echo e(url('/')); ?>/asset/images/bank.png" width="100%">
</div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">Bank Account</h3>
                            <!--h4 class="mb-0">Invest large amounts</h4>
                            <span style="font-size:0.8rem">Use a bank account to instantly Add Fund.</span-->
                        </div>
                    </div> 
                          </div>
                      </div>
                      
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body text-center">
                          <h4 class="mb-0"><?php echo e(__('Name:')); ?> <?php echo e($adminbank->name); ?></h4>
                          <h4 class="mb-0"><?php echo e(__('Bank Name:')); ?> <?php echo e($adminbank->bank_name); ?></h4>
                          <h1 class="mb-1 text-muted"><?php echo e(__('A/C: ')); ?><?php echo e($adminbank->acct_no); ?></h1>
                          <h5 class="mb-0"><?php echo e(__('Routing No:')); ?> <?php echo e($adminbank->iban); ?></h5>
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
                          
                          <div class="row">
                        <div class="col-sm-2">
<!--i class="fa fa-btc fa-2x" aria-hidden="true" style="color:blue"></i-->
<img src="<?php echo e(url('/')); ?>/asset/images/btc.png" width="90%">
</div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">Crypto Currency</h3>
                            <!--h4 class="mb-0">Invest large amounts</h4>
                            <span style="font-size:0.8rem">Use a crypto currency account to instantly Add Fund.</span-->
                        </div>
                    </div>
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
                    <h3 class="mb-0"><?php echo e(__('Transfer money')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button-->
                    <span class="form-text text-xs">Transfer charge is <?php echo e($set->transfer_charge); ?>% per transaction, If user is not a member of <?php echo e($set->site_name); ?>, registration will be required to claim money. Money will be refunded within 5 days if user does not receive amount.</span>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('submit.ownbank')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Email')); ?></label>
                          <div class="col-lg-10">
                              <input type="email" name="email" class="form-control" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?></label>
                          <div class="col-lg-10">
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                              </span>
                              <input type="number" class="form-control" name="amount" id="amounttransfer" min="<?php echo e($set->min_transfer); ?>"  onkeyup="transfercharge()" required>
                              <input type="hidden" value="<?php echo e($set->transfer_charge); ?>" id="chargetransfer">
                              <span class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </span>
                            </div>
                          </div>
                        </div>                   
                        <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Pay')); ?> <span id="resulttransfer"></span></button>
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
          <?php if(count($deposits)>0): ?>  
            <div class="table-responsive py-4 card">
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
               
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
               
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
          <?php else: ?>
          
  
          <center><div class="col-md-12 text-center">
              <p class="text-center text-muted card-text mt-8"><?php echo e(__('No Transactions History Found!')); ?></p>
              
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
            
          </div></center>
          <?php endif; ?>
        </div> 
        <div class="row">
          <div class="col-md-12">
          <?php echo e($transfer->links()); ?>

          </div>
        </div>
      </div> 
      <!--div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                <?php echo e(__('Statistics')); ?>

                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> <?php echo e(__('Sent')); ?></span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->symbol); ?> <?php echo e(number_format($sent)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle"><?php echo e(__('Pending')); ?></span><br>
                  <span class="surtitle"><?php echo e(__('Returned')); ?></span><br>
                  <hr>
                  <span class="surtitle "><b><?php echo e(__('Total')); ?></b></span>
                  
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->symbol); ?> <?php echo e(number_format($pending)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->symbol); ?> <?php echo e(number_format($rebursed)); ?>.00</span><br>
                  <hr>
                  <span class="surtitle "><b><?php echo e($currency->symbol); ?> <?php echo e(number_format($total)); ?>.00</b></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php $__currentLoopData = $received; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card">
         
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="h4 mb-0 text-dark">#<?php echo e($val->ref_id); ?></h5>
                </div>
                <div class="col-4 text-right">
                  <?php if($val->status==0): ?>
                  <a href="<?php echo e(url('/')); ?>/user/received/<?php echo e($val->id); ?>" class="btn btn-sm btn-success" title="Mark as received"><i class="fa fa-check"></i> <?php echo e(__('Confirm')); ?></a>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col">
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->sender['email']); ?></p>
                  <p class="text-sm text-dark mb-0"><b><?php echo e(__('Total')); ?>: <?php echo e($currency->symbol.number_format($val->amount)); ?></b></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Date')); ?>: <?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></p>
                  <?php if($val->status==1): ?>
                    <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> <?php echo e(__('Received')); ?></span>
                  <?php elseif($val->status==0): ?>
                    <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                       
                  <?php elseif($val->status==2): ?>
                    <span class="badge badge-pill badge-info"><i class="fa fa-spinner"></i> <?php echo e(__('Returned')); ?></span>                    
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      </div-->
    </div>
   <!--FOR PAYPAL-->
    <form id="paypal_success_form" action="<?php echo e(url('user/paypal_success')); ?>" method="post">
        <?php echo csrf_field(); ?>
  <input type="hidden" name="amount" id="paypal_amount_idd" value="">
  <input type="hidden" name="charge" id="fees_amount_idd" value="">
  <input type="hidden" name="paypal_status" id="paypal_status" value="">
  <input type="hidden" name="paypal_email" id="paypal_email" value="">
  <input type="hidden" name="trx" id="trx_id" value=""> 
  
  
</form>
 

    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo e($paypalGatewayDetails->val1); ?>"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>

 
<script type="text/javascript">
function setSessionFunction() {
    //window.location.href = 'https://getvirtualcard.co.uk/user/transfer';
   
   setInterval(function () {
   //$('#fund').modal('show');
    }, 1000);
  <?php // Session::flash('from_dashboard', 'This_is_from_dashboard!'); 
  ?>
}
    $(window).on('load', function() {
       $('#fund').modal('show');  
    });
</script>

 

    <!-- Add the checkout buttons, set up the order and approve the order -->
    <script>
    $(document).ready(function() {
     
   });

    function recommendedAmount(value) {
        $('#cardamount').val(value);
        var Feesamount =  parseFloat(value.replace(/,/g, ''))*<?php echo $paypalGatewayDetails->charge ?>/100;
         $('#cardresult').html(Feesamount.toFixed(2));
        
    }
    
function checkWalletLimit() {
 if($('#cardamount').val()!='')
        { 
            if($('#cardamount').val() > <?php echo e($stripe->maxamo); ?>)
            {
                $('#cardamount_error').html("Sorry, max limit not allowed!.<br>");
            }else if($('#cardamount').val() < <?php echo e($stripe->minamo); ?>){
                 $('#cardamount_error').html("Sorry, min limit not allowed!.<br>");
            } else {
            $('#cardamount_error').html(' ');
          let _token   = $('meta[name="csrf-token"]').attr('content');
           var amt = $('#cardamount').val();
            $.ajax({
                url: "<?php echo e(route('card_before')); ?>",
                method: "POST",
                data: {amount:amt,_token:_token},
                success: function(data) { 
                   
                    if(data.result == '1')
                    {
                         $("#secert_id_cvc").val(data.secert);
                         $("#secert_id").val(data.secert);
                        //$("#payment_intent_id_cvc").val(data.payment_intent);
                        //$("#payment_intent_id").val(data.payment_intent);
                        //$("#browser_client_secret").val(data.data);
                         //console.log(data.data);
                         $("#next_button_id").prop('disabled', true);
                       $("#cardamount").prop('disabled', true);
                        $('#2ndStep').show();
                       
                      
                    
                }
                },
                error:function(err){ 
                    if(err.responseJSON.result == '0') {
                         
                        
                    }
                }
            });
            }
        } else {
            $('#cardamount_error').html("Please fill amount first.<br>");
        }
} 
   </script>
   <!--script src="https://js.stripe.com/v3/"></script-->
   <script>

  

   function radioValueFunction(value)
    {
        if(value == 'new'){
            $('#cvc_recollect_div').hide();
            $('#cvvc_collect_id').hide();
            $('#add_new_card').show();
            $('#add_new_card2').show();
        } else {
            
            
            
            $('#cvc_recollect_div').show();
             $('#cvvc_collect_id').show();
            $('#add_new_card').hide();
             $('#add_new_card2').hide();
            $('#'+value).show();
        }
        
        if(document.getElementById(value).checked == true) {  
            $('.cvc_class').hide();
             $('#cvv_input_'+value).show();
         //alert(value);   
            } else {  
                 $('.cvc_class').hide();   
            }
            document.getElementById("cvvc_collect_id").onclick = function() {
               if($('#cvv_input_'+value).val() !='')  
               {
                   $('#cvv_error').html(' ');
                  $('#cvc_form_id').submit();
                   //$('#cvvc_collect_id').attr('disabled');
               } else {
                   
                   $("#cvc_form_id").submit(function(e){
                        e.preventDefault();
                    });
                   $('#cvv_error').html('CVV should not be empty!');
               } 
          // $("body").removeClass("loading");
           // this.disabled = true;
        
            //do some validation stuff
              }  
    }
    
    function chechCharge()
{
   var Feesamount =  parseFloat($('#paypalamount_id').val().replace(/,/g, ''))*<?php echo $paypalGatewayDetails->charge ?>/100;
   
    //alert(Feesamount);
    $('#fees_amount_id').html(Feesamount.toFixed(2));
    $('#fees_amount_idd').val(Feesamount.toFixed(2));
}
    
      paypal.Buttons({
         
        createOrder: function(data, actions) {
            if($('#paypalamount_id').val() !='')
            {   $('#paypalamount_id_error').hide();
                return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: parseInt($('#paypalamount_id').val()) + parseFloat($('#fees_amount_idd').val())
                  }
                }]
              });
            } else {
                $('#paypalamount_id_error').html('Amount is required!');
                
            }
          
        },
         createOrderError : {
            
          },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            
             $("#paypal_amount_idd").val(details.purchase_units[0].amount.value);
             $("#paypal_status").val(details.status) ;
             $("#paypal_email").val(details.payer.email_address) ;
             $("#trx_id").val(details.id);
              $( "#paypal_success_form" ).submit();
              
              
              //END AJAX
            //alert('Transaction completed by ' + details.payer.name.given_name);
          });
        }
      }).render('#paypal-button-container'); // Display payment options on your web page
      
      /*
      let _token   = $('meta[name="csrf-token"]').attr('content');
               var amt = $('#amount_id').val();
                $.ajax({
                    url: "<?php echo e(url('user')); ?>/paypal_success",
                    method: "POST",
                    data: {details:details,_token:_token},
                    success: function(data) { 
                        if(data.result == 1)
                        {
                            
                            location.reload(); 
                            //window.setTimeout(function(){},3000)
                        }
                        
                    },
                    error:function(err){ 
                        alert('Error');
                    }
                });
                */
   /*  $(document).ready(function () {

    

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


        });  
        */
    document.getElementById("stripe_submit_button_id").onclick = function() {
       if($('#stripe_cardno').val() !='' && $('#stripe_cvc').val() !='' && $('#stripe_cardm').val() !='' && $('#stripe_cardy').val() !='')  
       {
          // $("#fund").hide();
          //$("body").addClass("loading");
          //$('#stripe_submit_button_id').attr('disabled',true);
       }  
  // $("body").removeClass("loading");
   // this.disabled = true;

    //do some validation stuff
      }  
      
      
    </script>
   <!--END PAYPAL-->
   
   
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/transfer/index.blade.php ENDPATH**/ ?>