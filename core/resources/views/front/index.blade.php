@extends('layout')
@section('css')
<style>
::placeholder {
  color: grey;
  opacity: 0.6; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: grey;
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: grey;
}
.ecomm i {
    font-size: 50px;
    color: #171347;
}
    /* Create three columns of equal width */
.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

/* Style the list */
.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

/* Add shadows on hover */
.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

/* Pricing header */
.price .header-basic{
      background: rgba(51,142,204,0.89);
  color: white;
  font-size: 25px;
}
.price .header-adv {
      background: rgba(29,51,108,0.89) !important;
  color: white;
  font-size: 25px;
}
.price .header-special {
      background: rgba(20,205,125,0.89) !important;
  color: white;
  font-size: 25px;
}

/* List items */
.price li {
  border-bottom: 1px solid #eee;
  padding: 15px;
  text-align: center;
}

/* Grey list item */
.price .grey {
  background-color: #eee;
  font-size: 20px;
}
.price h1{
    color:#fff;
}

/* The "Sign Up" button */
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 12px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px
  border-radius: 20px;
}

/* Change the width of the three columns to 100%
(to stack horizontally on small screens) */
@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>
@stop
@section('content')

<!--<section class="gray-bg effect-section">-->
<!--    <div class="effect-1">-->
<!--        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 361.1 384.8" style="enable-background:new 0 0 361.1 384.8;" xml:space="preserve" class="injected-svg svg_img white-color">-->
<!--        <path d="M53.1,266.7C19.3,178-41,79.1,41.6,50.1S287.7-59.6,293.8,77.5c6.1,137.1,137.8,238,15.6,288.9 S86.8,355.4,53.1,266.7z"></path>-->
<!--        </svg>-->
<!--    </div>-->
<!--    <div class="svg-bottom">-->
<!--        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="96px" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="injected-svg svg_img white-color">-->
<!--            <path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z"></path>-->
<!--        </svg>-->
<!--    </div>-->
<!--    <div class="container">-->
<!--        <div class="row full-screen align-items-center p-50px-tb lg-p-100px-t justify-content-center">-->
<!--            <div class="col-lg-6 m-50px-tb md-m-20px-t">-->
<!--                <h6 class="typed theme3rd-bg p-5px-tb p-15px-lr d-inline-block white-color border-radius-15 m-25px-b" data-elements="{{$set->title}}"></h6>-->
<!--                <h1 class="display-4 m-20px-b">{{$ui->header_title}}</h1>-->
<!--                <p class="font-2">{{$ui->header_body}}</p>-->
<!--                <div class="p-20px-t">-->
<!--                    <a class="m-btn m-btn-radius m-btn-theme" href="{{route('register')}}">-->
<!--                        <span class="m-btn-inner-text">{{__('Get Started')}}</span>-->
<!--                        <span class="m-btn-inner-icon arrow"></span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-6 m-50px-tb lg-m-0px-t text-center">-->
<!--                <img class="max-width-140" src="{{url('/')}}/asset/images/{{$ui->s4_image}}" title="" alt="">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->


<section class="gray-bg effect-section" style="background: #291261;">
    <div class="effect-1" style="display: none;">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 361.1 384.8" style="enable-background:new 0 0 361.1 384.8;" xml:space="preserve" class="injected-svg svg_img white-color">
        <path d="M53.1,266.7C19.3,178-41,79.1,41.6,50.1S287.7-59.6,293.8,77.5c6.1,137.1,137.8,238,15.6,288.9 S86.8,355.4,53.1,266.7z"></path>
        </svg>
    </div>
    <div class="svg-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="96px" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="injected-svg svg_img white-color">
            <path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z"></path>
        </svg>
    </div>
    <div class="container">
        <div class="row full-screen align-items-center p-50px-tb lg-p-100px-t justify-content-center">
            <div class="col-lg-6 m-50px-tb md-m-20px-t">
                <h6 class="typed theme3rd-bg p-5px-tb p-15px-lr d-inline-block white-color border-radius-15 m-25px-b" data-elements="Your business | Personal use | GooglePay | ApplePay
Facebook| Amazon | Online Ads | Gifts Card | Shopping & much more"></h6>
                <h1 class="display-4 m-20px-b" style="color:white!important;font-size: 46px;">{{$ui->header_title}}</h1>
                <!--<h1 class="display-4 m-20px-b" style="color:white!important;font-size: 46px;">Simplify Your Online Businesses</h1>-->
                <p class="font-2" style="color: white;">{{$ui->header_body}}</p>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://cuminup.com/register">
                        <span class="m-btn-inner-text">{{__('Get Started')}}</span>
                        <!--<span class="m-btn-inner-text">Get Started</span>-->
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-50px-tb lg-m-0px-t text-center">
                <!--<img class="max-width-140" src="{{url('/')}}/asset/images/{{$ui->s4_image}}" title="" alt="">-->
                <img class="max-width-140" src="{{asset('asset/images/section3_1626342935.png')}}" title="" alt="">
                
                
            </div>
        </div>
    </div>
</section>


<section class="section p-0px-t section-top-up-100" style="display:none">
    <div class="container">
        <div class="row">
            @foreach($item as $val)
            <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15">
                    <h5 class="m-10px-b">{{$val->title}}</h5>
                    <p class="m-0px">{{$val->details}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<br>
<h3 class="h1 m-15px-b" style="    text-align: center;">Strategic Partner</h3>

<div class="p-40px-tb border-top-1 border-bottom-1 border-color-gray">
    <div class="container">
        <div class="owl-carousel owl-loaded owl-drag" data-items="7" data-nav-dots="false" data-md-items="6" data-sm-items="5" data-xs-items="4" data-xx-items="3" data-space="30" data-autoplay="true">
            @foreach($brand as $brands)
                <div class="p8">
                    <img src="{{url('/')}}/asset/brands/{{$brands->image}}" title="" alt="">
                    <!--<img src="{{asset('asset/brands/')}}/{{$brands->image}}" title="" alt="">-->
                </div>
            @endforeach
        </div>
    </div>
</div>

<section class="section effect-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="{{url('/')}}/asset/images/{{$ui->s3_image}}" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">{{$ui->s3_title}}</h3>
                <p class="font-2 p-0px-t">{{$ui->s3_body}}</p>
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">{{$set->title}}</h6>
                    <p>{{__('Stimulate your sales with modular payment solutions and loyalty programs!')}}</p>
                </div>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://cuminup.com/register">
                        <span class="m-btn-inner-text">Get Your Card Now</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<section class="section effect-section">-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center md-m-25px-b m-40px-b">-->
<!--            <div class="col-lg-8 text-center">-->
<!--                <h3 class="h1 m-15px-b">{{$ui->s6_title}}</h3>-->
<!--                <p class="m-0px font-2">{{$ui->s6_body}}</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row justify-content-between">-->
<!--            <div class="col-lg-5 m-15px-tb">-->
<!--                <div class="media box-shadow p5 m-30px-b">-->
<!--                    <div class="icon-70 theme-color theme-bg-alt border-radius-50">-->
<!--                        <i class="fas fa-shopping-cart"></i>-->
<!--                    </div>-->
<!--                    <div class="media-body p-15px-l">-->
<!--                        <h5>Sell products</h5>-->
<!--                        <p class="m-0px">{{__('Any product can now be sold easily. Create and share your products with clients.')}}</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="media box-shadow p5 m-30px-b">-->
<!--                    <div class="icon-70 green-color green-bg-alt border-radius-50">-->
<!--                        <i class="fas fa-file-invoice"></i>-->
<!--                    </div>-->
<!--                    <div class="media-body p-15px-l">-->
<!--                        <h5>Send invoice</h5>-->
<!--                        <p class="m-0px">{{__('Bill clients seamlessly with invoice system and request money from anyone easily.')}}</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="media box-shadow p5">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50">-->
<!--                        <i class="fas fa-drafting-compass"></i>-->
<!--                    </div>-->
<!--                    <div class="media-body p-15px-l">-->
<!--                        <h5>Merchant integration</h5>-->
<!--                        <p class="m-0px">Receive money on your website with simple integration and a small fee of 10% per transaction.</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-6 m-15px-tb">-->
<!--                <img class="max-width-120" src="{{url('/')}}/asset/images/{{$ui->s2_image}}" title="" alt="">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->




<!--Hide from main page--start-->

<!--<section class="section effect-section" style="padding-top: 10px;">-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center md-m-25px-b m-40px-b">-->
<!--            <div class="col-lg-8 text-center">-->
<!--                <h3 class="h1 m-15px-b" style="    font-size: 38px;">Cashless - Billing features that stand out</h3>-->
<!--                <p class="m-0px font-2">Get more than just a payment gateway! Our payment solutions are the talk of the town and here's why. Recurring payments help you receive repetitive revenue, and flexible settlements makes it easier for you to share payments with your drop shippers.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--<div class="row">-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fas fa-shopping-basket"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">Sell Product</h5>-->
<!--                    <p class="m-0px">Combine multiple products and services on a single payment form to sell more.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fas fa-file-invoice-dollar"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">Recurring Payments</h5>-->
<!--                    <p class="m-0px">Receive payments periodically, without <br>hassle!</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fas fa-chart-line"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">Send & Request</h5>-->
<!--                    <p class="m-0px">Transfer and request money without account restrictions to any member.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fab fa-angellist"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">Auto-Settlement</h5>-->
<!--                    <p class="m-0px">Settle accounts twice a week automatically with the small fees!</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                    </div><div class="row">-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fas fa-clipboard-check"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">Become a Merchant</h5>-->
<!--                    <p class="m-0px">Securely store card details for a seamless checkout process.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fas fa-money-bill-wave"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">Payment Link</h5>-->
<!--                    <p class="m-0px">Create your own Merchant account that allow to integrate your website with merchant key to accept payment!</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fas fa-file-invoice"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">e-Invoicing</h5>-->
<!--                    <p class="m-0px">Request your payment easily with our customizable invoice!</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                        <div class="col-sm-6 col-lg-3 m-15px-tb">-->
<!--                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">-->
<!--                        <i class="fas fa-wallet"></i>-->
<!--                    </div>-->
<!--                    <h5 class="m-10px-b">e-Wallet Topup</h5>-->
<!--                    <p class="m-0px">Get more customers by receiving payment via e-Wallet!</p>-->
<!--                </div>-->
<!--            </div>-->
<!--                    </div>-->
<!--    </div>-->
<!--</section>-->

<!--Hide from main page--End-->



<!--Sandeep---code start-->
<section class="section gray-bg" style="    padding-top: 50px;">
  <div class="container">
        <div class="row justify-content-between  ">
            <div class="col-lg-6 m-15px-tb get-paid" style=" padding-top: 70px;">
                <h3 class="h1" style="padding-bottom: 22px;">Beyond Virtual Cards, <br>More Enterprise Feature!</h3>
                <p class="font-2 p-0px-t">Make fast, secure, and hassle-free payments for personal and business use!</p>
        <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
        <div class="row">
                <div class="col-sm-4">
                            <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/wallet (8).png" alt="" title="" style="width: 45px;margin-left: 30px;"><br> eWallet Topup</p>

                </div>
                <div class="col-sm-4">
                    <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/message.png" alt="" title="" style="width: 45px;margin-left: 30px;"><br> Fund Transfer </p>
                </div>
                <div class="col-sm-4">
                    <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/document.png" alt="" title="" class="text-center" style="width: 42px;margin-left: 30px;"><br> e-Invoicing </p>
                </div>
            </div>
            <br>
            <br>
           <div class="row">
                <div class="col-sm-4">
<p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/credit-card (3).png" alt="" title="" style="width: 40px;margin-left: 30px;"><br> Payment url (No Web/App) </p>
                </div>
                <div class="col-sm-4">
                   <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/backup.png" alt="" title="" style="width: 45px;margin-left: 30px;"><br> {{__('Subscription')}}</p>
                </div>
                <div class="col-sm-4">
                    <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/catalog.png" alt="" title="" style="width: 40px;margin-left: 30px;"><br> Sell Online </p>
                </div>
            </div>       
        
    </div>                                                                                   
                                                                                    
       <div class="p-20px-t" style="padding-top: 40px;">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://cuminup.com/enterprise-payment-solution">
                        <span class="m-btn-inner-text">Explore</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>                                                                             
                                                                                    
            </div>
            <div class="col-lg-6 m-15px-tb">
                <br><br><br><img class="max-width-120" src="https://cuminup.com/asset/images/pay2-pic1.jpg" title="" alt="" style="width: 100%;">
            </div>
        </div>
    
    
    
    
    <!--<div class="container">-->
    <!--    <div class="row justify-content-center md-m-25px-b m-40px-b">-->
    <!--        <div class="col-lg-8 text-center">-->
    <!--            <h3 class="h1 m-15px-b">{{__('Latest News')}}</h3>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="row">-->
    <!--        @foreach($blog as $val)-->
    <!--            <div class="col-lg-4 m-15px-tb">-->
    <!--                <div class="card blog-grid-1">-->
    <!--                    <div class="blog-img">-->
    <!--                        <a href="{{url('/')}}/single/{{$val->id}}/{{str_slug($val->title)}}">-->
    <!--                            <img src="{{url('/')}}/asset/thumbnails/{{$val->image}}" title="" alt="">-->
    <!--                        </a>-->
    <!--                        <span class="date">{{date("j", strtotime($val->created_at))}} <span>{{date("M", strtotime($val->created_at))}}</span></span>-->
    <!--                    </div>-->
    <!--                    <div class="card-body blog-info">-->
    <!--                        <h5>-->
    <!--                            <a href="{{url('/')}}/single/{{$val->id}}/{{str_slug($val->title)}}">{{$val->title}}</a>-->
    <!--                        </h5>-->
    <!--                        <p class="m-0px">{!!  str_limit($val->details, 60);!!}</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        @endforeach-->
    <!--    </div>-->
    <!--</div>-->
</section>
<!--Sandeep--code End-->



<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://cuminup.com/asset/images/mapping.png" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h3">No commitment! World-wide spending.</h3>
                
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Easy on-boarding process, plug-and-play platform means less commitment, and less time spent considering ready to use world-wide!</h6>
                    <p>
Use Virtual card to make payment world-wide.</p>
                </div>
                <div class="p-20px-t" style="
    padding-top: 40px;
">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://cuminup.com/register">
                        <span class="m-btn-inner-text">Apply Now</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>
<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://www.cuminup.com/asset/images/ACH.jpg" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">AUTOMATED CLEARING HOUSE (ACH)</h3>
                
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Get paid faster with ACH payment processing.</h6>
                    <p>
Use CuminUp ACH to make and accept payments.</p>
                </div>
                <div class="p-20px-t" style="
    padding-top: 40px;
">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://www.cuminup.com/register">
                        <span class="m-btn-inner-text">Apply Now</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>






<!-- card contents -->


<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">Digital Wallet & Virtual Cards</h3>
                
               
                    <p class="font-2 p-0px-t">
                        CuminUp put the purchase control in your hands Business or Personal, You decide who can charge your card, How much, How often
                    </p>
                     <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Virtual / Physical Cards ship cards to your business or customers. Various business that we support </h6>
                    <p>1. Advertising and Affiliate Agencies</p>
                    <p>2. Online Travel Agencies</p>
                    <p>3. PEOs & Payroll providers</p>
                    <p>4. SaaS Procurement Platform</p>
                    <p>5. Disbursements (Insurance & Warranty Payouts)</p>
                    <p>6. Health Insurance, FSA, HSA, and Benefits Providers</p>
                    <p>7. Expense Management Providers</p>
                    <p>8. Financial Services</p>
                    <p>9. Rewards and Incentives Platforms</p>
                    <p>10. Marketplaces</p>
                </div>
                <div class="p-20px-t" style="
    padding-top: 40px;
">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://www.cuminup.com/register">
                        <span class="m-btn-inner-text">Join CuminUp & Grow with us</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://www.cuminup.com/asset/images/cp.png" title="" alt="" style="    margin-bottom: 35px;">
            </div>
            
        </div>
    </div>
<br><br>    
    
</section>
<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <br><img src="https://cuminup.com/asset/images/prepaid card.png" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">Prepaid Card</h3>
                
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Prepaid card gives you loads of advantages and international acceptability</h6>
                    <p>1.Send money to other CuminUp users </p>
                    <p>2.Withdraw from any ATM with your CuminUp card</p>
                    <p>3.Access to a portal for card management and loading.</p>
                    <p>4.International card program.</p>
                    <p>5.Available in major currencies.</p>
                    <p>6.Instant issuance available.</p>
                   
                    
                </div>
                <div class="p-20px-t" style="
    padding-top: 40px;
">
                    <a class="m-btn m-btn-radius m-btn-theme" target="_blank" href="https://cuminup.com/#contact">
                        <span class="m-btn-inner-text">Apply Now</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>




<!--<section class="section gray-bg" style="    padding-top: 50px;">-->
    
    
    
<!--  <div class="container">-->
        
<!--        <div class="row justify-content-between  ">-->
<!--            <div class="col-lg-6 m-15px-tb get-paid" style="-->
<!--    padding-top: 70px;-->
<!--">-->
  
<!--                <h3 class="h1" style="-->
<!--    padding-bottom: 22px;-->
<!--">Beyond Virtual Cards, <br>More Enterprise Feature!</h3>-->
<!--                <p class="font-2 p-0px-t">Make fast, secure, and hassle-free payments for personal and business use!</p>-->
                

<!--        <div class="border-left-2 border-color-theme p-25px-l m-35px-t">-->
<!--        <div class="row">-->
<!--                <div class="col-sm-4">-->
<!--                            <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/wallet (8).png" alt="" title="" style="width: 45px;margin-left: 30px;"><br> eWallet Topup</p>-->

<!--                </div>-->
<!--                <div class="col-sm-4">-->
<!--                    <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/message.png" alt="" title="" style="width: 45px;margin-left: 30px;"><br> Fund Transfer </p>-->
<!--                </div>-->
<!--                <div class="col-sm-4">-->
<!--                    <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/document.png" alt="" title="" class="text-center" style="width: 42px;margin-left: 30px;"><br> e-Invoicing </p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <br>-->
<!--            <br>-->
<!--           <div class="row">-->
<!--                <div class="col-sm-4">-->
<!--<p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/credit-card (3).png" alt="" title="" style="width: 40px;margin-left: 30px;"><br> Payment url (No Web/App) </p>-->
<!--                </div>-->
<!--                <div class="col-sm-4">-->
<!--                   <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/backup.png" alt="" title="" style="width: 45px;margin-left: 30px;"><br> {{__('Subscription')}}</p>-->
<!--                </div>-->
<!--                <div class="col-sm-4">-->
<!--                    <p style="font-size: 18px;font-weight: bold;"><img src="https://cuminup.com/asset/images/catalog.png" alt="" title="" style="width: 40px;margin-left: 30px;"><br> Sell Online </p>-->
<!--                </div>-->
<!--            </div>       -->
        
<!--    </div>                                                                                   -->
                                                                                    
<!--       <div class="p-20px-t" style="-->
<!--    padding-top: 40px;-->
<!--">-->
<!--                    <a class="m-btn m-btn-radius m-btn-theme" href="https://cuminup.com/enterprise-payment-solution">-->
<!--                        <span class="m-btn-inner-text">Explore</span>-->
<!--                        <span class="m-btn-inner-icon arrow"></span>-->
<!--                    </a>-->
<!--                </div>                                                                             -->
                                                                                    
<!--            </div>-->
<!--            <div class="col-lg-6 m-15px-tb">-->
<!--                <br><br><br><img class="max-width-120" src="https://cuminup.com/asset/images/pay2-pic1.jpg" title="" alt="" style="-->
<!--    width: 100%;-->
<!--">-->
<!--            </div>-->
<!--        </div>-->
    
    
    
    <!--Already commented-->
    <!--<div class="container">-->
    <!--    <div class="row justify-content-center md-m-25px-b m-40px-b">-->
    <!--        <div class="col-lg-8 text-center">-->
    <!--            <h3 class="h1 m-15px-b">{{__('Latest News')}}</h3>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="row">-->
    <!--        @foreach($blog as $val)-->
    <!--            <div class="col-lg-4 m-15px-tb">-->
    <!--                <div class="card blog-grid-1">-->
    <!--                    <div class="blog-img">-->
    <!--                        <a href="{{url('/')}}/single/{{$val->id}}/{{str_slug($val->title)}}">-->
    <!--                            <img src="{{url('/')}}/asset/thumbnails/{{$val->image}}" title="" alt="">-->
    <!--                        </a>-->
    <!--                        <span class="date">{{date("j", strtotime($val->created_at))}} <span>{{date("M", strtotime($val->created_at))}}</span></span>-->
    <!--                    </div>-->
    <!--                    <div class="card-body blog-info">-->
    <!--                        <h5>-->
    <!--                            <a href="{{url('/')}}/single/{{$val->id}}/{{str_slug($val->title)}}">{{$val->title}}</a>-->
    <!--                        </h5>-->
    <!--                        <p class="m-0px">{!!  str_limit($val->details, 60);!!}</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        @endforeach-->
    <!--    </div>-->
    <!--</div>-->
    <!--Already commented-->
<!--</section>-->
<!-- end card contents -->

<!-- ppe contents -->


<br><br>


<!--<section class="section effect-section" style="-->
<!--    padding: 0px 0;-->
<!--">-->
<!--    <div class="container">-->
<!--        <div class="row align-items-center">-->
<!--            <div class="col-lg-6 m-15px-tb text-center">-->
<!--                <img src="https://www.cuminup.com/asset/images/cb.png" title="" alt="">-->
<!--            </div>-->
<!--            <div class="col-lg-6 m-15px-tb">-->
<!--                <h3 class="h1">Does your business need help during the COVID-19 pandemic?</h3>-->
                
<!--                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">-->
<!--                    <h6 class="font-2">Apply for a Paycheck Protection Program (PPP) Loan via our Loan Partner and get PPP help.</h6>-->
<!--                    <p>-->
<!--A new round of funding for the Paycheck Protection Program (PPP), administered by the SBA, continues the availability of much-needed financial support for eligible small businesses to help keep employees and stay open safely during the COVID-19 pandemic.</p>-->
<!--                </div>-->
<!--                <div class="p-20px-t" style="-->
<!--    padding-top: 40px;-->
<!--">-->
<!--                    <a class="m-btn m-btn-radius m-btn-theme" target="_blank" href="https://www.smartbizloans.com/apply?partner_id=cuminup&sb_apply_form=paycheck_protection ">-->
<!--                        <span class="m-btn-inner-text">Apply Now</span>-->
<!--                        <span class="m-btn-inner-icon arrow"></span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- end of ppe contents -->


<br>

<br>


<!-- content for Mercury account -->

<br><br>




<!--<section class="section effect-section" style="-->
<!--    padding: 0px 0;-->
<!--">-->
<!--    <div class="container">-->
<!--        <div class="row align-items-center">-->
            
<!--            <div class="col-lg-6 m-15px-tb">-->
<!--                <h3 class="h1">CuminUp Banking partner </h3>-->
                
<!--               <p class="font-2 p-0px-t">-->
<!--                    That built for start-ups and SME’s -->
<!--                   </p>-->
<!--                    <p class="font-2 p-0px-t">-->
                       
<!--                       companies Get full-stack bank accounts-->
<!--                    </p>-->
<!--                     <div class="border-left-2 border-color-theme p-25px-l m-35px-t">-->
<!--                    <h6 class="font-2">Open FDIC-insured bank accounts that come with Virtual & Debit Cards, team management, and a lot more. </h6>-->
<!--                     <p>Mercury makes bank accounts that help tech companies scale</p>-->
                    
                   
<!--                </div>-->
<!--                <div class="p-20px-t">-->
<!--                    <img src="https://www.cuminup.com/asset/images/mc.png" style="width:50%">-->
                   
<!--                    <h5 style="    padding-top: 20px;">Open an account right from your laptop</h5>-->
<!--                    <a class="m-btn m-btn-radius m-btn-theme" href="https://www.cuminup.com/register">-->
                        
<!--                        <span class="m-btn-inner-text">Get Started</span>-->
<!--                        <span class="m-btn-inner-icon arrow"></span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-6 m-15px-tb text-center">-->
<!--                <img src="https://www.cuminup.com/asset/images/lp.png" title="" alt="" style="    margin-bottom: 35px;">-->
<!--            </div>-->
            
<!--        </div>-->
<!--    </div>-->
<!--</section>-->


<!-- end of mercury account -->


<br><br>







@if(count($review)>0)
<section class="p-50px-t">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <img src="{{url('/')}}/asset/images/{{$ui->s7_image}}" title="" alt="">
            </div>
            <div class="col-lg-5 m-30px-b m-30px-t">
                <h3 class="h3 m-30px-b">{{$ui->s7_title}}</h3>
                <div class="owl-carousel owl-nav-arrow-bottom white-bg box-shadow-lg p5" data-items="1" data-nav-arrow="true" data-nav-dots="false" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1" data-space="0" data-autoplay="true">
                    @foreach($review as $vreview)
                    <div class="p-25px m-20px-b">
                        <p class="m-0px">{{$vreview->review}}</p>
                        <div class="media m-20px-t">
                            <div class="avatar-60 border-radius-50">
                                <img src="{{url('/')}}/asset/review/{{$vreview->image_link}}" alt="" title="">
                            </div>
                            <div class="media-body p-15px-l align-self-center">
                                <h6 class="m-0px">{{$vreview->name}}</h6>
                                <span class="font-small">{{$vreview->occupation}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section class="section gray-bg" style="    padding-top: 50px;">
    
    
    
  <div class="container">
        
        <div class="row justify-content-between  ">
            <div class="col-lg-6 m-15px-tb get-paid" style="
    padding-top: 165px;
">
  
                <h3 class="h1" style="
    padding-bottom: 22px;
">Social Selling - Get paid anywhere. You can sell everywhere.</h3>
                <p class="font-2 p-0px-t">Whether you sell on an eCommerce website, social media, or other platforms CuminUp helps you receive online payments easily.</p>
                
                <div class="social-icon si-30 white round nav" style="
    padding-top: 20px;">
                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/facebook.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/whatsapp.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/messenger.png" alt="" title=""></a>
                                                                                                                                                                                                                                                                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/instagram.png" alt="" title=""></a>
                                                                                  
                                                                                    </div>
                                                                                    
   <div class="social-icon si-30 white round nav" style="
    padding-top: 20px;">
   <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/main-socmed-wp@2x-291x300.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/twitter.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/gmail.png" alt="" title=""></a>
                                                                                                                                                                                                                                                                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/outlook.png" alt="" title=""></a>
                                                                                                                          
                                                                                    </div>                                                                     
                                                                                    
            </div>
            <div class="col-lg-6 m-15px-tb">
                <img class="max-width-120" src="https://www.cuminup.com/asset/images/pay.png" title="" alt="" style="
    width: 100%;
">
            </div>
        </div>
    </div>
    
    
    
    <!--<div class="container">-->
    <!--    <div class="row justify-content-center md-m-25px-b m-40px-b">-->
    <!--        <div class="col-lg-8 text-center">-->
    <!--            <h3 class="h1 m-15px-b">{{__('Latest News')}}</h3>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="row">-->
    <!--        @foreach($blog as $val)-->
    <!--            <div class="col-lg-4 m-15px-tb">-->
    <!--                <div class="card blog-grid-1">-->
    <!--                    <div class="blog-img">-->
    <!--                        <a href="{{url('/')}}/single/{{$val->id}}/{{str_slug($val->title)}}">-->
    <!--                            <img src="{{url('/')}}/asset/thumbnails/{{$val->image}}" title="" alt="">-->
    <!--                        </a>-->
    <!--                        <span class="date">{{date("j", strtotime($val->created_at))}} <span>{{date("M", strtotime($val->created_at))}}</span></span>-->
    <!--                    </div>-->
    <!--                    <div class="card-body blog-info">-->
    <!--                        <h5>-->
    <!--                            <a href="{{url('/')}}/single/{{$val->id}}/{{str_slug($val->title)}}">{{$val->title}}</a>-->
    <!--                        </h5>-->
    <!--                        <p class="m-0px">{!!  str_limit($val->details, 60);!!}</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        @endforeach-->
    <!--    </div>-->
    <!--</div>-->
</section>
<section class="section" style="    background-image: url(https://www.cuminup.com/asset/images/image.png);
       background-size: cover;
    background-position: right;">
    <div class="container">
        <div class="row justify-content-center md-m-25px-b m-40px-b">
            <div class="col-lg-6 text-center">
                <h3 class="h1 m-0px" style="    color: #ffffff;">Join thousands who choose CuminUp {{__('worldwide.')}}</h3>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-dark m-btn-radius" href="{{route('register')}}">{{__('Sign Up for Free')}} </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Contact Page work start-->
<section class="section bg-no-repeat bg-right-center gray-bg" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-15px-tb">
                <div class="row md-m-25px-b m-40px-b">
                    <div class="col-lg-12">
                        <h3 class="h1 m-15px-b">Need a hand?</h3>
                        <p class="m-0px font-2">We are here for all of your business needs. Our team of caring experts are standing by. Send your questions today by filling out the form below. Someone from our team will get back to you shortly. Someone from our team will get back to you shortly.</p>
                    </div>
                </div>
                <form class="rd-mailform" method="post" action="{{route('contact-submit')}}">
                    @csrf
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
                                <option value="<?=$country->name?>"  @if(!empty($query['countryCode']))<?=($country->iso_code == $query['countryCode']) ? 'selected' : ''?> @endif>{{$country->name}}</option>
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
                                <option value="<?=$country->calling_code?>"  @if(!empty($query['countryCode']))<?=($country->iso_code == $query['countryCode']) ? 'selected' : ''?> @endif>{{$country->iso_code}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
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
                        
                       
                        @if($set->recaptcha==1)
                            <div class="col-12">
                                <div class="form-group">
                                    {!! app('captcha')->display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            {{ $errors->first('g-recaptcha-response') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    
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
                <!--        <h6 class="h4 m-0px">{{$set->mobile}}</h6>-->
                <!--    </div>-->
                <!--</div>                -->
                <div class="media align-items-center p-10px-tb">
                    <div class="icon-40 theme-bg-alt border-radius-50 theme-color">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h6 class="h4 m-0px"><a href="mailto:{{$set->email}}">{{$set->email}}</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 m-15px-tb ml-auto" id="faq">
                <div class="accordion accordion-08 p10 border-radius-15 dark-bg white-color-light links-white">
                    @foreach($faq as $vfaq)
                    <div class="acco-group">
                        <a href="#" class="acco-heading">{{$vfaq->question}}</a>
                        <div class="acco-des">{!! $vfaq->answer!!}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact Page work End-->

@stop