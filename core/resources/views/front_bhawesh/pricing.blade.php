@extends('layout')
@section('css')

@stop
@section('content')
<style>
    .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgb(229 229 229 / 77%);
    border-radius: 1rem;
}

.pricing-plan-features li::before {
    content: "\F12C";
    font-family: "Material Design Icons";
    color: #3ccf8e;
       font-weight: 800;
    margin-left: 10px;
}
.pricing-plan-features {text-align:left;}.pricing-card {
    border: 1px solid #efefef;}
</style>
         
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('/')}}/asset/css/pricing-plan.css">
<section class="parallax effect-section">
    <div class="mask white-bg opacity-8"></div>
        <div class="container position-relative">
            <div class="row screen-65 align-items-center justify-content-center p-100px-tb">
                <div class="col-lg-10 text-center">
                    <h6 class="white-color-black font-w-500">{{$set->title}}</h6>
                    <h1 class="display-4 black-color m-20px-b" style="    font-weight: bold;">{{__('Our flexible Pricing Model')}}</h1>
                </div>
            </div>
        </div>
     
</section>
 <main>
          
            <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="card pricing-card pricing-plan-basic" style="box-shadow: 0 2px 40px 0 rgb(205 205 205 / 55%)">
            <div class="card-body">
              <i class="mdi mdi-cube-outline pricing-plan-icon"></i>
              <h3 class="h3"><b></b>Standard</h3></b>
              <h6 class="pricing-plan-title">FREE</h6>
              <br><ul class="pricing-plan-features">
                <li>Create up to 10 cards per months</li>
                <li>Add fund from various payment method</li>
                <li>Set spends limits, pause and close cards</li>
                <li>Web & Mobile Apps</li>
                <li>Access your data through our API</li>
              </ul>
              <a href="https://getvirtualcard.co.uk/register" class="btn pricing-plan-purchase-btn">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card pricing-card pricing-card-highlighted  pricing-plan-pro">
            <div class="card-body">
                <i class="mdi mdi-trophy pricing-plan-icon"></i>
              <h3 class="h3"><b></b>Enterprise</h3></b>
              <h6 class="pricing-plan-title">PER TRANSACTION FEE</h6>
             <br><ul class="pricing-plan-features">
                 <div></div>
                <li>Create up to 50 cards per month</li>
                <li>Add fund from various payment method</li>
                <li>Single & recurring payments</li>
                <li>Fund Transaction</li>
                <li>Donation</li>
                <li>e-Invoicing</li> 
                <li>Sell Online (Product & Services)</li>
                <li>Accept any form of payment for your business</li>
                <li>Merchant Gateway Private Keys</li>
                <li>Priority support- Account Manager</li>
                <li>0.50% cashback on your purchases*</li>
                <p>*On eligible transactions totalling up to $5,000 per month</p>
              </ul>
              <a href="https://getvirtualcard.co.uk/register" class="btn pricing-plan-purchase-btn">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card pricing-card pricing-plan-enterprise" style="box-shadow: 0 2px 40px 0 rgb(205 205 205 / 55%)">
            <div class="card-body">
              <i class="mdi mdi-wallet-giftcard pricing-plan-icon"></i>
              <h3 class="h3"><b></b>Partnership</h3></b>
              <h6 class="pricing-plan-title">WHITE LABEL CUSTOM BRANDING</h6>
              <br><ul class="pricing-plan-features">
                <li>Sandbox Environment</li>
                <li>Production Environment</li>
                <li>All in One Feature </li>
                <li>UI customisation & white label</li>
              </ul>
              <a href="https://getvirtualcard.co.uk/#contact" class="btn pricing-plan-purchase-btn">Get in Touch</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@stop