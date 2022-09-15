 <!doctype html>
<html class="no-js" lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="{{url('/')}}"/>
        <title>{{ $title }} | {{$set->site_name}}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="robots" content="index, follow">
        <meta name="apple-mobile-web-app-title" content="{{$set->site_name}}"/>
        <meta name="application-name" content="{{$set->site_name}}"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="description" content="{{$set->site_desc}}" />
        <link rel="shortcut icon" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="stylesheet" href="{{url('/')}}/asset/css/sweetalert.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/nucleo/css/nucleo.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/css/argon.css?v=1.1.0" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/css/sweetalert.css" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="{{url('/')}}/asset/dashboard/vendor/quill/dist/quill.core.css">
        <link href="{{url('/')}}/asset/fonts/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
        <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" />

      
         @yield('css')
         
         <style>
         .nav-item  .active  {
             color: #d5763b;
    background: #ffa74cd9;
    width: 93%;
    margin: 0px auto;
    border-radius: 5px;
         }
          
         </style>
    </head>
<!-- header begin-->
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
@php
date_default_timezone_set('Asia/Kolkata');
if(!empty(Auth::id()))
{ 
    $notification = DB::table('notification')->where(['sender_id'=>Auth::id(),'read_status_for_sender'=>0])->orderBy('id','DESC')->get();
}
@endphp
<body>
    <style>
        .dropdown-toggle::after {
            display:none;
        }
        
        .upgrade-premium{
            border: 1px solid #939598;
            background: #939598;
            padding: 5px 7px;
            border-radius: 50px;
            color: #fff;
            width: fit-content;
        }
        
        .upgrade-premium .fa-crown{
            color: #fff704; font-size: 20px;
        }
        
        @media only screen and (max-width:768px) {
            .mobile-view{
                display: none;
                
            }
            .navbar-top.border-bottom.navbar-dark{
                background-color:#311b6b!important;
            }
            .avatar{
            margin-left: -25px;
            }
            #only_for_mobile_view{
                display:block;
            }
            #only_for_mobile_view2{
                display:none;
            }
            #in_mobile_view_white{
                color:white!important;
            }
            #spinner_white {
           background-color: #ced4da !important;
        }
        }
        @media only screen and (min-width:768px) {
            
            #only_for_mobile_view{
                display:none;
            }
        }
    </style>
  <div class=""></div>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-cyan" id="sidenav-main" >
      <!--span id="SecondsUntilExpireererer" style="color:red;"></span-->
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{url('/')}}">
          <img src="{{url('/')}}/asset/{{ $logo->dark}}" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-light"></i>
              <i class="sidenav-toggler-line bg-light"></i>
              <i class="sidenav-toggler-line bg-light"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
              
              <li class="nav-item">
                  <a class="nav-link " href="{{route('user.newdashboard')}}">
                    <i class="fas fa-chart-pie"></i>
                    <span class="nav-link-text">Dashboard</span>
                   
                  </a>
                </li> 
              
            <li class="nav-item">
              
                  <a class="nav-link @if(route('user.dashboard')==url()->current()) active @endif" href="{{route('user.dashboard')}}">
                    <i class="fa fa-television"></i>
                    <span class="nav-link-text">{{__('Overview')}}</span>
                  </a>
              
            </li>  
          </ul>
          <hr class="my-3">
          @if(Auth::user()->virtual_card_activation == 1)
            <!--h6 class="navbar-heading p-0 text-muted">{{__('Prepaid Cards')}}</h6-->
              <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
                  <a class="nav-link @if(route('user.virtualcard')==url()->current() || route('user.physicalcard')==url()->current() || route('user.instant_issue')==url()->current() || route('user.vcard_orders')==url()->current()) active @endif" href="#navbar-examples333" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples3">
                    <!--For modern browsers-->
                   <i class="fa fa-cc-mastercard"></i>
                    <span class="nav-link-text">{{__('Prepaid Cards')}}</span>
                  </a>
                  <div class="collapse @if(route('user.virtualcard')==url()->current() || route('user.physicalcard')==url()->current() || route('user.instant_issue')==url()->current() || route('user.vcard_orders')==url()->current()) show @endif" id="navbar-examples333">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item @if(route('user.instant_issue')==url()->current()) active @endif text-default">
                        <a href="{{route('user.instant_issue')}}" class="nav-link">{{__('Instant Issuing Card')}}</a>
                      </li>
                      <li class="nav-item @if(route('user.virtualcard')==url()->current()) active @endif text-default">
                        <a href="{{route('user.virtualcard')}}" class="nav-link">{{__('All Virtual Card')}}</a>
                      </li> 
                       <li class="nav-item @if(route('user.physicalcard')==url()->current()) active @endif text-default">
                        <a href="{{route('user.physicalcard')}}" class="nav-link">{{__('All Physical Card')}}</a>
                      </li> 
                      
                      <li class="nav-item @if(route('user.vcard_orders')==url()->current()) active @endif text-default">
                        <a href="{{route('user.vcard_orders')}}" class="nav-link">{{__('Order List')}}</a>
                      </li>
                    </ul>
                  </div>
                </li>   
              </ul>
          @endif
          @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 1)
          <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
                  <a class="nav-link @if(route('user.ownbank')==url()->current() || route('user.request')==url()->current() || route('user.withdraw')==url()->current() || route('user.sendmoney')==url()->current() ) active @endif" href="#navbar-examples33332" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples3">
                    <!--For modern browsers-->
                   <i class="fa fa-cc-mastercard"></i>
                    <span class="nav-link-text">{{__('Fund Transfer')}}</span>
                  </a>
                  <div class="collapse @if(route('user.ownbank')==url()->current() || route('user.request')==url()->current() || route('user.withdraw') ==url()->current() || route('user.sendmoney')==url()->current()) show @endif" id="navbar-examples33332">
                    <ul class="nav nav-sm flex-column">
                    @if(Auth::user()->transfer_activation == 1)  
                      <li class="nav-item @if(route('user.ownbank')==url()->current()) active @endif text-default">
                        <a href="{{route('user.ownbank')}}" class="nav-link">{{__('Add Fund')}}</a>
                      </li>
                    @endif 
                     @if(Auth::user()->request_activation == 1)
                      <li class="nav-item @if(route('user.virtualcard')==url()->current()) active @endif text-default">
                        <a href="{{route('user.request')}}" class="nav-link">{{__('Request Money')}}</a>
                      </li> 
                      @endif
                       @if(Auth::user()->transfer_activation == 1)  
                       <li class="nav-item @if(route('user.sendmoney')==url()->current()) active @endif text-default">
                        <a href="{{route('user.sendmoney')}}" class="nav-link">{{__('Send Money')}}</a>
                      </li> 
                      @endif
                      <li class="nav-item @if(route('user.withdraw')==url()->current()) active @endif text-default">
                        <a href="{{route('user.withdraw')}}" class="nav-link">{{__('Withdrawal')}}</a>
                      </li>
                    </ul>
                  </div>
                </li>   
              </ul>
            @endif  
            {{--  <!--h6 class="navbar-heading p-0 text-muted">{{__('Fund Transfer')}}</h6-->
              <ul class="navbar-nav">
                @if(Auth::user()->transfer_activation == 1)  
                <li class="nav-item">
                  <a class="nav-link @if(route('user.ownbank')==url()->current()) active @endif" href="{{route('user.ownbank')}}">
                    <i class="fa fa-send"></i>
                    <span class="nav-link-text">{{__('Fund Transfers')}} 
                      @if(count($p_transfer)>0)
                        <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                        {{count($p_transfer)}}
                        </span>
                      @endif
                    </span>
                  </a>
                </li>
                @endif
                @if(Auth::user()->request_activation == 1)
                <li class="nav-item">
                  <a class="nav-link @if(route('user.request')==url()->current()) active @endif" href="{{route('user.request')}}">
                    <i class="fa fa-hand-peace"></i>
                    <span class="nav-link-text">{{__('Request Money')}}
                      @if(count($p_request)>0)
                        <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                        {{count($p_request)}}
                        </span>
                      @endif
                    </span>
                  </a>
                </li>
                @endif
                @if(Auth::user()->request_activation == 1)
                <li class="nav-item">
                  <a class="nav-link @if(route('user.ownbank')==url()->current()) active @endif" href="{{route('user.ownbank')}}">
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span class="nav-link-text">{{__('Send Money')}}
                      @if(count($p_request)>0)
                        <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                        {{count($p_request)}}
                        </span>
                      @endif
                    </span>
                  </a>
                </li>
                @endif
                 @if(Auth::user()->user_type == 2)          
                <li class="nav-item">
                  <a class="nav-link @if(route('user.withdraw')==url()->current()) active @endif" href="{{route('user.withdraw')}}">
                    <i class="fa fa-braille"></i>
                    <span class="nav-link-text">Withdrawal</span>
                  </a>
                </li>
                @endif
                <!--<li class="nav-item">-->
                <!--  <a class="nav-link " href="{{route('user.instant_issue')}}">-->
                <!--    <i class="fab fa-cc-mastercard"></i>-->
                <!--    <span class="nav-link-text">Instant Issue Card</span>-->
                <!--  </a>-->
                <!--</li>-->
              </ul>
          @endif
           --}}
          
          <!--hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">{{__('Collect Payments')}}</h6-->
          <ul class="navbar-nav mb-md-3"> 
            @if(Auth::user()->user_type == 1)
                <!--li class="nav-item">
                  @if(!empty(Auth::user()->verify_ssn) || !empty(Auth::user()->verify_ein))
                  <a class="nav-link @if(route('user.product')==url()->current()) active @endif" href="{{route('user.product')}}">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="nav-link-text">{{__('eStore')}}</span>
                  </a>
                  @else
                  <a class="nav-link @if(route('user.product')==url()->current()) active @endif">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="nav-link-text">{{__('eStore')}}</span>
                  </a>
                  @endif
                  
                  
                
                </li-->
            @endif
            
             
               
                @if(Auth::user()->payment_link_activation == 1) 
                <li class="nav-item">
                  <a class="nav-link @if(route('user.sclinks')==url()->current() || route('user.dplinks')==url()->current()) active @endif" href="#navbar-examples3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples3">
                    <!--For modern browsers-->
                    <i class="fa fa-tags"></i>
                    <span class="nav-link-text">{{__('Payment URLs')}}</span>
                  </a>
                  <div class="collapse @if(route('user.sclinks')==url()->current() || route('user.dplinks')==url()->current()) show @endif" id="navbar-examples3">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item @if(route('user.sclinks')==url()->current()) active @endif text-default">
                        <a href="{{route('user.sclinks')}}" class="nav-link">{{__('Single Charge')}}</a>
                      </li>                                 
                      <li class="nav-item @if(route('user.dplinks')==url()->current()) active @endif text-default">
                        <a href="{{route('user.dplinks')}}" class="nav-link">{{__('Donation')}}</a>
                      </li>                               
                    </ul>
                  </div>
                </li>
                @endif
               
               @if(Auth::user()->estore_activation == 1)
                <li class="nav-item">
                  <a class="nav-link @if(route('user.product')==url()->current()) active @endif" href="{{route('user.product')}}">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="nav-link-text">{{__('Sell Online')}}</span>
                  </a>
                </li> 
              @endif   
           
          </ul>
           @if(Auth::user()->invoice_activation == 1)   
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">{{__('Billing tools')}}</h6>
          <ul class="navbar-nav mb-md-3">  
            @if(Auth::user()->user_type == 1)
                <li class="nav-item">
                  @if(!empty(Auth::user()->verify_ssn) || !empty(Auth::user()->verify_ein))
                  <a class="nav-link @if(route('user.invoice')==url()->current()) active @endif" href="{{route('user.invoice')}}">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-link-text">{{__('e-Invoice')}}</span>
                  </a>
                  @else
                  <a class="nav-link @if(route('user.invoice')==url()->current()) active @endif" href="{{route('user.invoice')}}">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-link-text">{{__('e-Invoice')}}</span>
                  </a>
                  @endif
                </li>
            @endif
            @if(Auth::user()->user_type == 2)
                <li class="nav-item">
                  <a class="nav-link @if(route('user.invoice')==url()->current()) active @endif" href="{{route('user.invoice')}}">
                    <i class="fas fa-file-invoice"></i>
                    <span class="nav-link-text">{{__('e-Invoice')}}</span>
                  </a>
                </li>             
                <li class="nav-item">
                  <a class="nav-link @if(route('user.plan')==url()->current()) active @endif" href="{{route('user.plan')}}">
                    <i class="fa fa-sticky-note"></i>
                    <span class="nav-link-text">{{__('Subscription Plans')}}</span>
                  </a>
                </li>
            @endif
            <li class="nav-item">
                  <a class="nav-link @if(route('user.sub')==url()->current()) active @endif" href="{{route('user.sub')}}">
                    <i class="fa fa-bookmark"></i>
                    <span class="nav-link-text">{{__('My Subscription')}}</span>
                  </a>
            </li> 
          </ul>
          @endif
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">{{__('Account')}}</h6>
          <ul class="navbar-nav mb-md-3">
              <!--li class="nav-item">
                  <a class="nav-link @if(route('user.sclinks')==url()->current() || route('user.dplinks')==url()->current()) active @endif" href="#navbar-examples3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples3">
                    <i class="fa fa-tags"></i>
                    <span class="nav-link-text">{{__('Payment Links')}}</span>
                  </a>
                  <div class="collapse @if(route('user.sclinks')==url()->current() || route('user.dplinks')==url()->current()) show @endif" id="navbar-examples3">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item @if(route('user.sclinks')==url()->current()) active @endif text-default">
                        <a href="{{route('user.sclinks')}}" class="nav-link">{{__('Single Charge')}}</a>
                      </li>                                 
                                                     
                    </ul>
                  </div>
                </li-->
            @if(Auth::user()->user_type == 1)
                  <li class="nav-item">
                  <a class="nav-link @if(route('user.alltransactions')==url()->current() || route('user.transactionssc')==url()->current() || route('user.invoicelog')==url()->current() || route('user.senderlog')==url()->current() || route('user.transactionsd')==url()->current() || route('user.depositlog')==url()->current() || route('user.banktransfer')==url()->current()) active @endif" href="#navbar-examples2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples2">
                    <!--For modern browsers-->
                    <i class="fa fa-credit-card"></i>
                    <span class="nav-link-text">{{__('Transactions')}}</span>
                  </a>
                  <div class="collapse @if(route('user.alltransactions')==url()->current() || route('user.transactionssc')==url()->current() || route('user.invoicelog')==url()->current() || route('user.senderlog')==url()->current() || route('user.transactionsd')==url()->current() || route('user.depositlog')==url()->current() || route('user.banktransfer')==url()->current()) show @endif" id="navbar-examples2">
                    <ul class="nav nav-sm flex-column">
                        
                         <li class="nav-item @if(route('user.alltransactions')==url()->current()) active @endif text-default">
                        <a href="{{route('user.alltransactions')}}" class="nav-link">{{__('All Transactions')}}</a>
                      </li>
                      <li class="nav-item @if(route('user.depositlog')==url()->current()) active @endif text-default">
                        <a href="{{route('user.depositlog')}}" class="nav-link">{{__('Deposit')}}</a>
                      </li>                   
                      <li class="nav-item @if(route('user.banktransfer')==url()->current()) active @endif text-default">
                        <a href="{{route('user.banktransfer')}}" class="nav-link">{{__('Bank Transfer')}}</a>
                      </li>  
                        <!--li class="nav-item">
                  <a class="nav-link @if(route('user.bank')==url()->current()) active @endif" href="{{route('user.bank')}}">
                    <i class="fa fa-braille"></i>
                    <span class="nav-link-text">{{__('Bank Accounts')}}</span>
                  </a>
                </li-->                             
                    </ul>
                  </div>
                </li> 
            @endif
            @if(Auth::user()->user_type == 2)  
                <li class="nav-item">
                  <a class="nav-link @if(route('user.bank')==url()->current()) active @endif" href="{{route('user.bank')}}">
                    <i class="fa fa-braille"></i>
                    <span class="nav-link-text">{{__('Bank Accounts')}}</span>
                  </a>
                </li>            
                <li class="nav-item">
                  <a class="nav-link @if(route('user.charges')==url()->current()) active @endif" href="{{route('user.charges')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span class="nav-link-text">{{__('Charges')}}</span>
                  </a>
                </li>  
                <li class="nav-item">
                  <a class="nav-link @if(route('user.alltransactions')==url()->current() || route('user.transactionssc')==url()->current() || route('user.invoicelog')==url()->current() || route('user.senderlog')==url()->current() || route('user.transactionsd')==url()->current() || route('user.depositlog')==url()->current() || route('user.banktransfer')==url()->current()) active @endif" href="#navbar-examples2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples2">
                    <!--For modern browsers-->
                    <i class="fa fa-credit-card"></i>
                    <span class="nav-link-text">{{__('Transactions')}}</span>
                  </a>
                  <div class="collapse @if(route('user.alltransactions')==url()->current() || route('user.transactionssc')==url()->current() || route('user.invoicelog')==url()->current() || route('user.senderlog')==url()->current() || route('user.transactionsd')==url()->current() || route('user.depositlog')==url()->current() || route('user.banktransfer')==url()->current()) show @endif" id="navbar-examples2">
                    <ul class="nav nav-sm flex-column">
                        
                         <li class="nav-item @if(route('user.alltransactions')==url()->current()) active @endif text-default">
                        <a href="{{route('user.alltransactions')}}" class="nav-link">{{__('All Transactions')}}</a>
                      </li>
                      <li class="nav-item @if(route('user.transactionssc')==url()->current()) active @endif text-default">
                        <a href="{{route('user.transactionssc')}}" class="nav-link">{{__('Single Charge')}}</a>
                      </li>                                 
                      <li class="nav-item @if(route('user.transactionsd')==url()->current()) active @endif text-default">
                        <a href="{{route('user.transactionsd')}}" class="nav-link">{{__('Donation')}}</a>
                      </li>                  
                      <li class="nav-item @if(route('user.invoicelog')==url()->current()) active @endif text-default">
                        <a href="{{route('user.invoicelog')}}" class="nav-link">{{__('Invoice')}}</a>
                      </li>                   
                      <li class="nav-item @if(route('user.depositlog')==url()->current()) active @endif text-default">
                        <a href="{{route('user.depositlog')}}" class="nav-link">{{__('Deposit')}}</a>
                      </li>                   
                      <li class="nav-item @if(route('user.banktransfer')==url()->current()) active @endif text-default">
                        <a href="{{route('user.banktransfer')}}" class="nav-link">{{__('Bank Transfer')}}</a>
                      </li>  
                      <li class="nav-item @if(route('user.senderlog')==url()->current()) active @endif text-default">
                        <a href="{{route('user.senderlog')}}" class="nav-link">{{__('Merchant')}}</a>
                      </li>                                
                    </ul>
                  </div>
                </li> 
                 @if( Auth::user()->user_type == 2)
                  <li class="nav-item">
                    <a class="nav-link @if(route('user.merchant')==url()->current() || route('user.merchant-documentation')==url()->current()) active @endif" href="{{route('user.merchant')}}">
                      <i class="fa fa-laptop"></i>
                      <span class="nav-link-text">{{__('Website Integration')}}</span>
                    </a>
                  </li>  
                @endif
                @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
                  <li class="nav-item">
                    <a class="nav-link @if(route('user.doc-verification')==url()->current()) active @endif" href="{{route('user.doc-verification')}}">
                      <i class="fa fa-file-text"></i>
                      <span class="nav-link-text">{{__('Enterprise Verification')}}</span>
                    </a>
                  </li>  
                @endif
                
            @endif
            <li class="nav-item">
                  <a class="nav-link @if(route('user.ticket')==url()->current() || route('open.ticket')==url()->current()) active @endif" href="{{route('user.ticket')}}">
                    <i class="fa fa-bullseye"></i>
                    <span class="nav-link-text">{{__('Support')}}</span>
                  </a>
                </li> 
                
                <li class="nav-item">
                  <a class="nav-link @if(route('user.profile')==url()->current()) active @endif" href="{{route('user.profile')}}">
                    <i class="fa fa-cogs"></i>
                    <span class="nav-link-text">{{__('Settings')}}</span>
                  </a>
                </li>             
                
                 
            <li class="nav-item">
                  <a class="nav-link @if(route('user.audit')==url()->current()) active @endif" href="{{route('user.audit')}}">
                    <i class="fa fa-refresh"></i>
                    <span class="nav-link-text">{{__('Audit Logs')}}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('user.logout')}}">
                    <i class="ni ni-button-power"></i>
                    <span class="nav-link-text">{{__('Logout')}}</span>
                  </a>
                </li>
            <!--li class="nav-item">
                  <a class="nav-link" id="only_for_mobile_view" href="{{route('user.logout')}}">
                    <i class="ni ni-button-power"></i>
                    <span class="nav-link-text">{{__('Logout')}}</span>
                  </a>
                </li-->
          </ul>
        </div>
      </div>
    </div>
  </nav>
   <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark border-bottom" style="background-color: white;margin-bottom: 10px">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <span>@if(!empty($user->last_login)) {{__('Last Login:')}} {{date('M j, Y h:i:A' ,strtotime($user->last_login))}} @endif</span>  
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner bg-light">
                  <i class="sidenav-toggler-line" style="background-color:white;"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <a href="{{url('user/transfer')}}" class="btn btn-primary btn-sm hbtn" style="margin-right: 12px!important;" onclick="setSessionFunction()"><i class="fa fa-plus"></i> {{__('Add Fund')}}</a>
       <!--
          @if(Auth::user()->user_type == 1)
            <a href="{{url('user/upgrade')}}" class="mr-3 upgrade-premium" style="background: #f5b614;border: 1px solid #f5b614;margin-top: -8px;">Upgrade</a>
            <h3 class="mr-3 upgrade-premium" id="only_for_mobile_view2"><span>Standard</span></h3></a>
          @else
            <h3 class="mr-3 upgrade-premium"><span>Business</span></h3></a>
          @endif
          -->
          <div class="hbl">
             
              <h6 class="btn btn-primary btn-sm hbtn" id="in_mobile_view_white" style="margin-right: -7px!important;margin-top:7px;">
                  {{$currency->symbol.number_format($user->balance,2)}}
              </h6>
               
            </div>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown" ><a  href="{{url('user/ticket')}}"><i class="fa fa-question-circle" style="font-size:26px;cursor:poniter" aria-hidden="true"></i></a></li>
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="margin-right: -25px;"><i class="fa fa-bell hbell" id="in_mobile_view_white"></i>
               {{-- @if(($user->kyc_status==1 || $user->kyc_status==2) && $user->user_seen==0)
                <span class="badge badge-sm badge-circle badge-floating badge-danger border-white" style="margin-left: -30px;"> 1</span>
                @endif --}}
               
                @if(count($notification) > 0)
                <span class="badge badge-sm badge-circle badge-floating badge-danger border-white" style="margin-left: -30px;">{{count($notification)}}</span>
                @endif
                
                </a>
                
                @if(!empty($notification))
                
                <div class="dropdown-menu" style="height: auto;margin-left: -10px;height: 500px;overflow-y: scroll;">
                    @foreach($notification as $notify_details)
                    <a class="dropdown-item" href="{{url('')}}/{{$notify_details->link}}?n={{$notify_details->id}}"><b>{{$notify_details->title}}</b><br>
                   
                   
                    {{$notify_details->desription}}  
                    </br>
                    on {{date("j, M Y h:i:A", strtotime($notify_details->created_at))}}
                    
                    </a>
                     @endforeach
                </div> 
               
                @endif
                
                @if($user->kyc_status==1 && $user->user_seen==0)
                <div class="dropdown-menu" style="height: auto;margin-left: -10px;">
                    <a class="dropdown-item" href="{{url('user/profile')}}" target="_blank"><b>KYC has been Verified</b> </a>
                </div> 
                @endif
                
                 @if($user->kyc_status==2 && $user->user_seen==0)
                <div class="dropdown-menu" style="height: auto;margin-left: -10px;">
                    <a class="dropdown-item" href="{{url('user/profile')}}" target="_blank" ><b>KYC has been Rejected</b> </a>
                </div> 
                @endif
            </li>
            &nbsp;
              <li class="nav-item dropdown">
                <!--<a class="nav-link pr-0" href="{{url('user/profile')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                
                <a class="nav-link pr-0" href="{{url('user/profile')}}" >
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <img alt="Image placeholder" src="{{url('/')}}/asset/profile/{{$cast}}">
                    </span>
                    <div class="media-body ml-2  d-none d-lg-block">
                      <span class="mb-0 text-sm mt-2 text-default">{{$user->first_name}}</span><br>
                       @if(Auth::user()->user_type == 1)
                            <h3 class="mr-3" style="font-size:10px;" id="only_for_mobile_view2"><span>Standard</span><br><a class="" href="{{url
                      ('user/doc-verification')}}" ><span style="color:blue">Upgrade to Enterprise</span></a></h3>
                      @else
                        <h3 class="mr-3" style="font-size:10px;"><span>Enterprise</span></h3>
                      @endif
                    </div>
                  </div>
                </a>
                
              </li>
              <li class="nav-item" id="only_for_mobile_view2" >
                <a href="{{route('user.logout')}}" class="nav-link pr-0">
                  <i class="ni ni-button-power text-danger" style="margin-left: -40%;"></i>
                </a>
              </li>  
            </ul>
            
            
        </div>
      </div>
    </nav>
    <div class="header pb-6">
      <div class="container-fluid">
        <div class="header-body">
            @if(Auth::user()->user_type == 1)
                <!--@if(empty($user->kyc_link) || $user->kyc_status=='2')-->
        <!--        <div class="alert alert-error alert-dismissible" style="height:50px;background-color: #dd4b39;color: #ffffff;">-->
    				<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
    				<!--  <strong><i class="icon fa fa-warning"></i>Alert!</strong>-->
    				<!--   Your Business account is not started yet. Please upload the document to start.-->
    				<!--<span class="pull-right">-->
    				<!--	<a href="{{route('user.upgrade')}}" class="btn bg-navy" style="display:unset !important;background-color: #001f3f ;color: #ffffff;"><i class="fa fa-rocket"></i>  Upgrade Now</a>-->
    				<!--</span>-->
        <!--        </div>-->
                <!--@endif-->
            @endif
        </div>
      </div>
    </div>
<!-- header end -->

 <!--MODEL POPUP START HERE-->
      <div class="modal fade" id="modal-formx_sessionlogout" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
             
            <div class="modal-body p-0">
                                    <h3 style="color:red;padding:20px;background-color:#291261;color:white;">Session Expired! <!--span id="SecondsUntilExpire" style="color:red;"></span-->  <button type="button" style="float:right;color:white" class="close" data-dismiss="modal">&times;</button></h3>

              <div class="card border-0 mb-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <p>Oops! It seems that your session has expired. Please take a copy of any unsaved work and log in again.</p>
                    <br><br>
                  <div class="text-left mt-2 mb-3"></div> 
                  <!--div class="text-left mt-2 mb-3">Upgrade fee costs {{$set->upgrade_fee.$currency->name}} . Check PY scheme to see what your money is invested on.</div--> 
                    <div class="text-center">
                       <div class="row" >
                           <div class="col-sm-2"></div>
                       <!--div class="col-sm-6">
                            <button class="btn btn-danger" class="close" onclick="unlinkBankAccountHide()">No</button>
                        </div-->    
                        <div class="col-sm-5">
                           
                            <!--a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-success">STAY HERE</a-->
                            <a href="{{url('user/logout')}}" class="btn btn-success">Log in again</a>
                        </div>
                        <div class="col-sm-3"><a href="{{url('user/logout')}}" class="btn btn-default"> Close</a></div>
                    </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!--END MODEL-->

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top:10%;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
          <button type="button" class="close"><a href="{{url('/user/newdashboard')}}" style="font-size:25px;">&times;</a></button>
          <!--h4 class="modal-title">Modal Header</h4-->
        </div>
        <div class="modal-body" style="margin-top:-20px;">
           <center> <div><i class="fa fa-check-circle fa-4x" style="color:green" aria-hidden="true"></i>
</div></center>
          <p style="text-align: justify;">Your account has been created! Please update your profile  and verify enterprise business. </p>
        </div>
        <div class="text-center" style="padding:20px;">
          <center><button type="button" class="btn btn-default" data-dismiss="modal">Proceed for Enterprise Verification</button></center>
        </div>
      </div>
      
    </div>
  </div>
  @if(Session::has('enterprise'))
<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
 @endif
 
@yield('content')



<!-- footer begin>
      <footer class="footer pt-0">

      </footer-->
    </div>
  </div>
<script type="text/javascript">


  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/{{$set->livechat}}/default';
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
  <!-- Optional JS -->
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
  <!-- Argon JS -->
  <script src="{{url('/')}}/asset/dashboard/js/argon.js?v=1.1.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="{{url('/')}}/asset/dashboard/js/demo.min.js"></script>
  <script src="{{url('/')}}/asset/js/sweetalert.js"></script>
  <script src="{{url('/')}}/asset/js/countries.js"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script src="{{url('/')}}/asset/tinymce/tinymce.min.js"></script>
  <script src="{{url('/')}}/asset/tinymce/init-tinymce.js"></script>
</body>

</html>
@include('sweetalert::alert')
@yield('script')
@if (session('success'))
    <script>
      "use strict";
        $(document).ready(function () {
            swal("Success!", "{{ session('success') }}", "success");
        });
    </script>
@endif

@if (session('alert'))
    <script>
      "use strict";
        $(document).ready(function () {
            swal("Sorry!", "{{ session('alert') }}", "error");
        });
    </script>
@endif
    <script>
    @if(Session::has('message'))
    "use strict";
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
    populateCountries("country", "state");
    </script>
    <script type="text/javascript">
$(function() {
   
    var $form = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
   
});


</script>
<script type="text/javascript">
  "use strict";
  function cardcharge(){
    var amount = $("#cardamount").val();
    var charge = $("#charge").val();
    var survix_old =  (parseFloat(amount)*parseFloat(charge)/100)+parseFloat(amount);
    var survix =  (parseFloat(amount)*parseFloat(charge)/100);
    var cur = '{{$currency->name}}';
    if(isNaN(survix)){
      survix =0;           
    }
    var ddd = cur+' '+survix;
    $("#cardresult").text(survix);
  }
</script>
<script type="text/javascript">
  "use strict";
  function cryptocharge(){
    var amount = $("#amountcrypto").val();
    var charge = $("#chargecrypto").val();
    var survix =  (parseFloat(amount)*parseFloat(charge)/100)+parseFloat(amount);
    var cur = '{{$currency->name}}';
    if(isNaN(survix)){
      survix =0;           
    }
    var ddd = cur+' '+survix;
    $("#resultcrypto").text(ddd);
  }
</script> 
<script type="text/javascript">
  "use strict";
  function transfercharge(){
    var amount = $("#amounttransfer").val();
    var charge = $("#chargetransfer").val();
    var survix =  (parseFloat(amount)*parseFloat(charge)/100)+parseFloat(amount);
    var cur = '{{$currency->name}}';
    if(isNaN(survix)){
      survix =0;           
    }
    var ddd = cur+' '+survix;
    $("#resulttransfer").text(ddd);
  }
</script> 




@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    $('#modal-formx').modal('show');
});
</script>
@endif
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 6)
<script>
$(function() {
    $('#modal-socialdetails').modal('show');
});
</script>
@endif

<script>
//FOR SESSION

var IDLE_TIMEOUT = 360; //seconds
var _idleSecondsTimer = null;
var _idleSecondsCounter = 0;

document.onclick = function() {
    _idleSecondsCounter = 0;
};

document.onmousemove = function() {
    _idleSecondsCounter = 0;
};


document.onkeypress = function() {
    _idleSecondsCounter = 0;
};

_idleSecondsTimer = window.setInterval(CheckIdleTime, 1000);

function CheckIdleTime() {
     _idleSecondsCounter++;
     var oPanel = document.getElementById("SecondsUntilExpire");
     if (oPanel)
         oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
    if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        window.clearInterval(_idleSecondsTimer);
        document.location.href = "@php echo url('/user/logout'); @endphp";
       // alert("Time expired!");
      // $('#modal-formx_sessionlogout').modal('show');
     /*   if(confirm('Are you sure do you still want to stay here?')){ 
           
            document.location.href = "@php echo $_SERVER['REQUEST_URI']; @endphp";
        } else { 
            
            
            //document.getElementById('id01').style.display='block'
          
          // document.location.href = "@php echo url('/user/logout'); @endphp";
            //document.location.href = "@php echo url('/login'); @endphp";
        }
        */
        
    } else if(_idleSecondsCounter == '300') {
        $('#modal-formx_sessionlogout').modal('show');
    }
}

</script>

