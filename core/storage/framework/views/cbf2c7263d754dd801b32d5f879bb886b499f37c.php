

<?php $__env->startSection('content'); ?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
 <style>
   body {
    position: relative;
  }
  ul.nav-pills {
    top: 120px;
    position: fixed;
  }
  div.col-sm-9 div {
    height: 250px;
    font-size: 28px;
  }
 /* #section1 {color: #fff; background-color: #1E88E5;}
  #section2 {color: #fff; background-color: #673ab7;}
  #section3 {color: #fff; background-color: #ff9800;}
  #section41 {color: #fff; background-color: #00bcd4;}
  #section42 {color: #fff; background-color: #009688;}
  */
  @media  screen and (max-width: 810px) {
    #section1, #section2, #section3, #section41, #section42  {
      margin-left: 150px;
    }
  }
  </style>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      div.pac-container {
        z-index: 99999999999 !important;
      } 
     .sdsd1 {
         border: 1px solid blue;
      }
      
    .phys-add {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    
    /* Hide the browser's default radio button */
    .phys-add input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }
    
    /* Create a custom radio button */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
    }
    
    /* On mouse-over, add a grey background color */
    .phys-add:hover input ~ .checkmark {
      background-color: #ccc;
    }
    
    /* When the radio button is checked, add a blue background */
    .phys-add input:checked ~ .checkmark {
      background-color: #2196F3;
    }
    
    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    
    /* Show the indicator (dot/circle) when checked */
    .phys-add input:checked ~ .checkmark:after {
      display: block;
    }
    
    /* Style the indicator (dot/circle) */
    .phys-add .checkmark:after {
     	top: 9px;
    	left: 9px;
    	width: 8px;
    	height: 8px;
    	border-radius: 50%;
    	background: white;
    }
    
ul.nav-pills {
    top: 120px;
    position: fixed;
    width: 100%;
}
    </style>
    <script>
      // This sample uses the Autocomplete widget to help the user select a
      // place, then it retrieves the address components associated with that
      // place, and then it populates the form fields with those details.
      // This sample requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      let placeSearch;
      let autocomplete;
      const componentForm = {
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
        postal_code: "short_name",
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("autocomplete"),
          { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

        for (const component in componentForm) {
          document.getElementById(component).value = "";
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
          const addressType = component.types[0];

          if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>

<?php
    $address1 = Auth::user()->address1;
    $address2 = Auth::user()->address2;
    $city = Auth::user()->city;
    $state = Auth::user()->state;
    $country = Auth::user()->country;
    $zip_code = Auth::user()->zip_code;
?>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <?php if(Auth::user()->user_type == 2): ?>  
    <div class="row">
        <div class="col-md-12">
            <?php if(empty($address1) || empty($address2) || empty($city) || empty($state) || empty($country) || empty($zip_code)): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Alert!</strong> Please update your Warehouse/Shop/Office address (Shipping company will pickup the item from this address ).
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <a href="<?php echo e(url('user/profile')); ?>">
                      <button type="button" style="padding: 3px 10px; background-color: #000; color: white; font-size: 12px; margin: 0px; border: 1px solid #000; float: right; font-weight: 600;">
                        Take Action
                      </button>
                  </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
   <?php endif; ?>
    <div class="row">

            <nav class="col-sm-2" id="myScrollspy">
                <div class="card" id="edit">
      <ul class="nav nav-pills nav-stacked" style="margin-top: 45px;">
        <li class="nav-item" style="width:14%;margin-bottom:6px;"><a class="nav-link " id="section1_ID" href="<?php echo e(url('user/profile#section1')); ?>">Personal Info</a></li>
        <li class="nav-item" style="width:14%;margin-bottom:6px;"><a  class="nav-link" id="section2_ID" href="<?php echo e(url('user/profile#section2')); ?>">Profile Image</a></li>
        <li class="nav-item" style="width:14%;margin-bottom:6px;"><a class="nav-link" id="section3_ID" href="<?php echo e(url('user/profile#section3')); ?>">eKYC Document</a></li>
         <!--li class="nav-item" style="width:14%;margin-bottom:6px;"><a class="nav-link " id="section4_ID" href="<?php echo e(url('user/profile#section4')); ?>">Social Media(Optional)</a></li-->
          <li class="nav-item" style="width:14%;margin-bottom:6px;"><a class="nav-link " id="section4_ID" href="<?php echo e(url('user/profile#section4')); ?>">Bank Account</a></li>
        <li class="nav-item" style="width:14%;margin-bottom:6px;"><a class="nav-link " id="section5_ID" href="<?php echo e(url('user/profile#section5')); ?>">2Factor Security</a></li>
        <li class="nav-item" style="width:13%"><a class="nav-link" id="section6_ID" href="<?php echo e(url('user/profile#section6')); ?>">Delete Account</a></li>

      </ul>
      </div>
    </nav>
    
    <div class="col-sm-10">
      <div id="section1">    
         <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0"><?php echo e(__('Account Setting')); ?></h3>
          </div>
          <div class="card-body">
            <form action="<?php echo e(url('user/account')); ?>" method="post">
            <?php echo csrf_field(); ?>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Full Name')); ?></label>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-6">
                          <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo e($user->first_name); ?>" readonly>
                        </div>      
                        <div class="col-6">
                          <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo e($user->last_name); ?>" readonly>
                        </div>
                    </div>
                  </div>
                </div>  
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Business Name')); ?>(optional)</label>
                  <div class="col-lg-9">
                    <input type="text" name="business_name" class="form-control" placeholder="Your Business Name" value="<?php echo e($user->business_name); ?>">
                    <span class="form-text text-xs"><?php echo e(__('Your business name is the official name of your company. It should be the same as the name on your registration documents.')); ?></span>
                  </div>
                </div>   
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Phone Number')); ?></label>
                  <div class="col-lg-9">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">+</span>
                      </div>
                      <?php $countries = DB::table('countries')->get(); ?>
                      <select class="form-control" name="prefix" style="margin-right: 10px;" readonly>
                          <?php foreach($countries as $country){?>
                          <option value="<?=$country->id?>" <?=($country->iso_code == $user->phone_iso) ? 'selected' :''?>> <?php echo e($country->name); ?> <?php echo e('('); ?><?php echo e('+'); ?><?php echo e($country->calling_code); ?><?php echo e(')'); ?></option>
                          <?php }?>
                      </select>
                      <input pattern=".{10,10}" required title="10 digits" name="phone" type="text" maxlength="13" class="form-control" value="<?php echo e($user->phone); ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" readonly>
                    </div>
                  </div>
                </div>     
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Email Address')); ?></label>
                  <div class="col-lg-9">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                      </div>
                      <input type="email" name="email" class="form-control" placeholder="<?php echo e(__('Email Address')); ?>" value="<?php echo e($user->email); ?>" readonly>
                    </div>
                  </div>
                </div> 
            <?php if($user->user_type == 1): ?>    
              <div class="form-group row">
                  <label class="col-form-label col-lg-3">Address Line 1</label>
                  <div class="col-lg-9">
                    <input type="text" id="street_number" name="address1" class="form-control" placeholder="Address Line 1" value="<?php echo e($user->address1); ?>" <?php if($user->address1): ?> <?php echo e('readonly'); ?> <?php endif; ?> maxlength="55">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Address Line 2</label>
                  <div class="col-lg-9">
                    <input type="text" id="route" name="address2" class="form-control" placeholder="Address Line 2" value="<?php echo e($user->address2); ?>" <?php if($user->address2): ?> <?php echo e('readonly'); ?> <?php endif; ?>   maxlength="55">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">City</label>
                  <div class="col-lg-9">
                    <input type="text" id="locality" name="city" class="form-control" placeholder="City" value="<?php echo e($user->city); ?>" <?php if($user->city): ?> <?php echo e('readonly'); ?> <?php endif; ?> maxlength="55">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">State</label>
                  <div class="col-lg-9">
                    <input type="text" id="administrative_area_level_1" name="state" class="form-control" placeholder="State" value="<?php echo e($user->state); ?>" <?php if($user->state): ?> <?php echo e('readonly'); ?> <?php endif; ?>  maxlength="55">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Country</label>
                  <div class="col-lg-9">
                    <input type="text" id="country" name="country" class="form-control" placeholder="Country" value="<?php echo e($user->country); ?>" <?php if($user->country): ?> <?php echo e('readonly'); ?> <?php endif; ?> maxlength="55">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Zip Code</label>
                  <div class="col-lg-9">
                    <input type="text" id="postal_code" name="zip_code" class="form-control" placeholder="Zip Code" value="<?php echo e($user->zip_code); ?>" <?php if($user->zip_code): ?> <?php echo e('readonly'); ?> <?php endif; ?>  maxlength="8">
                  </div>
                </div>
                <?php endif; ?>
                <?php if($user->user_type == 2): ?>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><b style="color:#5151fa"><?php echo e(__('Your Product Pickup Address')); ?> </b>(i.e Shop or Warehouse or Office)</label>
                  <div class="col-lg-9">
                    <!--<input type="text" name="office_address" class="form-control" placeholder="Search Address" value="<?php echo e($user->office_address); ?>">-->
                    <input type="text" class="form-control" id="autocomplete" onFocus="geolocate()" placeholder="Enter your address">
                  </div>
                </div> 
                
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Address Line 1</label>
                  <div class="col-lg-9">
                    <input type="text" id="street_number" name="address1" class="form-control" placeholder="Address Line 1" value="<?php echo e($user->address1); ?>"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Address Line 2</label>
                  <div class="col-lg-9">
                    <input type="text" id="route" name="address2" class="form-control" placeholder="Address Line 2" value="<?php echo e($user->address2); ?>"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">City</label>
                  <div class="col-lg-9">
                    <input type="text" id="locality" name="city" class="form-control" placeholder="City" value="<?php echo e($user->city); ?>"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">State</label>
                  <div class="col-lg-9">
                    <input type="text" id="administrative_area_level_1" name="state" class="form-control" placeholder="State" value="<?php echo e($user->state); ?>"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Country</label>
                  <div class="col-lg-9">
                    <input type="text" id="country" name="country" class="form-control" placeholder="Country" value="<?php echo e($user->country); ?>"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Zip Code</label>
                  <div class="col-lg-9">
                    <input type="text" id="postal_code" name="zip_code" class="form-control" placeholder="Zip Code" value="<?php echo e($user->zip_code); ?>"  readonly="readonly">
                  </div>
                </div>
                <?php endif; ?>
                 <?php if($user->user_type == 2): ?>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Website')); ?></label>
                  <div class="col-lg-9">
                    <input type="text" name="website_link" class="form-control" placeholder="Your Business Website Link" value="<?php echo e($user->website_link); ?>"  readonly="readonly">
                  </div>
                </div> 
                
                
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Shipping Margin (upto 5%)')); ?></label>
                  <div class="col-lg-9">
                    <input type="number" min="0" max="5" class="form-control" name="shipping_margin" placeholder="Shipping Margin" value="<?php echo e($user->shipping_margin); ?>">
                  </div>
                  <p style="color: #ff9900; font-size: 14px; margin-left: 15px;">Note: Shipping Commission amount will be added in your wallet</p>
                </div>
                <?php endif; ?>
                <!--<div class="form-group row">-->
                <!--  <label class="col-form-label col-lg-3"><?php echo e(__('Employer Identification Number ( EIN )')); ?></label>-->
                <!--  <div class="col-lg-9">-->
                <!--    <input type="text" class="form-control" name="verify_ein" placeholder="Your Employer Identification Number ( EIN )" value="<?php echo e($user->verify_ein); ?>">-->
                <!--  </div>-->
                <!--</div>-->
                 <?php if($user->user_type == 2): ?>
                <div class="form-group row">
                  <label class="col-form-label col-lg-5"><?php echo e(__('Technical skill, are you a developer?')); ?></label>
                  <div class="col-lg-7">
                    <select class="form-control custom-select" name="developer" required>
                      <option value='1' <?php if($user->developer==1): ?> selected <?php endif; ?>><?php echo e(__('Yes')); ?></option>
                      <option value='0' <?php if($user->developer==0): ?> selected <?php endif; ?>><?php echo e(__('No')); ?></option>
                    </select>
                  </div>
                </div>
                <?php endif; ?>
                <div class="form-group row">
                <label class="col-form-label-castro col-lg-3"><?php echo e(__('Password')); ?></label>
                <div class="col-lg-9">
                <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-white btn-sm"><?php echo e(__('Change password')); ?></a>
                </div>
              </div> 
               <?php if($user->user_type == 2): ?>
                <label class="phys-add">Office Address same as Shop Address (Keep same as above)
                  <input type="radio" checked="checked" value="0" name="radio_add" id="phy_add">
                  <span class="checkmark"></span>
                </label>
                
                <label class="phys-add">Add Office Address
                  <input type="radio" name="radio_add" value="1" id="new_add">
                  <span class="checkmark"></span>
                </label>
                <?php endif; ?>
                <div id="add_phy_address">
                    <!--<div class="form-group row">-->
                    <!--  <label class="col-form-label col-lg-3"><?php echo e(__('Physical Address')); ?></label>-->
                    <!--  <div class="col-lg-9">-->
                    <!--    <input type="text" class="form-control" id="autocomplete" onFocus="geolocate()" placeholder="Enter your address">-->
                    <!--  </div>-->
                    <!--</div>-->
                    <div class="form-group row" id="phy_line1">
                      <label class="col-form-label col-lg-3">Address Line 1</label>
                      <div class="col-lg-9">
                        <input type="text" id="street_number" name="phy_line1" class="form-control" placeholder="Address Line 1">
                      </div>
                    </div>
                    <div class="form-group row" id="phy_line2">
                      <label class="col-form-label col-lg-3">Address Line 2</label>
                      <div class="col-lg-9">
                        <input type="text" id="route" name="phy_line2" class="form-control" placeholder="Address Line 2">
                      </div>
                    </div>
                    <div class="form-group row" id="phy_city">
                      <label class="col-form-label col-lg-3">City</label>
                      <div class="col-lg-9">
                        <input type="text" id="locality" name="phy_city" class="form-control" placeholder="City">
                      </div>
                    </div>
                    <div class="form-group row" id="phy_state">
                      <label class="col-form-label col-lg-3">State</label>
                      <div class="col-lg-9">
                        <input type="text" id="administrative_area_level_1" name="phy_state" class="form-control" placeholder="State">
                      </div>
                    </div>
                    <div class="form-group row" id="phy_country">
                      <label class="col-form-label col-lg-3">Country</label>
                      <div class="col-lg-9">
                        <input type="text" id="postal_code" name="phy_country" class="form-control" placeholder="Country">
                      </div>
                    </div>
                    <div class="form-group row" id="phy_zip">
                      <label class="col-form-label col-lg-3">Zip Code</label>
                      <div class="col-lg-9">
                        <input type="text" id="postal_code" name="phy_zip" class="form-control" placeholder="Zip Code">
                      </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('NEXT')); ?></button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <br>
      <br>
      <div id="section2">
           <div class="card">
          <div class="card-body text-center">
            <h3 class="card-title mb-3"><?php echo e(__('Change Profile Image')); ?></h3>
            
            <!--p class="card-text text-sm"><?php echo e(__('Please upload your photo.')); ?></p-->
            <a href="#" class="avatar text-center">
              <img src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($cast); ?>"/>
            </a>
            <form action="<?php echo e(url('user/avatar')); ?>" enctype="multipart/form-data" method="post">
                 <center><div class="image_error_html2" style="color:red"></div></center>
            <?php echo csrf_field(); ?>
                <div class="form-group">
                  <div class="custom-file">
                    <!--input type="file" class="custom-file-input" id="customFileLang" name="image" accept="image/*" required>
                    <label class="custom-file-label" for="customFileLang" style="border: 1px solid blue;"><?php echo e(__('Choose Media')); ?></label-->
                    <div class="text-center"> <center> <label for="files_2" class="btn">Upload Image</label><span id="files_2_2" style="margin-top: 9px;"></span></center></div>
                              <input id="files_2" style="visibility:hidden;" type="file" name="image" onchange="checkFileExtenion2()" required>
                  </div> 
                </div>              
              <div class="text-center">
                <button type="submit" class="btn btn-success btn-sm" id="avatar_submit_btn_id"><?php echo e(__('NEXT')); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
     <div id="section3">
           <div class="card">
          <div class="card-body text-center">
            <h3 class="card-title mb-3"><?php echo e(__('KYC')); ?></h3>
            <!--p class="card-text text-sm" style="    color: #4a4af1;"><?php echo e(__('Please update your US SSN No. company EIN with National ID get full acess of all services.')); ?></p-->
            <center><div class="image_error_html" style="color:red"></div></center>
                <form action="<?php echo e(url('user/standverify')); ?>" enctype="multipart/form-data" method="post">
                <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <div class="custom-file">
                          <!--div class="row">
                           <div class="col-2">
                          <label style="text-align:left">SSN</label></div>
                        <div class="col-10"><input type="text" class="form-control" name="verify_ssn" placeholder="Your SSN Number" value="<?php echo e($user->verify_ssn); ?>"></div>
                        </div-->
                        <!--div class="row">
                           <div class="col-2">
                        <label style="text-align:left">EIN</label></div>
                       <div class="col-10">
                        <input type="text" class="form-control mt-1" name="verify_ein" placeholder="Company EIN Number"  value="<?php echo e($user->verify_ein); ?>">
                        </div>
                        </div-->
                        <br>
                        <div class="row">
                            
                           <div class="col-12">
                       <!--input type="file" class="custom-file-input" id="customFileLang2" name="photo_id" required>
                        <label class="custom-file-label sdsd1" for="customFileLang2" style="top: 0px;"><?php echo e(__('Upload National ID')); ?></label-->
                       <div class="text-center"> <center> <label for="files_1" class="btn">Upload Documents</label><span id="files_1_1" style="margin-top: 9px;"></span></center></div>
                              <input id="files_1" style="visibility:hidden;" type="file" name="photo_id" onchange="checkFileExtenion()">
                        <span style="margin-left:-300px"><b>National ID:</b> Passport, National ID,Driving License, Insurance Card.<br>Format supported: PDF, JPG, JPEG, PNG files,<br> Max Size: 10MB.</span>
                        </div>
                        </div>
                      </div> 
                    </div>              
                  <div class="text-center" style="margin-top: 130px;">
                    <button type="submit" class="btn btn-success btn-sm" ><?php echo e(__('NEXT')); ?></button>
                  </div>
                </form>
          </div>
               <?php if(Auth::user()->user_type == 1): ?>
            <div class="card">
                <div class="card-body text-center">
                    <span class="badge badge-pill badge-primary">
                        <!--a href="<?php echo e(route('user.upgrade')); ?>"><span class="badge badge-pill badge-primary">Upgrade to Business</span></a-->
                         <a href="<?php echo e(route('user.doc-verification')); ?>"><span class="badge badge-pill badge-primary" style="background-color: #1d0d44;color:white">Upgrade to Business</span></a>
                        
                    </span>
                </div>
            </div>
        <?php else: ?>
        
            <!--<div class="card-header">-->
            <!--    <h3 class="card-title"><?php echo e(__('Business Details')); ?></h3>-->
            <!--</div>-->
            <!--<div class="table-responsive">-->
            <!--    <table class="table table-bordered table-striped">-->
            <!--        <tbody> -->
            <!--            <tr>-->
            <!--                <td><?php echo e(__('Company Certificate')); ?></td>-->
            <!--                <td><a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($user->kyc_link); ?>" target="_blank"><?php echo e(__('View')); ?></a></td>           -->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td><?php echo e(__('Address id')); ?></td>-->
            <!--                <td><a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($user->address_id); ?>" target="_blank"><?php echo e(__('View')); ?></a></td>           -->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td><?php echo e(__('National id')); ?></td>-->
            <!--                <td><a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($user->photo_id); ?>" target="_blank"><?php echo e(__('View')); ?></a></td>           -->
            <!--            </tr>-->
            <!--        </tbody>-->
            <!--    </table>-->
            <!--</div>-->
        
        <?php endif; ?>
        </div>
      
    </div> 
      
      <div id="section4" class="onscroll_chnage">         
          <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0"><?php echo e(__('Bank Account')); ?></h3>
          </div>
          <div class="card-body">
                
                <?php if(!empty($bank->id)): ?>
                      <form role="form" action="<?php echo e(url('user/edit_bank')); ?>" method="post">
                          <?php else: ?>
                          <form role="form" action="<?php echo e(url('user/add_bank')); ?>" method="post">
                          <?php endif; ?>
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Bank')); ?></label>
                          <div class="col-lg-10">
                              <?php if(!empty($bank->id)): ?>
                              <input type="hidden" name="id" class="form-control" value="<?php echo e($bank->id); ?>">
                              <?php endif; ?>
                              <input type="hidden" name="added_by" class="form-control" value="profile">
                            <input type="text" name="name" class="form-control" required maxlength="55" <?php if(!empty($bank->name)): ?> value="<?php echo e($bank->name); ?>" <?php endif; ?>>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Account Name')); ?></label>
                          <div class="col-lg-10">
                            <input type="text" name="acct_name" class="form-control" required maxlength="55" <?php if(!empty($bank->acct_name)): ?> value="<?php echo e($bank->acct_name); ?>" <?php endif; ?>>
                          </div>
                        </div>                                                                      
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Account No')); ?></label>
                          <div class="col-lg-10">
                            <input type="text" name="acct_no" class="form-control" required maxlength="55" <?php if(!empty($bank->acct_no)): ?> value="<?php echo e($bank->acct_no); ?>" <?php endif; ?> onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                          </div>
                        </div>                        
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Routing No')); ?></label>
                          <div class="col-lg-10">
                            <input type="text" name="swift" class="form-control" required maxlength="55" <?php if(!empty($bank->swift)): ?> value="<?php echo e($bank->swift); ?>" <?php endif; ?>>
                          </div>
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                        </div>
                      </form>
                    
            <!--form action="<?php echo e(route('user.social')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Facebook')); ?></label>
                <div class="col-lg-8">
                  <input type="url" name="facebook" class="form-control" placeholder="Your Facebook Profile Link" value="<?php echo e($user->facebook); ?>">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Twitter')); ?></label>
                <div class="col-lg-8">
                  <input type="url" name="twitter" class="form-control" placeholder="Your Twitter Profile Link" value="<?php echo e($user->twitter); ?>">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Instagram')); ?></label>
                <div class="col-lg-8">
                  <input type="url" name="instagram" class="form-control" placeholder="Your Instagram Profile Link" value="<?php echo e($user->instagram); ?>">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('LinkedIn')); ?></label>
                <div class="col-lg-8">
                  <input type="url" name="linkedin" class="form-control" placeholder="Your LinkedIn Profile Link" value="<?php echo e($user->linkedin); ?>">    
                </div>
              </div>               
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Youtube')); ?></label>
                <div class="col-lg-8">
                  <input type="url" name="youtube" class="form-control" placeholder="Your Youtube Channel Link" value="<?php echo e($user->youtube); ?>">    
                </div>
              </div>                     
              <div class="text-center">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('NEXT')); ?></button>
              </div>
            </form-->
          </div>
        </div>
      </div>
       
      
     <div id="section5"> 
        <div class="card bg-white" id="2fa">
          <div class="card-body">
            <h3 class="mb-0"><?php echo e(__('Two-Factor Security Option')); ?></h3>
            <div class="align-item-sm-center flex-sm-nowrap text-left">
                <span class="form-text text-sm">
                <?php echo e(__('Two-factor authentication is a method for protection your web account. 
                  When it is activated you need to enter not only your password, but also a special code. 
                  You can receive this code by in mobile app. 
                  Even if third person will find your password, then cant access with that code.')); ?>

                </span>
                <span class="badge badge-pill badge-primary mb-3">
                  <?php if($user->fa_status==0): ?>
                  <?php echo e(__('Disabled')); ?>

                  <?php else: ?>
                  <?php echo e(__('Active')); ?>

                  <?php endif; ?>
                </span>
                <span class="form-text text-sm text-default">
                <?php echo e(__('1. Install an authentication app on your device. Any app that supports the Time-based One-Time Password (TOTP) protocol should work.')); ?>

                </span>
                <span class="form-text text-sm text-default">
                <?php echo e(__('2. Use the authenticator app to scan the barcode below.')); ?>               </span>
                <span class="form-text text-sm text-default">
                <?php echo e(__('3. Enter the code generated by the authenticator app.')); ?> <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en_IN&gl=US" target="_blank">Get it on Playstore</a>
                </span>
                <a data-toggle="modal" data-target="#modal-form2fa" href="" class="btn btn-success btn-sm">
                <?php if($user->fa_status==0): ?>
                  <?php echo e(__('Enable 2fa')); ?>

                <?php elseif($user->fa_status==1): ?>
                  <?php echo e(__('Disable 2fa')); ?>

                <?php endif; ?>
                </a>
                <div class="modal fade" id="modal-form2fa" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card bg-white border-0 mb-0 text-center">
                          <div class="card-body px-lg-5 py-lg-5">
                          <?php if($user->fa_status==0): ?>
                            <img src="<?php echo e($image); ?>" class="mb-3 user-profile">
                          <?php endif; ?>
                            <form action="<?php echo e(route('change.2fa')); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <div class="form-group row">
                                <div class="col-lg-12">
                                  <input type="number" name="code" class="form-control" minlength="6" placeholder="Six digit code" required>
                                    <input type="hidden"  name="vv" value="<?php echo e($secret); ?>">
                                  <?php if($user->fa_status==0): ?>
                                    <input type="hidden"  name="type" value="1">
                                  <?php elseif($user->fa_status==1): ?>
                                    <input type="hidden"  name="type" value="0">
                                  <?php endif; ?>
                                </div>
                              </div>            
                              <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">
                                <?php if($user->fa_status==0): ?>
                                  <?php echo e(__('Enable 2fa')); ?>

                                <?php elseif($user->fa_status==1): ?>
                                  <?php echo e(__('Disable 2fa')); ?>

                                <?php endif; ?>
                                </button>
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
    <div class="section6">
          <?php if($set->kyc): ?>
              <div class="card" id="kyc">
                
                <?php endif; ?>
          
          <div class="card-body text-center">
              <h3 class="card-title mb-3"><?php echo e(__('Delete Account')); ?></h3>
              <p class="card-text text-xs text-dark"><?php echo e(__('Closing this account means you will no longer be able to access this account on')); ?> <?php echo e($set->site_name); ?></p>
              <div class="text-right">
                  <a data-toggle="modal" data-target="#modal-formp" href="" class="btn btn-neutral btn-sm"><i class="fa fa-trash"></i> <?php echo e(__('Delete Account')); ?></a>
                </div>
            </div>
              </div>
            
         
    </div>    
      
    </div>
       <!--END SECTIONS-->    
       
        
      
        
    
        
      </div> 
     <div class="row">
      <div class="col-md-4">
       
       
     
         
        </div>
      </div>
    </div> 
   
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formp" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Are you sure do you want to delete it?')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="<?php echo e(route('delaccount')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <div class="form-group row">
                        <div class="col-lg-12">
                          <textarea type="text" name="reason" class="form-control" rows="5" placeholder="<?php echo e(__('Sorry to see you leave, Please tell us why you are leaving us?')); ?>" required></textarea>
                        </div>
                      </div>             
                      <div class="text-right">
                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Yes delete my account')); ?></button>
                      </div>
                    </form>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Change Password')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="<?php echo e(route('change.password')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <div class="form-group row">
                        <label class="col-form-label col-lg-5"><?php echo e(__('Current Password')); ?></label>
                        <div class="col-lg-7">
                          <input type="password" name="current_password" class="form-control" maxnlength="30" placeholder="Your Current Password" required>
                        </div>
                      </div> 
                      <input type="hidden" name="email" value="getvirtualcard21@gmail.com">
                      <div class="form-group row">
                        <label class="col-form-label col-lg-5"><?php echo e(__('New Password')); ?></label>
                        <div class="col-lg-7">
                          <input type="password" name="new_password" id="inputPassword" onkeyup="passwordStrengthCheck()" class="form-control" maxlength="30" placeholder="Your New Password" required>
                        </div>
                        <div id="passwordAlertDiv" style="display:none;margin-left:195px;">
        				<span id="passwordalertoutput" class="password-strength-status" style="font-size: 12px;"></span>
        				<span class="password-strength-status2"></span>
        				<span class="password-strength-status3"></span>
				      </div>
                      </div> 
                      <div class="form-group row">
                        <label class="col-form-label col-lg-5"><?php echo e(__('Confirm Password')); ?></label>
                        <div class="col-lg-7">
                          <input type="password" name="confirm_password" id="password-confirm" class="form-control" manlength="30" placeholder="Confirm New Password" onkeyup="ConfirmpasswordCheck()" required>
                        </div>
                        <span id="confirm_pwd_error" style="font-size: 12px;margin-left:195px;"></span>
                      </div>             
                      <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm" id="continue_click"><?php echo e(__('Change Password')); ?></button>
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

   <!--div class="modal fade bd-example-modal-sm2" id="bd-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center mt-5 pt-5 pb-4">
      <h3> <i class="fas fa-crown" style="color: #fff704; font-size: 20px;"></i> Are you sure do you want to delete it?</h3>
      <a href="<?php echo e(route('user.upgrade')); ?>"><p>Yes..</p></a>
    </div>
  </div>
</div-->

    <script src="https://www.gstatic.com/firebasejs/3.7.2/firebase.js"></script>
 <?php if($user->user_type == 2): ?>  
<script>
$(document).ready(function(){  
   
            var scroll_pos = 0;
            $(document).scroll(function() { 
                
                scroll_pos = $(this).scrollTop();
                $('#SecondsUntilExpireererer').html(scroll_pos);
                if(scroll_pos > 0 && scroll_pos < 1400) {
                    //$("#section1_ID").addClass("nav-link active");
                    $("#section1_ID").css('background-color', '#1d0d44');
                    $("#section1_ID").css('color', 'white');
                     $("#section1").css('border-color', '#1d0d44');
                     $("#section1").css('border-style', 'solid');
                    //style=":black;: solid;"
                } else {
                    //$("#section1_ID").removeClass("nav-link active");
                    $("#section1_ID").css('background-color', '');
                    $("#section1_ID").css('color', '');
                    $("#section1").css('border-color', '');
                     $("#section1").css('border-style', '');
                }
                if(scroll_pos > 1401 && scroll_pos < 1700) {
                    $("#section2_ID").css('background-color', '#1d0d44');
                    $("#section2_ID").css('color', 'white');
                    $("#section2").css('border-color', '#1d0d44');
                     $("#section2").css('border-style', 'solid');
                } else {
                    $("#section2_ID").css('background-color', '');
                    $("#section2_ID").css('color', '');
                     $("#section2").css('border-color', '');
                     $("#section2").css('border-style', '');
                }
                if(scroll_pos > 1701 && scroll_pos < 2200) {
                    $("#section3_ID").css('background-color', '#1d0d44');
                    $("#section3_ID").css('color', 'white');
                    $("#section3").css('border-color', '#1d0d44');
                     $("#section3").css('border-style', 'solid');
                } else {
                    $("#section3_ID").css('background-color', '');
                    $("#section3_ID").css('color', '');
                    $("#section3").css('border-color', '');
                     $("#section3").css('border-style', '');
                }
                if(scroll_pos > 2200 && scroll_pos < 2600) {
                    $("#section4_ID").css('background-color', '#1d0d44');
                    $("#section4_ID").css('color', 'white');
                    $("#section4").css('border-color', '#1d0d44');
                     $("#section4").css('border-style', 'solid');
                } else {
                    $("#section4_ID").css('background-color', '');
                    $("#section4_ID").css('color', '');
                    $("#section4").css('border-color', '');
                     $("#section4").css('border-style', '');
                }
                if(scroll_pos > 2600 && scroll_pos < 3998) {
                    $("#section5_ID").css('background-color', '#1d0d44');
                    $("#section5_ID").css('color', 'white');
                    $("#section5").css('border-color', '#1d0d44');
                     $("#section5").css('border-style', 'solid');
                } else {
                    $("#section5_ID").css('background-color', '');
                    $("#section5_ID").css('color', '');
                    $("#section5").css('border-color', '');
                     $("#section5").css('border-style', '');
                }
                if(scroll_pos > 3999 && scroll_pos < 4000) {
                    $("#section6_ID").css('background-color', '#1d0d44');
                    $("#section6_ID").css('color', 'white');
                } else {
                    $("#section6_ID").css('background-color', '');
                    $("#section6_ID").css('color', '');
                }
                
            });
        });
        
  </script> 
  <?php else: ?> 
  <script>
$(document).ready(function(){  
   
            var scroll_pos = 0;
            $(document).scroll(function() { 
                
                scroll_pos = $(this).scrollTop();
                $('#SecondsUntilExpireererer').html(scroll_pos);
                if(scroll_pos > 0 && scroll_pos < 700) {
                    //$("#section1_ID").addClass("nav-link active");
                    $("#section1_ID").css('background-color', '#1d0d44');
                    $("#section1_ID").css('color', 'white');
                     $("#section1").css('border-color', '#1d0d44');
                     $("#section1").css('border-style', 'solid');
                    //style=":black;: solid;"
                } else {
                    //$("#section1_ID").removeClass("nav-link active");
                    $("#section1_ID").css('background-color', '');
                    $("#section1_ID").css('color', '');
                    $("#section1").css('border-color', '');
                     $("#section1").css('border-style', '');
                }
                if(scroll_pos > 701 && scroll_pos < 900) {
                    $("#section2_ID").css('background-color', '#1d0d44');
                    $("#section2_ID").css('color', 'white');
                    $("#section2").css('border-color', '#1d0d44');
                     $("#section2").css('border-style', 'solid');
                } else {
                    $("#section2_ID").css('background-color', '');
                    $("#section2_ID").css('color', '');
                     $("#section2").css('border-color', '');
                     $("#section2").css('border-style', '');
                }
                if(scroll_pos > 901 && scroll_pos < 1200) {
                    $("#section3_ID").css('background-color', '#1d0d44');
                    $("#section3_ID").css('color', 'white');
                    $("#section3").css('border-color', '#1d0d44');
                     $("#section3").css('border-style', 'solid');
                } else {
                    $("#section3_ID").css('background-color', '');
                    $("#section3_ID").css('color', '');
                    $("#section3").css('border-color', '');
                     $("#section3").css('border-style', '');
                }
                if(scroll_pos > 1201 && scroll_pos < 1600) {
                    $("#section4_ID").css('background-color', '#1d0d44');
                    $("#section4_ID").css('color', 'white');
                    $("#section4").css('border-color', '#1d0d44');
                     $("#section4").css('border-style', 'solid');
                } else {
                    $("#section4_ID").css('background-color', '');
                    $("#section4_ID").css('color', '');
                    $("#section4").css('border-color', '');
                     $("#section4").css('border-style', '');
                }
                if(scroll_pos > 1601 && scroll_pos < 1900) {
                    $("#section5_ID").css('background-color', '#1d0d44');
                    $("#section5_ID").css('color', 'white');
                    $("#section5").css('border-color', '#1d0d44');
                     $("#section5").css('border-style', 'solid');
                } else {
                    $("#section5_ID").css('background-color', '');
                    $("#section5_ID").css('color', '');
                    $("#section5").css('border-color', '');
                     $("#section5").css('border-style', '');
                }
                if(scroll_pos > 3999 && scroll_pos < 4000) {
                    $("#section6_ID").css('background-color', '#1d0d44');
                    $("#section6_ID").css('color', 'white');
                } else {
                    $("#section6_ID").css('background-color', '');
                    $("#section6_ID").css('color', '');
                }
                
            });
        });
        
  </script> 
  <?php endif; ?>
 <script> 
// Get all sections that have an ID defined
const sections = document.querySelectorAll("section[id]");

// Add an event listener listening for scroll
window.addEventListener("scroll", navHighlighter);

function navHighlighter() {
  
  // Get current scroll position
  let scrollY = window.pageYOffset;
  
  // Now we loop through sections to get height, top and ID values for each
  sections.forEach(current => {
    const sectionHeight = current.offsetHeight;
    const sectionTop = current.offsetTop - 50;
    sectionId = current.getAttribute("id");
    
    /*
    - If our current scroll position enters the space where current section on screen is, add .active class to corresponding navigation link, else remove it
    - To know which link needs an active class, we use sectionId variable we are getting while looping through sections as an selector
    */
    if (
      scrollY > sectionTop &&
      scrollY <= sectionTop + sectionHeight
    ){
      document.querySelector(".navigation a[href*=" + sectionId + "]").classList.add("active");
    } else {
      document.querySelector(".navigation a[href*=" + sectionId + "]").classList.remove("active");
    }
  });
}

// Initialize Firebase
var config = {
    apiKey: "AIzaSyC6Lv7OHLKcpMzOC4Fq0rUyoGcdP6LK7TY",
    //apiKey: "your api key",
     authDomain: "achcuminup.firebaseapp.com",
    //authDomain: "your auth domain",
    databaseURL: "https://achcuminup-default-rtdb.firebaseio.com/",
    //storageBucket: "your storage bucket",
    storageBucket: "achcuminup.appspot.com",
    messagingSenderId: "7924668898"
   // messagingSenderId: "your messaging id"
    
     
 
  //projectId: "achcuminup",
  
  
  //appId: "1:7924668898:web:30a0dbdf03a89d145cc1bb",
  
  };
firebase.initializeApp(config);

const messaging = firebase.messaging();

messaging.requestPermission()
.then(function() {
  console.log('Notification permission granted.');
  return messaging.getToken();
})
.then(function(token) {
  console.log(token); // Display user token
})
.catch(function(err) { // Happen if user deney permission
  console.log('Unable to get permission to notify.', err);
});

messaging.onMessage(function(payload){
	console.log('onMessage',payload);
})

</script> 

    
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7B46osUBu80aqL18GWC3UaSeaq98jrpg&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function () {
        $('#add_phy_address').hide();
        $('input[name="radio_add"]').on('click', function () {
            if($(this).val() == 0)
            {
                $('#add_phy_address').hide();
            }else
            {
                $('#add_phy_address').show();
            }
           
        });
    });
    
    $("#files_1").change(function() {
          filename = this.files[0].name
          //console.log(filename);
          $('#files_1_1').html(filename);
        });
    function checkFileExtenion()
                {
                $('input[type="file"]').change(function () {
                    var ext = this.value.match(/\.(.+)$/)[1];
                    switch (ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'pdf':    
                        case 'png':
                        case 'gif':
                            $('.image_error_html').html('');
                            $('.company_docs_submit_button').attr('disabled', false);
                            break;
                        default:
                           $('.company_docs_submit_button').attr('disabled', true);
                           $('.image_error_html').html('This file format is not allowed!');
                            this.value = '';
                            files_1_1
                            $("#files_1_1").html(null);
                            //$('input[type="file"]').val(' ');
                    }
                });
                
               }   
               
        $("#files_2").change(function() {
          filename = this.files[0].name
          //console.log(filename);
          $('#files_2_2').html(filename);
        });
    function checkFileExtenion2()
                {
                $('input[type="file"]').change(function () {
                   /* var file = this.files[0];
                        var fileType = file["type"];
                        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
                        if ($.inArray(fileType, validImageTypes) < 0) {
                             // invalid file type code goes here.
                             alert('invalid');
                        } else {
                            alert('Valid');
                        }
                        */

                    var ext = this.value.match(/\.(.+)$/)[1];
                    switch (ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                            $('.image_error_html2').html('');
                            $('.company_docs_submit_button').attr('disabled', false);
                            break;
                        default:
                           $('.company_docs_submit_button').attr('disabled', true);
                           $('.image_error_html2').html('This file format is not allowed!');
                            this.value = '';
                           
                            $("#files_2_2").html(null);
                            //$('input[type="file"]').val(' ');
                    }
                    
                });
                
               } 
 
   function passwordStrengthCheck() { 
	$('#passwordAlertDiv').show();
	var number = '[0-9]';
	var alphabets = '[a-zA-Z]';
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if ($('#inputPassword').val().length > 7 && $('#inputPassword').val().match(alphabets) && $('#inputPassword').val().match(number) && $('#inputPassword').val().match(special_characters)) {
		//$('#password-strength-status').removeClass();
		//$('#password-strength-status').addClass('weak-password');
		$('.password-strength-status').css('color','#2d4ec8');
		$('.password-strength-status').html("(Hints- at least 8 characters. Alphanumeric & special character-john123$%&*@)");
		$('#continue_click').prop('disabled', false);
		$('#inputPassword').attr('type','password');
	} else {
		$('.password-strength-status').css('color','red');
		$('.password-strength-status').html("(Hints- at least 8 characters. Alphanumeric & special character-john123$%&*@)");
	     $('#continue_click').prop('disabled', true);
		
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
           
    </script>
    <script type="text/javascript">
$("#files_2").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_2_2').css('color','red');
             $('#files_2_2').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_13_13').css('color','red');
                      $('#files_13_13').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_2_2').css('color','black');
                    $('#files_2_2').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
        
        $("#files_1").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_1_1').css('color','red');
             $('#files_1_1').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_1_1').css('color','red');
                      $('#files_1_1').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_1_1').css('color','black');
                    $('#files_1_1').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
        
        $("#avatar_submit_btn_id").click(function() {
             if(document.getElementById("files_2").files.length == 0)
             {
                 $('#files_2_2').css('color','red');
                 $('#files_2_2').html('Required filed missing!');
                 $('.company_docs_submit_button').attr('disabled', true);
                 //alert('NULL');
             } else {
                 
             }
             
         }); 
         $("#diretor_submit_btn_id").click(function() {
             if(document.getElementById("files_1").files.length == 0)
             {
                 $('#files_1_1').css('color','red');
                 $('#files_1_1').html('Required filed missing!');
                 $('.company_docs_submit_button').attr('disabled', true);
                 //alert('NULL');
             } else {
                 
             }
             
         }); 
</script>
    
    
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/profile/index.blade.php ENDPATH**/ ?>