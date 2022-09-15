@extends('loginlayout')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-5 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark">{{ __("Upload a New National ID of Your's") }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-9">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> {{ $error }}
                </div>
            @endforeach
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('type') }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                    </button>
                    {{ session()->get('message') }}
                </div>
            @endif
            @if (session()->has('status'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                    </button>
                    {{ session()->get('status') }}
                </div>
            @endif
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-3">
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <!--div class="text-center text-dark mb-5">
                <small>{{__('Recover your account')}}</small>
              </div-->
              <form role="form" action="{{route('user.reupload')}}" method="post" enctype="multipart/form-data">
                                      <input class="form-control" placeholder="{{ __('Email') }}" type="hidden" name="email"  value="{{$email}}">

                @csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    
                    <select class="form-control" name="upload_type" onchange="uploadtypeCheck(this.value)">
                        <option>Form of ID</option>
                        <option>Passport</option>
                        <option>Driving Licence</option>
                        <option>State ID</option>
                    </select>    
                      @if ($errors->has('email'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                  </div>
                </div>
                <div class="form-group" id="default_div">
                    Why we collect ID's
                    We verify your identity using multiple tools, including, facial recognition technology provided by our partner,
                    We verify identity to mitigate financial loss and maintain regulatory compliance.
                    Our <a href="{{url('privacy')}}">Privacy Policy</a>
                  <!--div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" class="form-control" placeholder="{{ __('Password') }}" type="password" name="password" required>
                    
                      @if ($errors->has('password'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                  </div-->
                </div>
                <div class="form-group" id="passport_div" style="display:none;">
                   <div class="row">
                       <div class="col-sm-6">
                           <b>{{__('Please Check That:')}}</b><br><br>
                           <span><i class="fa fa-check" aria-hidden="true" color="green"></i>
                            An ideal ID picture</span><br>
<span><i class="fa fa-check" aria-hidden="true"></i> All corners of the ID are visible against the backdrop.</span><br>
<span><i class="fa fa-check" aria-hidden="true"></i> All ID data is legible.</span><br>
<span><i class="fa fa-check" aria-hidden="true"></i> The photo is in color.</span>
                           
                       </div>
                          
                            
                            
                       <div class="col-sm-6">
                           <img src="{{url('asset/images/passport-sample.jpeg')}}" style="width:50%">
                       </div>
                      </div> <br>
                      <div class="form-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFileLang" name="image12" accept="image/*" required>
                    <label class="custom-file-label" for="customFileLang">{{__('Choose Media')}}</label>
                  </div> 
                 
                        <small class="text-left">(Format supported:JPG, JPEG, PNG files,<br> Max Size: 10MB)</small>
                </div><br>
                 <div class="input-group input-group-alternative">
                    <!--div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div-->
                  <select class="form-control" name="country" required>
                      <option>Select Country</option>
                      @foreach($All_country as $c_details)
                      <option value="{{$c_details->id}}">{{$c_details->name}}</option>
                      @endforeach
                    </select>  
                      @if ($errors->has('country'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('country') }}</strong>
                        </span>
                      @endif
                  </div><br>
                  <div class="input-group input-group-alternative">
                    <!--div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div-->
                     <input class="form-control" placeholder="{{ __('Address') }}" type="text" name="address1" required>
                      @if ($errors->has('address1'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('address1') }}</strong>
                        </span>
                      @endif
                  </div><br>
                  <div class="input-group input-group-alternative">
                    <!--div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div-->
                     <input class="form-control" placeholder="{{ __('Apartment/Suite/Floor') }}" type="text" name="address2" required>
                      @if ($errors->has('address2'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('address2') }}</strong>
                        </span>
                      @endif
                  </div><br>
                  <div class="input-group input-group-alternative">
                    <!--div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div-->
                     <input class="form-control" placeholder="{{ __('City') }}" type="text" name="city" required>
                      @if ($errors->has('city'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('city') }}</strong>
                        </span>
                      @endif
                  </div><br>
                  <div class="input-group input-group-alternative">
                    <!--div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div-->
                     <input class="form-control" placeholder="{{ __('State') }}" type="text" name="state" required>
                      @if ($errors->has('state'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('state') }}</strong>
                        </span>
                      @endif
                  </div><br>
                  <div class="input-group input-group-alternative">
                    <!--div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div-->
                     <input class="form-control" placeholder="{{ __('Zip Code') }}" type="text" name="zip_code" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="6" required>
                      @if ($errors->has('zip_code'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('zip_code') }}</strong>
                        </span>
                      @endif
                  </div>
                  <!--div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password-confirm" class="form-control" placeholder="{{ __('Re-Enter Password') }}" type="password" name="password_confirmation" required>
                      @if ($errors->has('password_confirmation'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                      @endif
                  </div-->
                </div><!--END DIV-->
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4">{{__('Submit')}}</button>
                </div>
                <!--div class="row mt-3">
                  <div class="col-6">
                    <a href="{{route('user.password.request')}}" class="text-dark"><small>{{__('Forgot password?')}}</small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="{{route('register')}}" class="text-dark"><small>{{__('Create an account')}}</small></a>
                  </div>
                </div-->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<script>
function uploadtypeCheck(value)
{
    if(value == 'Form of ID')
    {
        $('#passport_div').hide();
        $('#default_div').show();

    }
    if(value == 'Passport')
    {
         $('#passport_div').show();
        $('#default_div').hide();
    }
    if(value == 'Driving Licence')
    {
         $('#passport_div').show();
        $('#default_div').hide();
    }
    if(value == 'State ID')
    {
         $('#passport_div').show();
        $('#default_div').hide();
    }
}
</script>
@stop