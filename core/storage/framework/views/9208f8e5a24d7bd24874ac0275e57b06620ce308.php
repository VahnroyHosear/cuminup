    <?php $__env->startSection('content'); ?>
    <div class="container-fluid mt--6">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Congifure website')); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Website name')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="site_name" maxlength="200" value="<?php echo e($set->site_name); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Company email')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="email" name="email" value="<?php echo e($set->email); ?>" class="form-control" required>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Support email')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="email" name="support_email" value="<?php echo e($set->support_email); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Mobile')); ?></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="text" name="mobile" max-length="14" value="<?php echo e($set->mobile); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Website title')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" max-length="200" value="<?php echo e($set->title); ?>" class="form-control" required>
                                    </div>
                                </div>                         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw duration')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="withdraw_duration" max-length="200" value="<?php echo e($set->withdraw_duration); ?>" class="form-control" required>
                                    </div>
                                </div>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Short description')); ?></label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="site_desc" rows="4" class="form-control" required><?php echo e($set->site_desc); ?></textarea>
                                    </div>
                                </div>                           
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Tawk ID')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="livechat" class="form-control" value="<?php echo e($set->livechat); ?>">
                                    </div>
                                </div>           
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save Changes')); ?></button>
                                    </div>
                            </form>
                        </div>
                    </div>
                   <div class="card">
            <div class="card-header">
                <h3 class="mb-0"><?php echo e(__('Virtual Cards Settings')); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.settlement.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>                    
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Card Min Amount')); ?></label>
                        <div class="col-lg-10">
                            <input type="number"  pattern="[0-9]+(\.[0-9]{0,2})?%?" value="<?php echo e($set->virtual_card_min_amt); ?>" id="duration" name="vcard_min_amt" class="form-control" placeholder="1" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Card Max Amount')); ?></label>
                        <div class="col-lg-10">
                            <input type="number" name="vcard_max_amt" pattern="[0-9]+(\.[0-9]{0,2})?%?" value="<?php echo e($set->virtual_card_max_amt); ?>" id="duration" class="form-control" placeholder="1" required>
                        </div>
                    </div>
                   
                          
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>        
                    <div class="card">
            <div class="card-header">
                <h3 class="mb-0"><?php echo e(__('Settlement')); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.settlement.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>                    
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Duration')); ?></label>
                        <div class="col-lg-10">
                            <input type="number" name="duration" pattern="[0-9]+(\.[0-9]{0,2})?%?" value="<?php echo e($set->duration); ?>" id="duration" class="form-control" placeholder="1" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Period')); ?></label>
                        <div class="col-lg-10">
                            <select class="form-control select" name="period" id="period" data-fouc required>    
                                <option value="Day" 
                                    <?php if($set->period=='Day'): ?>
                                    <?php echo e(__('selected')); ?>

                                    <?php endif; ?>
                                    ><?php echo e(__('Day')); ?>

                                </option>                                         
                                <option value="Week" 
                                    <?php if($set->period=='Week'): ?>
                                    <?php echo e(__('selected')); ?>

                                    <?php endif; ?>
                                    ><?php echo e(__('Week')); ?>

                                </option>                                         
                                <option value="Month" 
                                    <?php if($set->period=='Month'): ?>
                                    <?php echo e(__('selected')); ?>

                                    <?php endif; ?>
                                    ><?php echo e(__('Month')); ?>

                                </option>                                         
                                <option value="Year" 
                                    <?php if($set->period=='Year'): ?>
                                    <?php echo e(__('selected')); ?>

                                    <?php endif; ?>
                                    ><?php echo e(__('Year')); ?>

                                </option>                                       
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Next Settlement')); ?></label>
                        <div class="col-lg-10">
                            <input type="text" readonly value='<?php echo e(date("Y/m/d", strtotime($set->next_settlement))); ?>' class="form-control">
                        </div>
                    </div>        
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>                   
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Features')); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.features.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>   
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->kyc==1): ?>
                                                <input type="checkbox" name="kyc" id="customCheckLogin1" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="kyc" id="customCheckLogin1"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin1">
                                            <span class="text-muted"><?php echo e(__('Kyc')); ?></span>     
                                            </label>
                                        </div> 
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->mobile_verification==1): ?>
                                                <input type="checkbox" name="mobile_verification" id="customCheckLogin3" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="mobile_verification"id="customCheckLogin3"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin3">
                                            <span class="text-muted"><?php echo e(__('Mobile verification')); ?></span>     
                                            </label>
                                        </div> 
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->email_verification==1): ?>
                                                <input type="checkbox" name="email_activation" id="customCheckLogin2" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="email_activation"id="customCheckLogin2"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin2">
                                            <span class="text-muted"><?php echo e(__('Email verification')); ?></span>     
                                            </label>
                                        </div>                       
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->email_notify==1): ?>
                                                <input type="checkbox" name="email_notify" id="customCheckLogin3" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="email_notify"id="customCheckLogin3"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin3">
                                            <span class="text-muted"><?php echo e(__('Email notify')); ?></span>     
                                            </label>
                                        </div>  
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->registration==1): ?>
                                                <input type="checkbox" name="registration" id="customCheckLogin4" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="registration"id="customCheckLogin4"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin4">
                                            <span class="text-muted"><?php echo e(__('Registration')); ?></span>     
                                            </label>
                                        </div>                                    
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->subscription==1): ?>
                                                <input type="checkbox" name="subscription" id="customCheckLogin13" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="subscription"id="customCheckLogin13"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin13">
                                            <span class="text-muted"><?php echo e(__('Subscription')); ?></span>     
                                            </label>
                                        </div>                                                                                                                                                                                           
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->recaptcha==1): ?>
                                                <input type="checkbox" name="recaptcha" id="customCheckLogin6" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="recaptcha"id="customCheckLogin6"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin6">
                                            <span class="text-muted"><?php echo e(__('Recaptcha')); ?></span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->merchant==1): ?>
                                                <input type="checkbox" name="merchant" id="customCheckLogin7" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="merchant" id="customCheckLogin7"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin7">
                                            <span class="text-muted"><?php echo e(__('Merchant')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->transfer==1): ?>
                                                <input type="checkbox" name="transfer" id="customCheckLogin8" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="transfer" id="customCheckLogin8"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin8">
                                            <span class="text-muted"><?php echo e(__('Transfer')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->request_money==1): ?>
                                                <input type="checkbox" name="request_money" id="customCheckLogin9" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="request_money" id="customCheckLogin9"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin8">
                                            <span class="text-muted"><?php echo e(__('Request Money')); ?></span>     
                                            </label>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->invoice==1): ?>
                                                <input type="checkbox" name="invoice" id="customCheckLogin10" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="invoice" id="customCheckLogin10"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin10">
                                            <span class="text-muted"><?php echo e(__('Invoice')); ?></span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->store==1): ?>
                                                <input type="checkbox" name="store" id="customCheckLogin10" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="store" id="customCheckLogin10"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin10">
                                            <span class="text-muted"><?php echo e(__('Store')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->donation==1): ?>
                                                <input type="checkbox" name="donation" id="customCheckLogin11" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="donation" id="customCheckLogin11"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin11">
                                            <span class="text-muted"><?php echo e(__('Donation')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->single==1): ?>
                                                <input type="checkbox" name="single" id="customCheckLogin12" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="single" id="customCheckLogin12"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin12">
                                            <span class="text-muted"><?php echo e(__('Single Charge')); ?></span>     
                                            </label>
                                        </div>
                                    </div>
                                </div>         
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save Changes')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>                   
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0"><?php echo e(__('Charges')); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.charges.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Transfer/Request')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="transfer_charge" value="<?php echo e($set->transfer_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                                                                                                                                                
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw')); ?><span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="withdraw_charge" value="<?php echo e($set->withdraw_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                                       
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Merchant')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="merchant_charge" value="<?php echo e($set->merchant_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                              
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Invoice')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="invoice_charge" value="<?php echo e($set->invoice_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                            
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Product Order')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="product_charge" max-length="10" value="<?php echo e($set->product_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Single Charge')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="single_charge" max-length="10" value="<?php echo e($set->single_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Donation')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="donation_charge" max-length="10" value="<?php echo e($set->donation_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Subscription')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="subscription_charge" max-length="10" value="<?php echo e($set->subscription_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>  
                                    
                                    <label class="col-form-label col-lg-2">Shipping Commission <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="shipping_commission" max-length="10" value="<?php echo e($set->shipping_commission); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div> 
                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw Limit')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" name="withdraw_limit" value="<?php echo e($set->withdraw_limit); ?>" class="form-control" required>
                                        </div>
                                    </div>  
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Balance on Signup ')); ?><span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" name="bal" value="<?php echo e($set->balance_reg); ?>" class="form-control" required>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Minimum Transfer')); ?><span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" name="min_transfer" value="<?php echo e($set->min_transfer); ?>" class="form-control" required>
                                        </div>
                                    </div>                           
                                </div>                    
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save Changes')); ?></button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0"><?php echo e(__('Change Password')); ?></h3>
                        </div>
                        <!--div class="card-body">
                            <form action="<?php echo e(route('admin.account.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"><?php echo e(__('Username')); ?></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="username" value="<?php echo e($val->username); ?>" class="form-control">
                                        </div>
                                    </div>                         
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"><?php echo e(__('Password')); ?></label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password"  class="form-control" required>
                                        </div>
                                    </div>          
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                                </div>
                            </form>
                        </div-->
                          <div class="card-body ">
                    <form action="<?php echo e(route('admin.account.update')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Current Password')); ?></label>
                        <div class="col-lg-10">
                          <input type="password" name="current_password" class="form-control" maxnlength="30" placeholder="Your Current Password" required>
                        </div>
                      </div> 
                      <input type="hidden" name="email" value="getvirtualcard21@gmail.com">
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('New Password')); ?></label>
                        <div class="col-lg-10">
                          <input type="password" name="new_password" id="inputPassword" onkeyup="passwordStrengthCheck()" class="form-control" maxlength="30" placeholder="Your New Password" required>
                        </div>
                        <div id="passwordAlertDiv" style="display:none;margin-left:195px;">
        				<span id="passwordalertoutput" class="password-strength-status" style="font-size: 12px;"></span>
        				<span class="password-strength-status2"></span>
        				<span class="password-strength-status3"></span>
				      </div>
                      </div> 
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Confirm Password')); ?></label>
                        <div class="col-lg-10">
                          <input type="password" name="confirm_password" id="password-confirm" class="form-control" manlength="30" placeholder="Confirm New Password" onkeyup="ConfirmpasswordCheck()" required>
                        </div>
                        <span id="confirm_pwd_error" style="font-size: 12px;margin-left:195px;"></span>
                      </div>             
                      <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm" id="continue_click"><?php echo e(__('Change Password')); ?></button>
                      </div>
                    </form>
                  </div>
                    </div> 
                </div>    
            </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
   function passwordStrengthCheck() { 
	$('#passwordAlertDiv').show();
	var number = '[0-9]';
	var alphabets = '[a-zA-Z]';
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if ($('#inputPassword').val().length > 7 && $('#inputPassword').val().match(alphabets) && $('#inputPassword').val().match(number) && $('#inputPassword').val().match(special_characters)) {
		//$('#password-strength-status').removeClass();
		//$('#password-strength-status').addClass('weak-password');
		$('.password-strength-status').css('color','#2d4ec8');
		$('.password-strength-status').html("(Hints- at least 8 characters. Alphanumeric & special character-john123$%&*@)");
		$('#continue_click').prop('disabled', false);
		$('#inputPassword').attr('type','password');
	} else {
		$('.password-strength-status').css('color','red');
		$('.password-strength-status').html("(Hints- at least 8 characters. Alphanumeric & special character-john123$%&*@)");
	     $('#continue_click').prop('disabled', true);
		
	}
	
	if($('#password-confirm').val() !='')
    {
        if($('#inputPassword').val() == $('#password-confirm').val())
        {
            
             $('#confirm_pwd_error').css('color','#2d4ec8');
	      	$('#confirm_pwd_error').html("Confirm password matched");
		//$('.password-strength-status3').html("");
            $('#continue_click').prop('disabled', false);
        } else {
             $('#confirm_pwd_error').css('color','red');
	      	$('#confirm_pwd_error').html("Confirm password not matched!");
            $('#continue_click').prop('disabled', true);
        }
    }

}
               
function ConfirmpasswordCheck()
{
    
    if($('#inputPassword').val() !='')
    {
        if($('#inputPassword').val() == $('#password-confirm').val())
        {
            
             $('#confirm_pwd_error').css('color','#2d4ec8');
	      	$('#confirm_pwd_error').html("Confirm password matched");
		//$('.password-strength-status3').html("");
            $('#continue_click').prop('disabled', false);
        } else {
             $('#confirm_pwd_error').css('color','red');
	      	$('#confirm_pwd_error').html("Confirm password not matched!");
            $('#continue_click').prop('disabled', true);
        }
    }
}
   
</script>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>