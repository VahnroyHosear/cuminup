@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Request money')}}</a>
              <!--a data-toggle="modal" data-target="#fund" href=""  class="btn btn-sm btn-success">{{__('Topup Balance')}}</a-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">   
        <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="accordion" id="accordionExample">
                  <div class="card bg-white border-0 mb-0">
                    <div class="card-header" id="headingOne">
                      <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="mb-0">Card</h4>
                      </div>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <form action="{{ route('card')}}" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$stripe->val1}}" id="payment-form">
                          @csrf
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
                            <div class="col form-group required">
                              <input type="number" class="form-control input-lg custom-input card-number" name="cardNumber" placeholder="Valid Card Number" min="16" autocomplete="off" required autofocus size="20"/>
                            </div>
                          </div> 
                          <div class='form-group row'>
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" required>
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-month' name="cardM" placeholder='MM' maxlength='2' type='text'>
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY' maxlength='4'type='text'>
                            </div>
                          </div>			  	                
                          <div class="text-center">
                            
                            <button type="submit" class="btn btn-success btn-sm">{{__('Pay')}} <span id="cardresult"></span></button><br>
                            <img src="{{url('/')}}/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                          </div>
                          
                        </form>
                      </div>
                    </div>
                    @if($adminbank->status==1)
                      <hr>
                      <div class="card-header" id="headingTwo">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="mb-0">Transfer</h4>
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
                          <h4 class="mb-0">Crypto Currency</h4>
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
                    <h3 class="mb-0">{{__('Request money')}} <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button-->
                    <span class="form-text text-xs">User must be a member of {{$set->site_name}}, Transfer charge is {{$set->transfer_charge}}% per transaction. Charge will be taken from money requested</span>
                  </div>
                  <div class="card-body">
                    <form action="{{route('submit.request')}}" method="post" id="modal-details">
                      @csrf
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Email')}}</label>
                          <div class="col-lg-10">
                              <input type="email" name="email" class="form-control"  required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2">{{__('Amount')}}</label>
                          <div class="col-lg-10">
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <span class="input-group-text">{{$currency->symbol}}</span>
                              </span>
                              <input type="text" maxlength="10" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="amount" id="amount" required>
                              <span class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </span>
                            </div>
                          </div>
                        </div>                   
                        <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details">{{__('Request money')}}</button>
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
      <div class="col-md-12">
        <div class="row">  
        @if(count($request)>0)
          
          <div class="card">
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Ref No')}}</th>
              
              <th>{{__('Email')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Charge')}}</th>
               <th>{{__('Status')}}</th>
                <th>{{__('Action')}}</th>
             <th>{{__('Date')}}</th>
             
             
            </tr>
          </thead>
          <tbody> 
          @foreach($request as $k=>$val)
          <tr>
             
                <td>{{++$k}}</td>
                <td>#{{$val->ref_id}}</td>
               
                <td>@if($val->user_id==$user->id)
                        <p class="text-sm text-dark mb-0">{{__('To')}}:{{$val->email}}</p>
                        @else
                        <p class="text-sm text-dark mb-0">{{__('From')}}: {{$val->receiver['email']}}</p>
                        @endif</td>
                <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                <td>@if($val->status==1)
                          
                          <span class="badge badge-pill badge-primary">Charge: {{$currency->symbol.number_format($val->charge,2)}}</span>
                          
                    @endif      
                    </td>
               <td>@if($val->status==1)
                          
                          <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> {{__('Confirmed')}}</span>
                        @elseif($val->status==0)
                          <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> {{__('Pending')}}</span>  
                         @else
                         <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> {{__('Rejected')}}</span>  
                        @endif</td>
                <td>@if($val->user_id==$user->id)
                        {{__('NA')}}
                        @else
                        @if($val->status != 2 && $val->status!=1 && $val->user_id != $user->id)
                        <a href="{{url('user/send_money')}}/{{$val->confirm}}" class="btn btn-sm btn-success">{{__('Pay')}}</a>
                        <a href="{{url('user/reject_money')}}/{{$val->confirm}}" class="btn btn-sm btn-primary">{{__('Reject')}}</a>
                        @else
                        {{__('NA')}}
                        @endif
                        @endif</td>        
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
               
               
            
            </tr>  
          @endforeach
          </tbody>
          </table>
          @else
            <center><div class="col-md-12">
                
             <br>
              
              <p class="text-center text-muted card-text mt-8">{{__('No Request History Found!')}}</p>
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Start Requesting Money')}}</a>
              <p class="text-center text-muted card-text mt-8"></p>
              <br>
         
        </div> </center>
         @endif
       
      </div> 
      
     </div>
     </div>
     </div>
     </div>
     <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                {{__('Statistics')}}
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> {{__('Received')}}</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($sent)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{__('Pending')}}</span><br>
                  <span class="surtitle ">{{__('Total')}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->name}} {{number_format($pending)}}.00</span><br>
                  <span class="surtitle ">{{$currency->name}} {{number_format($total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
@stop