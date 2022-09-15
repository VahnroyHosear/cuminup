<!doctype html>
<html class="no-js" lang="en">
    <head>
        <base href="{{url('/')}}"/>
        <title>{{ $title }} | {{$set->site_name}}</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="robots" content="index, follow">
        <meta name="apple-mobile-web-app-title" content="{{$set->site_name}}"/>
        <meta name="application-name" content="{{$set->site_name}}"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="description" content="{{$set->site_desc}}" />
        <link rel="shortcut icon" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="apple-touch-icon" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="apple-touch-icon" sizes="72x72" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="stylesheet" href="{{url('/')}}/asset/css/sweetalert.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/nucleo/css/nucleo.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/css/argon.css?v=1.1.0" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/css/sweetalert.css" type="text/css">
        <link href="{{url('/')}}/asset/fonts/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/static/style/master.css" type="text/css">
        
        <!--Sandeep--Code Start-->
        <link href="{{url('/')}}/asset/static/plugin/font-awesome/css/all.min.css" rel="stylesheet" media >
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

         @yield('css')
    </head>
<!-- header begin-->
  <body class="bg-future">
      
      <!--Old Header start-->
      
    <!--<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-dark">-->
    <!--  <div class="container">-->
    <!--    <a class="navbar-brand" href="{{url('/')}}">-->
    <!--      <img src="{{url('/')}}/asset/{{$logo->image_link}}">-->
    <!--    </a>-->
    <!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">-->
    <!--      <span class="navbar-toggler-icon"></span>-->
    <!--    </button>-->
    <!--    <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">-->
    <!--      <div class="navbar-collapse-header">-->
    <!--        <div class="row">-->
    <!--          <div class="col-6 collapse-brand">-->
    <!--            <a href="{{url('/')}}">-->
    <!--              <img src="{{url('/')}}/asset/{{$logo->image_link}}">-->
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
    <!--          <a href="{{route('about')}}" class="nav-link">-->
    <!--          <span class="nav-link-inner--text text-dark">Why Cuminup</span>-->
    <!--          </a>-->
    <!--        </li> -->
    <!--        <li class="nav-item dropdown">-->
    <!--            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
    <!--              {{__('Features')}}-->
    <!--            </a>-->
    <!--            <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
    <!--                <a class="dropdown-item" href="{{url('/prepaid-card')}}">Prepaid card</a>-->
    <!--                <a class="dropdown-item" href="{{url('/e-invoicing-solution')}}">{{__('E-invoicing')}}</a>-->
    <!--                <a class="dropdown-item" href="{{url('/payment-solution')}}">{{__('Payment Solution')}}</a>-->
    <!--                <a class="dropdown-item" href="{{url('/online-selling-software')}}">{{__('Online Selling')}}</a>-->
    <!--                <a class="dropdown-item" href="{{url('/ewallet-solution')}}">{{__('Ewallet System')}}</a>-->
    <!--                <a class="dropdown-item" href="{{url('/subscription-management-software-system')}}">{{__('Subscription Management')}}</a>-->
    <!--            </div>-->
    <!--        </li>-->
    <!--        <li class="nav-item">-->
    <!--          <a href="{{url('/costing')}}" class="nav-link">-->
    <!--          <span class="nav-link-inner--text text-dark">Fees & Costing</span>-->
    <!--          </a>-->
    <!--        </li>    -->
    <!--        <li class="nav-item">-->
    <!--          <a href="{{url('/')}}#contact" class="nav-link">-->
    <!--          <span class="nav-link-inner--text text-dark">Get in touch</span>-->
    <!--          </a>-->
    <!--        </li>  -->
    <!--        <li class="nav-item d-none d-lg-block ml-lg-4">-->
    <!--          @if(url()->current()==route('admin.loginForm'))-->
    <!--          @else-->
    <!--            @if (Auth::guard('user')->check())-->
    <!--              @if(route('2fa')==url()->current() || route('user.authorization')==url()->current()) -->
    <!--                <a href="{{route('user.logout')}}" class="btn btn-neutral">-->
    <!--                  <span class="nav-link-inner--text font-weight-500">{{__('Logout')}}</span>-->
    <!--                </a>-->
    <!--              @else-->
    <!--              @php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));  @endphp-->
    <!--              @if($uriSegments[2] == 'login_with_otp')-->
    <!--                <a href="{{route('user.logout')}}" class="btn btn-neutral">-->
    <!--                  <span class="nav-link-inner--text font-weight-500">{{__('Logout')}}</span>-->
    <!--                </a>-->
    <!--            @else-->
    <!--            <a href="{{route('user.dashboard')}}" class="btn btn-neutral">-->
    <!--                  <span class="nav-link-inner--text font-weight-500">{{__('Dashboard')}}</span>-->
    <!--                </a>-->
    <!--            @endif    -->
    <!--              @endif-->
    <!--            @else-->
    <!--            @php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); @endphp-->
    <!--            @if($uriSegments[1] == 'register')-->
    <!--              <a href="{{route('login')}}" class="btn btn-neutral">-->
    <!--                <span class="nav-link-inner--text font-weight-500">{{__('Login')}}</span>-->
    <!--              </a>-->
    <!--            @else-->
    <!--                @php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); @endphp-->
    <!--                @if($uriSegments[1] == 'user-reupload')-->
    <!--                <a href="{{route('login')}}" class="btn btn-neutral">-->
    <!--                    <span class="nav-link-inner--text font-weight-500">{{__('Login')}}</span>-->
    <!--                  </a>-->
    <!--                @else-->
    <!--                <a href="{{route('register')}}" class="btn btn-neutral">-->
    <!--                    <span class="nav-link-inner--text font-weight-500">{{__('SignUp')}}</span>-->
    <!--                  </a>-->
    <!--                @endif  -->
    <!--            @endif-->
                                         
    <!--            @endif-->
    <!--          @endif-->
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
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img alt="" title="" src="{{url('/')}}/asset/{{$logo->image_link}}">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse navbar-collapse-overlay" id="navbar-main-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item mm-in px-dropdown">
                                <a class="nav-link" href="#">{{__('Features')}}</a>
                                <!--<i class="fa fa-angle-down px-nav-toggle"></i>-->
                                <ul class="px-dropdown-menu mm-dorp-in">
                                   <li><a href="{{url('/prepaid-card')}}">Prepaid card</a></li>
                                  <li><a href="{{url('/e-invoicing-solution')}}">{{__('E-invoicing')}}</a></li>
                                    <li><a href="{{url('/payment-solution')}}">{{__('Payment Solution')}}</a></li>
                                    <li><a href="{{url('/online-selling-software')}}">{{__('Online Selling')}}</a></li>
                                    <li><a href="{{url('/ewallet-solution')}}">{{__('Ewallet System')}}</a></li>
                                    <li><a href="{{url('/subscription-management-software-system')}}">{{__('Subscription Management')}}</a></li>
                                    <!--<li><a href="{{url('/chatapps')}}">Chat / Messenger Apps</a></li>-->
                                    <li><a href="{{url('/enterprise-payment-solution')}}">Custom eCommerce Website Solution</a></li>
                                </ul>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('enterprise-payment-solution')}}">Enterprise</a>
                            </li>
                            <!--li class="nav-item">
                                <a class="nav-link" href="{{route('about')}}">Why Us</a>
                            </li-->
                            
                               
                                
                                <ul class="px-dropdown-menu mm-dorp-in">
                                   
                                   
                                    
                                    
                                </ul>
                            </li>
                         
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/costing')}}">Pricing</a>
                            </li>
                            
                             <li class="nav-item">
                                <a class="nav-link" href="{{url('/integration')}}">Integration</a>
                            </li>
                            
                             <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}#contact">Get in touch</a>
                            </li>
                         
                            
                                                   
                            
                            @if (Auth::guard('user')->check())
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="{{route('user.dashboard')}}">{{__('Dashboard')}}</a>
                            </li>
                            @else
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="{{route('register')}}">{{__('Signup')}}</a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="{{route('login')}}">{{__('Login')}}</a>
                            </li>
                            @endif
                        </ul>
                        @if (Auth::guard('user')->check())
                        <a href="{{route('user.dashboard')}}" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l">{{__('Dashboard')}}</a>
                        @else
                        <a href="{{route('login')}}" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l">{{__('Login')}}</a>
                         <a href="{{route('register')}}" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd1 m-btn-sm m-20px-l">Free Signup</a>
    <!--                     <a href="https://ach.cuminup.com" target="_blank" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd1 m-btn-sm m-20px-l" style="    background: #00c685;-->
    <!--border: 2px solid #00c685;">Open ACH Account</a>-->
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Header Nav -->
        </div>
    </header>
    
<!-- New header End -->

@yield('content')


<!-- footer begin -->
<footer class="dark-bg footer">
        <div class="footer-top border-style top light">
            <div class="container">
                <div class="row">
                
                    
                    <div class="col-lg-4 m-15px-tb">
                        <h5 class="white-color footer-title">
                               <img src="{{url('/')}}/asset/{{$logo->dark}}" title="" alt="" style="background: white; border-radius: 5px; padding: 5px;">
                        </h5>
                       
                        <p class="white-color-light">
                        <!--{{$set->title}}-->
                        Virtual, Physical Prepaid Debit Card, Payment and Ewallet Solution Company in USA
                        </p>
                        <div class="social-icon si-30 white round nav social-icon fab-footer">
                            @foreach($social as $socials)
                                @if(!empty($socials->value))
                                <a href="{{$socials->value}}"><i class="fab fa-{{$socials->type}}"></i></a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-3 col-4 col-sm-4 ml-lg-auto  m-15px-tb" style="padding-left:30px">
                        <h5 class="white-color footer-title">
                            {{__('Quick links')}}
                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            
                            <!--li><a href="{{url('/')}}#contact">{{__('Contact')}}</a></li>
                             <li>
                                <a href="{{route('login')}}">{{__('Login')}}</a-->
                            </li>
                            <li><a href="{{url('/e-invoicing-solution')}}">{{__('E-invoicing Solution')}}</a></li>
                            <li><a href="{{url('/payment-solution')}}">{{__('Payment Solution')}}</a></li>
                            <li><a href="{{url('/online-selling-software')}}">{{__('Online Selling Solution')}}</a></li>
                            <li><a href="{{url('/ewallet-topup-software')}}">{{__('Ewallet Top-up Solution')}}</a></li>
                            <li><a href="{{url('/subscription-management-software-system')}}">{{__('Subscription Solution')}}</a></li>
                            <!--<li><a href="{{route('user.merchant')}}">{{__('Merchant Services')}}</a></li>-->
                            <!--<li><a href="{{route('user.invoice')}}">{{__('Send Invoices')}}</a></li>-->
                            <!--<li><a href="{{route('user.product')}}">{{__('Sell Products')}}</a></li>-->
                        </ul>
                    </div>
                    <div class="col-lg-2 col-4 col-sm-4  m-15px-tb">
                        <h5 class="white-color footer-title">
                        {{__('Company')}}
                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li><a href="{{route('about')}}">Why CuminUp</a></li>
                            <li><a href="{{route('terms')}}">{{__('Terms of Use')}}</a></li>
                            <li><a href="{{route('privacy')}}">{{__('Privacy Policy')}}</a></li>
                            <li><a href="https://www.cuminup.com/page/19">BSA and AML Policy</a></li>
                            <li><a href="{{url('/security')}}">Security</a></li>
                            @if(count($faq)>0)
                            <li><a href="{{url('/')}}#faq">{{__('FAQs')}}</a></li>
                            @endif
                            <li><a href="{{url('e-signfront')}}">E-Sign Consent</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-4 col-sm-4  m-15px-tb">
                        <h5 class="white-color footer-title">
                          Services
                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <!--@foreach($pages as $vpages)-->
                            <!--    @if(!empty($vpages))-->
                            <!--<li><a href="{{url('/')}}/page/{{$vpages->id}}">{{$vpages->title}}</a></li>-->
                            <!--    @endif-->
                            <!--@endforeach-->
                            
                                   
                                    <!--<li><a href="{{url('/productpaymentform')}}">Product payment Form</a></li>-->
                                    <!--<li><a href="{{url('/chatapps')}}">Chat / Messenger Apps</a></li>-->
                                    
                                    <li><a href="{{url('/secure-card')}}">Secure Card</a></li>
                                    <li><a href="{{url('/virtual-card-number')}}">Virtual Card Number</a></li>
                                    <li><a href="{{url('/virtual-card')}}">Virtual Card</a></li>
                                    <li><a href="{{url('/ewallet-solution')}}">eWallet Solution</a></li>
                                    <li><a href="{{url('/physical-card')}}">Physical Card</a></li>
                                    <li><a href="{{url('/prepaid-card')}}">Prepaid card</a></li>
                                    
                                    <!--<li><a href="{{url('/ecomsolution')}}">Custom eCommerce Solution</a></li>-->
                                    <!--<li><a href="{{url('/costing')}}">Fees & Costing</a></li>-->
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
                        <!--<p class="m-0px font-small white-color-light" style="margin-left:-15px!important">{{$set->site_name}}  &copy; {{date('Y')}}. {{__('All Rights Reserved.')}}</p>-->
                        <p class="m-0px font-small white-color-light right-section" style="text-align: center;">{{$set->site_name}}  &copy; {{date('Y')}}. {{__('All Rights Reserved.')}}</p>
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
s1.src='https://embed.tawk.to/{{$set->tawk_id }}/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{url('/')}}/asset/dashboard/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/js/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/clipboard/dist/clipboard.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/nouislider/distribute/nouislider.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/quill/dist/quill.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/dropzone/dist/min/dropzone.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="{{url('/')}}/asset/dashboard/js/argon.js?v=1.1.0"></script>
    <script src="{{url('/')}}/asset/dashboard/js/demo.min.js"></script>
    <script src="{{url('/')}}/asset/js/sweetalert.js"></script>
    
   
</body>

</html>
    @include('sweetalert::alert')
@yield('script')
@if (session('success'))
    <script>
        $(document).ready(function () {
            swal("Success!", "{{ session('success') }}", "success");
        });
    </script>
@endif

@if (session('alert'))
    <script>
        $(document).ready(function () {
            swal("Sorry!", "{{ session('alert') }}", "error");
        });
    </script>
@endif
<script>
            @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
    @endif
</script>


<script>
     $(document).ready(function() {
            $('.select2').select2();
        });
</script>
@if($set->recaptcha==1)
  {!! NoCaptcha::renderJs() !!}
@endif