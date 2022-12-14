@extends('master')

@section('content')

 <?php $countries =DB::table('countries')->get(); ?>
 <head> 
  <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>
<div class="container-fluid mt--6">
  
    <div class="content-wrapper">
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Update Account Information')}}
                          <a class="badge badge-warning" style="float:right;color:black;"href="{{url('admin/users')}}" ><i class="fa fa-angle-double-left"></i> Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/profile-update')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Business name')}}</label>
                                <div class="col-lg-10">
                                    <input type=""hidden value="{{$client->id}}" name="id">
                                    <input type="text" name="business_name" class="form-control" value="{{$client->business_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('First Name')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="first_name" class="form-control" value="{{$client->first_name}}">
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Last Name')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="last_name" class="form-control" value="{{$client->last_name}}">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Email')}}</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" readonly value="{{$client->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Mobile')}}</label>
                                <div class="col-lg-4">
                                    
                                    <select class="form-control" name="prefix" >
                                      <?php foreach($countries as $country){?>
                                      <option value="<?=$country->id?>" <?=($country->iso_code == $client->phone_iso) ? 'selected' :''?>> <?= '(+'.$country->calling_code .') ' .$country->name?></option>
                                      <?php }?>
                                  </select>
                                  </div>
                                  <div class="col-lg-6">
                                    <input type="text" name="mobile" class="form-control" value="{{$client->phone}}">
                                    </div>
                                
                            </div>                         
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Office address')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="address" class="form-control" value="{{$client->office_address}}">
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Website')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="website" class="form-control" value="{{$client->website_link}}">
                                </div>
                            </div>   
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Business country')}}</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="business_country" >
                                        <?php foreach($countries as $country){?>
                                        <option value="<?=$country->id?>"  <?=($country->iso_code == $client->phone_iso) ? 'selected' :''?>><?= $country->name ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>   
                            
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Source')}}</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="source_from">
                                    <option value="By Social Media" <?=($client->source_from =='By Social Media' ) ? 'selected' :''?>>By Social Media</option>
                                    <option value="Google Ads/ Search Result" <?=($client->source_from == 'Google Ads/ Search Result') ? 'selected' :''?>>Google Ads/ Search Result</option>
                                    <option value="From a Friend" <?=($client->source_from == 'From a Friend') ? 'selected' :''?>>From a Friend</option>
                                    <option value="From SureUp" <?=($client->source_from =='From SureUp' ) ? 'selected' :''?>>From SureUp</option>
                                    <option value="From Merchant" <?=($client->source_from == 'From Merchant') ? 'selected' :''?>>From Merchants</option>
                                    <option value="From Tempo" <?=($client->source_from == 'From Tempo') ? 'selected' :''?>>From Tempo</option>

                                    <option value="Others" <?=($client->source_from == 'Others') ? 'selected' :''?>>Others</option>
                                    </select>
                                </div>
                            </div>   
                            
                            
                            
                            
                            
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Balance')}}</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="number" name="balance" max-length="10" value="{{$client->balance}}" class="form-control">
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Status')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($client->email_verify==1)
                                            <input type="checkbox" name="email_verify" id=" customCheckLogin5" class="custom-control-input" value="1" checked>
                                        @else
                                            <input type="checkbox" name="email_verify"id=" customCheckLogin5"  class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for=" customCheckLogin5">
                                        <span class="text-muted">{{__('Email verification')}}</span>     
                                        </label>
                                    </div>                                     
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($client->fa_status==1)
                                            <input type="checkbox" name="fa_status" id=" customCheckLogin6" class="custom-control-input" value="1" checked>
                                        @else
                                            <input type="checkbox" name="fa_status" id=" customCheckLogin6"  class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for=" customCheckLogin6">
                                        <span class="text-muted">{{__('2fa security')}}</span>     
                                        </label>
                                    </div>                                                              
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-form-label col-lg-3">{{__('Virtual Card Activation')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            @if($client->virtual_card_activation ==1)
                                          <input type="checkbox" name="virtual_card_activation" checked>
                                          @else
                                         <input type="checkbox" name="virtual_card_activation">
                                            @endif
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">{{__('eStore Activation')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            @if($client->estore_activation ==1)
                                          <input type="checkbox" name="estore_activation" checked>
                                          @else
                                         <input type="checkbox" name="estore_activation">
                                            @endif
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">{{__('Transfer Activation')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            @if($client->transfer_activation ==1)
                                          <input type="checkbox" name="transfer_activation" checked>
                                          @else
                                         <input type="checkbox" name="transfer_activation">
                                            @endif
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">{{__('Request Activation')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            @if($client->request_activation ==1)
                                          <input type="checkbox" name="request_activation" checked>
                                          @else
                                         <input type="checkbox" name="request_activation">
                                            @endif
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Billing Tools<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            @if($client->invoice_activation ==1)
                                          <input type="checkbox" name="invoice_activation" checked>
                                          @else
                                         <input type="checkbox" name="invoice_activation">
                                            @endif
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">{{__('Payment Link Activation')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            @if($client->payment_link_activation ==1)
                                          <input type="checkbox" name="payment_link_activation" checked>
                                          @else
                                         <input type="checkbox" name="payment_link_activation">
                                            @endif
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle" src="{{url('/')}}/asset/profile/{{$client->image}}" width="120" height="120" alt="">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <ul class="list list-unstyled mb-0">
                                    <li><span class="text-sm">{{__('Joined:')}} {{date("Y/m/d h:i:A", strtotime($client->created_at))}}</span></li>
                                    <li><span class="text-sm">
                                        @if(!empty($client->last_login))
                                        {{__('Last Login:')}} {{date("Y/m/d h:i:A", strtotime($client->last_login))}}
                                        @else
                                        {{__('Last Login:')}} {{date("Y/m/d h:i:A", strtotime($client->created_at))}}
                                        @endif
                                        </span></li>
                                    <li><span class="text-sm">{{__('Last Updated:')}} {{date("Y/m/d h:i:A", strtotime($client->updated_at))}}</span></li>
                                    <li><span class="text-sm"><?php
                                    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$client->ip_address));
                                    //dd($query);
                                    if($query)
                                    {
                                        echo $query['city']." | ".$query['country']." | ".$client->ip_address;
                                    }
                                ?> </span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>  
                @if($set->kyc==1)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('KYC-Entreprise Verification')}}</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <!--th>#</th-->
                                <th class="text-center">{{__('Status')}}</th>
                                <th class="text-center">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        @if($client->kyc_status==0)
                                        {{__('Unverified')}}
                                        @elseif($client->kyc_status==2)
                                         {{__('Rejected')}}
                                        @elseif($client->kyc_status==1)
                                        {{__('Verified')}}
                                        @else
                                        {{__('Pending')}}
                                        @endif
                                    </td>
                                   {{-- <td class="text-left">
                                        <ul class="p-0">
                                            @if(!empty($client->kyc_link))
                                                <li><a href="{{url('/')}}/asset/profile/{{$client->kyc_link}}" target="_blank">{{__('Company Certificate')}}</a></li>
                                                <!--li><a href="{{url('/')}}/asset/profile/{{$client->photo_id}}" target="_blank">{{__('Photo ID')}}</a></li-->
                                                <li><a href="{{url('/')}}/asset/profile/{{$client->address_id}}" target="_blank">{{__('Address Proof')}}</a></li>
                                            @else
                                            {{__('No file')}}
                                            @endif
                                        </ul>
                                    </td>--}}
                                    <td class="">
                                        <div class="dropdown">
                                            <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                            <a class="text-dark" href="{{url('/')}}/admin/verification-kyc/{{$client->id}}" title="View User Details">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            @if($client->kyc_status!=1)
                                            {{--@if(!empty($client->kyc_link))--}}
                                                <!--a class='dropdown-item' href ="{{url('/')}}/admin/approve-kyc/{{$client->id}}"><i class="icon-eye mr-2"></i>{{__('Approve')}}</a-->
                                                <a class='dropdown-item' href ="{{url('/')}}/admin/verification-kyc/{{$client->id}}"><i class="icon-eye mr-2"></i>{{__('Approve')}}</a>

                                                <!--<a class='dropdown-item' href ="{{url('/')}}/admin/reject-kyc/{{$client->id}}"><i class="icon-eye-blocked2 mr-2"></i>{{__('Reject')}}</a>-->
                                                <a class='dropdown-item' data-toggle="modal" data-target="#rejectmessage"><i class="icon-eye-blocked2 mr-2"></i>{{__('Reject')}}</a>
                                           
                                            @endif
                                            
                                            @if($client->kyc_status==1)
                                                <a class='dropdown-item' href ="{{url('/')}}/admin/verification-kyc/{{$client->id}}"><i class="icon-eye mr-2"></i>{{__('View Details')}}</a>
                                                <a class='dropdown-item' data-toggle="modal" data-target="#rejectmessage"><i class="icon-eye-blocked2 mr-2"></i>{{__('Reject')}}</a>
                                            @endif
                                            </div>
                                        </div>
                                    </td>           
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Business Details')}}</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>{{__('SSN')}}</td>
                                    <td>{{ $client->verify_ssn }}</td>           
                                </tr> 
                                <tr>
                                    <td>{{__('EIN')}}</td>
                                    <td>{{ $client->verify_ein }}</td>           
                                </tr> 
                                <tr>
                                    <td>{{__('National id')}}</td>
                                    <td>
                                        @if(!empty($client->photo_id))
                                        <a href="{{url('/')}}/asset/profile/{{$client->photo_id}}" target="_blank">{{__('View')}}</a>
                                        @else
                                        {{'Not uploaded'}}
                                        @endif
                                    </td>           
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if(!empty($get_token))
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                <h3 class="card-title">{{__('Set Limits')}}</h3>
                            </div>
                            <div class="col-md-7">
                                @if($client->lithic_status == 'PAUSED')
                                    <a href="{{url('admin/lithics-activate/'.$client->id)}}" class="btn btn-sm btn-neutral">{{__('Activate Account')}}</a>
                                @elseif($client->lithic_status == 'ACTIVE')
                                    <a href="{{url('admin/lithics-deactivate/'.$client->id)}}" class="btn btn-sm btn-warning">{{__('Deactivate Account')}}</a>
                                @else
                                    <a class="btn btn-sm btn-warning">{{__('No Account')}}</a>
                                @endif
                            </div>
                        </div>
                                        
                        <form action="{{url('admin/update-limits/'.$client->id)}}" method="post">
                        @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-6">{{__('Status')}}</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" name="lithic_status" value="{{$get_token->data[0]->state}}" class="form-control" disabled>
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-6">{{__('Daily Spend Limit')}}</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="text" name="daily_limit" value="{{$get_token->data[0]->spend_limit->daily}}" class="form-control">
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-6">{{__('Monthly Spend Limit')}}</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="text" name="monthly_limit" value="{{$get_token->data[0]->spend_limit->monthly}}" class="form-control">
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-6">{{__('Lifetime Spend Limit')}}</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="text" name="lifetime_limit" value="{{$get_token->data[0]->spend_limit->lifetime}}" class="form-control">
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-sm">{{__('Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Change Password')}}</h3>
                        <form action="{{url('/')}}/admin/request-password/{{$client->id}}" method="post">
                        @csrf
                            <div class="form-group">
                              <div class="custom-file">
                                <input type="text" class="form-control" name="password" placeholder="New Password">
                                <input type="text" class="form-control mt-4" name="password_confirmation" placeholder="Confirm Password">
                              </div> 
                            </div>              
                          <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Audit Logs')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                        <thead>
                            <tr>
                            <th>{{__('S / N')}}</th>
                            <th>{{__('Reference ID')}}</th>
                            <th>{{__('Log')}}</th>
                            <th>{{__('Created')}}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @foreach($audit as $k=>$val)
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>#{{$val->trx}}</td>
                                <td>{{$val->log}}</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="rejectmessage" tabindex="-1" role="dialog" aria-labelledby="rejectmessageTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rejectmessageTitle">Add Comment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{url('/')}}/admin/reject-kyc/{{$client->id}}" method="post">
            @csrf
                <div class="form-group row">
                  <label class="col-form-label col-lg-4">{{__('Add Comment')}}</label>
                  <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                          <textarea name="comment" class="form-control" row="5"></textarea>
                        </div> 
                    </div>
                  </div>
                </div>
                <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
@stop
