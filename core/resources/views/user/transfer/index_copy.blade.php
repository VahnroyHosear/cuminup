@extends('userlayout')
<head>
  <meta name="csrf-token" content="{{csrf_token()}}" />

</head>    
@section('content')
@php
$paypalGatewayDetails = DB::table('gateways')->where('id',507)->first();

@endphp
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="#" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Send money')}}</a>
              <a data-toggle="modal" data-target="#fund" href="#"  class="btn btn-sm btn-success">{{__('Load Fund to Your Account')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">   
        <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                  
                <div class="accordion" id="accordionExample">
                    <h3 class="mb-0" style="padding: 15px;">Select a Payment Method</h3>
                  <div class="card bg-white border-0 mb-0">
                    <div class="card-header" id="headingOne">
                      <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="row">
                        <div class="col-sm-2"><i class="fa fa-credit-card-alt fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">Debit/Credit Cards</h3>
                            <h4 class="mb-0">Instant small amounts</h4>
                            <span style="font-size:0.8rem">Use any Visa or Mastercard Debit/Credit card  to make a small investments.</span>
                        </div>
                    </div>    
                      </div>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                        <form action="{{ route('card')}}" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$stripe->val1}}" id="payment-form">
                          @csrf
                           <span>Card Details</span>
                           <!--div id="card-element">
                            </div>
                            <div id="card-errors" role="alert"></div-->
                           
                         <div class="form-group row">
                            <div class="col-xs-12 col-md-12 form-group required">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">{{$currency->symbol}}</span>
                                </div>
                                <input type="number" step="any" class="form-control" name="amount" id="cardamount" onkeyup="cardcharge()" placeholder="0.00" min="{{$stripe->minamo}}" required> 
                                <input type="hidden" value="{{$stripe->charge}}" id="charge"> 
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                            </div>
                            &nbsp;&nbsp;<span>{{__('Your saved credit and debit cards')}}</span>
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>{{__('Card Type')}}</th>
                                <th>{{__('Last 4 Digit')}}</th>
                                <th>{{__('Expire')}}</th>
                            </tr>
                        <tbody> 
                        <tr>
                        @foreach($list_saved_cards as $cardDetails)
                        <td><input type="radio" name="selected_card" style="-webkit-appearance: auto;" onclick="radioValueFunction(this.value)" value="{{$cardDetails->last4}}">
                        <span id="{{$cardDetails->last4}}" style="display:none;">Enter CVV No.&nbsp;<input type="text" size='8' name="cvv" ></span>
                        </td>
                        <td>{{$cardDetails->brand}}</td>
                        <td>{{$cardDetails->last4}}</td>
                         
                          <td>{{$cardDetails->exp_month}}/{{$cardDetails->exp_year}}</td>
                        @endforeach
                        </tr>
                        </tbody>
                        </table>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><input type="radio" name="selected_card" style="-webkit-appearance: auto;" onclick="radioValueFunction(this.value)" value="new"> {{__('Add Debit/Credit/ATM Card')}}</span>
                      <br>
                      <span id="add_new_card" style="display:none!important;">
                            <div class="col form-group required">
                              <input type="text" class="form-control input-lg custom-input card-number" name="cardNumber" placeholder="Valid Card Number" minlength="16" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="16" autocomplete="off" required autofocus size="20"/>
                            </div>
                          </div> 
                          <div class='form-group row' id="add_new_card2" style="display:none;">
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-month' name="cardM" placeholder='MM' maxlength='2' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY' maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                          </div>
                         </span>
                          
                          <span>Billing Address</span>
                              <div class='row'>
                            <div class='col-sm-6'>
                              <input autocomplete='off' class='form-control' name="user_name"  placeholder='Full Name' type='text' required >
                            </div>
                            <div class='col-sm-6'>
                              <input class='form-control' placeholder='Email'  name="user_email" type='text' required>
                            </div>
                            
                          </div>
                          <br>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <input autocomplete='off' class='form-control'  placeholder='Address' type='text' name='user_address' required >
                            </div>
                            <div class='col-sm-6'>
                              <input class='form-control' placeholder='City' name="user_city" type='text' required>
                            </div>
                            
                          </div>
                            <br>
                            <div class='form-group row'>
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="user_state" placeholder='State' type='text' required >
                            </div>
                            <div class='col form-group expiration required'>
                                <select class="form-control" name="user_country">
                                    <option>Select Country</option>
                                    <?php foreach($countries as $country){?>
                                    <option value="<?=$country->iso_code?>"><?= $country->name ?></option>
                                    <?php }?>
                                </select>    
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-year' name="user_zipcode" placeholder='Zip Code' maxlength='7' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            
                          </div>
                          <div class="form-group required">
                              <textarea placeholder="Description" name="user_description"  class="form-control" required ></textarea>
                            </div>
                             			  	                
                          <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm">{{__('Pay')}} <span id="cardresult"></span></button><br>
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
<i class="fa fa-paypal fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">PayPal</h3>
                            <h4 class="mb-0">Instant large amounts</h4>
                            <span style="font-size:0.8rem">Use Your PayPal account to instantly Add Fund.</span>
                        </div>
                    </div>  
                          </div>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body text-center">
                          <!--h4 class="mb-0">{{$adminbank->bank_name}}</h4>
                          <h1 class="mb-1 text-muted">{{$adminbank->acct_no}}</h1-->
                          <form action="{{ route('paypal')}}" role="form" method="post">
                          @csrf
                          <div class="form-group row">
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
                              <p style="margin-left:-80%;">Fees:<span id="fees_amount_id">0.00</span></p>
                               <span id="paypalamount_id_error" style="color:red"></span>
                            </div>
                            
                          </div> 
                         	
                         	</style>
                          <div class="text-center">
                              <div id="paypal-button-container"></div>
                            <!--button type="submit" class="btn btn-success btn-sm">{{__('Pay')}} <span id="cardresult"></span></button--><br>
                          </div>
                          
                        </form>
                        </div>
                      </div>
                    <!--END PAYPAL-->
                    @if($adminbank->status==1)
                      <hr>
                      <div class="card-header" id="headingTwo">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#`Two" aria-expanded="false" aria-controls="collapseTwo">
                           <div class="row">
                        <div class="col-sm-2">
<i class="fa fa-university fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">Bank Account</h3>
                            <h4 class="mb-0">Invest large amounts</h4>
                            <span style="font-size:0.8rem">Use a bank account to instantly Add Fund.</span>
                        </div>
                    </div> 
                          </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body text-center">
                          <h4 class="mb-0">{{$adminbank->bank_name}}</h4>
                          <h1 class="mb-1 text-muted">{{$adminbank->acct_no}}</h1>
                          <form method="post" action="{{route('bank_transfersubmit')}}">
                            @csrf
                            <div class="form-group row">
                              <div class="col-lg-6 offset-lg-3">
                                <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text">{{$currency->symbol}}</span>
                                  </span>
                                  <input type="number" step="any" name="amount" max-length="10" class="form-control" required>
                                </div>
                              </div>
                            </div>
                            <div class="text-center">
                              <button type="submit" class="btn btn-neutral btn-sm">I'hv sent the money</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    @endif
                    <hr>
                    <div class="card-header" id="headingThree">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          
                          <div class="row">
                        <div class="col-sm-2">
<i class="fa fa-btc fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-9">
                            <h3 class="mb-0">Crypto Currency</h3>
                            <h4 class="mb-0">Invest large amounts</h4>
                            <span style="font-size:0.8rem">Use a crypto currency account to instantly Add Fund.</span>
                        </div>
                    </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        <form method="post" action="{{ route('crypto')}}">
                          @csrf
                          <div class="form-group row">
                            <div class="col-lg-8 offset-lg-2">
                              <div class="input-group">
                                <span class="input-group-prepend">
                                  <span class="input-group-text">{{$currency->symbol}}</span>
                                </span>
                                <input type="number" step="any" name="amount" max-length="10" class="form-control" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-8 offset-lg-2">
                              <select class="form-control select" name="crypto" data-dropdown-css-class="bg-primary" data-fouc required>
                                  <option value='505'>Bitcoin</option>
                                  <option value='506'>Ethereum</option>
                              </select>
                            </div>
                          </div>          
                          <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm">{{__('Pay')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Transfer money')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Transfer charge is {{$set->transfer_charge}}% per transaction, If user is not a member of {{$set->site_name}}, registration will be required to claim money. Money will be refunded within 5 days if user does not claim money.</span>
                  </div>
                  <div class="card-body">
                    <form action="{{route('submit.ownbank')}}" method="post" id="modal-details">
                      @csrf
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Email')}}</label>
                          <div class="col-lg-10">
                              <input type="email" name="email" class="form-control" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Amount')}}</label>
                          <div class="col-lg-10">
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <span class="input-group-text">{{$currency->symbol}}</span>
                              </span>
                              <input type="number" class="form-control" name="amount" id="amounttransfer" min="{{$set->min_transfer}}"  onkeyup="transfercharge()" required>
                              <input type="hidden" value="{{$set->transfer_charge}}" id="chargetransfer">
                              <span class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </span>
                            </div>
                          </div>
                        </div>                   
                        <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details">{{__('Pay')}} <span id="resulttransfer"></span></button>
                        </div>         
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          @if(count($transfer)>0)  
            @foreach($transfer as $k=>$val)
              <div class="col-md-6">
                <div class="card bg-white">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8">
                        <!-- Title -->
                        <h5 class="h4 mb-0 text-dark">#{{$val->ref_id}}</h5>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          <p class="text-sm text-dark mb-0">{{__('Amount')}}: {{$currency->symbol.number_format($val->amount)}}</p>
                          @if($val->receiver['email']!=null)
                          <p class="text-sm text-dark mb-0">{{__('Email')}}: {{$val->receiver['email']}}</p>
                          @else
                          <p class="text-sm text-dark mb-0">{{__('Email')}}: {{$val->temp}}</p>
                          @endif
                          <p class="text-sm text-dark mb-2">{{__('Date')}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</p>
                          <span class="badge badge-pill badge-primary">
                          @if($val->status==2) <s>{{__('Fee')}}: {{$currency->symbol.number_format($val->charge)}}</s>
                          @else {{__('Charge')}}: {{$currency->symbol.number_format($val->charge)}} @endif</span>
                          @if($val->status==1)
                            <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> {{__('Confirmed')}}</span>
                          @elseif($val->status==0)
                            <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> {{__('Pending')}}</span>                        
                          @elseif($val->status==2)
                            <span class="badge badge-pill badge-info"><i class="fa fa-check"></i> {{__('Returned')}}</span>
                          @endif
                        </div>
                      </div>
                  </div>
                </div>
              </div> 
            @endforeach
          @else
          
  
          <div class="col-md-12">
            <p class="text-center text-muted card-text mt-8">No Transfer Log Found</p>
          </div>
          @endif
        </div> 
        <div class="row">
          <div class="col-md-12">
          {{ $transfer->links() }}
          </div>
        </div>
      </div> 
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                {{__('Statistics')}}
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> {{__('Sent')}}</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($sent)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{__('Pending')}}</span><br>
                  <span class="surtitle">{{__('Returned')}}</span><br>
                  <span class="surtitle ">{{__('Total')}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->name}} {{number_format($pending)}}.00</span><br>
                  <span class="surtitle ">{{$currency->name}} {{number_format($rebursed)}}.00</span><br>
                  <span class="surtitle ">{{$currency->name}} {{number_format($total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @foreach($received as $k=>$val)
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="h4 mb-0 text-dark">#{{$val->ref_id}}</h5>
                </div>
                <div class="col-4 text-right">
                  @if($val->status==0)
                  <a href="{{url('/')}}/user/received/{{$val->id}}" class="btn btn-sm btn-success" title="Mark as received"><i class="fa fa-check"></i> {{__('Confirm')}}</a>
                  @endif
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col">
                  <p class="text-sm text-dark mb-0">{{__('Email')}}: {{$val->sender['email']}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Total')}}: {{$currency->symbol.number_format($val->amount)}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Date')}}: {{date("h:i:A j, M Y", strtotime($val->created_at))}}</p>
                  @if($val->status==1)
                    <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> {{__('Received')}}</span>
                  @elseif($val->status==0)
                    <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> {{__('Pending')}}</span>                       
                  @elseif($val->status==2)
                    <span class="badge badge-pill badge-info"><i class="fa fa-spinner"></i> {{__('Returned')}}</span>                    
                  @endif

                </div>
              </div>
            </div>
          </div>
        @endforeach 
      </div>
    </div>
   <!--FOR PAYPAL-->
    <form id="paypal_success_form" action="{{url('user/paypal_success')}}" method="post">
        @csrf
  <input type="hidden" name="amount" id="paypal_amount_idd" value="">
  <input type="hidden" name="charge" id="fees_amount_idd" value="">
  <input type="hidden" name="paypal_status" id="paypal_status" value="">
  <input type="hidden" name="paypal_email" id="paypal_email" value="">
  <input type="hidden" name="trx" id="trx_id" value=""> 
  
  
</form>
 <script src="https://js.stripe.com/v3/"></script>

    <script src="https://www.paypal.com/sdk/js?client-id={{$paypalGatewayDetails->val1}}"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>

    

    <!-- Add the checkout buttons, set up the order and approve the order -->
    <script>
    var stripe = Stripe('pk_test_Z87YQoBAGOY1ZBXj774mf5uk00QJcWxUrj');
     var elements = stripe.elements();
    // Set up Stripe.js and Elements to use in checkout form
        var style = {
          base: {
            color: "#32325d",
          }
        };
        
        var card = elements.create("card", { style: style });
        card.mount("#card-element");
    card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
/*
stripe.confirmCardPayment({{'pi_1J18ytFvve2wXawid2ZRPTP1_secret_lcvpvYHECyDO5BKxM6DdiCbqf'}}, {
  payment_method: {
    card: card,
    billing_details: {
      name: 'Jenny Rosen'
    }
  },
  setup_future_usage: 'off_session'
}).then(function(result) {
  if (result.error) {
    // Show error to your customer
    console.log(result.error.message);
  } else {
    if (result.paymentIntent.status === 'succeeded') {
      // Show a success message to your customer
      // There's a risk of the customer closing the window before callback execution
      // Set up a webhook or plugin to listen for the payment_intent.succeeded event
      // to save the card to a Customer

      // The PaymentMethod ID can be found on result.paymentIntent.payment_method
    }
  }
});
*/
    function radioValueFunction(value)
    {
        if(value == 'new'){
            $('#add_new_card').show();
            $('#add_new_card2').show();
        } else {
            $('#add_new_card').hide();
             $('#add_new_card2').hide();
            $('#'+value).show();
        }
    }
    
    function chechCharge()
{
   var Feesamount =  parseFloat($('#paypalamount_id').val().replace(/,/g, ''))*<?php echo $paypalGatewayDetails->charge ?>/100;
   
    //alert(Feesamount);
    $('#fees_amount_id').html(Feesamount.toFixed(2));
    $('#fees_amount_idd').val(Feesamount.toFixed(2));
}
    
      paypal.Buttons({
         
        createOrder: function(data, actions) {
            if($('#paypalamount_id').val() !='')
            {   $('#paypalamount_id_error').hide();
                return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: parseInt($('#paypalamount_id').val()) + parseFloat($('#fees_amount_idd').val())
                  }
                }]
              });
            } else {
                $('#paypalamount_id_error').html('Amount is required!');
                
            }
          
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