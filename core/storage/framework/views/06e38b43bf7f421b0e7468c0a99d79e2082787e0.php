<head>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
</head>  
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-5 pt-lg-9">
        
        <style>
            .form-error-msg{
                color:red;
            }
            @media  only screen and (max-width: 600px) {
              .for-mobile-view {
                display: none;
              }
            }
        </style>
        
        



        
        
      <div class="container" style="    margin-top: -67px;">
          <div class="progress1">
    <div class="progress-bar1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:34%">
      <span class="sr-only">25% Complete</span>
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
              <h1 class="text-dark"><?php echo e(__("Let's us get to know you!")); ?></h1>
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
                <small style="font-size:16px;"><b><?php echo e(__('Select Your Account Type')); ?></b></small>
              </div>
              <form role="form" action="<?php echo e(route('submitregister')); ?>" method="post">
                <?php echo csrf_field(); ?>
                
                <div class="form-group row">
                  <div class="col-lg-12">
                    <div class="row" style="margin-top: -35px;">
                        
                        <div class="col-6">
                           <!--label>
                             Standard
                            </label>
                            <input class="form-control"  type="radio" name="user_type"  required-->
                        <div class="radio">
                          <label><input type="radio" name="account_type" checked value="standard"> Standard</label><br>
                          <small style="color:#2d4ec8;font-size: 12px;">(Mostly used by individual and startup companies)</small>
                        </div>
                        </div>      
                        <div class="col-6">
                            <div class="radio">
                          <label><input type="radio" name="account_type" value="enterprise"> Enterprise</label><br>
                          <small style="color:#2d4ec8;font-size: 12px;">(Recommended for medium and large companies)</small>
                        </div>
                        </div>
                          
                        </div>
                    </div>
                  </div>
                
                 
                
                <div class="form-group row">
                    <div class="text-left text-dark mb-2">
                <small style="font-size:16px;"><b>&nbsp;&nbsp;&nbsp;<?php echo e(__('Personal Details')); ?></b></small>
              </div>
                  <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">
                          <div class="input-group input-group-alternative">
                            
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="<?php echo e(__('*First Name')); ?>" type="text" name="first_name" maxlength="55" value="<?php echo e(old('first_name')); ?>" required>
                          </div>
                        </div>      
                        <div class="col-6">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="<?php echo e(__('*Last Name')); ?>" type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" maxlength="55" required>
                          
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
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                            <select class="form-control" name="prefix" required>
                                <option value="">*Select Country Code</option>
                                
                                <?php 
                                 $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
                                  
                                   
                                   
                                       // echo $query['city']." | ".$query['country']." | ".$val->ip_address;
                                    
                                foreach($countries as $country){?>
                                <option value="<?=$country->id?>"  <?php if(!empty($query['countryCode'])): ?><?=($country->iso_code == $query['countryCode']) ? 'selected' : ''?> <?php endif; ?>><?php echo e($country->iso_code); ?> <?php echo e('('); ?><?php echo e('+'); ?><?php echo e($country->calling_code); ?><?php echo e(')'); ?></option>
                                <?php }?>
                            </select>
                          </div>
                        </div>      
                        <div class="col-8">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                            </div>
                            <input class="form-control" placeholder="<?php echo e(__('*Phone Number')); ?>" type="text" name="phone" value="<?php echo e(old('phone')); ?>" maxlength="13" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                          </div>
                        <small style="color:#2d4ec8;font-size: 12px;">(We will send you a text to verify your phone. Message and Data rates may apply.)</small>

                        </div>
                    </div>
                  </div>
                  <?php if($errors->has('phone')): ?>
                    <span class="error form-error-msg " style="margin-left:44%;font-size:12px"><?php echo e($errors->first('phone')); ?></span>
                  <?php endif; ?>
                </div>
                
                
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="fa fa-users"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('Business Name')); ?>" type="text" name="business_name" value="<?php echo e(old('business_name')); ?>" maxlength="55">
                  </div>
                  <?php if($errors->has('business_name')): ?>
                    <span class="error form-error-msg " style="font-size: 12px;"><?php echo e($errors->first('business_name')); ?></span>
                  <?php endif; ?>
                </div>                                              
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('*Email')); ?>" type="email" name="email" value="<?php echo e(old('email')); ?>" required>
                  </div>
                  <?php if($errors->has('email')): ?>
                    <span class="error form-error-msg" style="font-size: 10px;"><?php echo e($errors->first('email')); ?></span>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative input-container">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                   
                    <input class="form-control" placeholder="<?php echo e(__('*Password')); ?>" type="password" name="password" required id="inputPassword" value="<?php echo e(old('password')); ?>" maxlength="30" onkeyup="passwordStrengthCheck()">
                  
                   <div class='col-lg-1'><i class="material-icons visibility" style="margin-top:12px;">visibility_off</i></div>
                  </div>
                  <div id="passwordAlertDiv" style="display:none;">
        				<span id="passwordalertoutput" class="password-strength-status" style="font-size: 12px;"></span>
        				<span class="password-strength-status2"></span>
        				<span class="password-strength-status3"></span>
				      </div>
                  <?php if($errors->has('password')): ?>
                    <span class="error form-error-msg " style="font-size: 10px;"><?php echo e($errors->first('password')); ?></span>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password-confirm" class="form-control" placeholder="<?php echo e(__('*Re-Enter Password')); ?>" maxlength="30" type="password" name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>" onchange="ConfirmpasswordCheck()" required>
                      <?php if($errors->has('password_confirmation')): ?>
                        <span class="error form-error-msg "style="font-size: 12px;" >
                          <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                        </span>
                      <?php endif; ?>
                       
                  </div>
                 <span id="confirm_pwd_error" style="font-size: 12px;"></span>
                </div>
                 
                <!--div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="fa fa-globe"></i></span>
                    </div>
                    <select class="form-control" name="business_country" >
                        <option value="" >What country is your business based?</option>
                        <?php foreach($countries as $country){?>
                        <option value="<?=$country->id?>" ><?= $country->name ?></option>
                        <?php }?>
                    </select>
                  </div>
                  </div-->
                  
                 <!--div class="form-group">
                     <div class="row">
                   <div class="col-lg-12">
                    <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="fa fa-globe"></i></span>
                    </div>
                    <select class="form-control" name="source_from">
                        <option value="">How did you hear about GetVirtualCard?</option>
                        
                        <option value="By Social Media">By Social Media</option>
                        <option value="Google Ads/ Search Result">Google Ads/ Search Result</option>
                        <option value="From a Friend">From a Friend</option>
                        
                        <option value="Others">Others</option>
                    </select>
                  </div>
                  
                  
                      <?php if($errors->has('source_from')): ?>
                        <span class="error form-error-msg "><?php echo e($errors->first('source_from')); ?></span>
                      <?php endif; ?>
                      </div>
                      </div>
                </div-->
                
                
                
                
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Agree to <a href="<?php echo e(route('terms')); ?>" target="_blank">Terms & Conditions</a></span>
                  </label>
                </div>
                <?php if($set->recaptcha==1): ?>
                <br>
                <center>
                <div class="row">
                    
                   <div class="col-lg-12">
                  <?php echo app('captcha')->display(); ?>

                  <?php if($errors->has('g-recaptcha-response')): ?>
                      <span class="help-block" style="color:red;">
                          <?php echo e($errors->first('g-recaptcha-response')); ?>

                      </span>
                  <?php endif; ?>
                  </div>
                  </div></center>
                <?php endif; ?>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4" disabled id="continue_click"><?php echo e(__('Create an account')); ?></button>
                </div>
                <div class="row mt-4 text-center">
                  <div class="col-4">
                    <a href="<?php echo e(route('user.password.request')); ?>" class="text-dark" style="  color:black;   text-decoration: underline;
    font-weight: bold;"><small><b style="color:blue;"><?php echo e(__('Forgot password?')); ?></b></small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="<?php echo e(route('login')); ?>" class="text-dark" style=" color:black;   text-decoration: underline;
    font-weight: bold;"><small><b>Already have an account? </small></a>
    <br> <span style="background-color:1d0e44;margin-right: 30px;" class="btn"><?php echo e(__('Login Now')); ?></span>
                  </div>
                  
                </div>
              </form>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views//auth/register.blade.php ENDPATH**/ ?>