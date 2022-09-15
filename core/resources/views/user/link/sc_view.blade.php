@extends('paymentlayout')

@section('content')
<div class="main-content payment">
  <div class="header py-7 py-lg-8 pt-lg-1">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h3 class="text-white">{{$link->name}}</h3> <span class="text-white">By {{$merchant->business_name}}</span>
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
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <img src="{{url('/')}}/asset/profile/{{$merchant->image}}" class="rounded-circle border-secondary">
              </div>
            </div>
          </div>
          <div class="card-body pt-7 px-5">
            <div class="text-center text-dark mb-5">
              <small>{!!$link->description!!}</small>
            </div>
            <form role="form" action="{{ route('send.single')}}" method="post" id="modal-details">
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
                  <input class="form-control" readonly type="number" name="amount" value="{{number_format($link->amount,2)}}">
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
                            <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <h4 class="mb-0">Card</h4>
                            </div>
                          </div>
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                              <form action="{{ route('send.single')}}" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$stripe->val1}}" id="payment-form">
                                @csrf
                                <div class="form-group row">
                                  <div class="col-xs-12 col-md-12 form-group required">
                                    <input type="text" class="form-control input-lg custom-input" name="cardNumber"  placeholder="*Debit/Credit Card Number" minlength="3" maxlength="16" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required autofocus size="20"/>
                                  </div>                                  
                                  <div class="col-xs-12 col-md-12 form-group required">
                                    <input type="email" class="form-control input-lg custom-input" name="email" placeholder="*Email Address" autocomplete="off"  required  autofocus/>
                                  </div>
                                  <div class="col form-group required">
                                    <input type="text" class="form-control input-lg custom-input" name="first_name" placeholder="*First Name" autocomplete="off" required autofocus/>
                                  </div>                                  
                                  <div class="col form-group required">
                                    <input type="text" class="form-control input-lg custom-input" name="last_name" placeholder="*Last Name" autocomplete="off" required autofocus/>
                                  </div>
                                </div> 
                                <div class='form-group row'>
                                  <div class='col form-group cvc'>
                                    <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='*CVC' type='text' maxlength="3" minlength="3" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                  </div>
                                  <div class='col form-group expiration required'>
                                    <input class='form-control card-expiry-month' name="cardM" placeholder='*MM' minlength="2" maxlength='2' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                  </div>
                                  <div class='col form-group expiration required'>
                                    <input class='form-control card-expiry-year' name="cardY" placeholder='*YYYY' minlength="4" maxlength='4'type='text' required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                  </div>
                                </div>			
                                <input type="hidden" value="card" name="type">  	                
                                <div class="text-center">
                                  <button type="submit" class="btn-block btn-success btn-sm" form="modal-details" style="font-size: 16px;">{{__('Pay')}} <span id="cardresult"></span></button><br>
                                  <img src="{{url('/')}}/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                                </div>
                                
                              </form>
                            </div>
                          </div>
                          <!--Account Balance-->
                          <hr>
                          <div class="card-header" id="headingTwo">
                              <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4 class="mb-0">Pay with Account</h4>
                              </div>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
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
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="button" data-toggle="modal" data-target="#fund" class="btn-block btn-success my-4" style="font-size:17px;border-radius:4px;padding:5px">{{__('Pay')}}</button>
              </div>
              <div class="text-center">
                <p class="paragraph small">If you have any questions, contact
                  <a href="mailto:{{$merchant->email}}">{{$merchant->email}}</a>
                </p>
              </div>
              <div class="text-center">
                @if($merchant->facebook!=null)
                  <a href="{{$merchant->facebook}}"><i class="sn fab fa-facebook"></i></a>   
                @endif 
                @if($merchant->twitter!=null)                      
                  <a href="{{$merchant->twitter}}"><i class="sn fab fa-twitter"></i></a>
                @endif      
                @if($merchant->linkedin!=null)                     
                  <a href="{{$merchant->linkedin}}"><i class="sn fab fa-linkedin"></i></a> 
                @endif     
                @if($merchant->instagram!=null)                        
                  <a href="{{$merchant->instagram}}"><i class="sn fab fa-instagram"></i></a>   
                @endif 
                @if($merchant->youtube!=null)                          
                  <a href="{{$merchant->youtube}}"><i class="sn fab fa-youtube"></i></a>  
                @endif                        
              </div> 
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop