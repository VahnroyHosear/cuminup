@extends('loginlayout')
@section('css')
<style>
    .fab
    {
        margin-top:7px;
        border-radius:20px;
        color:#171347;
      background-color: #ffffff;
        
    }
    
    .nav {
    /*display: -ms-flexbox;*/
    display: flex;
    /*-ms-flex-wrap: wrap;*/
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.social-icon.round a {
    border-radius: 3px;
}
.social-icon.si-30 a {
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    border: none;
    font-size: 16px;
    
}
.social-icon.si-30 a:hover
{
    background-color:#ffffff;
}

.social-icon.white a {
    /*background-color: #ffffff;*/
    /*color: #171347;*/
    /*border: 1px solid #ffffff;*/
}
</style>
@stop
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .form-error-msg{
            color:red;
        }
        @media only screen and (max-width: 600px) {
          .for-mobile-view {
            display: none;
          }
        }
    </style>
</head>
@section('content')

<?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>

<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-5 pt-lg-9">
        <div class="container" style="margin-top: -67px;">
            <div class="progress1">
                <div class="progress-bar1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:34%">
                    <span class="sr-only">25% Complete</span>
                    <br>
                    <br>
                    <i class="fa fa-user"></i>  <span class="for-mobile-view">Create an account</span>
                </div>
                <div class="progress-bar2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:33%">
                    <span class="sr-only">0% Complete</span>
                    <i class="fa fa-mobile-phone"></i>  <span class="for-mobile-view">Verification</span>
                </div>
               
                <div class="progress-bar2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:33%">
                    <span class="sr-only">0% Complete</span>
                    <i class="fa fa-credit-card"></i>  <span class="for-mobile-view">Ready to use</span>
                </div>
            </div>
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-dark">{{ __("Let's us get to know you!")}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
 
    <div class="container mt--8 pb-5" >
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-3">
            </div>
            <div class="card-body px-lg-5 py-lg-5" style="padding-top: 0rem !important;">
              <div class="text-left text-dark mb-5">
                <small style="font-size:16px;"><b>{{__('Select Your Account Type')}}</b></small>
              </div>
                <form action="/" method="POST">
                    @csrf
                    <div class="row">    
                        <div class="col-lg-6" style="white-space:nowrap;">
                            <div class="row" style="">
                                <div class="col-sm-2">
                                <input placeholder="First name" type="radio" style="width:20px; height:20px" name="usertype" required value="0" checked>
                                </div>
                                <div class="col-sm-2">
                                <label class="ind">Standard</label><br>
                                <!--<small style="color:#2d4ec8;font-size: 12px;">(Mostly used by individual and startup companies)</small>-->
                                <small style="color:#808080;font-size: 12px;">(Suitable for Start-up and Individuals )</small>
                                </div>
                            </div>
                            @if ($errors->has('nfame'))
                                <span class="error form-error-msg ">
                                    {{ $errors->first('fname') }}
                                </span>
                            @endif  
                        </div> 
                        <div class="col-lg-6" style="white-space:nowrap">
                            <div class="row">
                                 <div class="col-sm-2">
                                    <input placeholder="Last name" type="radio" style="width:20px; height:20px" name="usertype" required value="1">
                                </div>
                                <div class="col-sm-2" style="margin-left:-20px">
                                    <label class="bus">Enterprise</label><br>
                                    <small style="color:#808080;font-size: 12px;">(Mostly used by Medium and Large companies)</small>
                                </div>
                            </div>
                            @if ($errors->has('lname'))
                                <span class="error form-error-msg ">
                                    {{ $errors->first('lname') }}
                                </span>
                            @endif  
                        </div>
                    </div>
                </form>  
                
                <div id="indivisual">  
                    <form role="form" action="{{route('submitregister')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_type" value="1">
                    <input type="hidden" name="account_type" value="standard">
                    <div class="form-group row">
                        <div class="text-left text-dark mb-2">
                            <small style="font-size:16px;"><b>&nbsp;&nbsp;&nbsp;{{__('Personal Details')}}</b></small>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6">
                                  <div class="input-group input-group-alternative">
                                    
                                    <div class="input-group-prepend">
                                      <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{__('*First Name')}}" type="text" name="first_name" maxlength="55" value="{{old('first_name')}}" required>
                                  </div>
                                </div>      
                                <div class="col-6">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{__('*Last Name')}}" type="text" name="last_name" value="{{old('last_name')}}" maxlength="55" required>
                                  
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-12">
                        <div class="row">
                            <div class="col-4">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="fa fa-flag"></i></span>
                                </div>
                                
                                <select class="form-control" name="prefix" required>
                                    <option value="">*Select Country Code</option>
                                    
                                    <?php  foreach($countries as $country){ ?>
                                        <option value="{{ $country->id }}" <?php if($country->id == '840'){ echo "selected"; } ?> >{{$country->iso_code}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                                    <?php }?>
                                </select>
                              </div>
                            </div>      
                            <div class="col-8">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                                </div>
                                <input class="form-control" placeholder="{{__('*Phone Number')}}" type="text" name="phone" value="{{old('phone')}}" maxlength="13" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                              </div>
                            <!--<small style="color:#2d4ec8;font-size: 12px;">(We will send you a text to verify your phone. Message and Data rates may apply.)</small>-->
                             <small style="color:	#808080;font-size: 12px;">(We will send you a text to verify your phone. Message and Data rates may apply.)</small>
    
                            </div>
                        </div>
                      </div>
                      @if ($errors->has('phone'))
                        <span class="error form-error-msg " style="margin-left:44%;font-size:12px">{{$errors->first('phone')}}</span>
                      @endif
                    </div>
                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="fa fa-users"></i></span>
                        </div>
                        <input class="form-control" placeholder="{{__('Business Name')}}" type="text" name="business_name" value="{{old('business_name')}}" maxlength="55">
                      </div>
                      @if ($errors->has('business_name'))
                        <span class="error form-error-msg " style="font-size: 12px;">{{$errors->first('business_name')}}</span>
                      @endif
                    </div>                                              
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control" placeholder="{{ __('*Email')}}" type="email" name="email" value="{{old('email')}}" required>
                      </div>
                      @if ($errors->has('email'))
                        <span class="error form-error-msg" style="font-size: 10px;">{{$errors->first('email')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative input-container">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                       
                        <input class="form-control" placeholder="{{ __('*Password')}}" type="password" name="password" required id="password1" value="{{old('password')}}" maxlength="30" onkeyup="passwordStrengthCheck()">
                      
                       <!--<div class='col-lg-1'><i class="material-icons visibility" style="margin-top:12px;">visibility_off</i></div>-->
                       <div class='col-lg-1'><i onclick="myFunction1()" class="material-icons fa fa-eye" style="margin-top:12px; font-size:24px;"></i></div>
                      </div>
                      <div id="passwordAlertDiv" style="display:none;">
            				<span id="passwordalertoutput" class="password-strength-status" style="font-size: 12px;"></span>
            				<span class="password-strength-status2"></span>
            				<span class="password-strength-status3"></span>
    				      </div>
                      @if ($errors->has('password'))
                        <span class="error form-error-msg " style="font-size: 10px;">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input id="password-confirm" class="form-control" placeholder="{{ __('*Re-Enter Password') }}" maxlength="30" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" onchange="ConfirmpasswordCheck()" required>
                        <div class='col-lg-1'><i onclick="myFunction2()" class="material-icons fa fa-eye" style="margin-top:12px; font-size:24px;"></i></div>
                          @if ($errors->has('password_confirmation'))
                            <span class="error form-error-msg "style="font-size: 12px;" >
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-briefcase-24"></i></span>
                        </div>
                        <input type="text" class="form-control" name="ssn" placeholder="Social Security Number i.e 546-32-8768" required id="phone">
                        @if($errors->has('ssn'))
                            <span class="error form-error-msg ">
                                {{ $errors->first('ssn') }}
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input type="text" class="form-control" id="datepicker2" name="dob" autocomplete="off" placeholder="Date of birth i.e 1990-08-01">
                        @if ($errors->has('dob'))
                            <span class="error form-error-msg ">
                                {{ $errors->first('dob') }}
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-square-pin"></i></span>
                                </div>
                                <input type="test" class="form-control" name="street_address" placeholder="Street Address" required>
                                @if ($errors->has('street_address'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('street_address') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-building"></i></span>
                                </div>
                                <input type="test" class="form-control" name="city" placeholder="City"  value="{{old('city')}}" required>
                                @if ($errors->has('city'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('city') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>     
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-world"></i></span>
                                </div>
                                <select class="form-control select" name="u_country">
                                    <option value="">Select Country</option>
                                    <?php  foreach($countries as $country){ ?>
                                        <option value="{{ $country->name }}" <?php if($country->id == '840'){ echo "selected"; } ?> >{{$country->name}}</option>
                                    <?php }?>
                                </select>
                                @if ($errors->has('postalcode'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('postalcode') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-map-big"></i></span>
                                </div>
                                <select class="form-control select" name="state">
                                    <option value="">Select State</option>
                                    @php
                                        $allstates = DB::table('states')->where('country_id', '840')->get();
                                    @endphp
                                    @foreach($allstates as $states)
                                    <option value="{{$states->iso_code}}">{{$states->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('state') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-single-copy-04"></i></span>
                                </div>
                                <input type="text" class="form-control" name="postalcode" placeholder="Postal Code" required  value="{{old('postalcode')}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="5" maxlength="6">
                                @if ($errors->has('postalcode'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('postalcode') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>     
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                      <label class="custom-control-label" for=" customCheckLogin">
                         <span class="text-muted">I am a US resident, agree to the <a href="{{route('terms')}}" target="_blank">Terms</a> and provide my consent for <a href="{{route('cards')}}" target="_blank">Card</a> and <a href="{{route('getach')}}" target="_blank">ACH</a> authorizations, <a href="{{route('e-signfront')}}" target="_blank">E-Sign</a> and <a href="{{route('privacy')}}" target="_blank">Privacy</a> purposes.</span>
                      </label>
                    </div>
                    
                    @if($set->recaptcha==1)
                        <div class="row">
                            <div class="col-lg-12">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block" style="color:red;">
                                        {{ $errors->first('g-recaptcha-response') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <div class="text-center" style="margin-top:20px;">
                        <button type="submit" class="btn btn-success my-4">{{__('Create an account')}}</button>
                    </div>
                    <div class="row mt-4 text-center">
                        
                        <!--<div class="col-12 login-part" style="margin-top: -30px;" >-->
                        <!--<a href="{{route('user.password.request')}}" class="text-dark" style="  color:black;   text-decoration: underline; font-weight: bold;"><small><b style="color:blue;">{{__('Forgot password?')}}</b></small></a>-->
                        <!--<br>-->
                        <!--<a href="{{route('login')}}" class="text-dark" style="color:black; text-decoration: underline; font-weight: bold;"><small><b>Already have an account? </b></small></a>-->
                        <!--<br>-->
                        <!--<span style="background-color:1d0e44;margin-right: 5px;" class="btn">{{__('Login Now')}}</span>-->
                        <!--</div>-->
                        
                        
                        <div class="col-4" style="margin-left: 30px;">
                             <a href="{{route('login')}}" class="text-dark" style="color:black; text-decoration: underline; font-weight: bold;"><small><b>Already have an account? </b></small></a><br> <span style="background-color:1d0e44;margin-right: 30px;" class="btn">{{__('Login Now')}}</span>
                           
                        </div>
                        
                        <div class="col-6 text-right">
                            <a href="{{route('user.password.request')}}" class="text-dark" style="  color:black;   text-decoration: underline; font-weight: bold;"><small><b style="color:blue;">{{__('Forgot password?')}}</b></small></a>
                        </div>
                        
                    </div>
                  </form>
                </div>
                
                <div id="business_formdiv" style="display:none;"> 
                  <form role="form" action="{{route('submitregister')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_type" value="2">
                    <input type="hidden" name="account_type" value="enterprise">
                    <div class="form-group row">
                        <div class="text-left text-dark mb-2">
                            <small style="font-size:16px;"><b>&nbsp;&nbsp;&nbsp;{{__('Personal Details')}}</b></small>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6">
                                  <div class="input-group input-group-alternative">
                                    
                                    <div class="input-group-prepend">
                                      <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{__('*First Name')}}" type="text" name="first_name" maxlength="55" value="{{old('first_name')}}" required>
                                  </div>
                                </div>      
                                <div class="col-6">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{__('*Last Name')}}" type="text" name="last_name" value="{{old('last_name')}}" maxlength="55" required>
                                  
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-12">
                        <div class="row">
                            <div class="col-4">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="fa fa-flag"></i></span>
                                </div>
                               
                                <select class="form-control" name="prefix" required>
                                    <option value="">*Select Country Code</option>
                                    
                                    <?php foreach($countries as $country){ ?>
                                        <option value="{{ $country->id }}" <?php if($country->id == '840'){ echo "selected"; } ?> >{{$country->iso_code}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                                    <?php }?>
                                </select>
                              </div>
                            </div>      
                            <div class="col-8">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                                </div>
                                <input class="form-control" placeholder="{{__('*Phone Number')}}" type="text" name="phone" value="{{old('phone')}}" maxlength="13" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                              </div>
                            <small style="color:#2d4ec8;font-size: 12px;">(We will send you a text to verify your phone. Message and Data rates may apply.)</small>
    
                            </div>
                        </div>
                      </div>
                      @if ($errors->has('phone'))
                        <span class="error form-error-msg " style="margin-left:44%;font-size:12px">{{$errors->first('phone')}}</span>
                      @endif
                    </div>
                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="fa fa-users"></i></span>
                        </div>
                        <input class="form-control" placeholder="{{__('Business Name')}}" type="text" name="business_name" value="{{old('business_name')}}" maxlength="55">
                      </div>
                      @if ($errors->has('business_name'))
                        <span class="error form-error-msg " style="font-size: 12px;">{{$errors->first('business_name')}}</span>
                      @endif
                    </div>                                              
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control" placeholder="{{ __('*Email')}}" type="email" name="email" value="{{old('email')}}" required>
                      </div>
                      @if ($errors->has('email'))
                        <span class="error form-error-msg" style="font-size: 10px;">{{$errors->first('email')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative input-container">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                       
                        <input class="form-control" placeholder="{{ __('*Password')}}" type="password" name="password" required id="password3" value="{{old('password')}}" maxlength="30" onkeyup="passwordStrengthCheck()">
                      
                       <div class='col-lg-1'><i onclick="myFunction3()" class="material-icons fa fa-eye" style="margin-top:12px; font-size:24px;"></i></div>
                      </div>
                      <div id="passwordAlertDiv" style="display:none;">
            				<span id="passwordalertoutput" class="password-strength-status" style="font-size: 12px;"></span>
            				<span class="password-strength-status2"></span>
            				<span class="password-strength-status3"></span>
    				      </div>
                      @if ($errors->has('password'))
                        <span class="error form-error-msg " style="font-size: 10px;">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input id="password-confirment" class="form-control" placeholder="{{ __('*Re-Enter Password') }}" maxlength="30" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" onchange="ConfirmpasswordCheck()" required>
                        <div class='col-lg-1'><i onclick="myFunction4()" class="material-icons fa fa-eye" style="margin-top:12px; font-size:24px;"></i></div>
                          @if ($errors->has('password_confirmation'))
                            <span class="error form-error-msg "style="font-size: 12px;" >
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <select class="form-control select" name="btype" id="business_type">
                                    <option>Select Business Type</option>
                                    <option value="corporation" data-id="947c7505-c936-4dd6-a0b6-8bef9a125911">Corporation</option>
                                    <option value="llc" data-id="0e44178c-6ebd-4aca-be07-51d26f2c13aa">LLC</option>
                                    <option value="llp" data-id="0cbef692-acdd-4633-954e-cfa3d45f965b">LLP</option>
                                    <option value="lp" data-id="84d9fe71-5fde-4220-8c6e-3436f457f243">LP</option>
                                    <option value="non_profit" data-id="a6a6c7c2-f498-4653-a9d3-680714ddc205">Non-Profit</option>
                                    <option value="partnership" data-id="9775974d-6f2e-4bb8-b96d-28a2454e3d20">Partnership</option>
                                    <option value="public_corporation" data-id="247c9a1d-1b57-4889-8ab2-dc236dd1582b">Public Corporation</option>
                                    <option value="sole_proprietorship" data-id="b86d1e30-ed89-44e7-946f-dd6344030e3c">Sole Proprietorship</option>
                                    <option value="trust" data-id="492148db-a94e-4732-8e84-c4ff25fac659">Trust</option>
                                    <option value="unincorporated_association" data-id="bb0210ed-8482-4f2f-8f3c-5db55d1228e5">Unincorporated Association</option>
                                </select>   
                                @if ($errors->has('btype'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('btype') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-briefcase-24"></i></span>
                                </div>
                                <input type="hidden" name="uuid" placeholder="Business UUID" id="b_uuid"  value="" required>
                                <input type="text" class="form-control" name="EIN" placeholder="EIN i.e 12-3456789" required id="phone2">
                                  @if ($errors->has('EIN'))
                                      <span class="error form-error-msg ">
                                          {{ $errors->first('EIN') }}
                                      </span>
                                  @endif
                              </div>
                            </div>
                        </div>     
                      </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text text-future"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input type="text" class="form-control" id="datepicker3" name="dob" autocomplete="off" placeholder="Date of birth i.e 1990-08-01">
                        @if ($errors->has('dob'))
                            <span class="error form-error-msg ">
                                {{ $errors->first('dob') }}
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-square-pin"></i></span>
                                </div>
                                <input type="test" class="form-control" name="street_address" placeholder="Street Address" required>
                                @if ($errors->has('street_address'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('street_address') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-building"></i></span>
                                </div>
                                <input type="test" class="form-control" name="city" placeholder="City"  value="{{old('city')}}" required>
                                @if ($errors->has('city'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('city') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>     
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-world"></i></span>
                                </div>
                                <select class="form-control select" name="u_country">
                                    <option value="">Select Country</option>
                                    <?php  foreach($countries as $country){ ?>
                                        <option value="{{ $country->name }}" <?php if($country->id == '840'){ echo "selected"; } ?> >{{$country->name}}</option>
                                    <?php }?>
                                </select>
                                @if ($errors->has('postalcode'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('postalcode') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-map-big"></i></span>
                                </div>
                                <select class="form-control select" name="state">
                                    <option value="">Select State</option>
                                    @php
                                        $allstates = DB::table('states')->where('country_id', '840')->get();
                                    @endphp
                                    @foreach($allstates as $states)
                                    <option value="{{$states->iso_code}}">{{$states->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('state') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-future"><i class="ni ni-single-copy-04"></i></span>
                                </div>
                                <input type="text" class="form-control" name="postalcode" placeholder="Postal Code" required  value="{{old('postalcode')}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="5" maxlength="6">
                                @if ($errors->has('postalcode'))
                                    <span class="error form-error-msg ">
                                        {{ $errors->first('postalcode') }}
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>     
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id=" customCheckLogin1" type="checkbox" required>
                      <label class="custom-control-label" for=" customCheckLogin1">
                        <span class="text-muted">I am a US resident, agree to the <a href="{{route('terms')}}" target="_blank">Terms</a> and provide my consent for <a href="{{route('cards')}}" target="_blank">Card</a> and <a href="{{route('getach')}}" target="_blank">ACH</a> authorizations, <a href="{{route('e-signfront')}}" target="_blank">E-Sign</a> and <a href="{{route('privacy')}}" target="_blank">Privacy</a> purposes.</span>
                      </label>
                    </div>
                    
                    @if($set->recaptcha==1)
                        <div class="row">
                            <div class="col-lg-12">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block" style="color:red;">
                                        {{ $errors->first('g-recaptcha-response') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-success my-4">{{__('Create an account')}}</button>
                    </div>
                    <div class="row mt-4 text-center">
                        <div class="col-4">
                            <a href="{{route('user.password.request')}}" class="text-dark" style="  color:black;   text-decoration: underline; font-weight: bold;"><small><b style="color:blue;">{{__('Forgot password?')}}</b></small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('login')}}" class="text-dark" style="color:black; text-decoration: underline; font-weight: bold;"><small><b>Already have an account? </b></small></a>
                            <br> <span style="background-color:1d0e44;margin-right: 30px;" class="btn">{{__('Login Now')}}</span>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
   
            $("input[name$='usertype']").click(function() { 
                //alert();
                var usertype_val = $(this).val();
                if(usertype_val == '1') { 
                    $("#indivisual").hide();
                    $("#business_formdiv").show();
                } else {
                    $("#indivisual").show();
                    $("#business_formdiv").hide();
                }
            });
        });
    </script>

    <script>
        var maxBirthdayDate = new Date();
        maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18 );
        maxBirthdayDate.setMonth(11,31)
        $( "#datepicker2" ).datepicker({
        	dateFormat: 'yy-mm-dd',
        	changeMonth: true,
            changeYear: true,
        	maxDate: maxBirthdayDate,
          yearRange: '1950:'+maxBirthdayDate.getFullYear(),
        });
        
        $('#date').datepicker({ dateFormat: 'yy-mm-dd' }).val();
    </script>
    
    <script>
        var maxBirthdayDate = new Date();
        maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18 );
        maxBirthdayDate.setMonth(11,31)
        $( "#datepicker3" ).datepicker({
        	dateFormat: 'yy-mm-dd',
        	changeMonth: true,
            changeYear: true,
        	maxDate: maxBirthdayDate,
          yearRange: '1950:'+maxBirthdayDate.getFullYear(),
        });
        
        $('#date1').datepicker({ dateFormat: 'yy-mm-dd' }).val();
    </script>
    
    <script>
        
        $("#business_type").change(function () {
       
            $("#b_uuid").val($(this).find(':selected').data("id"));
           
        });
    
    </script>
    
    <script>
        //SSN AUTO MASKING
        function validate_int(myEvento) {
          if (myEvento.keyCode == 8 || (myEvento.keyCode >= 35 && myEvento.keyCode <= 40)) {
            dato = true;
          } else {
            dato = true;
          }
          return dato;
        }
        
        function phone_number_mask() {
          var myMask = "___-__-____";
          var myCaja = document.getElementById("phone");
          var myText = "";
          var myNumbers = [];
          var myOutPut = ""
          var theLastPos = 1;
          myText = myCaja.value;
          //get numbers
          for (var i = 0; i < myText.length; i++) {
            if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
              myNumbers.push(myText.charAt(i));
            } 
          }
          //write over mask
          for (var j = 0; j < myMask.length; j++) {
            if (myMask.charAt(j) == "_") { //replace "_" by a number 
              if (myNumbers.length == 0)
             // myOutPut = myOutPut + myNumbers.shift();
                myOutPut = myOutPut + myMask.charAt(j);
              else {
                  // myOutPut = myOutPut + myMask.charAt(j);
                myOutPut = myOutPut + myNumbers.shift();
                theLastPos = j + 1; //set caret position
              }
            } else {
              myOutPut = myOutPut + myMask.charAt(j);
            }
          }
          document.getElementById("phone").value = myOutPut;
          document.getElementById("phone").setSelectionRange(theLastPos, theLastPos);
        }
        document.getElementById("phone").onkeyup = phone_number_mask;
        //END SSN MASKING
        
        //EIN AUTO MASKING

        function validate_int(myEvento) {
          if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
            dato = true;
          } else {
            dato = false;
          }
          return dato;
        }
        
        function phone_number_mask2() {
          var myMask = "__-_______";
          var myCaja = document.getElementById("phone2");
          var myText = "";
          var myNumbers = [];
          var myOutPut = ""
          var theLastPos = 1;
          myText = myCaja.value;
          //get numbers
          for (var i = 0; i < myText.length; i++) {
            if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
              myNumbers.push(myText.charAt(i));
            }
          }
          //write over mask
          for (var j = 0; j < myMask.length; j++) {
            if (myMask.charAt(j) == "_") { //replace "_" by a number 
              if (myNumbers.length == 0)
                myOutPut = myOutPut + myMask.charAt(j);
              else {
                myOutPut = myOutPut + myNumbers.shift();
                theLastPos = j + 1; //set caret position
              }
            } else {
              myOutPut = myOutPut + myMask.charAt(j);
            }
          }
          document.getElementById("phone2").value = myOutPut;
          document.getElementById("phone2").setSelectionRange(theLastPos, theLastPos);
        }
        document.getElementById("phone2").onkeypress = validate_int;
        document.getElementById("phone2").onkeyup = phone_number_mask2;
        //END EIN MASKING
    </script>
    
    
    
    <script type="text/javascript">

        const visibilityToggle = document.querySelector('.visibility');
        const input = document.querySelector('.input-container input');
        var password = true;
        
        visibilityToggle.addEventListener('click', function() {
          if (password) {  
            input.setAttribute('type', 'text');
            visibilityToggle.innerHTML = 'visibility';
          } else {
            input.setAttribute('type', 'password');
            visibilityToggle.innerHTML = 'visibility_off';
          }
          password = !password;
        });

    </script>  
<script type="text/javascript">

    function passwordStrengthCheck() { 
	$('#passwordAlertDiv').show();
	var number = '[0-9]';
	var alphabets = '[a-zA-Z]';
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if ($('#inputPassword').val().length > 7 && $('#inputPassword').val().match(alphabets) && $('#inputPassword').val().match(number) && $('#inputPassword').val().match(special_characters)) {
		//$('#password-strength-status').removeClass();
		//$('#password-strength-status').addClass('weak-password');
		$('.password-strength-status').css('color','#2d4ec8');
		$('.password-strength-status').html("(Hints- at least 8 character password required. Alphanumeric & special character-john123$%&*@)");
		$('#individual_submit').prop('disabled', false);
		$('#inputPassword').attr('type','password');
	} else {
		$('.password-strength-status').css('color','red');
		$('.password-strength-status').html("(Hints- at least 8 character password required. Alphanumeric & special character-john123$%&*@)");
	     $('#individual_submit').prop('disabled', true);
		
	}
	
	if($('#password-confirm').val() !='')
    {
        if($('#inputPassword').val() == $('#password-confirm').val())
        {
            
             $('#confirm_pwd_error').css('color','#2d4ec8');
	      	$('#confirm_pwd_error').html("Confirm password matched");
		//$('.password-strength-status3').html("");
            $('#continue_click').prop('disabled', false);
        } else {
             $('#confirm_pwd_error').css('color','red');
	      	$('#confirm_pwd_error').html("Confirm password not matched!");
            $('#continue_click').prop('disabled', true);
        }
    }

}



function ConfirmpasswordCheck()
{
    
    if($('#inputPassword').val() !='')
    {
        if($('#inputPassword').val() == $('#password-confirm').val())
        {
            
             $('#confirm_pwd_error').css('color','#2d4ec8');
	      	$('#confirm_pwd_error').html("Confirm password matched");
		//$('.password-strength-status3').html("");
            $('#continue_click').prop('disabled', false);
        } else {
             $('#confirm_pwd_error').css('color','red');
	      	$('#confirm_pwd_error').html("Confirm password not matched!");
            $('#continue_click').prop('disabled', true);
        }
    }
}

$(document).ready(function() {
    if($('#inputPassword').val() !='' && $('#password-confirm').val() !='')
    {
        $('#continue_click').prop('disabled', false);
    } else {
        $('#continue_click').prop('disabled', true);
    }
});
</script> 

<script>
function myFunction1() {
  var x = document.getElementById("password1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
function myFunction2() {
  var x = document.getElementById("password-confirm");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
function myFunction3() {
  var x = document.getElementById("password3");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
function myFunction4() {
  var x = document.getElementById("password-confirment");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
      
@stop