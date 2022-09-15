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
@section('content')

<head>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
</head> 
<div class="main-content">
    <!-- Header -->
    <div class="header lheader bg-future py-7 py-lg-5 pt-lg-9" style="margin-top:-4rem">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                <br>
              <h1 class="text-dark">{{ __('Sign In') }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-3">
            </div>
            <div class="card-body px-lg-5 py-lg-5" style="padding-top:0rem!important">
              <div class="text-center text-dark mb-5 loginw" style="    margin-bottom: 1rem !important;">
                <small>{{ __('Welcome back,') }} please confirm you are visiting {{url('/')}}</small>
              </div>
              
              <script>
// Add active class to the current button (highlight it)
var header = document.getElementById("nav-tabs");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>



<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<style>
    <style>
/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 10px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
  font-size: 18px;
}

/* Style the active class, and buttons on mouse-over */
.active, .btn:hover {
  background-color: #666;
  color: white;
}

.form-error-msg{
                color:red;
            }
</style>
</style>
              
              <ul class="nav nav-tabs login-mobile-rep">
                  <li class="mobli"><button class="btn btn2 active login-btn " data-toggle="tab" href="#phonetab">Login By Phone</button></li>
                  <li class="or">{{__('OR')}}</li>
                   <li class="emaili"><button class="btn login-btn " data-toggle="tab" href="#emailtab">Login By Email</button></li>
                   
              
              
             
            </ul>
            
            <div class="tab-content">
             
              <div id="phonetab" class="tab-pane fade active show" style="    background: #f7fafc;">
                <form role="form" action="{{route('submitloginphone')}}" method="post">
                @csrf
                <!--div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                    </div>
                    <?php $countries =DB::table('countries')->get(); ?>
                            <select class="form-control" name="prefix" style="max-width: 80px;">
                                <option value="">Select Country Code</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?=$country->id?>" <?=($country->iso_code =='US') ? 'selected' : ''?>>{{$country->name}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                                <?php }?>
                            </select>
                    <input class="form-control" placeholder="{{ __('Phone') }}" type="number" step="any" name="phone" required>
                  </div>
                  @if ($errors->has('email'))
                      <span class="error form-error-msg ">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                </div-->
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="fa fa-globe"></i></span>
                    </div>
                    <?php $countries =DB::table('countries')->where('active',1)->get(); ?>
                            <select class="form-control" name="prefix">
                                <option value="">Select Country Code</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?=$country->id?>" <?=($country->iso_code =='US') ? 'selected' : ''?>>{{$country->name}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                                <?php }?>
                            </select>
                  </div>
                  @if ($errors->has('email'))
                      <span class="error form-error-msg ">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Phone') }}" type="text" step="any" name="phone" maxlength="13" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                  </div>
                  @if ($errors->has('phone'))
                    <span class="error form-error-msg ">
                      <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative input-container2">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="inputPassword" class="form-control" placeholder="{{ __('Password') }}" type="password" name="password" required>
                    <div><i class="material-icons visibility2" style="color:black;margin-top:12px;    margin-right: 5px;">visibility_off</i></div>
                  </div>
                  @if ($errors->has('password'))
                    <span class="error form-error-msg ">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
                <!--<div class="custom-control custom-control-alternative custom-checkbox">-->
                <!--  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember_me">-->
                <!--  <label class="custom-control-label" for=" customCheckLogin">-->
                <!--    <span class="text-muted">{{__('Remember me')}}</span>-->
                <!--  </label>-->
                <!--</div>-->
               
                @if($set->recaptcha==1)
               <div class="form-group text-center">
                  
                  <center> <span>  {!! app('captcha')->display() !!} </span></center>
                  @if ($errors->has('g-recaptcha-response'))
                      <span class="help-block">
                          {{ $errors->first('g-recaptcha-response') }}
                      </span>
                  @endif
                  </div>
                @endif
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4 text-uppercase logins" style="    margin-top: 0.5rem !important;    margin-bottom: 0.5rem !important;">{{__('Login')}}</button>
                </div>
                <div class="row mt-3">
                  <div class="col-6">
                    <a href="{{route('user.password.request')}}" class="text-dark" style="text-decoration: underline;"><small>{{__('Forgot password?')}}</small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="{{route('register')}}" class="text-dark" style="text-decoration: underline;color:green;"><small style="color:green;">{{__('Create an account')}}</small></a>
                  </div>
                </div>
              </form>
              </div>
              
               <div id="emailtab" class="tab-pane fade" style="    background: #f7fafc;">
                <form role="form" action="{{route('submitlogin')}}" method="post">
                @csrf
                
                
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Email') }}" type="email" name="email" required>
                  </div>
                  @if ($errors->has('email'))
                      <span class="error form-error-msg ">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative input-container">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="inputPassword" class="form-control" placeholder="{{ __('Password') }}" type="password" name="password" required>
                     <div><i class="material-icons visibility" style="color:black;margin-top:12px;margin-right: 5px;">visibility_off</i></div>
                  </div>
                  @if ($errors->has('password'))
                    <span class="error form-error-msg ">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
                <!--<div class="custom-control custom-control-alternative custom-checkbox">-->
                <!--  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember_me">-->
                <!--  <label class="custom-control-label" for=" customCheckLogin">-->
                <!--    <span class="text-muted">{{__('Remember me')}}</span>-->
                <!--  </label>-->
                <!--</div>-->
                
                @if($set->recaptcha==1)
               <center> <span>  {!! app('captcha')->display() !!} </span></center>
                  @if ($errors->has('g-recaptcha-response'))
                      <span class="help-block">
                          {{ $errors->first('g-recaptcha-response') }}
                      </span>
                  @endif
                @endif
                
                
                <div class="text-center">
                  <button type="submit" class="btn btn-success text-uppercase logins">{{__('Login')}}</button>
                </div>
                <div class="row mt-3">
                  <div class="col-6">
                    <a href="{{route('user.password.request')}}" class="text-dark" style="    text-decoration: underline;
    font-weight: bold;"><small>{{__('Forgot password?')}}</small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="{{route('register')}}" class="text-dark" style="    text-decoration: underline;
    font-weight: bold;"><small style="color:green;">{{__('Create an account')}}</small></a>
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
        const visibilityToggle2 = document.querySelector('.visibility2');
        const input2 = document.querySelector('.input-container2 input');
        var password2 = true;
        visibilityToggle2.addEventListener('click', function() {
          if (password2) {  
            input2.setAttribute('type', 'text');
            visibilityToggle2.innerHTML = 'visibility';
          } else {
            input2.setAttribute('type', 'password');
            visibilityToggle2.innerHTML = 'visibility_off';
          }
          password2 = !password2;
          
            });
     </script>
    
@stop