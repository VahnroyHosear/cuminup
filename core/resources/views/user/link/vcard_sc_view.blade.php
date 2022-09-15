@extends('paymentlayout')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
@php
$paypalGatewayDetails = DB::table('gateways')->where('id',507)->first();

@endphp
<div class="main-content payment">
  <div class="header py-5">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h3 class="text-white">@if(!empty($productTypeDetails->name)){{$productTypeDetails->name}}@endif
            </h3> <span class="text-white">By {{$merchant->first_name}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">    
    </div>
  </div>
  <div class="container mt--8 pb-5 mb-0">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
          <span class="alert-icon"><i class="ni ni-like-2"></i></span>
          @foreach($errors->all() as $error)
          <span class="alert-text">{{$error}}</span>
          @endforeach
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="card card-profile bg-white border-0 mb-5">
            <a href="{{url('user/newdashboard')}}"  class="text-right" style="font-size:29px;margin-right: 20px;" data-dismiss="modal">&times;</a>
            
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                  <a href="{{url('user/newdashboard')}}">
                <img src="{{url('/')}}/asset/{{$logo->image_link}}" class="rounded-circle border-secondary" style="border-radius:0%!important;margin-top: 23px;">
                </a>
              </div>
              
            </div>
            
          
            
          </div>
            <div class="card-body pt-7 px-2">
          <center><h3> Order Summary </h3></center>
        
              <div class=" box" style="padding: 15px;">
      
<h5>Product Type (@if(!empty($productTypeDetails->name)){{$productTypeDetails->name}}@endif)</h5>
       
      <table>
          <tr>
         <td>Quantity </td> <td>{{$planDetails->plan_quantity}} {{__('Cards')}} </td>
    </tr>
    <tr>
    <td>Expedited Fee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> <td>{{$currency->symbol.number_format($planDetails->plan_expedited_fee,2)}} </td>
    </tr>
     <tr><td>Card Fee</td> <td>{{$currency->symbol.number_format($planDetails->plan_price,2)}}</td></tr>
    <tr>
        <th><b>Total Cost</b></th> <td><b>{{$currency->symbol.number_format($planDetails->plan_price+$planDetails->plan_expedited_fee,2)}}</b></td></tr>
    
   </table>
<br>
        </div> 
            <div class="text-center text-dark mb-5">
              
              <small>{!!$link->description!!}</small>
            </div>
            <form role="form" action="{{ route('send.vcard.single')}}" method="post" id="modal-details">
                <input type="hidden" name="payment_link_ref_id" value="{{$payment_link_ref_id}}">
                
              @csrf
              @if($link->amount==null)
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-future">{{$currency->symbol}}</span>
                  </div>
                  <input class="form-control" placeholder="0.00" id="xx" type="number" name="amount" required>
                </div>
              </div>
              @else
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-future">{{$currency->symbol}}</span>
                  </div>
                  <input class="form-control" readonly type="number" name="amount" value="{{number_format($planDetails->plan_price+$planDetails->plan_expedited_fee,2)}}">
                </div>
              </div>
              @endif
              <input type="hidden" value="{{$link->ref_id}}" name="link">
              <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="accordion" id="accordionExample">
                          <h3 class="mb-0" style="padding: 15px;">Select a Payment Method <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                        <div class="card bg-white border-0 mb-0">
                          <!--Pay with Card-->
                          <div class="card-header" id="headingOne">
                            <!--div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <h4 class="mb-0">Card</h4>
                            </div-->
                             <div class="row" class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="col-sm-2"> <img src="{{url('/')}}/asset/images/visa_1.png" width="100%"></div>      
                        <div class="col-sm-9">
                           
                             <h3 class="mb-0">Visa/Mastercard</h3>
                            <!--h4 class="mb-0">Instant small amounts</h4>
                            <span style="font-size:0.8rem">Use any Visa or Mastercard Debit/Credit card  to make a small investments.</span-->
                           
                        </div>
                    </div> 
                          </div>
                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                              <form action="{{ route('send.single')}}" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$stripe->val1}}" id="payment-form">
                                @csrf
                                <div class="form-group row">
                                  <div class="col-xs-12 col-md-12 form-group required">
                                    <input type="text" class="form-control input-lg custom-input" name="cardNumber" placeholder="Debit/Credit Card Number*" minlength="16"  maxlength='16' autocomplete="off" required autofocus onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/ required>
                                  </div>
                                  <div class='col form-group cvc'>
                                    <input  autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC*' type='text' minlength="3"  maxlength="3" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                  </div>
                                  <div class='col form-group expiration required'>
                                    <input type="text" class='form-control card-expiry-month' style="width: 125%;border-right: none;"name="cardM" placeholder='MM*' minlength="2" maxlength='2' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    </div>
                                  <div class='col form-group expiration required'>
                                    <input type="text" class='form-control card-expiry-year' style="border-left: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;"name="cardY" placeholder='YYYY*' minlength="4" maxlength='4' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    </div>
                                  <div class="col-xs-12 col-md-12 form-group required">
                                    <input type="email" class="form-control input-lg custom-input" name="email" placeholder="Email Address*" autocomplete="off" required autofocus/>
                                  </div>
                                  <div class="col form-group required">
                                    <input type="text" class="form-control input-lg custom-input" maxlength="50" name="first_name" placeholder="First Name*" id="firstname"autocomplete="off" required autofocus/>
                                    <small><p id='first' style="font-size: 12px; color: red;"></p></small>
   
                                  </div>                                  
                                  <div class="col form-group required">
                                    <input type="text" class="form-control input-lg custom-input" maxlength="50" id="lastname" name="last_name"  placeholder="Last Name*" autocomplete="off" required autofocus/>
                                   <small><p id='last' style="font-size: 12px; color: red;"></p></small>
                                  </div>
                                </div> 
                                <div class='form-group row'>
                                   
                                  
                                </div>	
                                
                                <input type="hidden" value="card" name="type">  	                
                                <div class="text-center">
                                  <button type="submit" class="btn btn-success btn-sm" form="modal-details" style="font-size: 16px;">{{__('Pay Now')}} <span id="cardresult"></span></button><br>
                                  <img src="{{url('/')}}/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                                </div>
                                
                              </form>
                            </div>
                          </div>
                            <!--PAYPAL START-->
                     <hr>
                    <div class="card-header" id="headingFour">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                           <div class="row">
                        <div class="col-sm-2">
                           

                        <img src="{{url('/')}}/asset/images/paypal.png" width="90%"></div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">PayPal</h3>
                            <!--h4 class="mb-0">Instant large amounts</h4>
                            <span style="font-size:0.8rem">Use Your PayPal account to instantly Purchase Plan</span-->
                        </div>
                    </div>
                          </div>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body text-center">
                         
                          <form action="{{ route('paypal')}}" role="form" method="post">
                          @csrf
                          <!--div class="form-group row">
                            <div class="col-xs-12 col-md-12 form-group required">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">{{$currency->symbol}}</span>
                                </div>
                                <input type="text" step="any" class="form-control" name="amount" id="paypalamount_id" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10" onchange="chechCharge()"  placeholder="0.00" min="{{$stripe->minamo}}" required> 
                                <input type="hidden" value="{{$stripe->charge}}" id="charge"> 
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                               
                              </div>
                              <p style="margin-left:-395px;">Fees:<span id="fees_amount_id">0.00</span></p>
                               <span id="paypalamount_id_error" style="color:red"></span>
                            </div>
                            
                          </div--> 
                         	
                         	</style>
                          <div class="text-center">
                              <div id="paypal-button-container"></div>
                            <!--button type="submit" class="btn btn-success btn-sm">{{__('Pay')}} <span id="cardresult"></span></button--><br>
                          </div>
                          
                        </form>
                        </div>
                      </div>
                    <!--END PAYPAL-->
                          <!--Account Balance-->
                          
                          <!--div class="card-header" id="headingTwo">
                              <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="row">
                        <div class="col-sm-2">
                        <img src="{{url('/')}}/asset/images/bank.png" width="100%"></div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">Pay with Account</h3>
                            
                        </div>
                    </div>
                              </div>
                          </div-->
                          <!--div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body text-center">
                              @if (Auth::guard('user')->check())
                                <form method="post" role="form" action="{{route('send.single')}}">
                                  @csrf
                                  <h4 class="mb-0">Account Balance</h4>
                                  <h1 class="mb-1 text-muted">{{$currency->symbol.number_format($user->balance)}}</h1>
                                  <input type="hidden" value="account" name="type">
                                  <input type="hidden" value="{{$link->ref_id}}" name="link">
                                  <input type="hidden" name="amount" id="castro" value="{{$link->amount}}">
                                  <div class="text-center">
                                    <button type="submit" onclick="second_modal()" class="btn btn-neutral btn-sm">Pay now</button>
                                  </div>
                                </form>
                              @else
                                @php
                                  Session::put('oldLink', url()->current());
                                @endphp
                                <h3 class="mb-3 text-muted">Login to Complete Transfer</h3>
                                <a href="{{route('login')}}" class="btn btn-neutral btn-sm">Login</a>
                              @endif
                            </div>
                          </div-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="customCheckLogin" type="checkbox" checked required>
                  <label class="custom-control-label" for="customCheckLogin">
                    <span class="text-muted">Agree to <a href="{{route('terms')}}">Terms & Conditions</a></span>
                  </label>
                </div>
              <div class="text-center">
                <button type="button" data-toggle="modal" data-target="#fund" id="submit_pay_now_button" disabled class="btn btn-success my-4" style="font-size:17px;border-radius:4px;padding:5px">{{__('Pay Now')}}</button>
              </div>
              <div class="text-center">
                <p class="paragraph small">If you have any questions, contact <b>{{$set->support_email}}</b>
                  <a href="mailto:{{$set->email}}"></a>
                </p>
              </div>
              {{--
              <div class="text-center">
                @if($merchant->first_name!=null)
                  <a href="#"><i class="sn fab fa-facebook"></i></a>   
                @endif 
                @if($merchant->first_name!=null)                      
                  <a href="#"><i class="sn fab fa-twitter"></i></a>
                @endif      
                @if($merchant->first_name!=null)                     
                  <a href="#"><i class="sn fab fa-linkedin"></i></a> 
                @endif     
                @if($merchant->first_name!=null)                        
                  <a href="#"><i class="sn fab fa-instagram"></i></a>   
                @endif 
                @if($merchant->first_name!=null)                          
                  <a href="#"><i class="sn fab fa-youtube"></i></a>  
                @endif                        
              </div>
              --}}
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <form action="{{route('paypal.vcard.single')}}" method="POST" id="paypal_success_form">
      @csrf
      <input type="hidden" name="type" value="paypal">
       <input type="hidden" name="payment_link_ref_id" value="{{$payment_link_ref_id}}">
      <input type="hidden" name="paypal_amount" id="paypal_amount_idd">
      <input type="hidden" name="paypal_status" id="paypal_status">
      <input type="hidden" name="paypal_email" id="paypal_email">
      <input type="hidden" name="paypal_trx_id" id="trx_id">
   </form>
    <script src="https://www.paypal.com/sdk/js?client-id={{$paypalGatewayDetails->val1}}"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>
    <script>
    $(document).ready(function(){
        $('#first').hide();
        $('#last').hide();
     $("#firstname").keyup(function(){
         var inputtxt = $("#firstname").val();
         //alert(inputtxt);
         var letters = /^[A-Za-z]+$/;
           if(inputtxt.match(letters))
             {
                 $('#first').hide();
              return true;
             }
           else
             {
               $('#first').show();
               $('#firstname').val(null);
             
             }
      });
      $("#lastname").keyup(function(){
         var lasttxt = $("#lastname").val();
         //alert(inputtxt);
         var letters = /^[A-Za-z]+$/;
           if(lasttxt.match(letters))
             {
                 $('#last').hide();
              return true;
             }
           else
             {
               $('#last').show();
               $('#lastname').val(null);
             
             }
      });
    });
    </script>

    <!-- Add the checkout buttons, set up the order and approve the order -->
    <script>
          $( document ).ready(function() {
           if($('#customCheckLogin').val() == 'on')
           {
               $('#submit_pay_now_button').prop('disabled', false);
           } else {
               $('#submit_pay_now_button').prop('disabled', true);
           }
          });
          $("#customCheckLogin").change(function () {
                //alert($(this).val());
                if($(this).val() == 'on')
                {
                    $('#submit_pay_now_button').prop('disabled', false);
                } else {
                    $('#submit_pay_now_button').prop('disabled', true);
                }
            });
    function chechCharge()
{
   //var Feesamount =  parseFloat($('#paypalamount_id').val().replace(/,/g, ''))*<?php echo $paypalGatewayDetails->charge ?>/100;
   
    //alert(Feesamount);
    //$('#fees_amount_id').html(Feesamount.toFixed(2));
    //$('#fees_amount_idd').val(Feesamount.toFixed(2));
}
    
      paypal.Buttons({
         
        createOrder: function(data, actions) {
                return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: {{number_format($planDetails->plan_price+$planDetails->plan_expedited_fee,2)}}
                  }
                }]
              });
         
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
                    url: "{{url('user')}}/paypal_success",
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
    </script>
   <!--END PAYPAL-->
   
@stop