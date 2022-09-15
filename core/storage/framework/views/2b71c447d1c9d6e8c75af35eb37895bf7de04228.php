<?php $__env->startSection('css'); ?>
<style>
   .fab
    {
        margin-top:7px;
        border-radius:20px;
        color:#171347;
      background-color: #ffffff;
        
    }
    
    .nav {
    /*display: -ms-flexbox;*/
    display: flex;
    /*-ms-flex-wrap: wrap;*/
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.social-icon.round a {
    border-radius: 3px;
}
.social-icon.si-30 a {
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    border: none;
    font-size: 16px;
    
}
.social-icon.si-30 a:hover
{
    background-color:#ffffff;
}

.social-icon.white a {
    /*background-color: #ffffff;*/
    /*color: #171347;*/
    /*border: 1px solid #ffffff;*/
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="section bg-no-repeat bg-right-center gray-bg" id="contact">
    <div class="container">
        <div class="row cont-us">
            <div class="col-lg-6 m-15px-tb">
                <div class="row md-m-25px-b m-40px-b cont-us">
                    <div class="col-lg-12">
                        <h3 class="h1 m-15px-b">Need a hand?</h3>
                        <p class="m-0px font-2">We are here for all of your business needs. Our team of caring experts are standing by. Send your questions today by filling out the form below. Someone from our team will get back to you shortly. Someone from our team will get back to you shortly.</p>
                    </div>
                </div>
                <form class="rd-mailform" method="post" action="<?php echo e(route('contact-submit')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input  type="text" name="name" placeholder="*Full Name" class="form-control" required>
                            </div>
                        </div>
                        
                         <div class="col-6">
                            <div class="form-group">
                                 <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                            <select class="form-control" name="country" required>
                                <option value="">*Select Country</option>
                                
                                <?php 
                                 $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
                                  
                                   
                                   
                                       // echo $query['city']." | ".$query['country']." | ".$val->ip_address;
                                    
                                foreach($countries as $country){?>
                                <option value="<?=$country->name?>"  <?php if(!empty($query['countryCode'])): ?><?=($country->iso_code == $query['countryCode']) ? 'selected' : ''?> <?php endif; ?>><?php echo e($country->name); ?></option>
                                <?php }?>
                            </select>
                            </div>
                        </div> 
                                              
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input  type="email" name="email" placeholder="*Email"  class="form-control" required>
                            </div>
                            </div> 
                            
                        <div class="col-sm-2">
                            <div class="form-group">
                                  <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                            <select class="form-control" name="prefix" required>
                                <option value="">*Select Country Code</option>
                                
                                <?php 
                                 $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
                                  
                                   
                                   
                                       // echo $query['city']." | ".$query['country']." | ".$val->ip_address;
                                    
                                foreach($countries as $country){?>
                                <option value="<?=$country->calling_code?>"  <?php if(!empty($query['countryCode'])): ?><?=($country->iso_code == $query['countryCode']) ? 'selected' : ''?> <?php endif; ?>><?php echo e($country->iso_code); ?> <?php echo e('('); ?><?php echo e('+'); ?><?php echo e($country->calling_code); ?><?php echo e(')'); ?></option>
                                <?php }?>
                            </select>
                            </div>
                        </div>  
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input  type="text" name="number" placeholder="*Mobile Number" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" maxlength="13" required>
                            </div>
                        </div> 
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input  type="text" name="company_name" placeholder="Company Name"  class="form-control">
                            </div>
                        </div>  
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!--input  type="text" name="mobile" placeholder="Your Industry*"  class="form-control" required-->
                                <select name="company_industry" required class="form-control" id="industry-717c46dc-3275-4157-a4e0-735ec420ec73___form-2" class="hs-input invalid error is-placeholder" name="industry" data-reactid=".hbspt-forms-0.1:$3.$industry.0">
                                     <option value="" disabled="" selected="" data-reactid=".hbspt-forms-0.1:$3.$industry.0.0">*Please Select Industry</option>
                                    <option>Gifts & Flowers</option>
                                   
                                    <option>Home & Garden</option>
                                    <option>Health & personal care</option>
                                    <option>Computer Accessories & Services</option>
                                    <option>Financial Services & Products</option>
                                    <option>Vehicle Sales</option>
                                    <option>Education</option>
                                    <option>Electronic & Communication</option>
                                    <option>Sports & Outdoor</option>
                                    <option value="Accelerator" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Accelerator">Accelerator</option><option value="Accountancy / Business Finance" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Accountancy / Business Finance">Accountancy / Business finance</option><option value="Acquirer" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Acquirer">Acquirer</option><option value="Agritech" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Agritech">Agritech</option><option value="Banking" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Banking">Banking</option><option value="Charitable giving" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Charitable giving">Charitable giving</option><option value="Consulting" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Consulting">Consulting</option><option value="Credit scoring" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Credit scoring">Credit scoring</option><option value="Cryptocurrency" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Cryptocurrency">Cryptocurrency</option><option value="Ecommerce / Retail" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Ecommerce / Retail">Ecommerce / Retail</option><option value="Education" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Education">Education</option><option value="Forex" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Forex">Forex</option><option value="Fraud Detection / KYC" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Fraud Detection / KYC">Fraud detection / KYC</option><option value="Government" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Government">Government</option><option value="iGaming" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$iGaming">iGaming</option><option value="Infrastructure as a service" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Infrastructure as a service">Infrastructure as a service</option><option value="Insights / Data" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Insights / Data">Insights / Data</option><option value="Insurance" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Insurance">Insurance</option><option value="Legal" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Legal">Legal</option><option value="Lending" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Lending">Lending</option><option value="Marketplace" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Marketplace">Marketplace</option><option value="Media / Association" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Media / Association">Media / Association</option><option value="Money Transfer" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Money Transfer">Remittance</option><option value="Payment Service Provider" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Payment Service Provider">Payment service provider</option><option value="PFMs (Personal Finance)" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$PFMs (Personal Finance)">PFMs (Personal Finance)</option><option value="Platform partner" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Platform partner">Platform partner</option><option value="Rental / Property" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Rental / Property">Rental / Property</option><option value="Rewards / Cashback" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Rewards / Cashback">Rewards / Cashback</option><option value="Security" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Security">Security</option><option value="Subscription management" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Subscription management">Subscription management</option><option value="Telecom" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Telecom">Telecom</option><option value="Trading" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Trading">Trading</option><option value="Travel" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Travel">Travel</option><option value="Utilities" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Utilities">Utilities</option><option value="Venture capital" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Venture capital">Venture capital</option><option value="Wealth / Investment" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Wealth / Investment">Wealth / Investment</option><option value="Other" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Other">Other</option></select>
                            </div>
                        </div>
                                              
                         <div class="col-sm-12">
                            <div class="form-group">
                                <textarea  type="text" name="message" placeholder="*Your Message" minlength="50" class="form-control" required></textarea>
                            </div>
                        </div>
                        
                       
                        <?php if($set->recaptcha==1): ?>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php echo app('captcha')->display(); ?>

                                    <?php if($errors->has('g-recaptcha-response')): ?>
                                        <span class="help-block">
                                            <?php echo e($errors->first('g-recaptcha-response')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    
                        <div class="col-12">
                            <button class="m-btn m-btn-dark m-btn-radius" type="submit" name="send">Get Started</button>
                        </div>
                        
                    </div>
                </form>
                <div class="h1 theme-color"></div>
                <!--<div class="media align-items-center p-10px-tb">-->
                <!--    <div class="icon-40 theme-bg-alt border-radius-50 theme-color">-->
                <!--        <i class="fas fa-phone"></i>-->
                <!--    </div>-->
                <!--    <div class="media-body p-15px-l">-->
                <!--        <h6 class="h4 m-0px"><?php echo e($set->mobile); ?></h6>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="media align-items-center p-10px-tb">
                    <div class="icon-40 theme-bg-alt border-radius-50 theme-color">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h6 class="h4 m-0px"><a href="mailto:<?php echo e($set->email); ?>"><?php echo e($set->email); ?></a></h6>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 m-15px-tb ml-auto" id="faq">
                <div class="accordion accordion-08 p10 border-radius-15 dark-bg white-color-light links-white">
                    <?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vfaq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="acco-group">
                        <a href="#" class="acco-heading"><?php echo e($vfaq->question); ?></a>
                        <div class="acco-des"><?php echo $vfaq->answer; ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<style>
    .cont-us
    {
        margin-top:50px;
    }
</style>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/front/contact-us.blade.php ENDPATH**/ ?>