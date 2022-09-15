<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</head>
  
  
<?php $__env->startSection('content'); ?>
   
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark"><?php echo e(__('Verification')); ?></h1>
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
            <div class="card-header bg-transparent pb-0">
            </div>
            <div class="card-body px-lg-5 py-lg-3">
              <div class="text-center text-dark mb-5">
                <small><?php echo e(__('Please verify recaptcha for otp verification')); ?></small><br><br>
               <small>We will send OTP on this number <?php echo e('+'); ?><?php echo e($user->prefix); ?><?php echo e('-XXX-XXX-XX'); ?><?php echo e(substr($user->phone,-2)); ?></small>
              </div>
               &nbsp;&nbsp;<center><div id="recaptcha-container222"></div></center>
               <br>
               <br>
             
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
              
              <!--ul class="nav nav-tabs login-mobile-rep" style="padding-bottom: 10px;">
              <li><button class="btn active login-btn " data-toggle="tab" href="#emailtab">Login By Email</button></li>
              <p style="text-align:center; margin-bottom: 5px; margin-top: 5px;">Or</p>
              <li><button class="btn btn2 login-btn " data-toggle="tab" href="#phonetab">Login By Phone</button></li>
            </ul-->
            
            <div class="tab-content">
             
              <!--div id="emailtab" class="tab-pane active " style="    background: #f7fafc;">
              <form role="form" action="<?php echo e(route('user.password.email')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('Email')); ?>" type="email" name="email" required>
                  </div>
                </div>
               
                
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4"><?php echo e(__('Reset')); ?></button>
                </div>
              </form>
            </div>
            
            <div id="phonetab" class="tab-pane fade in show" style="    background: #f7fafc;">
             
                
                 <div class="form-group row">
                  <div class="col-lg-12">
                    <div class="row">
                        <div class="col-5">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-flag"></i></span>
                            </div>
                            <?php $countries =DB::table('countries')->orderby('name','ASC')->get(); ?>
                            <select class="form-control" name="prefix" id="indi_countryCallingCode">
                                <option value="">Select Country Code</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?=$country->calling_code?>" <?=($country->iso_code =='IN') ? 'selected' : ''?>><?php echo e($country->name); ?> <?php echo e('('); ?><?php echo e('+'); ?><?php echo e($country->calling_code); ?><?php echo e(')'); ?></option>
                                <?php }?>
                            </select>
                          </div>
                        </div>      
                        <div class="col-7">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                            </div>
                            <input class="form-control" placeholder="<?php echo e(__('Phone Number')); ?>" type="text" maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="phone" required id="inputPhone_individual">
                          
                          </div>
                          
                        </div>
                        <span id="phone_err22" style="color:red;margin-left:12px;"></span>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4" onclick="clickindividualSUbmitButton()"><?php echo e(__('Submit')); ?></button>
                </div>
             
            </div-->
            
            </div>
            </div>
          </div>
          <div class="row" style="margin-top:-70px;padding:20px;">
            <div class="col-6">
              <a href="<?php echo e(route('login')); ?>" style="text-decoration: underline;" class="text-dark"><small><?php echo e(__('Login')); ?></small></a>
            </div>
            <div class="col-6 text-right">
              <a href="<?php echo e(route('register')); ?>" style="text-decoration: underline;" class="text-dark"><small><?php echo e(__('Create an account')); ?></small></a>
            </div>
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
                          <!--div id="recaptcha-container222"></div-->
                            <div class="text-left">
                                
                            </div>    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
<div class="modal fade" id="after_register_model2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="background-color: #333;">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                         
                            <div class="text-center">
                                <h3>OTP Verification</h3> 
                                <span style="font-size:12px">Input the code we sent to <?php echo e('+'); ?><?php echo e($user->prefix); ?><?php echo e('-XXX-XXX-XX'); ?><?php echo e(substr($user->phone,-2)); ?> <?php echo e('to access your account.'); ?></span>
                            <span style="color:red;" id="verify_otp_error_result"></span><br>
                            <input type="text" name="" id="inputOtp" class="form-control" placeholder="Enter Mobile OTP Here" required maxlength="6"> 
                          <p id="hide_countDownTimer_idd" style="font-size:10px">&nbsp;&nbsp;Resend OTP After: <b><span id="SecondsUntilExpire"></span> Second</b></p>

                            <br>
                            <button class="btn btn-success" onclick="VerifyTOPSubmit()">Verify OTP</button>
                            <a href="<?php echo e($_SERVER['REQUEST_URI']); ?>?resend=1" class="btn btn-primary" id="resend_otp_button_idd" style="display:none">Resend OTP Now</a>
                            </div>
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
                                <h5 style="color:red">Sorry your phone number format is incorrect!</h5> 
                            <span style="color:red;" id="verify_otp_error_result"></span><br>
                           
                            
                            <a href="<?php echo e(url('user/logout')); ?>" class="btn btn-primary">Try Again!!</a>
                            
                            
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
       
<!--FIREBASE SETTING-->

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
  apiKey: "AIzaSyBf5Tvn1dgZQTNNBP70eQMitjvjCNUn9gU",
  authDomain: "cuminup-7c3c4.firebaseapp.com",
  projectId: "cuminup-7c3c4",
  storageBucket: "cuminup-7c3c4.appspot.com",
  messagingSenderId: "791929045937",
  appId: "1:791929045937:web:dcec65a7079ad4d070f390",
  measurementId: "G-CRX2BKPEJD"
};
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
//var phoneinput;
    // phoneinput = document.getElementById("inputPhone_individual");
   //var verifyotp=document.getElementById("verifyotp");
 var plusCallingCode;//str1.concat(callingCode.value);
                        plusCallingCode = '<?php echo e($customer_mobile); ?>';
//alert(plusCallingCode);
   $(document).ready(function(){ 
     
                    
                 
                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container222', {
                        'size': 'normal',
                        'callback': function(response) { 
                            
                        },
                        'expired-callback': function() {
                        }
                        });
                        
                         //$('#after_register').modal('hide');
                         
                        var cverify=window.recaptchaVerifier;
                        
                        firebase.auth().signInWithPhoneNumber(plusCallingCode,cverify).then(function(response){
                             
                        $('#after_register_model2').modal('show');
                         TimerStartFunction();
                        //console.log('Result'+response);
                        window.confirmationResult=response;
                        }).catch(function(error){
                            console.log(error.message);
                            $('#after_register').modal('hide');
                            $('#after_register_model2_error').modal('show');
                           
                           
                        })
   });    
$(document).ready(function(){ 
    var sPageURL = window.location.search.substring(1);
    if(sPageURL== 'resend=1')
    {
         //$('#after_register_model2').modal('hide');
         // resendFunction();
    }
   
});     
   function resendFunction() {
         /* window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container223', {
                        'size': 'normal',
                        'callback': function(response) { 
                            
                        },
                        'expired-callback': function() {
                        }
                        });
                        
                         //$('#after_register').modal('hide');
                         
                        var cverify=window.recaptchaVerifier;
                        
                        firebase.auth().signInWithPhoneNumber(plusCallingCode,cverify).then(function(response){
                             
                        $('#after_register_model2').modal('show');
                         TimerStartFunction();
                        //console.log('Result'+response);
                        window.confirmationResult=response;
                        }).catch(function(error){
                            console.log(error.message);
                            $('#after_register').modal('hide');
                            $('#after_register_model2_error').modal('show');
                           
                           
                        })
                        */
                        
                }
            
    
   
   
    function VerifyTOPSubmit(){ 
      var otpinput=document.getElementById("inputOtp");
      if(otpinput.value.length == 0)
      {
       $('#verify_otp_error_result').html('Please enter your OTP here!');
      }
               confirmationResult.confirm(otpinput.value).then(function(response){
                   $('#after_register').modal('hide');
                   $('#after_register_model2').modal('hide');
                   var user = firebase.auth().currentUser;

                    user.delete().then(function() {
                       console.log('User deleted.');
                    }).catch(function(error) {
                      // An error happened.
                    });
                  location.href = '<?php echo e(url('/')); ?>/2fa?u=1';   
                   //location.href = '<?php echo e(url('/')); ?>/user/newdashboard';

                  // $('#inputPhone_individual').prop('readonly', true);
                    //$('#individual_submit').removeAttr('disabled');
                    //$('#indi_SENDOTPSUBMITbutton').prop('disabled', true);
                   // $('#verify_otp_success_result').html('OTP has been verified successfylly.');
                  // console.log(response);
                 
                 
                    var userobj=response.user;
                    var token=userobj.xa;
                    var provider="phone";
                   var email=phoneinput.value;
                    if(token!=null && token!=undefined && token!=""){
                    //sendDatatoServerPhp(email,provider,token,email);
                    }
               })
               .catch(function(error){
                   $('#verify_otp_error_result').html('Sorry your OTP is not Matched!');
                   console.log(error);
               })
           }
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
            //document.location.href = "<?php echo url('/user/logout'); ?>";
           // alert("Time expired!");
          // $('#modal-formx_sessionlogout').modal('show');
         /*   if(confirm('Are you sure do you still want to stay here?')){ 
               
                document.location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
            } else { 
                
                
                //document.getElementById('id01').style.display='block'
              
              // document.location.href = "<?php echo url('/user/logout'); ?>";
                //document.location.href = "<?php echo url('/login'); ?>";
            }
            */
            
        } else if(_idleSecondsCounter == '170') {
            //$('#modal-formx_sessionlogout').modal('show');
        }
    }
}
</script>   
    
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views//auth/passwords/login_otp.blade.php ENDPATH**/ ?>