<!doctype html>
<html class="no-js" lang="en">
    <head>
        <base href="<?php echo e(url('/')); ?>"/>
        <title><?php echo e($title); ?> | <?php echo e($set->site_name); ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="robots" content="index, follow">
        <meta name="apple-mobile-web-app-title" content="<?php echo e($set->site_name); ?>"/>
        <meta name="application-name" content="<?php echo e($set->site_name); ?>"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="description" content="<?php echo e($set->site_desc); ?>" />
        <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="apple-touch-icon" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/css/sweetalert.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/nucleo/css/nucleo.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/css/argon.css?v=1.1.0" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/css/sweetalert.css" type="text/css">
        <link href="<?php echo e(url('/')); ?>/asset/fonts/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/static/style/master.css" type="text/css">
        
        <!--Sandeep--Code Start-->
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/font-awesome/css/all.min.css" rel="stylesheet" media >
        <!--Sandeep--Code End-->
        
        <style>
           .footer .list-unstyled li a:hover {
    color: #ffc107;
}
.social-icon.si-30 a {
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
        border: none;
    font-size: 16px;
    background: white;
}







        </style>
        <!--<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />-->

         <?php echo $__env->yieldContent('css'); ?>
    </head>
<!-- header begin-->
  <body class="bg-future">
      
      <!--Old Header start-->
      
    <!--<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-dark">-->
    <!--  <div class="container">-->
    <!--    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">-->
    <!--      <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>">-->
    <!--    </a>-->
    <!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">-->
    <!--      <span class="navbar-toggler-icon"></span>-->
    <!--    </button>-->
    <!--    <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">-->
    <!--      <div class="navbar-collapse-header">-->
    <!--        <div class="row">-->
    <!--          <div class="col-6 collapse-brand">-->
    <!--            <a href="<?php echo e(url('/')); ?>">-->
    <!--              <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>">-->
    <!--            </a>-->
    <!--          </div>-->
    <!--          <div class="col-6 collapse-close">-->
    <!--            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">-->
    <!--              <span></span>-->
    <!--              <span></span>-->
    <!--            </button>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <ul class="navbar-nav align-items-lg-center ml-lg-auto">-->
    <!--        <li class="nav-item">-->
    <!--          <a href="<?php echo e(route('about')); ?>" class="nav-link">-->
    <!--          <span class="nav-link-inner--text text-dark">Why Cuminup</span>-->
    <!--          </a>-->
    <!--        </li> -->
    <!--        <li class="nav-item dropdown">-->
    <!--            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
    <!--              <?php echo e(__('Features')); ?>-->
    <!--            </a>-->
    <!--            <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
    <!--                <a class="dropdown-item" href="<?php echo e(url('/prepaid-card')); ?>">Prepaid card</a>-->
    <!--                <a class="dropdown-item" href="<?php echo e(url('/e-invoicing-solution')); ?>"><?php echo e(__('E-invoicing')); ?></a>-->
    <!--                <a class="dropdown-item" href="<?php echo e(url('/payment-solution')); ?>"><?php echo e(__('Payment Solution')); ?></a>-->
    <!--                <a class="dropdown-item" href="<?php echo e(url('/online-selling-software')); ?>"><?php echo e(__('Online Selling')); ?></a>-->
    <!--                <a class="dropdown-item" href="<?php echo e(url('/ewallet-solution')); ?>"><?php echo e(__('Ewallet System')); ?></a>-->
    <!--                <a class="dropdown-item" href="<?php echo e(url('/subscription-management-software-system')); ?>"><?php echo e(__('Subscription Management')); ?></a>-->
    <!--            </div>-->
    <!--        </li>-->
    <!--        <li class="nav-item">-->
    <!--          <a href="<?php echo e(url('/costing')); ?>" class="nav-link">-->
    <!--          <span class="nav-link-inner--text text-dark">Fees & Costing</span>-->
    <!--          </a>-->
    <!--        </li>    -->
    <!--        <li class="nav-item">-->
    <!--          <a href="<?php echo e(url('/')); ?>#contact" class="nav-link">-->
    <!--          <span class="nav-link-inner--text text-dark">Get in touch</span>-->
    <!--          </a>-->
    <!--        </li>  -->
    <!--        <li class="nav-item d-none d-lg-block ml-lg-4">-->
    <!--          <?php if(url()->current()==route('admin.loginForm')): ?>-->
    <!--          <?php else: ?>-->
    <!--            <?php if(Auth::guard('user')->check()): ?>-->
    <!--              <?php if(route('2fa')==url()->current() || route('user.authorization')==url()->current()): ?> -->
    <!--                <a href="<?php echo e(route('user.logout')); ?>" class="btn btn-neutral">-->
    <!--                  <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Logout')); ?></span>-->
    <!--                </a>-->
    <!--              <?php else: ?>-->
    <!--              <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));  ?>-->
    <!--              <?php if($uriSegments[2] == 'login_with_otp'): ?>-->
    <!--                <a href="<?php echo e(route('user.logout')); ?>" class="btn btn-neutral">-->
    <!--                  <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Logout')); ?></span>-->
    <!--                </a>-->
    <!--            <?php else: ?>-->
    <!--            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-neutral">-->
    <!--                  <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Dashboard')); ?></span>-->
    <!--                </a>-->
    <!--            <?php endif; ?>    -->
    <!--              <?php endif; ?>-->
    <!--            <?php else: ?>-->
    <!--            <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>-->
    <!--            <?php if($uriSegments[1] == 'register'): ?>-->
    <!--              <a href="<?php echo e(route('login')); ?>" class="btn btn-neutral">-->
    <!--                <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Login')); ?></span>-->
    <!--              </a>-->
    <!--            <?php else: ?>-->
    <!--                <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>-->
    <!--                <?php if($uriSegments[1] == 'user-reupload'): ?>-->
    <!--                <a href="<?php echo e(route('login')); ?>" class="btn btn-neutral">-->
    <!--                    <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Login')); ?></span>-->
    <!--                  </a>-->
    <!--                <?php else: ?>-->
    <!--                <a href="<?php echo e(route('register')); ?>" class="btn btn-neutral">-->
    <!--                    <span class="nav-link-inner--text font-weight-500"><?php echo e(__('SignUp')); ?></span>-->
    <!--                  </a>-->
    <!--                <?php endif; ?>  -->
    <!--            <?php endif; ?>-->
                                         
    <!--            <?php endif; ?>-->
    <!--          <?php endif; ?>-->
    <!--        </li>-->
    <!--      </ul>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</nav>-->
    
    <!--old header END-->
    
    
    <!--New Header--Start-->
    <header class="header-nav header-dark">
        <div class="fixed-header-bar">
            <!-- Header Nav -->
            <div class="navbar navbar-main navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <img alt="" title="" src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse navbar-collapse-overlay" id="navbar-main-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item mm-in px-dropdown">
                                <a class="nav-link" href="#"><?php echo e(__('Features')); ?></a>
                                <!--<i class="fa fa-angle-down px-nav-toggle"></i>-->
                                <ul class="px-dropdown-menu mm-dorp-in">
                                   <li><a href="<?php echo e(url('/prepaid-card')); ?>">Prepaid card</a></li>
                                  <li><a href="<?php echo e(url('/e-invoicing-solution')); ?>"><?php echo e(__('E-invoicing')); ?></a></li>
                                    <li><a href="<?php echo e(url('/payment-solution')); ?>"><?php echo e(__('Payment Solution')); ?></a></li>
                                    <li><a href="<?php echo e(url('/online-selling-software')); ?>"><?php echo e(__('Online Selling')); ?></a></li>
                                    <li><a href="<?php echo e(url('/ewallet-solution')); ?>"><?php echo e(__('Ewallet System')); ?></a></li>
                                    <li><a href="<?php echo e(url('/subscription-management-software-system')); ?>"><?php echo e(__('Subscription Management')); ?></a></li>
                                    <!--<li><a href="<?php echo e(url('/chatapps')); ?>">Chat / Messenger Apps</a></li>-->
                                    <li><a href="<?php echo e(url('/enterprise-payment-solution')); ?>">Custom eCommerce Website Solution</a></li>
                                </ul>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('enterprise-payment-solution')); ?>">Enterprise</a>
                            </li>
                            <!--li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('about')); ?>">Why Us</a>
                            </li-->
                            
                               
                                
                                <ul class="px-dropdown-menu mm-dorp-in">
                                   
                                   
                                    
                                    
                                </ul>
                            </li>
                         
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/costing')); ?>">Pricing</a>
                            </li>
                            
                             <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/integration')); ?>">Integration</a>
                            </li>
                            
                             <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/')); ?>#contact">Get in touch</a>
                            </li>
                         
                            
                                                   
                            
                            <?php if(Auth::guard('user')->check()): ?>
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="<?php echo e(route('user.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Signup')); ?></a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <?php if(Auth::guard('user')->check()): ?>
                        <a href="<?php echo e(route('user.dashboard')); ?>" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l"><?php echo e(__('Dashboard')); ?></a>
                        <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l"><?php echo e(__('Login')); ?></a>
                         <a href="<?php echo e(route('register')); ?>" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd1 m-btn-sm m-20px-l">Free Signup</a>
    <!--                     <a href="https://ach.cuminup.com" target="_blank" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd1 m-btn-sm m-20px-l" style="    background: #00c685;-->
    <!--border: 2px solid #00c685;">Open ACH Account</a>-->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Header Nav -->
        </div>
    </header>
    
<!-- New header End -->

<?php echo $__env->yieldContent('content'); ?>


<!-- footer begin -->
<footer class="dark-bg footer">
        <div class="footer-top border-style top light">
            <div class="container">
                <div class="row">
                
                    
                    <div class="col-lg-4 m-15px-tb">
                        <h5 class="white-color footer-title">
                               <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->dark); ?>" title="" alt="" style="background: white; border-radius: 5px; padding: 5px;">
                        </h5>
                       
                        <p class="white-color-light">
                        <!--<?php echo e($set->title); ?>-->
                        Virtual, Physical Prepaid Debit Card, Payment and Ewallet Solution Company in USA
                        </p>
                        <div class="social-icon si-30 white round nav social-icon fab-footer">
                            <?php $__currentLoopData = $social; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socials): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($socials->value)): ?>
                                <a href="<?php echo e($socials->value); ?>"><i class="fab fa-<?php echo e($socials->type); ?>"></i></a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-4 col-sm-4 ml-lg-auto  m-15px-tb" style="padding-left:30px">
                        <h5 class="white-color footer-title">
                            <?php echo e(__('Quick links')); ?>

                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            
                            <!--li><a href="<?php echo e(url('/')); ?>#contact"><?php echo e(__('Contact')); ?></a></li>
                             <li>
                                <a href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a-->
                            </li>
                            <li><a href="<?php echo e(url('/e-invoicing-solution')); ?>"><?php echo e(__('E-invoicing Solution')); ?></a></li>
                            <li><a href="<?php echo e(url('/payment-solution')); ?>"><?php echo e(__('Payment Solution')); ?></a></li>
                            <li><a href="<?php echo e(url('/online-selling-software')); ?>"><?php echo e(__('Online Selling Solution')); ?></a></li>
                            <li><a href="<?php echo e(url('/ewallet-topup-software')); ?>"><?php echo e(__('Ewallet Top-up Solution')); ?></a></li>
                            <li><a href="<?php echo e(url('/subscription-management-software-system')); ?>"><?php echo e(__('Subscription Solution')); ?></a></li>
                            <!--<li><a href="<?php echo e(route('user.merchant')); ?>"><?php echo e(__('Merchant Services')); ?></a></li>-->
                            <!--<li><a href="<?php echo e(route('user.invoice')); ?>"><?php echo e(__('Send Invoices')); ?></a></li>-->
                            <!--<li><a href="<?php echo e(route('user.product')); ?>"><?php echo e(__('Sell Products')); ?></a></li>-->
                        </ul>
                    </div>
                    <div class="col-lg-2 col-4 col-sm-4  m-15px-tb">
                        <h5 class="white-color footer-title">
                        <?php echo e(__('Company')); ?>

                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li><a href="<?php echo e(route('about')); ?>">Why CuminUp</a></li>
                            <li><a href="<?php echo e(route('terms')); ?>"><?php echo e(__('Terms of Use')); ?></a></li>
                            <li><a href="<?php echo e(route('privacy')); ?>"><?php echo e(__('Privacy Policy')); ?></a></li>
                            <li><a href="https://www.cuminup.com/page/19">BSA and AML Policy</a></li>
                            <li><a href="<?php echo e(url('/security')); ?>">Security</a></li>
                            <?php if(count($faq)>0): ?>
                            <li><a href="<?php echo e(url('/')); ?>#faq"><?php echo e(__('FAQs')); ?></a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo e(url('e-signfront')); ?>">E-Sign Consent</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-4 col-sm-4  m-15px-tb">
                        <h5 class="white-color footer-title">
                          Services
                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <!--<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vpages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                            <!--    <?php if(!empty($vpages)): ?>-->
                            <!--<li><a href="<?php echo e(url('/')); ?>/page/<?php echo e($vpages->id); ?>"><?php echo e($vpages->title); ?></a></li>-->
                            <!--    <?php endif; ?>-->
                            <!--<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                            
                                   
                                    <!--<li><a href="<?php echo e(url('/productpaymentform')); ?>">Product payment Form</a></li>-->
                                    <!--<li><a href="<?php echo e(url('/chatapps')); ?>">Chat / Messenger Apps</a></li>-->
                                    
                                    <li><a href="<?php echo e(url('/secure-card')); ?>">Secure Card</a></li>
                                    <li><a href="<?php echo e(url('/virtual-card-number')); ?>">Virtual Card Number</a></li>
                                    <li><a href="<?php echo e(url('/virtual-card')); ?>">Virtual Card</a></li>
                                    <li><a href="<?php echo e(url('/ewallet-solution')); ?>">eWallet Solution</a></li>
                                    <li><a href="<?php echo e(url('/physical-card')); ?>">Physical Card</a></li>
                                    <li><a href="<?php echo e(url('/prepaid-card')); ?>">Prepaid card</a></li>
                                    
                                    <!--<li><a href="<?php echo e(url('/ecomsolution')); ?>">Custom eCommerce Solution</a></li>-->
                                    <!--<li><a href="<?php echo e(url('/costing')); ?>">Fees & Costing</a></li>-->
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="footer-bottom border-style top light foot-bottom" style=" padding:10px;">
            <div class="container">
                <div class="row">
                        
                    <p style="color: white; font-size: 12px;">
                        <strong>Disclaimers</strong>-Banking services are fully managed by Linsyx Technologies Inc. and it's strategic partner Greentech Fin Inc. By continuing using the website, you confirm your agreement with the above-mentioned statements and documents. 
                                If you are interested in particular services, please contact the sales team for more information about the servicing company.

                    </p>
                    
                    <div class="col-md-12  col-lg-12 text-center text-md-left m-5px-tb footer-reserved" style="">
                        <!--<p class="m-0px font-small white-color-light" style="margin-left:-15px!important"><?php echo e($set->site_name); ?>  &copy; <?php echo e(date('Y')); ?>. <?php echo e(__('All Rights Reserved.')); ?></p>-->
                        <p class="m-0px font-small white-color-light right-section" style="text-align: center;"><?php echo e($set->site_name); ?>  &copy; <?php echo e(date('Y')); ?>. <?php echo e(__('All Rights Reserved.')); ?></p>
                    </div>
                    
                    <div class="col-md-6 m-5px-tb">
                    </div>
                </div>
                
                <div class="row" >
                        <!--<div class="col-md-12 text-center text-md-left m-5px-tb ssl" style="padding-left:510px;">-->
                        <div class="col-md-12  text-center text-md-left m-5px-tb ssl" style="text-align: center !important;">
                      <script type="text/javascript"> //<![CDATA[
                      var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
                      document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
                    //]]></script>
    
            
                    <script language="JavaScript" type="text/javascript">
                      TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_md_167x42.png", "POSDV", "none" );
                    </script>
                        </div>
                </div>
        
         
            </div>
             
        </div>
  
              
        
     
    </footer>
    
    
    
    
    
    
    
    
    
    
    
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/<?php echo e($set->tawk_id); ?>/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/js/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/clipboard/dist/clipboard.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/select2/dist/js/select2.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/nouislider/distribute/nouislider.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/quill/dist/quill.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/dropzone/dist/min/dropzone.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/js/argon.js?v=1.1.0"></script>
    <script src="<?php echo e(url('/')); ?>/asset/dashboard/js/demo.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/asset/js/sweetalert.js"></script>
    
   
</body>

</html>
    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(session('success')): ?>
    <script>
        $(document).ready(function () {
            swal("Success!", "<?php echo e(session('success')); ?>", "success");
        });
    </script>
<?php endif; ?>

<?php if(session('alert')): ?>
    <script>
        $(document).ready(function () {
            swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");
        });
    </script>
<?php endif; ?>
<script>
            <?php if(Session::has('message')): ?>
    var type = "<?php echo e(Session::get('alert-type','info')); ?>";
    switch (type) {
        case 'info':
            toastr.info("<?php echo e(Session::get('message')); ?>");
            break;
        case 'warning':
            toastr.warning("<?php echo e(Session::get('message')); ?>");
            break;
        case 'success':
            toastr.success("<?php echo e(Session::get('message')); ?>");
            break;
        case 'error':
            toastr.error("<?php echo e(Session::get('message')); ?>");
            break;
    }
    <?php endif; ?>
</script>


<script>
     $(document).ready(function() {
            $('.select2').select2();
        });
</script>
<?php if($set->recaptcha==1): ?>
  <?php echo NoCaptcha::renderJs(); ?>

<?php endif; ?><?php /**PATH /home/cuminup/public_html/core/resources/views/loginlayout.blade.php ENDPATH**/ ?>