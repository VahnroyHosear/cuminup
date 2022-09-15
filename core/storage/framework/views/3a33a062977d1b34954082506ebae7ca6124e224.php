<?php $__env->startSection('content'); ?>
<head>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

</head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>

.card {
    margin-bottom: 30px;
    border: 0;
    box-shadow: 0 0 2rem 0 rgb(248 249 254);
       /* background-color: #f8f9fe;*/
}
.openname{color: #0f0f0f!important;font-weight: bold;}
.openc{ width: 60%;    margin-bottom: -1rem !important;
    margin: 0px auto;
    text-align: left;
    background: whitesmoke;
    padding: 10px;
    border-radius: 8px;}
.openn{ color: #b2aeae!important;
    font-size: 12px!important;}
 <?php $__currentLoopData = $AllvCardDesigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $DesignDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
.card-body2<?php echo e($DesignDetails->id); ?>{width: 60%;margin: 9px auto; padding: 0.5rem 1rem;
background: <?php echo e($DesignDetails->class_name); ?>;    font-size: 14px;
    border-radius: 8px;
    flex: 1 1 auto;}
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $AllvCardDesigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $DesignDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
    .card-body<?php echo e($DesignDetails->id); ?>

    {    
        padding: 0.5rem 1rem;
    background: <?php echo e($DesignDetails->class_name); ?>;
        border-radius: 15px;
        flex: 1 1 auto;
    }
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

.text-gray {
    color: #9f9e9e !important;
}
.text-primary {
    color: #ffffff !important;
}
strong {
    font-weight: bold;
}
    .btn-neutral
{
       color: #ffffff;
    border-color: transparent;
    background-color: rgb(25 55 228);
    box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
    font-size: 13px;
    margin-top: 9px;border-radius:30px;
}
.btn-neutral:hover
{
    color: #fff;
    border-color: #1937e4;
    background-color: #1937e4;
}
</style>


<div class="container-fluid mt--6" style="background-color:white">


  <div class="content-wrapper" style="margin-top:5px;">
    <center><div class="row align-items-center " style="padding-bottom: 20px;">
        <div class="col-lg-2 col-sm-2">All Cards</div>
      <div class="col-lg-3 col-sm-3">
        <?php if($created_vcards_limit->cvard_limit < 0  && Auth::user()->user_type == 1): ?>      
            <a href="<?php echo e(url('user/instant_issue')); ?>" class="btn btn-sm btn-neutral" style="background: #1937e4;
    padding: 7px 15px;
    color: #ffffff;"><i class="fa fa-plus"></i> Purchase Plan for Cards</a>
        <?php elseif($created_vcards_limit->cvard_limit > 0 ): ?> 
         <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create New Card</a>
        <?php else: ?>
            <?php if(Auth::user()->kyc_status == 1): ?>
                <a href="<?php echo e(url('user/instant_issue')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Instant Card</a>
            <?php else: ?>                
            <a href="<?php echo e(url('user/instant_issue')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Instant Card</a>

              <!--a href="<?php echo e(url('user/upgrade')); ?>" class="btn btn-sm btn-neutral" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-plus"></i> Create Instant Card</a-->
            <?php endif; ?>
        <?php endif; ?>
        
        
      </div><br>
      <div class="col-lg-3 col-sm-3" style="margin-top: 12px;">
          
          <label class="h2 mb-0 text-future text-future1" style="    font-weight: 500;
    color: black;">Card Status:</label>
          <select id="selected_id" onchange="selectedValue(this.value)" style="border-radius: 30px;
    color: white;
    background: #1937e4;
    padding: 0px 10px;">
              <option value="All">All</option>
              <option value="Open">Active</option>
              <option value="Paused">Freezed</option>
              <option value="Closed">Terminated</option>
              </select>
          </div>
         
      <div class="col-lg-3 col-sm-3">
          <b style="color: #1937e4;
    text-decoration: underline;"><?php echo e(__('Remaining Cards:')); ?> <?php echo e($created_vcards_limit->cvard_limit); ?></b>
         </div> 
    </div></center>
    <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h2 class="mb-0 font-weight-bolder">Create a new card</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="margin-top: -25px;"><i class="fa fa-times"></i></span>
                </button>
                <!--p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p-->
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.create_new')); ?>">
                    <?php echo csrf_field(); ?>
                   <!--div class="form-group row">
                    <label class="col-form-label col-lg-12"><b>Product Type</b><span style="color:red"><?php echo e(__('*')); ?></span></label>
                    <div class="col-lg-12">
                      <select name="product_plan_type" class="form-control" required>
                          <option value="">Select Product</option>
                         <?php $__currentLoopData = $AllvCardPlanOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($p_details->id); ?>"><?php echo e($p_details->plan_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>  
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12"><b>Card Nick Name</b><span style="color:red"><?php echo e(__('*')); ?></span></label>
                    <div class="col-lg-12">
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" required>
                    </div>
                  </div> 
                   <style>.down {
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
}
.arrow {
  border: solid black;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 3px;
}
</style>
                  <div class="form-group row">
                      
                    <label class="col-form-label col-lg-12"><b>Spend Limit</b><span style="color:red"><?php echo e(__('*')); ?></span></label>
                   
                    <div class="col-lg-12">
                       
                           
                     <center><div style="padding:10px;"><p class="text-center"><?php echo e($currency->symbol); ?><span id="demo"></span>.00</p></div></center>
                    
                    <input id="amount_id" type="range" min="<?php echo e($set->virtual_card_min_amt); ?>" id2="0" name="card_limit" onchange="checkWalletLimit(this.value)" max="<?php echo e($set->virtual_card_max_amt); ?>" value="<?php echo e($set->virtual_card_min_amt); ?>" class="form-control"/>

                            <!--div class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div-->
                          <!--input type="text" name="card_limit" class="form-control" onchange="checkWalletLimit()" id="amount_id" min="<?php echo e($set->virtual_card_min_amt); ?>" maxlength="11" placeholder="Card extend limit i.e 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required-->
                          <!--select class="form-control" name="card_limit"  onchange="checkWalletLimit(this.value)" required>
                              <option>Select Limit <i class="arrow down"></i></option>
                              <option value="100"><?php echo e($currency->symbol); ?><?php echo e(__('100')); ?></option>
                              <option value="200"><?php echo e($currency->symbol); ?><?php echo e(__('200')); ?></option>
                              <option value="300"><?php echo e($currency->symbol); ?><?php echo e(__('300')); ?></option>
                              <option value="500"><?php echo e($currency->symbol); ?><?php echo e(__('500')); ?></option>
                              <option value="700"><?php echo e($currency->symbol); ?><?php echo e(__('700')); ?></option>
                              <option value="1000"><?php echo e($currency->symbol); ?><?php echo e(__('1000')); ?></option>
                              <option value="1500"><?php echo e($currency->symbol); ?><?php echo e(__('1500')); ?></option>
                              <option value="2000"><?php echo e($currency->symbol); ?><?php echo e(__('2000')); ?></option>
                           </select-->
                        
                        <span id="check_wal_bal_msg" style="color:green"></span>
                          <span id="check_wal_bal_error" style="color:red"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12"><b><?php echo e(__('Card Validity')); ?></b><span style="color:red"><?php echo e(__('*')); ?></span></label>
                    <div class="col-lg-12">
                      <select name="spend_limit_duration" class="form-control" required>
                          <option value=""><?php echo e(__('Select Card Validity')); ?></option>
                         
                         <option value="MONTHLY">Per Month</option>
                         <option value="ANNUALLY">Per Year</option>
                         <option value="TRANSACTION">Per Transaction</option>
                         <option value="FOREVER">Forever(Total)</option>
                         <option value="SINGLE_USE">Single Use(Closes shortly after first use)</option>
                        </select>  
                    </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-form-label col-lg-12"><b>Card Type</b></label>
                    <!--input type="radio" class="form-control-input" style="-webkit-appearance:auto!important;margin-left:16px" name="card_type" value="SINGLE_USE"><label class="col-form-label col-lg-12" style="margin-top:-32px;margin-left:20px">Single Use (Closes shortly after first use)</label-->
                   
                       <div class="col-lg-4">
                           <div class="radio">
                              <label><input type="radio" name="card_type"  checked value="SINGLE_USE" onchange="CardTypeValueCheck(this.value)"> Virtual Card</label>
                            </div>
                        </div> 
                        <div class="col-lg-6">
                        <div class="radio">
                          <label><input type="radio" name="card_type"  value="PHYSICAL" onchange="CardTypeValueCheck(this.value)"> Physical (Plastic Card)</label>
                        </div> 
                        </div>
                      <!--select class="form-control" name="card_type" onchange="CardTypeValueCheck(this.value)">
                          <option value=""><b>Select Card Type</b></option>
                         <option value="SINGLE_USE">Single Use (Closes shortly after first use)</option>
                         <option value="PHYSICAL">Physical (Plastic Card)</option>
                        </select-->  
                   
                  </div>
                  <div class="form-group row" id="card_type_div_id" style="display:none;">
                    <label class="col-form-label col-lg-12">Postal Address for Plastic Card</label>
                    <div class="col-lg-12" style="margin-bottom:10px">
                      <input type="text" name="postal_address" class="form-control"  placeholder="H No / Street">
                    </div>
                    <div class="col-lg-6" style="margin-bottom:10px">
                      <input type="text" name="postal_city" class="form-control"  placeholder="City">
                    </div>
                    <div class="col-lg-6">
                        <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                            <select class="form-control" name="postal_country" id="selectVehicle">
                                <option value="">Select Country</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?php echo e($country->iso_code); ?>" data-id="<?php echo e($country->id); ?>" <?=($country->iso_code =='US') ? 'selected' : ''?>><?php echo e($country->name); ?></option>
                                <?php }?>
                            </select>  
                    </div>
                    <div class="col-lg-6" id="state_id_input">
                          <?php $states =DB::table('states')->where('country_id',840)->orderby('id','ASC')->get(); ?>
                            <select class="form-control" name="postal_state" id="state_id">
                                <option value="">Select State</option>
                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state->iso_code); ?>"><?php echo e($state->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                    </div>
                    
                    
                    <div class="col-lg-6">
                      <input type="number" name="postal_zip_code" class="form-control"  placeholder="Zip Code">
                    </div>
                    <!--span style="font-size:12px;"><b>Note: Plastic card This card will be activated with in few hours.</b></span-->
                  </div>                 
                  <div class="text">
                      <span style="font-size:12px;"><b>Note: This card will be activated within few hours.</b></span>
                    <button type="submit" class="btn btn-neutral btn-block my-4" id="create_card_btn_id">Create Prepaid Card</button>
                    
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <!--ALLCARD START-->
        <div class="row" id="allcard_div_id">
      <?php $__currentLoopData = $virtualCardsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
        <div class="col-lg-4">
          <div class="card">
            <!-- Card body -->
            <div class="card-body<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 <?php if($cardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($cardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('Inactive'); ?><?php endif; ?></span>                </div>
                <div class="col-auto">
                  <a class="mr-0 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-arrow-circle-down" style="color:white"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="<?php echo e(url('user/virtualtransactions')); ?>/<?php echo e($cardDetails->token); ?>" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                     <?php if($cardDetails->is_paused_by_admin == 0): ?>
                     
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#updatecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i>Update Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'PAUSED'): ?>
                        <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'OPEN'): ?>
                        <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause Card</a>
                        <?php endif; ?>
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-trash"></i>Delete Card</a>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
                </div>
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
               
                </span>
                <div class="text-primary"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <img src="https://cuminup.com/asset/images/logo_1604661746.png" class="navbar-brand-img" alt="...">
                </div>
              </div>
              <div class="row">               
                <div class="col-7">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->memo); ?></span><br>
                  <span class="text-white" style="    font-size: 13px;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <span class="text-white"><?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></span></span>
                </div>
                <div class="col"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->last_four_digit); ?></span><br>
                  
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>
              
            </div>
          <div class="row" style="margin-top:5px;">
               <div class="col-4"></div><div class="col-6"> <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="badge badge-pill badge-success">Manage Card</span></a>
               <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="<?php echo e(url('user/virtualtransactions')); ?>/<?php echo e($cardDetails->token); ?>" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                      <?php if($cardDetails->is_paused_by_admin == 0): ?>
                      
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#updatecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i><?php echo e(__('Update Card')); ?></a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'PAUSED'): ?>
                        <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'OPEN'): ?>
                        <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause Card</a>
                        <?php endif; ?>
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-trash"></i>Delete Card</a>
                        <?php endif; ?>
                   
                    <?php endif; ?>    
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
               
               </div></div>
           
          </div>
           
        </div>
        
        <div class="modal fade" id="modal-more<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder"><?php echo e($cardDetails->memo); ?> Card Details <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </butto-->
                </div>
               <div class="card-body2<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
 <?php if($cardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($cardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('Inactive'); ?><?php endif; ?></span>                  </div>
               
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
                <?php echo e($cardDetails->memo); ?>

                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <div><?php echo e(substr($cardDetails->pan,0,4)); ?> <?php echo e(substr($cardDetails->pan,4,4)); ?> <?php echo e(substr($cardDetails->pan,8,4)); ?> <?php echo e(substr($cardDetails->pan,12,4)); ?></div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->exp_month)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e($cardDetails->exp_month); ?><?php endif; ?> / <?php if(empty($cardDetails->exp_year)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e(substr($cardDetails->exp_year,2,4)); ?><?php endif; ?></span><br>
                  <!--span class="text-white">$<?php echo e($cardDetails->spend_limit); ?> /<span class="text-white">$1000</span></span-->
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->cvv)): ?><?php echo e('XXX'); ?><?php else: ?><?php echo e($cardDetails->cvv); ?><?php endif; ?></span><br>
                  <!--span class="text-white"><?php echo e($cardDetails->cvv); ?></span-->
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Card Nick Name
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->memo); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Monthly Limit
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
                <span class="h6 surtitle text-gray mb-2 openn">
                Funding Source
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->FundingAccount); ?></div>
                  <p style="color: black!important;">xxxx xxx xxx <?php echo e($cardDetails->FundingLastFour); ?></p>
                </div>
              </div>
            <div class="row" style="width:60%;margin:0px auto">
                 <?php if($cardDetails->is_paused_by_admin == 0): ?>
                <div class="col-md-6">
                      <?php if($cardDetails->card_state == 'PAUSED'): ?>
                    <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    <?php endif; ?>
                    <?php if($cardDetails->card_state == 'OPEN'): ?>
                    <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                     <?php if($cardDetails->card_state != 'CLOSED'): ?>
                    <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Delete</strong></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      
       <div class="modal fade" id="limitexceeed-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Limit Exceeded</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Please upgrade your plan!</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  
                </form>
                <div class="text-center">
                   
                    <?php if($created_vcards_limit->cvard_limit == 0): ?>
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a>
                    <?php else: ?>
                  <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Card</a>
                    <?php endif; ?>
                    <!--a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="opencard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Delete Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3><?php echo e(__('Your will not able to use this card anymore.')); ?></h3>
                <h3><?php echo e(__('Are you sure you want to close it?')); ?></h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.close_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
       <div class="modal fade" id="pausecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.pause_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="updatecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Update Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <!--p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p-->
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.update_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name (Name on Card)</label>
                    <div class="col-lg-12">
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" value="<?php echo e($cardDetails->memo); ?>" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Monthly Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" min="10" max="5000" value="<?php echo e($cardDetails->spend_limit); ?>" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit Duration</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="spend_limit_duration" required>
                          <option value="">Select Limit Duration</option>
                         <option value="TRANSACTION" <?php if($cardDetails->spend_limit_duration == 'TRANSACTION'): ?><?php echo e('Selected'); ?><?php endif; ?>>TRANSACTION</option>
                         <option value="MONTHLY" <?php if($cardDetails->spend_limit_duration == 'MONTHLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>MONTHLY</option>
                         <option value="ANNUALLY" <?php if($cardDetails->spend_limit_duration == 'ANNUALLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>ANNUALLY</option>
                         <option value="FOREVER" <?php if($cardDetails->spend_limit_duration == 'FOREVER'): ?><?php echo e('Selected'); ?><?php endif; ?>>FOREVER</option>
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Card Type</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE" <?php if($cardDetails->type == 'SINGLE_USE'): ?><?php echo e('Selected'); ?><?php endif; ?>>SINGLE USE</option>
                         
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4">Update Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
      <?php if($created_vcards_limit->cvard_limit == 0 && count($virtualCardsList) < 0): ?>
        <div class="col-lg-12">
          <div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards yet!</h3>
                <br>
                 <div class="text-center">
                    <?php if(Auth::user()->kyc_status == 1): ?>
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Create Instant Card</a>
                    <?php else: ?>
                    <a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a>
                    <?php endif; ?>
                    <!--a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a-->
                   
                  <!--a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-success">Create Card</a-->
                  <!--a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a-->
                   
                    <!--a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a-->
                    <!--a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div> 
        </div>
        </div> 
        <?php else: ?>
        <?php if(count($virtualCardsList) == 0): ?>
        <div class="col-lg-12">
          <div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards found!</h3>
                <?php if($created_vcards_limit->cvard_limit > 0 ): ?>
              <center><h2 class="mb-0 font-weight-bolder">Lets create you new Virtual Card</h2></center>
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral" style="padding: 10px;"><i class="fa fa-plus"></i> Create New Card</a>
              <?php endif; ?>
                <br>
                <br>
                <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
                <br>
                 
              </div> 
        </div>
        </div>
        <?php endif; ?>
         <?php endif; ?>
    </div>
    <!--ALLCARD END-->
    <div class="row" id="open_div_id" style="display:none;">
      <?php $__currentLoopData = $virtualCardsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($cardDetails->card_state == 'OPEN'): ?>
        <div class="col-lg-4">
          <div class="card">
            <!-- Card body -->
            <div class="card-body<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 <?php if($cardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($cardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('Inactive'); ?><?php endif; ?></span>                </div>
                <div class="col-auto">
                  <a class="mr-0 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-arrow-circle-down" style="color:white"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="<?php echo e(url('user/virtualtransactions')); ?>/<?php echo e($cardDetails->token); ?>" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                      <?php if($cardDetails->is_paused_by_admin == 0): ?>
                      
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#updatecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i>Update Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'PAUSED'): ?>
                        <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'OPEN'): ?>
                        <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause Card</a>
                        <?php endif; ?>
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-trash"></i>Delete Card</a>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
                </div>
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
               
                </span>
                <div class="text-primary"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <img src="https://cuminup.com/asset/images/logo_1604661746.png" class="navbar-brand-img" alt="...">
                </div>
              </div>
              <div class="row">               
                <div class="col-7">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->memo); ?></span><br>
                  <span class="text-white" style="    font-size: 13px;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <span class="text-white"><?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></span></span>
                </div>
                <div class="col"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->last_four_digit); ?></span><br>
                  
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>
              
            </div>
          <div class="row" style="margin-top:5px;">
               <div class="col-4"></div><div class="col-6"> <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="badge badge-pill badge-success">Manage Card</span></a>
               <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="<?php echo e(url('user/virtualtransactions')); ?>/<?php echo e($cardDetails->token); ?>" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                      <?php if($cardDetails->is_paused_by_admin == 0): ?>
                      
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#updatecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i><?php echo e(__('Update Card')); ?></a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'PAUSED'): ?>
                        <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'OPEN'): ?>
                        <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause Card</a>
                        <?php endif; ?>
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-trash"></i>Delete Card</a>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
               
               </div></div>
           
          </div>
           
        </div>
        
        <div class="modal fade" id="modal-more<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder"><?php echo e($cardDetails->memo); ?> Card Details <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </butto-->
                </div>
               <div class="card-body2<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
 <?php if($cardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($cardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('Inactive'); ?><?php endif; ?></span>                  </div>
               
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
                <?php echo e($cardDetails->memo); ?>

                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <div><?php echo e(substr($cardDetails->pan,0,4)); ?> <?php echo e(substr($cardDetails->pan,4,4)); ?> <?php echo e(substr($cardDetails->pan,8,4)); ?> <?php echo e(substr($cardDetails->pan,12,4)); ?></div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->exp_month)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e($cardDetails->exp_month); ?><?php endif; ?> / <?php if(empty($cardDetails->exp_year)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e(substr($cardDetails->exp_year,2,4)); ?><?php endif; ?></span><br>
                  <!--span class="text-white">$<?php echo e($cardDetails->spend_limit); ?> /<span class="text-white">$1000</span></span-->
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->cvv)): ?><?php echo e('XXX'); ?><?php else: ?><?php echo e($cardDetails->cvv); ?><?php endif; ?></span><br>
                  <!--span class="text-white"><?php echo e($cardDetails->cvv); ?></span-->
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Card Nick Name
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->memo); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Monthly Limit
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
                <span class="h6 surtitle text-gray mb-2 openn">
                Funding Source
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->FundingAccount); ?></div>
                  <p style="color: black!important;">xxxx xxx xxx <?php echo e($cardDetails->FundingLastFour); ?></p>
                </div>
              </div>
            <div class="row" style="width:60%;margin:0px auto">
                 <?php if($cardDetails->is_paused_by_admin == 0): ?>
                <div class="col-md-6">
                      <?php if($cardDetails->card_state == 'PAUSED'): ?>
                    <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    <?php endif; ?>
                    <?php if($cardDetails->card_state == 'OPEN'): ?>
                    <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                     <?php if($cardDetails->card_state != 'CLOSED'): ?>
                    <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Delete</strong></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      
       <div class="modal fade" id="limitexceeed-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Limit Exceeded</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Please upgrade your plan!</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  
                </form>
                <div class="text-center">
                   
                    <?php if($created_vcards_limit->cvard_limit == 0): ?>
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a>
                    <?php else: ?>
                  <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Card</a>
                    <?php endif; ?>
                    <!--a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="opencard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Delete Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.close_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
       <div class="modal fade" id="pausecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.pause_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="updatecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Update Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <!--p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p-->
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.update_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name (Name on Card)</label>
                    <div class="col-lg-12">
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" value="<?php echo e($cardDetails->memo); ?>" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Monthly Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" min="10" max="5000" value="<?php echo e($cardDetails->spend_limit); ?>" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit Duration</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="spend_limit_duration" required>
                          <option value="">Select Limit Duration</option>
                         <option value="TRANSACTION" <?php if($cardDetails->spend_limit_duration == 'TRANSACTION'): ?><?php echo e('Selected'); ?><?php endif; ?>>TRANSACTION</option>
                         <option value="MONTHLY" <?php if($cardDetails->spend_limit_duration == 'MONTHLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>MONTHLY</option>
                         <option value="ANNUALLY" <?php if($cardDetails->spend_limit_duration == 'ANNUALLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>ANNUALLY</option>
                         <option value="FOREVER" <?php if($cardDetails->spend_limit_duration == 'FOREVER'): ?><?php echo e('Selected'); ?><?php endif; ?>>FOREVER</option>
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Card Type</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE" <?php if($cardDetails->type == 'SINGLE_USE'): ?><?php echo e('Selected'); ?><?php endif; ?>>SINGLE USE</option>
                         
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4">Update Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
      <?php if($created_vcards_limit->cvard_limit == 0 && count($virtualCardsList) < 0): ?>
        <div class="col-lg-12">
          <div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards yet!</h3>
                <br>
                 <div class="text-center">
                    <?php if(Auth::user()->kyc_status == 1): ?>
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Create Instant Card</a>
                    <?php else: ?>
                    <a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a>
                    <?php endif; ?>
                    <!--a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a-->
                   
                  <!--a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-success">Create Card</a-->
                  <!--a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a-->
                   
                    <!--a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a-->
                    <!--a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div> 
        </div>
        </div> 
        <?php else: ?>
        <?php if(count($virtualCardsList) == 0): ?>
        <div class="col-lg-12">
          <div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards found!</h3>
                <?php if($created_vcards_limit->cvard_limit > 0 ): ?>
              <center><h2 class="mb-0 font-weight-bolder">Lets create you new Virtual Card</h2></center>
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral" style="padding: 10px;"><i class="fa fa-plus"></i> Create New Card</a>
              <?php endif; ?>
                <br>
                <br>
                <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
                <br>
                 
              </div> 
        </div>
        </div>
        <?php endif; ?>
         <?php endif; ?>
    </div>
    <!--PAUSED-->
    <div class="row" id="paused_id" style="display:none;">
      <?php $__currentLoopData = $virtualCardsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($cardDetails->card_state == 'PAUSED'): ?>
        <div class="col-lg-4">
          <div class="card">
            <!-- Card body -->
            <div class="card-body<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 <?php if($cardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($cardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('Inactive'); ?><?php endif; ?></span>                </div>
                <div class="col-auto">
                  <a class="mr-0 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-arrow-circle-down" style="color:white"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="<?php echo e(url('user/virtualtransactions')); ?>/<?php echo e($cardDetails->token); ?>" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                      <?php if($cardDetails->is_paused_by_admin == 0): ?>
                      
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#updatecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i>Delete Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'PAUSED'): ?>
                        <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause Card</a>
                        <?php endif; ?>
                        <?php if($cardDetails->card_state == 'OPEN'): ?>
                        <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause Card</a>
                        <?php endif; ?>
                         <?php if($cardDetails->card_state != 'CLOSED'): ?>
                        <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-trash"></i>Delete Card</a>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
                </div>
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
               
                </span>
                <div class="text-primary"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <img src="https://cuminup.com/asset/images/logo_1604661746.png" class="navbar-brand-img" alt="...">
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->memo); ?></span><br>
                  <span class="text-white" style="    font-size: 13px;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <span class="text-white"><?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></span></span>
                </div>
                <div class="col"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->last_four_digit); ?></span><br>
                  
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-more<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder"><?php echo e($cardDetails->memo); ?> Card Details <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button-->
                </div>
               <div class="card-body2<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                <?php if($cardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($cardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('Inactive'); ?><?php endif; ?></span>                  
                  </div>
               
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
                <?php echo e($cardDetails->memo); ?>

                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <div><?php echo e(substr($cardDetails->pan,0,4)); ?> <?php echo e(substr($cardDetails->pan,4,4)); ?> <?php echo e(substr($cardDetails->pan,8,4)); ?> <?php echo e(substr($cardDetails->pan,12,4)); ?></div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->exp_month)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e($cardDetails->exp_month); ?><?php endif; ?> / <?php if(empty($cardDetails->exp_year)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e(substr($cardDetails->exp_year,2,4)); ?><?php endif; ?></span><br>
                  <!--span class="text-white">$<?php echo e($cardDetails->spend_limit); ?> /<span class="text-white">$1000</span></span-->
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->cvv)): ?><?php echo e('XXX'); ?><?php else: ?><?php echo e($cardDetails->cvv); ?><?php endif; ?></span><br>
                  <!--span class="text-white"><?php echo e($cardDetails->cvv); ?></span-->
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Nick Name
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->memo); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Monthly Limit
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
                <span class="h6 surtitle text-gray mb-2 openn">
                Funding Source
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->FundingAccount); ?></div>
                  <p style="color: black!important;">xxxx xxx xxx <?php echo e($cardDetails->FundingLastFour); ?></p>
                </div>
              </div>
            <div class="row" style="width:60%;margin:0px auto">
                 <?php if($cardDetails->is_paused_by_admin == 0): ?>
                <div class="col-md-6">
                      <?php if($cardDetails->card_state == 'PAUSED'): ?>
                    <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    <?php endif; ?>
                    <?php if($cardDetails->card_state == 'OPEN'): ?>
                    <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                     <?php if($cardDetails->card_state != 'CLOSED'): ?>
                    <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Delete</strong></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      
       <div class="modal fade" id="limitexceeed-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Limit Exceeded</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Please upgrade your plan!</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  
                </form>
                <div class="text-center">
                    
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a>
                    <!--a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="opencard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Delete Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3><?php echo e(__('Your will not able to use this card anymore.')); ?></h3>
                <h3><?php echo e(__('Are you sure you want to close it?')); ?></h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.close_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
       <div class="modal fade" id="pausecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.pause_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="updatecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Update Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <!--p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p-->
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.update_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name (Name on Card)</label>
                    <div class="col-lg-12">
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" value="<?php echo e($cardDetails->memo); ?>" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Monthly Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" min="10" max="5000" value="<?php echo e($cardDetails->spend_limit); ?>" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit Duration</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="spend_limit_duration" required>
                          <option value="">Select Limit Duration</option>
                         <option value="TRANSACTION" <?php if($cardDetails->spend_limit_duration == 'TRANSACTION'): ?><?php echo e('Selected'); ?><?php endif; ?>>TRANSACTION</option>
                         <option value="MONTHLY" <?php if($cardDetails->spend_limit_duration == 'MONTHLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>MONTHLY</option>
                         <option value="ANNUALLY" <?php if($cardDetails->spend_limit_duration == 'ANNUALLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>ANNUALLY</option>
                         <option value="FOREVER" <?php if($cardDetails->spend_limit_duration == 'FOREVER'): ?><?php echo e('Selected'); ?><?php endif; ?>>FOREVER</option>
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Card Type</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE" <?php if($cardDetails->type == 'SINGLE_USE'): ?><?php echo e('Selected'); ?><?php endif; ?>>SINGLE USE</option>
                         
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4">Update Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
       <?php if(count($virtualCardsList) == 0): ?>
        <div class="col-lg-12">
          <!--div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards yet!</h3>
                <br>
                 <div class="text-center">
                    
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a>
                  </div>
              </div> 
        </div-->
        <div class="card">
              <?php if($created_vcards_limit->cvard_limit > 0 ): ?>
              <center><h2 class="mb-0 font-weight-bolder">Lets <a data-toggle="modal" data-target="#modal-formx" style="color:green;cursor:pointer">Create</a> New Virtual Card</h2></center>
              <?php endif; ?>
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards found!</h3>
                <br>
                <br>
                <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
                <br>
                 
              </div> 
        </div>
        </div> 
        <?php endif; ?>
    </div>
    <!--END PAUSED-->
    <!--CLOSED START-->
    <div class="row" id="closed_id" style="display:none;">
      <?php $__currentLoopData = $virtualCardsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($cardDetails->card_state == 'CLOSED'): ?>
        <div class="col-lg-4">
          <div class="card">
            <!-- Card body -->
            <div class="card-body<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 <?php if($cardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($cardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('Inactive'); ?><?php endif; ?></span>                </div>
                <div class="col-auto">
                  <a class="mr-0 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-arrow-circle-down" style="color:white"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="<?php echo e(url('user/virtualtransactions')); ?>/<?php echo e($cardDetails->token); ?>" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                    <?php if($cardDetails->is_paused_by_admin == 0): ?>
                    
                     <?php if($cardDetails->card_state != 'CLOSED'): ?>
                    <a data-toggle="modal" data-target="#updatecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i>Update Card</a>
                    <?php endif; ?>
                    <?php if($cardDetails->card_state == 'PAUSED'): ?>
                    <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause Card</a>
                    <?php endif; ?>
                    <?php if($cardDetails->card_state == 'OPEN'): ?>
                    <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause Card</a>
                    <?php endif; ?>
                     <?php if($cardDetails->card_state != 'CLOSED'): ?>
                    <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-trash"></i>Delete Card</a>
                    <?php endif; ?>
                    
                    <?php endif; ?>
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
                </div>
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
               
                </span>
                <div class="text-primary"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <img src="https://cuminup.com/asset/images/logo_1604661746.png" class="navbar-brand-img" alt="...">
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->memo); ?></span><br>
                  <span class="text-white" style="    font-size: 13px;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <span class="text-white"><?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></span></span>
                </div>
                <div class="col"  data-toggle="modal" data-target="#modal-more<?php echo e($cardDetails->id); ?>" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php echo e($cardDetails->last_four_digit); ?></span><br>
                  
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-more<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder"><?php echo e($cardDetails->memo); ?> Card Details <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button-->
                </div>
               <div class="card-body2<?php echo e($cardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                  <span class="badge badge-pill badge-success"><?php if($cardDetails->card_state == 'OPEN'): ?><?php echo e('Active'); ?><?php elseif($cardDetails->card_state == 'CLOSED'): ?><?php echo e('CLOSED'); ?><?php else: ?><?php echo e('Inactive'); ?><?php endif; ?></span>                </div>
               
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
                <?php echo e($cardDetails->memo); ?>

                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <div><?php echo e(substr($cardDetails->pan,0,4)); ?> <?php echo e(substr($cardDetails->pan,4,4)); ?> <?php echo e(substr($cardDetails->pan,8,4)); ?> <?php echo e(substr($cardDetails->pan,12,4)); ?></div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->exp_month)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e($cardDetails->exp_month); ?><?php endif; ?> / <?php if(empty($cardDetails->exp_year)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e(substr($cardDetails->exp_year,2,4)); ?><?php endif; ?></span><br>
                  <!--span class="text-white">$<?php echo e($cardDetails->spend_limit); ?> /<span class="text-white">$1000</span></span-->
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php if(empty($cardDetails->cvv)): ?><?php echo e('XXX'); ?><?php else: ?><?php echo e($cardDetails->cvv); ?><?php endif; ?></span><br>
                  <!--span class="text-white"><?php echo e($cardDetails->cvv); ?></span-->
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Nick Name
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->memo); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Monthly Limit
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($currency->symbol.number_format($cardDetails->restAmount/100,2)); ?> / <?php echo e($currency->symbol.number_format($cardDetails->spend_limit,2)); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
                <span class="h6 surtitle text-gray mb-2 openn">
                Funding Source
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;"><?php echo e($cardDetails->FundingAccount); ?></div>
                  <p style="color: black!important;">xxxx xxx xxx <?php echo e($cardDetails->FundingLastFour); ?></p>
                </div>
              </div>
            <div class="row" style="width:60%;margin:0px auto">
                 <?php if($cardDetails->is_paused_by_admin == 0): ?>
                <div class="col-md-6">
                      <?php if($cardDetails->card_state == 'PAUSED'): ?>
                    <a data-toggle="modal" data-target="#opencard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    <?php endif; ?>
                    <?php if($cardDetails->card_state == 'OPEN'): ?>
                    <a data-toggle="modal" data-target="#pausecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                     <?php if($cardDetails->card_state != 'CLOSED'): ?>
                    <a data-toggle="modal" data-target="#closecard-model<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Delete</strong></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      
       <div class="modal fade" id="limitexceeed-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Limit Exceeded</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Please upgrade your plan!</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  
                </form>
                <div class="text-center">
                    
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a>
                    <!--a href="<?php echo e(url('user/upgrade')); ?>"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="opencard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Delete Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                 <h3><?php echo e(__('Your will not able to use this card anymore.')); ?></h3>
                <h3><?php echo e(__('Are you sure you want to close it?')); ?></h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.close_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
       <div class="modal fade" id="pausecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.pause_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="updatecard-model<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Update Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <!--p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p-->
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.update_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name (Name on Card)</label>
                    <div class="col-lg-12">
                    <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">    
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" value="<?php echo e($cardDetails->memo); ?>" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Monthly Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" min="10" max="5000" value="<?php echo e($cardDetails->spend_limit); ?>" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit Duration</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="spend_limit_duration" required>
                          <option value="">Select Limit Duration</option>
                         <option value="TRANSACTION" <?php if($cardDetails->spend_limit_duration == 'TRANSACTION'): ?><?php echo e('Selected'); ?><?php endif; ?>>TRANSACTION</option>
                         <option value="MONTHLY" <?php if($cardDetails->spend_limit_duration == 'MONTHLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>MONTHLY</option>
                         <option value="ANNUALLY" <?php if($cardDetails->spend_limit_duration == 'ANNUALLY'): ?><?php echo e('Selected'); ?><?php endif; ?>>ANNUALLY</option>
                         <option value="FOREVER" <?php if($cardDetails->spend_limit_duration == 'FOREVER'): ?><?php echo e('Selected'); ?><?php endif; ?>>FOREVER</option>
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Card Type</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE" <?php if($cardDetails->type == 'SINGLE_USE'): ?><?php echo e('Selected'); ?><?php endif; ?>>SINGLE USE</option>
                         
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4">Update Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
       <?php if(count($virtualCardsList) == 0): ?>
        <div class="col-lg-12">
          <!--div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards yet!</h3>
                <br>
                 <div class="text-center">
                    
                    <a href="<?php echo e(url('user/instant_issue_designs/1')); ?>"  class="btn btn-success">Upgrade Now</a>
                  </div>
              </div> 
        </div-->
        <div class="card">
              <?php if($created_vcards_limit->cvard_limit > 0 ): ?>
              <center><h2 class="mb-0 font-weight-bolder">Lets <a data-toggle="modal" data-target="#modal-formx" style="color:green;cursor:pointer">Create</a> New Virtual Card</h2></center>
              <?php endif; ?>
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards found!</h3>
                <br>
                <br>
                <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
                <br>
                 
              </div> 
        </div>
        </div> 
        <?php endif; ?>
    </div>
    <!--END CLOSED-->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center mt-5 pt-5 pb-4">
      <h3> <i class="fas fa-crown" style="color: #fff704; font-size: 20px;"></i> Upgrade to Business</h3>
      <a href="<?php echo e(route('user.upgrade')); ?>"><p>Click Here..</p></a>
    </div>
  </div>
</div>
   
    
          <div class="modal fade" id="modal-formfund9" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">Add Funds to Virtual Card</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="http://vcard.ewalletscard.com/user/fund-virtual">
                    <input type="hidden" name="_token" value="qvuwGVN5NwUQukGJx44qtIeJmGkLWhDk6PoIl3yG">                    <input type="hidden" name="id" value="e9bc954b-261c-4d70-a1c5-2c64fd3c716c">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-12">Amount</label>
                        <div class="col-lg-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="any" name="amount" class="form-control" max="10000" required="">
                            </div>
                            <p class="form-text text-xs">Charge is 4.3%.</p>
                        </div>
                    </div>                 
                    <div class="text-right">
                        <button type="submit" class="btn btn-neutral btn-block my-4">Fund Card</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>      
      
    


<!-- footer begin -->
      <footer class="footer pt-0">

      </footer>
    </div>
  </div>
<script>
function CardTypeValueCheck(value)
{
    if(value == 'PHYSICAL')
    {
        $('#card_type_div_id').show();
    } else {
        $('#card_type_div_id').hide();
    }
    
}
function selectedValue(selectedvalue)
{
    if(selectedvalue == 'Paused')
    {
        $('#open_div_id').hide();
        $('#allcard_div_id').hide();
        $('#closed_id').hide();
        $('#paused_id').show();
    }
    else if(selectedvalue == 'Open')
    {
        $('#closed_id').hide();
         $('#allcard_div_id').hide();
        $('#paused_id').hide();
         $('#open_div_id').show();
        
    }
    else if(selectedvalue == 'Closed')
    {
        $('#open_div_id').hide();
         $('#allcard_div_id').hide();
        $('#paused_id').hide();
          $('#closed_id').show();
    }
    else if(selectedvalue == 'All')
    {
        $('#open_div_id').hide();
        $('#paused_id').hide();
        $('#closed_id').hide();
        $('#allcard_div_id').show();
    }
}

function checkWalletLimit(value)
{
 if(value!='')
        { 
          let _token   = $('meta[name="csrf-token"]').attr('content');
           var amt = value;
            $.ajax({
                url: "<?php echo e(url('user')); ?>/check_wallet_balance",
                method: "POST",
                data: {amount:amt,_token:_token},
                success: function(data) { 
                    
                    if(data.result == '1')
                    {  
                        console.log(data);
                        //$('#checked').show();
                        $('#check_wal_bal_error').hide();
                        $('#check_wal_bal_msg').show();
                       $('#check_wal_bal_msg').html(data.response);
                       $("#create_card_btn_id").prop('disabled', false);
                    }
                },
                error:function(err){ 
                    if(err.responseJSON.result == '0') {
                         $('#check_wal_bal_msg').hide();
                         $('#check_wal_bal_error').show();
                         $("#check_wal_bal_error").html('Sorry, Insufficient balance in your wallet! <a href="<?php echo e(url("user/transfer")); ?>">Add Fund</a>');
                        $("#create_card_btn_id").prop('disabled', true);
                        
                    }
                }
            });
        }
}

$("#selectVehicle").change(function () {


   // alert($(this).find(':selected').attr('data-id'));
    //alert($(this).attr("data-id"));
 if($(this).find(':selected').attr('data-id')!='')
        { 
          let _token   = $('meta[name="csrf-token"]').attr('content');
           var country_id = $(this).find(':selected').attr('data-id');
            $.ajax({
                url: "<?php echo e(url('user')); ?>/select_country_by_state",
                method: "POST",
                data: {country_id:country_id,_token:_token},
                success: function(data) { 
                    
                    if(data.result == '1')
                    {  
                        console.log(data);
                        /*if(data.Data.length == 0)
                        {
                            $('#state_id').hide();
                            $('#state_id_input').html('<input type="text" class="form-control" name="postal_state">');
                        } else {
                            //$('#state_id_input').hide();
                            //$('#state_id_input').html('');
                            $('#state_id').html('');
                            $.each(data.Data, function(index, states) {
                                $('#state_id').append('<option >'+states.name +'</option>');
                                }); 
                        }
                        */
                        //$('#state_id_input').hide();
                            //$('#state_id_input').html('');
                            $('#state_id').html('');
                            $.each(data.Data, function(index, states) {
                                $('#state_id').append('<option value="'+states.iso_code+'">'+states.name +'</option>');
                                }); 
                    }
                },
                error:function(err){ 
                    if(err.responseJSON.result == '0') {
                        console.log(err);
                         //$('#check_wal_bal_msg').hide();
                         //$('#check_wal_bal_error').show();
                         //$("#check_wal_bal_error").html('Sorry, Insufficient balance in your wallet! <a href="<?php echo e(url("user/transfer")); ?>">Add Fund</a>');
                        //$("#create_card_btn_id").prop('disabled', true);
                        
                    }
                }
            });
        } 
        
}); 


var slider = document.getElementById("amount_id");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
   
  output.innerHTML = this.value;
  $('#amount_id').attr('value' , this.value);
  //alert(this.value);
  $("#amount_id").val(this.value);
   //checkWalletLimit(this.value);
}
</script>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/virtualcard/index.blade.php ENDPATH**/ ?>