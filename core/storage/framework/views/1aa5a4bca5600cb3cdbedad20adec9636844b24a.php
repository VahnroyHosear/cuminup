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
        
        <!--<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />-->

         <?php echo $__env->yieldContent('css'); ?>
    </head>
<!-- header begin-->
  <body class="bg-future">
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
          <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="<?php echo e(url('/')); ?>">
                  <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item">
              <a href="<?php echo e(route('about')); ?>" class="nav-link">
              <span class="nav-link-inner--text text-dark">Why Cuminup</span>
              </a>
            </li> 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo e(__('Features')); ?>

                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo e(url('/prepaid-card')); ?>">Prepaid card</a>
                    <a class="dropdown-item" href="<?php echo e(url('/e-invoicing-solution')); ?>"><?php echo e(__('E-invoicing')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(url('/payment-solution')); ?>"><?php echo e(__('Payment Solution')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(url('/online-selling-software')); ?>"><?php echo e(__('Online Selling')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(url('/ewallet-solution')); ?>"><?php echo e(__('Ewallet System')); ?></a>
                    <a class="dropdown-item" href="<?php echo e(url('/subscription-management-software-system')); ?>"><?php echo e(__('Subscription Management')); ?></a>
                </div>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/costing')); ?>" class="nav-link">
              <span class="nav-link-inner--text text-dark">Fees & Costing</span>
              </a>
            </li>    
            <li class="nav-item">
              <a href="<?php echo e(url('/')); ?>#contact" class="nav-link">
              <span class="nav-link-inner--text text-dark">Get in touch</span>
              </a>
            </li>  
            <li class="nav-item d-none d-lg-block ml-lg-4">
              <?php if(url()->current()==route('admin.loginForm')): ?>
              <?php else: ?>
                <?php if(Auth::guard('user')->check()): ?>
                  <?php if(route('2fa')==url()->current() || route('user.authorization')==url()->current()): ?> 
                    <a href="<?php echo e(route('user.logout')); ?>" class="btn btn-neutral">
                      <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Logout')); ?></span>
                    </a>
                  <?php else: ?>
                  <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));  ?>
                  <?php if($uriSegments[2] == 'login_with_otp'): ?>
                    <a href="<?php echo e(route('user.logout')); ?>" class="btn btn-neutral">
                      <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Logout')); ?></span>
                    </a>
                <?php else: ?>
                <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-neutral">
                      <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Dashboard')); ?></span>
                    </a>
                <?php endif; ?>    
                  <?php endif; ?>
                <?php else: ?>
                <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>
                <?php if($uriSegments[1] == 'register'): ?>
                  <a href="<?php echo e(route('login')); ?>" class="btn btn-neutral">
                    <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Login')); ?></span>
                  </a>
                <?php else: ?>
                    <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>
                    <?php if($uriSegments[1] == 'user-reupload'): ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-neutral">
                        <span class="nav-link-inner--text font-weight-500"><?php echo e(__('Login')); ?></span>
                      </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-neutral">
                        <span class="nav-link-inner--text font-weight-500"><?php echo e(__('SignUp')); ?></span>
                      </a>
                    <?php endif; ?>  
                <?php endif; ?>
                                         
                <?php endif; ?>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- header end -->

<?php echo $__env->yieldContent('content'); ?>


<!-- footer begin -->
<footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
          <aside id="text-2" class="column-1_3 widget widget_text"><h5 class="widget_title" style="font-size: 1.250em;
    color: white;">About Us</h5>		
          <div class="textwidget">
              <p style="text-align: left;font-size: 15px;">Virtual Card is the leading financial establishment providing high-quality international banking services.
              We are always ready to partner with you by offering full financial support to our clients worldwide.</p>
</div>
		</aside>
		</div>
		<div class="col-xl-3">
		    <aside id="text-3" class="column-1_3 widget widget_text"><h5 class="widget_title" style="font-size: 1.250em;
    color: white;">Quick Access</h5>			<div class="textwidget">
        <ul style="    text-align: left;
    font-size: 14px;
    padding-left: 16px;">
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/virtual-card-number/">Virtual Card Number</a></span></li>
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/secure-card/">Secure Card</a></span></li>
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/developers/">Developers</a></span></li>
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/security/">Security</a></span></li>
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/cookie-policy-uk/">Cookies Policy</a></span></li>
</ul>
</div>
		</aside>
		</div>
        <!--<div class="col-xl-4">-->
        <!--  <div class="copyright text-center text-xl-left text-dark"  style="color:#aeb1be!important">-->
        <!--  <a href="<?php echo e(url('/')); ?>" class="ml-1 text-future"><?php echo e($set->site_name); ?></a>  &copy; <?php echo e(date('Y')); ?>. <?php echo e(__('All Rights Reserved.')); ?> -->
        <!--  </div>-->
        <!--</div>-->
        <div class="col-xl-3">
          <aside id="text-3" class="column-1_3 widget widget_text"><h5 class="widget_title" style="font-size: 1.250em;
    color: white;">Informations</h5>		
          <div class="textwidget">
              <ul style="    text-align: left;
    font-size: 14px;
    padding-left: 16px;">

<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/faq/">FAQ</a></span></li>
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/terms-conditions/">Terms &amp; Conditions</a></span></li>
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/privacy-policy/">Privacy Policy</a></span></li>
<li><span style="color: #abacba;"><a style="color: #abacba;" href="https://getvirtualcard.co.uk/contacts/">Contact Us</a></span></li>


</ul>
</div>
		</aside>
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

<?php endif; ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/loginlayout.blade.php ENDPATH**/ ?>