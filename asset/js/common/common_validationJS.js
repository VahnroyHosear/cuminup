
 
 
 //FOR Amount in decimal with commas
// $('.amount_input').mask("#,##0.00", {reverse: true});


//FIREBASE START
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

 // Your web app's Firebase configuration

  var firebaseConfig = {
  apiKey: "AIzaSyChIGOmijQq4ygUD8wLxy7AyPtoUcUdl_0",
  authDomain: "cuminpay-8723d.firebaseapp.com",
  projectId: "cuminpay-8723d",
  storageBucket: "cuminpay-8723d.appspot.com",
  messagingSenderId: "1047027192793",
  appId: "1:1047027192793:web:04dd421e2b7022c688ffc8",
  measurementId: "G-R6164C2PWB",
  databaseURL: "https://cuminpay-8723d-default-rtdb.firebaseio.com/"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

//=========================Login With Phone==========================
//FOR INDIVIDUAL USER MOBILE OTP Via FIREBASE
   var str1 = "+";
   
   var callingCode;
   function getCountryCodeFunction(CallingCode) {
        callingCode = CallingCode;//document.getElementById("indi_countryCallingCode");
        
   }
  var plusCallingCode = str1.concat(callingCode);
  
  
    var phoneinput;
     phoneinput = document.getElementById("inputPhone_individual");
   var verifyotp=document.getElementById("verifyotp");

function Indi_PhoneInputOnChnage()
{

    if($('#inputPhone_individual').val().length == '10')
    {
        $('#indi_SENDOTPSUBMITbutton').removeAttr('disabled');
    }
}
   function clickindividualSUbmitButton() { 
    $('#after_register').modal('show');
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container222', {
        'size': 'normal',
        'callback': function(response) { 
            
        },
        'expired-callback': function() {
        }
        });
         $('#after_register').modal('hide');
        var cverify=window.recaptchaVerifier;
        firebase.auth().signInWithPhoneNumber(plusCallingCode.concat(phoneinput.value),cverify).then(function(response){
           
        $('#after_register_model2').modal('show');
        console.log('Result'+response);
        window.confirmationResult=response;
        }).catch(function(error){
            console.log(error.message);
            $('#after_register').modal('hide');
            $('#after_register_model2_error').modal('show');
           
           
        })
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
                   $('#inputPhone_individual').prop('disabled', true);
                    $('#indi_SENDOTPSUBMITbutton').prop('disabled', true);
                    $('#verify_otp_success_result').html('OTP has been verified successfylly.');
                   console.log(response);
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
           
//FOR BUSINESS USER MOBILE OTP Via FIREBASE 
function Busi_PhoneInputOnChnage()
{

    if($('#busi_user_PhoneInputID').val().length == '10')
    {
        $('#busi_user_PhoneSubmitID').removeAttr('disabled');
    }
}
  
function clickbusinessSUbmitButton(){
    var busi_phoneinput = document.getElementById("busi_user_PhoneInputID");
    
   $('#OTP_CaptchaModelID').modal('show'); 
   window.recaptchaVerifier2 = new firebase.auth.RecaptchaVerifier('recaptcha-container333', {
        'size': 'normal',
        'callback': function(response) { 
            
        },
        'expired-callback': function() {
        }
        });
         $('#OTP_CaptchaModelID').modal('hide');
        var cverify2=window.recaptchaVerifier2;
        firebase.auth().signInWithPhoneNumber(plusCallingCode.concat(busi_phoneinput.value),cverify2).then(function(response){
        console.log('Result2'+response);
       
            $('#OTP_VerifyModelID').modal('show');
        window.confirmationResult2=response;
        }).catch(function(error){
             $('#after_register_modelbusi_error').modal('show');
            console.log(error);
        })
    
}

function busi_VerifyTOPSubmit(){ 
      var otpinput2=document.getElementById("inputOtp2");
      if(otpinput2.value.length == 0)
      {
       $('#verify_otp_error_result2').html('Please enter your OTP here!');
      }
               confirmationResult2.confirm(otpinput2.value).then(function(response){
                   $('#OTP_VerifyModelID').modal('hide');
                   $('#busi_user_PhoneInputID').prop('disabled', true);
                    $('#busi_user_PhoneSubmitID').prop('disabled', true);
                    $('#OTP_CaptchaModelID').modal('hide');
                    $('#busi_verify_otp_success_result').html('OTP has been verified successfully.');
                   console.log(response);
                    var userobj=response.user;
                    var token=userobj.xa;
                    var provider="phone";
                   var email=phoneinput.value;
                    if(token!=null && token!=undefined && token!=""){
                    }
               })
               .catch(function(error){
                   
                   $('#verify_otp_error_result2').html('Sorry your OTP is not Matched!');
                   console.log(error);
               })
           } 
   //=================End Login With Phone=========================
//END FIREBASE



    function checkPasswordMatch22() {
        var password22 = $("#inputPassword").val();
        var confirmPassword22 = $("#txtConfirmPassword").val();
        if (password22 != confirmPassword22)
         {  
            $("#CheckPasswordMatch").css('color','red');
            $("#CheckPasswordMatch").html("Passwords does not match!");
        }   
        else {
            $("#CheckPasswordMatch").css('color','green');
            $("#CheckPasswordMatch").html("Passwords match.");
            
        }
    }
    function checkPasswordMatch33() {
        var password33 = $("#inputPassword").val();
        var confirmPassword33 = $("#txtConfirmPassword_2").val();
        if (password33 != confirmPassword33)
         {  
            $("#CheckPasswordMatch_2").css('color','red');
            $("#CheckPasswordMatch_2").html("Passwords does not match!");
        }   
        else {
            $("#CheckPasswordMatch_2").css('color','green');
            $("#CheckPasswordMatch_2").html("Passwords match.");
        }
    }
    $(document).ready(function () {
       $("#txtConfirmPassword").keyup(checkPasswordMatch22);
       $("#txtConfirmPassword_2").keyup(checkPasswordMatch33);
    });

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


const visibilityToggle3 = document.querySelector('.c_visibility');
const input3 = document.querySelector('.input-container3 input');
var password3 = true;

visibilityToggle3.addEventListener('click', function() {
  if (password3) {
    input3.setAttribute('type', 'text');
    visibilityToggle3.innerHTML = 'visibility';
  } else {
    input3.setAttribute('type', 'password');
    visibilityToggle3.innerHTML = 'visibility_off';
  }
  password3 = !password3;
  
});

const visibilityToggle4 = document.querySelector('.visibility4');
const input4 = document.querySelector('.input-container4 input');
var password4 = true;

visibilityToggle4.addEventListener('click', function() {
  if (password4) {
    input4.setAttribute('type', 'text');
    visibilityToggle4.innerHTML = 'visibility';
  } else {
    input4.setAttribute('type', 'password');
    visibilityToggle4.innerHTML = 'visibility_off';
  }
  password4 = !password4;
  
});

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


$('#date').datepicker({ dateFormat: 'yy-mm-dd' }).val();
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




function passwordStrengthCheck() { 
	$('#passwordAlertDiv').show();
	var number = '[0-9]';
	var alphabets = '[a-zA-Z]';
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	
	
	if ($('#inputPassword').val().length < 8) {
		$('.password-strength-status').css('color','red');
		$('.password-strength-status').html("Should be at least 8 characters.");
		$('#individual_submit').prop('disabled', true);
		$('#inputPassword').attr('type','password');
	} else {
		$('.password-strength-status').css('color','green');
		$('.password-strength-status').html("8 characters included");
		if($('#inputPassword').val().match(number) && $('#inputPassword').val().match(alphabets) && $('#inputPassword').val().match(special_characters))		
		{
			
			$('#individual_submit').removeAttr('disabled');

		}
	}
	

	if($('#inputPassword').val().match(alphabets) && $('#inputPassword').val().match(number)){
			$('.password-strength-status2').css('color','green');
			$('.password-strength-status2').html("Alphabet and number included");
	
	} else {
		$('.password-strength-status2').css('color','red');
		$('#inputPassword').attr('type','password');
		$('.password-strength-status2').html("Should include at least 1 character and number.");
		$('#continue_click').prop('disabled', true);
	}
	if($('#inputPassword').val().match(special_characters)){
		$('.password-strength-status3').css('color','green');
		$('.password-strength-status3').html("Special character included");
	} else {
		$('.password-strength-status3').css('color','red');
		$('#inputPassword').attr('type','password');
		$('.password-strength-status3').html("Should include at least 1 special character.");
		$('#continue_click').prop('disabled', true);
	}
	
}

function passwordStrengthCheck_buser() { 
	$('#passwordAlertDiv_buser').show();
	var number = '[0-9]';
	var alphabets = '[a-zA-Z]';
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	
	
	if ($('#inputPassword_buser').val().length < 8) {
		$('.password-strength-status_buser').css('color','red');
		$('.password-strength-status_buser').html("Should be at least 8 characters.");
		$('#individual_submit').prop('disabled', true);
		$('#inputPassword_buser').attr('type','password');
	} else {
		$('.password-strength-status_buser').css('color','green');
		$('.password-strength-status_buser').html("8 characters included");
		if($('#inputPassword_buser').val().match(number) && $('#inputPassword_buser').val().match(alphabets) && $('#inputPassword_buser').val().match(special_characters))		
		{
			
			$('#individual_submit').removeAttr('disabled');

		}
	}
	

	if($('#inputPassword_buser').val().match(alphabets) && $('#inputPassword_buser').val().match(number)){
			$('.password-strength-status2_buser').css('color','green');
			$('.password-strength-status2_buser').html("Alphabet and number included");
			$('#continue_click').removeAttr('disabled');
	} else {
		$('.password-strength-status2_buser').css('color','red');
		$('#inputPassword_buser').attr('type','password');
		$('.password-strength-status2_buser').html("Should include at least 1 character and number.");
		$('#continue_click').prop('disabled', true);
	}
	if($('#inputPassword_buser').val().match(special_characters)){
		$('.password-strength-status3_buser').css('color','green');
		$('.password-strength-status3_buser').html("Special character included");
		$('#continue_click').removeAttr('disabled');
	} else {
		$('.password-strength-status3_buser').css('color','red');
		$('#inputPassword_buser').attr('type','password');
		$('.password-strength-status3_buser').html("Should include at least 1 special character.");
		$('#continue_click').prop('disabled', true);
	}
	
}

$("#business_type").change(function () {
       
        $("#b_uuid").val($(this).find(':selected').data("id"));
       
    });

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

 function checkUserExist(username){ 
        let _token   = $('meta[name="csrf-token"]').attr('content');
        if(username!='')
        { 
            $.ajax({
                url: "https://ach.cuminup.com/check_username",
                method: "POST",
                data: {username:username,_token:_token},
                success: function(data) { 
                    console.log(data.result);
                    if(data.result == '1')
                    {
                        $('#checked').show();
                        $('#unchecked').hide();
                       $('#username_err1').html("Username "+username+ " is available");
                        $("#individual_submit").prop('disabled', false);
                    }
                },
                error:function(err){ 
                    if(err.responseJSON.result == '0') {
                         $('#checked').hide();
                         $('#unchecked').show();
                         $("#username_err").html("Username "+username+ " is taken!");
                        $("#individual_submit").prop('disabled', true);
                        if(err.responseJSON.response.username[0] == 'The username has already been taken.') 
                        {
                         $("#username_err").html("Username "+username+ " is taken!");
                        } else {
                            $("#username_err").html(err.responseJSON.response.username[0]);
                        }
                    }
                }
            });
        }
    }
    
function checkUserExist2(username2){ 
        let _token   = $('meta[name="csrf-token"]').attr('content');
        if(username2!='')
        { 
            $.ajax({
                url: "https://ach.cuminup.com/check_username",
                method: "POST",
                data: {username:username2,_token:_token},
                success: function(data) { 
                    console.log(data.result);
                    if(data.result == '1')
                    {
                        $('#checked2').show();
                        $('#unchecked2').hide();
                       $('#username_err2').html("Username "+username2+ " is available");
                        $("#business_submit").prop('disabled', false);
                    }
                },
                error:function(err){ 
                    if(err.responseJSON.result == '0') {
                         $('#checked2').hide();
                         $('#unchecked2').show();
                         $("#username_err22").html("Username "+username2+ " is taken!");
                        $("#business_submit").prop('disabled', true);
                         if(err.responseJSON.response.username[0] == 'The username has already been taken.') 
                        {
                         $("#username_err22").html("Username "+username2+ " is taken!");
                        } else {
                            $("#username_err22").html(err.responseJSON.response.username[0]);
                        }
                    }
                }
            });
        }
    } 
 
 //FOR EXISTING MOBILE NO CHECK FOR INDI USER  
function checkUserMobileExist(indiUserMobileNo){ 
        let _token   = $('meta[name="csrf-token"]').attr('content');
      
        if(indiUserMobileNo!='')
        { 
            $.ajax({
                url: "https://ach.cuminup.com/check_usermobile",
                method: "POST",
                data: {phone:indiUserMobileNo,_token:_token},
                success: function(data) { 
                   
                    console.log(data.result);
                    if(data.result == '1')
                    {
                        $("#indi_SENDOTPSUBMITbutton").prop('disabled', false);
                        $('#phone_err22').hide();
                       
                    }
                },
                error:function(err){
                     $("#indi_SENDOTPSUBMITbutton").prop('disabled', true);
                    $("#business_submit").prop('disabled', true);
                    $('#phone_err22').show();
                    console.log(err.responseJSON.response.phone[0]);
                    $("#phone_err22").html(err.responseJSON.response.phone[0]);
                   
                }
            });
        }
    } 
 //FOR EXISTING MOBILE NO CHECK FOR BUSI USER  
function checkUserMobileExist2(indiUserMobileNo){ 
        let _token   = $('meta[name="csrf-token"]').attr('content');
      
        if(indiUserMobileNo!='')
        { 
            $.ajax({
                url: "https://ach.cuminup.com/check_usermobile",
                method: "POST",
                data: {phone:indiUserMobileNo,_token:_token},
                success: function(data) { 
                   
                    console.log(data.result);
                    if(data.result == '1')
                    {
                        $("#busi_user_PhoneSubmitID").prop('disabled', false);
                        $('#phone_err33').hide();
                        
                    }
                },
                error:function(err){
                     $("#busi_user_PhoneSubmitID").prop('disabled', true);
                    $("#business_submit").prop('disabled', true);
                    $('#phone_err33').show();
                    console.log(err.responseJSON.response.phone[0]);
                    $("#phone_err33").html(err.responseJSON.response.phone[0]);
                    
                }
            });
        }
    }  
 