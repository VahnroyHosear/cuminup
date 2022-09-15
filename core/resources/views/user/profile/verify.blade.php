@extends('loginlayout')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
            
            @media only screen and (max-width: 600px) {
              .for-mobile-view {
                display: none;
              }
            }
        </style>


</head>
<div class="main-content">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-9 bg-future">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
               <div class="progress1">
    <div class="progress-bar1" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width:34%">
      <span class="sr-only">33% Complete</span>
     Step 1 > <span class="for-mobile-view">Create an account</span>
    </div>
    <div class="progress-bar1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:33%">
      <span class="sr-only">33% Complete</span>
     Step 2 > <span class="for-mobile-view"> Verification</span>
    </div>
   
    <div class="progress-bar2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:33%">
      <span class="sr-only">0% Complete</span>
     Step 3 > <span class="for-mobile-view">Create Virtual Cards</span>
    </div>
  </div>
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark">
                @if(Auth::guard('user')->user()->status == 1 )
                  {{__('Account has been blocked')}}
                @else
                  {{__('Verification')}}
                @endif
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

          <!--div class="card card-profile bg-white border-0 mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="{{url('/')}}/asset/profile/{{$cast}}" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
                
              <div class="text-center text-dark mb-5">
                <small>{{__('We have sent you 6 digit of verification code on your email id')}}, <span class="text-muted"><a href="{{route('user.send-emailVcode')}}">{{__('Resend email')}}</a></span></small>
              </div>
              <form role="form" action="{{ route('user.email-verify')}}" method="post">
                @csrf
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input type="hidden"  name="id" value="{{Auth::guard('user')->user()->id}}">
                    <input class="form-control" placeholder="{{ __('Code') }}" type="text" name="email_code" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4">{{__('Verify')}}</button>
                </div>
              </form>
            </div>
          </div-->
           <div class="card card-profile bg-white border-0 mb-5">
               
             
                <div class="text-center text-dark mb-5">
                @if($admin->email_verification == 0 && $admin->mobile_verification == 1)    
                <center><p><small>{{__('Please Verify Captcha')}}</small></p></center>
                @endif
              </div>
              @if($admin->mobile_verification == 1)
               <div class="card-body" style="margin-bottom: 70px;">
              <center><div id="recaptcha-container222" ></div></center>
              </div>
              @elseif($admin->email_verification == 1) 
              
              <div class="card-body" style="margin-bottom: 70px;">
                  <form action="{{ route('user.mobile-verify')}}" method="POST">
                      @csrf
              <div class="row">
                               
                             
                                   <div class="col-3"></div>
                                <div class="col-sm-6"><input type="text" name="email_code"  id="remove_error_cls_id2" class="form-control error" placeholder="Enter Email Verification Code" onchange="checkEmailCode2(this.value)" required maxlength="6"> 
                                <span id="only_email_error" style="color:red"></span>
                                </div>
                                
                                
                                 
                            </div> <br>
                             <center><button class="btn btn-success"  id="OTP_submit_button2">Verify</button></center>
                    </form>         
              </div>
              
              @endif
           </div>
         
        </div>
      </div>
    </div>
     <div class="modal fade" id="after_register" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                          
                            <div class="text-left">
                                
                            </div>    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
<div class="modal fade" id="after_register_model2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="background:#333;">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                         
                            <center><div class="text-center">
                                 <h3>{{__('Let us verify your Phone')}}</h3> 
                             <form action="{{route('user.mobile-update')}}" method="post">   
                             @csrf
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                <div class="col-sm-3">
                                    <?php $countries =DB::table('countries')->orderby('name','ASC')->get();?>
                            <select class="form-control" name="prefix">
                                <option value="">Select Country Code</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?=$country->calling_code?>" <?=($country->iso_code == $phone_iso) ? 'selected' : ''?>>{{$country->iso_code}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                                <?php }?>
                            </select>
                                </div>
                            <div class="col-sm-5">
                                  <input type="text" name="phone" class="form-control" placeholder="Enter New Mobile Number"  value="{{$user_phone}}" required> 
                                </div>
                            
                       
                           </div>
                           <br>
                           <div class="row">  
                           <div class="col-4"></div><div class="col-2"></div>
                    <div class="col-4"><input type="submit" class="btn btn-success" style="background-color:#058d2770;margin-right: -89px;padding: 5px;font-size: 12px;" value="Change Mobile No"> </div>
                        </div>
                            </form>
                            <br>
                                <h3>Verification</h3> 
                           <style>
                           .error {
                                border-block-color: red;
                            }
                           </style>
                           @if($admin->email_verification == 1 && $admin->mobile_verification == 1)
                           <center> <div class="row">
                               <div class="col-sm-2"></div>
                               <div class="col-sm-4">
                                <input type="text" name="" id="inputOtp" class="form-control error" placeholder="Enter Mobile OTP Here" required maxlength="6"> 
                                <span style="color:red;float:right" id="verify_otp_error_result"></span><br>
                                </div>
                               <div class="col-sm-4">
                                <input type="text" name=""  id="remove_error_cls_id" class="form-control error" placeholder="Enter Email Verification Code" onchange="checkEmailCode(this.value)" required maxlength="6"> 
                                <span style="color:red;" id="verify_otp_error_result2"></span>
                                </div>
                                
                            </div> </center>
                            <br> 
                            @endif
                            @if($admin->email_verification == 1 && $admin->mobile_verification == 0)
                           <center> <div class="row">
                               <div class="col-sm-4"></div>
                               <div class="col-sm-4">
                                <input type="text" name=""  id="remove_error_cls_id" class="form-control error" placeholder="Enter Email Verification Code" onchange="checkEmailCode(this.value)" required maxlength="6"> 
                                <span style="color:red;" id="verify_otp_error_result2"></span>
                                </div>
                                
                            </div> </center>
                            <br> 
                            @endif
                            @if($admin->email_verification == 0 && $admin->mobile_verification == 1)
                           <center> <div class="row">
                               <div class="col-sm-4"></div>
                               <div class="col-sm-4">
                                <input type="text" name="" id="inputOtp" class="form-control error" placeholder="Enter Mobile OTP Here" required maxlength="6"> 
                                <span style="color:red;float:right" id="verify_otp_error_result"></span><br>
                                </div>
                                
                            </div> </center>
                            <br> 
                            @endif
                          <!--center> <div class="row">
                               <div class="col-sm-3"></div>
                               <div class="col-sm-6">
                                <input type="text" name="" id="inputOtp" class="form-control error" placeholder="Enter Mobile OTP Here" required maxlength="6"> 
                                </div>
                            </div></center-->
                            
                            <p id="hide_countDownTimer_idd" style="font-size:10px;margin-right: -317px;margin-top: -31px;">&nbsp;&nbsp;Resend OTP After: <b><span id="SecondsUntilExpire"></span>&nbsp;Seconds</b></p>

                            
                            

                            <br>
                            <button class="btn btn-success" onclick="VerifyTOPSubmit()" id="OTP_submit_button">Verify</button>
                            <a href="{{$_SERVER['REQUEST_URI']}}" class="btn btn-primary" id="resend_otp_button_idd" style="display:none;margin-right: -236px;">{{__('Resend OTP')}}</a>
                           
                            </div></center>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  <div class="modal fade" id="after_register_model2_error" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                         
                            <div class="text-center">
                                <h5 style="color:red">Sorry your phone number is invalid!<br>Please enter valid phone number.</h5>
                                
                            <span style="color:red;" id="verify_otp_error_result"></span><br>
                           
                            <form action="{{route('user.mobile-update')}}" method="post">   
                             @csrf
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                <div class="col-sm-4">
                                    <?php $countries =DB::table('countries')->orderby('name','ASC')->get();?>
                            <select class="form-control" name="prefix">
                                <option value="">Select Country Code</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?=$country->calling_code?>" <?=($country->iso_code == $phone_iso) ? 'selected' : ''?>>{{$country->iso_code}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                                <?php }?>
                            </select>
                                </div>
                            <div class="col-sm-6">
                                  <input type="text" name="phone" class="form-control" placeholder="Enter New Mobile Number"  value="{{$user_phone}}" required> 
                                </div>
                            
                       
                           </div>
                           <br>
                           <div class="row">  
                           <div class="col-3"></div>
                    <div class="col-4"><input type="submit" class="btn btn-success" style="background-color:#058d2770;margin-right: -89px;padding: 5px;font-size: 12px;" value="Update Mobile Now"> </div>
                        </div>
                            </form>
                            <!--a href="{{url('user-password/reset')}}" class="btn btn-primary">Try Again!!</a-->
                            
                            
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>             
 <form action="{{ route('user.mobile-verify')}}" method="POST" id="submit_form_idd">
     @csrf
     <input type="hidden" value="{{$email_code}}" name="email_code">
      <input type="hidden" value="" id="mobile_token_id" name="mobile_token">
     
</form>                  
<!--FIREBASE SETTING-->

<?php 
    $user_id = Auth::guard('user')->user()->id;
    //dd($user_id); 
?>

<script src="https://cdn.cognitohq.com/flow.js"></script>

<script type="text/javascript">
  const flow = new Flow({
    publishableKey: "sandbox_key_b10deb370809cdb708ae59e82fdeffb7",
    templateId: "flwtmp_aec2rrgcz5NyC1",
    user: {
      customerReference: {{$user_id}}
    }
  });
</script>

<!--<button id="launch-flow">Verify my Identity</button>-->

<script type="text/javascript">
  document
    .querySelector("#launch-flow")
    .addEventListener("click", () => flow.open());
</script>


<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>                 
    <script>
 $(document).ready(function(){
//FOR INDIVIDUAL USER POPUP MODEL VALIDATION     
$("#after_register,#after_register_model2,#after_register_model2_error").modal({
show:false,
backdrop:'static'});
//FOR BUSINESS USER POPUP MODEL VALIDATION     
$("#OTP_CaptchaModelID,#OTP_VerifyModelID,#after_register_modelbusi_error").modal({
show:false,
backdrop:'static'});
    
});   
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
apiKey: "AIzaSyDcFs_lt2gVfH1j-46eCrt9qF-3SRBBXc0",
  authDomain: "getvirtualcard-8eb9c.firebaseapp.com",
  projectId: "getvirtualcard-8eb9c",
  storageBucket: "getvirtualcard-8eb9c.appspot.com",
  messagingSenderId: "338831172514",
  appId: "1:338831172514:web:06fb6a44569a6289f788fb",
  measurementId: "G-GTQVCF7YQV"
};
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

   //var verifyotp=document.getElementById("verifyotp");

$( document ).ready(function() {
   
          var str1 = "+";
                       //alert(document.getElementById("indi_countryCallingCode").value);
                      
                    //$('#after_register').modal('show');
                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container222', {
                        'size': 'normal',
                        'callback': function(response) { 
                            
                        },
                        'expired-callback': function() {
                        }
                        });
                         $('#after_register').modal('hide');
                        var cverify=window.recaptchaVerifier;
                        var phoneinput;
                             phoneinput = "{{'+'}}{{$user_phone_calling_code}}{{$user_phone}}";
                        firebase.auth().signInWithPhoneNumber(phoneinput,cverify).then(function(response){
                           
                        $('#after_register_model2').modal('show');
                        TimerStartFunction();
                        console.log('Result'+response);
                        window.confirmationResult=response;
                        }).catch(function(error){
                            console.log(error.message);
                            $('#after_register').modal('hide');
                            $('#after_register_model2_error').modal('show');
                           
                           
                        })
    
   
  }); 
    function VerifyTOPSubmit(){ 
      var otpinput=document.getElementById("inputOtp");
      if(otpinput.value.length == 0)
      {
       $('#verify_otp_error_result').html('Please enter your OTP here!');
      }
               confirmationResult.confirm(otpinput.value).then(function(response){
                   //$('#after_register').modal('hide');
                   $('#after_register_model2').modal('hide');
                   var userobj=response.user;
                    var token=userobj.xa;
                     $('#OTP_submit_button').attr('disabled',true);
                    $('#mobile_token_id').val(token);
                   $('#submit_form_idd').submit();
                  
                   //location.href = 'https://cuminup.com/user-password/reset-byphone';

                 
                    var userobj=response.user;
                    var token=userobj.xa;
                    var provider="phone";
                   var email=phoneinput.value;
                    if(token!=null && token!=undefined && token!=""){
                    //sendDatatoServerPhp(email,provider,token,email);
                    }
               })
               .catch(function(error){
                   $('#verify_otp_error_result').html('Sorry your have entered wrong otp!');
                   console.log(error);
               })
           }
           
    function checkEmailCode(emailCode){
        if(emailCode == "{{$email_code}}")
        {
            $('#remove_error_cls_id').removeClass("error");
            $('#verify_otp_error_result2').hide();
            $('#OTP_submit_button').removeAttr('disabled');
        } else {
            $('#OTP_submit_button').prop('disabled', true);
            $('#verify_otp_error_result2').html('Sorry verification code miss matched!');
            
        }
    }
    
    function checkEmailCode2(emailCode){
        if(emailCode == "{{$email_code}}")
        { 
            $('#only_email_error').html(' ');
             $('#remove_error_cls_id2').removeClass("error");
            //$('#verify_otp_error_result2').hide();
            $('#OTP_submit_button2').removeAttr('disabled');
        } else {
            //alert('Not matched');
            $('#OTP_submit_button2').prop('disabled', true);
            $('#only_email_error').html('Sorry verification code miss matched!');
            
        }
    }
    
    $(document).on("change", "#inputOtp", function () { 
       
       $('#inputOtp').removeClass("error");
       $('#OTP_submit_button').removeAttr('disabled');
       
    });  

    </script>
<script>
//FOR SESSION
function TimerStartFunction()
{
    var IDLE_TIMEOUT = 120; //seconds
    var _idleSecondsTimer = 0;
    var _idleSecondsCounter = 0;
    
    document.onclick = function() {
       // _idleSecondsCounter = 0;
    };
    
    document.onmousemove = function() {
       // _idleSecondsCounter = 0;
    };
    
    document.onkeypress = function() {
       // _idleSecondsCounter = 0;
    };
    
    _idleSecondsTimer = window.setInterval(CheckIdleTime, 1000);
    
    function CheckIdleTime() {
         _idleSecondsCounter++;
         var oPanel = document.getElementById("SecondsUntilExpire");
         if (oPanel)
             oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
        if (_idleSecondsCounter >= IDLE_TIMEOUT) {
            $('#hide_countDownTimer_idd').hide();
            $('#resend_otp_button_idd').show();
            //window.clearInterval(_idleSecondsTimer);
            //document.location.href = "@php echo url('/user/logout'); @endphp";
           // alert("Time expired!");
          // $('#modal-formx_sessionlogout').modal('show');
         /*   if(confirm('Are you sure do you still want to stay here?')){ 
               
                document.location.href = "@php echo $_SERVER['REQUEST_URI']; @endphp";
            } else { 
                
                
                //document.getElementById('id01').style.display='block'
              
              // document.location.href = "@php echo url('/user/logout'); @endphp";
                //document.location.href = "@php echo url('/login'); @endphp";
            }
            */
            
        } else if(_idleSecondsCounter == '170') {
            //$('#modal-formx_sessionlogout').modal('show');
        }
    }
}
</script>    
 
@stop