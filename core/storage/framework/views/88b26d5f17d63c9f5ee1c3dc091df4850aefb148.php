<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php $__env->startSection('content'); ?>

<!-- Page content -->
<style>
    hr{    margin-top: 0.5rem;
    margin-bottom: 0.5rem;}
</style>

<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <!--div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a href="<?php echo e(route('user.add-merchant')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Add website')); ?></a>
              <a href="<?php echo e(route('user.merchant-documentation')); ?>"  class="btn btn-sm btn-success"><?php echo e(__('Documentation')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div-->
    
    <?php if($user->send_for_verification == 1): ?>
    <div class="row">  
      <div class="col-md-12">
                    <div class="accordion" id="accordionExample">
                       
     
                    <h3 class="mb-0" style="padding: 15px;">Enterprise Verification <span class="mb-0" style="float:right;">Account Status <?php if($user->kyc_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                           
                            <?php if($user->kyc_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->kyc_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->kyc_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?></span></h3> 
                    <div class="row border-0" style="background-color:#291261;color:white;margin-left:0px;margin-right:0px;padding:5px 0px 5px 0px">
                        <div class="col-1"></div>
                        <div class="col-4">Document</div>
                         <div class="col-3">Document Status</div>
                          <div class="col-3">Updated On (mm/dd/yyyy)</div>
                    </div>    
                  <div class="card bg-white border-0 mb-0">
                    <div class="card-header" id="headingOne">
                      <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="row">
                        <div class="col-sm-1"><i class="fa fa-info-circle fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-4">
                            <h3 class="mb-0">Basic Information</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mb-0"> 
                            <?php if($user->business_info_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                            <?php if($user->business_info_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->business_info_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->business_info_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?>
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                            
                           <?php if(!empty($user->business_info_updated_at)): ?>  <?php echo e(date("m/d/Y", strtotime($user->business_info_updated_at))); ?> <?php echo e('|'); ?> <?php echo e(date("h:i:A", strtotime($user->business_info_updated_at))); ?> <?php endif; ?>
                            </div> 
                    </div>    
                      </div>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                        <div>    
                       
                           <!--span>Card Details</span-->
                           
                           
                         <div class="form-group row">
                             <table class="table">
                                <!--thead>
                                  <tr>
                                   
                                    <td>Company Legal Name</td>
                                    <td>Company Registration No</td>
                                  </tr>
                                </thead-->
                                <tbody>
                                  <tr>
                                    <th>Company Legal Name</th>
                                    <td><?php echo e($companyDetails->business_name); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Company Registration No</th>
                                    <td><?php echo e($companyDetails->company_registration_no); ?></td>
                                  </tr>
                                   <tr>
                                    <th>Business Type</th>
                                    <td><?php echo e($companyDetails->business_type); ?></td>
                                  </tr>
                                   <tr>
                                    <th>Business Category</th>
                                    <td><?php echo e($companyDetails->business_category); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Website</th>
                                    <td><?php echo e($companyDetails->link_online_registration); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Date of Incorporation</th>
                                    <td><?php echo e($companyDetails->date_incorporation_day); ?><?php echo e('.'); ?><?php echo e($companyDetails->date_incorporation_month); ?><?php echo e('.'); ?><?php echo e($companyDetails->date_incorporation_year); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Tax ID / VAT</th>
                                    <td><?php echo e($companyDetails->tax_id); ?></td>
                                  </tr>
                                  <tr>
                                    <th>Address</th>
                                    <td><?php echo e($companyDetails->building_number); ?> <?php echo e($companyDetails->street); ?> <?php echo e($companyDetails->city); ?> <?php echo e($companyDetails->state); ?> <?php echo e($companyDetails->country); ?> <?php echo e($companyDetails->zip_code); ?></td>
                                  </tr>
                                </tbody>
                            </table>  
                           
                          </div>
                          
                          
                         </div> 
                         
                         <div id="2ndStep" style="display:none"> 
                        <span id="payment_msg" style="color:green"></span>
                        
                                
                        
                              <div id="messages" role="alert" style="display: none;"></div>
                              <br>
                     
                        </div>
                      </div>
                    </div>
                    <!--PAYPAL START-->
                     <hr>
                    <div class="card-header" id="headingFour">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <div class="row">
                        <div class="col-sm-1">
<i class="fa fa-file-text fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-4">
                            <h3 class="mb-0">Business Documentation</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mb-0">
                            <?php if($user->business_docs_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                            <?php if($user->business_docs_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->business_docs_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->business_docs_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?>
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                             <?php if(!empty($user->business_docs_updated_at)): ?> <?php echo e(date("m/d/Y", strtotime($user->business_docs_updated_at))); ?> <?php echo e('|'); ?> <?php echo e(date("h:i:A", strtotime($user->business_docs_updated_at))); ?> <?php endif; ?>
                            </div> 
                    </div>  
                          </div>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body text-center">
                         
                          <table class="table">
                                
                                <tbody>
                                  <tr>
                                    <td>Incorporation</td>
                                    <td><?php echo e($companyDetails->real_Incorporation); ?></td>
                                    <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($companyDetails->Incorporation); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <tr>
                                    <td>Ownership</td>
                                    <td><?php echo e($companyDetails->real_Ownership); ?></td>
                                     <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($companyDetails->Ownership); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <tr>
                                    <td>Bank Account Statement</td>
                                    <td><?php echo e($companyDetails->real_Bank_account_statement); ?></td>
                                     <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($companyDetails->Bank_account_statement); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <tr>
                                      <td>Processing History</td>
                                      <td><?php echo e($companyDetails->real_Processing_history); ?></td>
                                       <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($companyDetails->Processing_history); ?>" target="_blank">View</a></td>
                                    </tr>  
                                </tbody>
                            </table> 
                        </div>
                      </div>
                    <!--END PAYPAL-->
                  
                    <hr>
                    <div class="card-header" id="headingThree">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          
                          <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-file-text-o fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-4">
                            <h3 class="mb-0">Additional documents (optional)</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mb-0"> 
                            <?php if($user->additional_docs_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                            <?php if($user->additional_docs_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->additional_docs_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->additional_docs_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?>
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                           <?php if(!empty($user->additional_docs_updated_at)): ?>  <?php echo e(date("m/d/Y", strtotime($user->additional_docs_updated_at))); ?> <?php echo e('|'); ?> <?php echo e(date("h:i:A", strtotime($user->additional_docs_updated_at))); ?> <?php endif; ?>
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                           <table class="table">
                                
                                <tbody>
                                    <?php $__currentLoopData = $additionalDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <tr>
                                    <td><?php echo e($details->doc_type); ?></td>
                                    <td><?php echo e($details->file_real_name); ?></td>
                                    <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->doc_name); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                      </div>
                    </div>
                    <hr>
                       <div class="card-header" id="headingFive">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          
                          <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-4">
                            <h3 class="mb-0">Representative / Director</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mb-0"> 
                            <?php if($user->representative_director_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                            <?php if($user->representative_director_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->representative_director_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->representative_director_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?>
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                            <?php if(!empty($user->representative_director_updated_at)): ?>  <?php echo e(date("m/d/Y", strtotime($user->representative_director_updated_at))); ?> <?php echo e('|'); ?> <?php echo e(date("h:i:A", strtotime($user->representative_director_updated_at))); ?> <?php endif; ?>
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                     
                     
                                <?php $__currentLoopData = $representativeDirectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <?php if($k < 10): ?>
                             <div class="card-body">    
                               <center><h3>Representative / Director <?php echo e(++$k); ?></h3></center>
                                <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Citizenship</td>
                                    <td><?php echo e($details->country); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal First Name</td>
                                    <td><?php echo e($details->first_name); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal Last Name</td>
                                    <td><?php echo e($details->last_name); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Dote of Birth</td>
                                    <td><?php echo e($details->dob_day); ?><?php echo e('.'); ?><?php echo e($details->dob_month); ?><?php echo e('.'); ?><?php echo e($details->dob_year); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Designation</td>
                                    <td><?php echo e($details->occupation); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Address</td>
                                    <td><?php echo e($details->building_number); ?> <?php echo e($details->street); ?> <?php echo e($companyDetails->city); ?> <?php echo e($companyDetails->state); ?> <?php echo e($details->country); ?> <?php echo e($details->zip_code); ?></td>
                                  </tr>
                                  <?php if(!empty($details->passport_doc)): ?>
                                  <tr>
                                    <td><?php echo e($details->doc_type); ?></td>  
                                    <td><?php echo e($details->real_passport_doc); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->passport_doc); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                   <?php if(!empty($details->identity_card)): ?>
                                  <tr>
                                      <td><?php echo e(__('Identity Card')); ?></td>  
                                    <td><?php echo e($details->real_identity_card); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->identity_card); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->driving_licence)): ?>
                                  <tr>
                                      <td><?php echo e(__('Driving Licence')); ?></td> 
                                    <td><?php echo e($details->real_driving_licence); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->driving_licence); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->residence_permit)): ?>
                                  <tr>
                                       <td><?php echo e(__('Residence Permit')); ?></td> 
                                    <td><?php echo e($details->real_residence_permit); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->residence_permit); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->address_proof)): ?>
                                  <tr>
                                       <td><?php echo e(__('Address Proof')); ?></td> 
                                    <td><?php echo e($details->real_address_proof); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->address_proof); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  </tbody>
                            </table> 
                          
                            </div>
                            <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                    </div>
                     <hr>
                       <div class="card-header" id="headingSix">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          
                          <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-users fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-4">
                            <h3 class="mb-0">Shareholder</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mb-0"> 
                            <?php if($user->share_holder_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                            <?php if($user->share_holder_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->share_holder_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->share_holder_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?>
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                             <?php if(!empty($user->share_holder_updated_at)): ?> <?php echo e(date("m/d/Y", strtotime($user->share_holder_updated_at))); ?> <?php echo e('|'); ?> <?php echo e(date("h:i:A", strtotime($user->share_holder_updated_at))); ?> <?php endif; ?>
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                     
                     
                                <?php $__currentLoopData = $shareHolders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <?php if($k < 10): ?>
                             <div class="card-body">    
                               <center><h3>Shareholder <?php echo e(++$k); ?></h3></center>
                                <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Citizenship</td>
                                    <td><?php echo e($details->country); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal First Name</td>
                                    <td><?php echo e($details->first_name); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal Last Name</td>
                                    <td><?php echo e($details->last_name); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Dote of Birth</td>
                                    <td><?php echo e($details->dob_day); ?><?php echo e('.'); ?><?php echo e($details->dob_month); ?><?php echo e('.'); ?><?php echo e($details->dob_year); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Occupation</td>
                                    <td><?php echo e($details->occupation); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Address</td>
                                    <td><?php echo e($details->building_number); ?> <?php echo e($details->street); ?> <?php echo e($companyDetails->city); ?> <?php echo e($companyDetails->state); ?> <?php echo e($details->country); ?> <?php echo e($details->zip_code); ?></td>
                                  </tr>
                                  <?php if(!empty($details->passport_doc)): ?>
                                  <tr>
                                     <td><?php echo e($details->doc_type); ?></td> 
                                    <td><?php echo e($details->real_passport_doc); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->passport_doc); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                   <?php if(!empty($details->identity_card)): ?>
                                  <tr>
                                      <td><?php echo e(__('Identity Card')); ?></td>
                                    <td><?php echo e($details->real_identity_card); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->identity_card); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->driving_licence)): ?>
                                  <tr>
                                      <td><?php echo e(__('Driving Licence')); ?></td>
                                    <td><?php echo e($details->real_driving_licence); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->driving_licence); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->residence_permit)): ?>
                                  <tr>
                                      <td><?php echo e(__('Residence Permit')); ?></td>
                                    <td><?php echo e($details->real_residence_permit); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->residence_permit); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->address_proof)): ?>
                                  <tr>
                                      <td><?php echo e(__('Address Proof')); ?></td>
                                    <td><?php echo e($details->real_address_proof); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->address_proof); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  </tbody>
                            </table> 
                          
                            </div>
                            <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                    </div>
                     <hr>
                       <div class="card-header" id="heading7">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                          
                          <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-4">
                            <h3 class="mb-0">Beneficiary</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mb-0"> 
                            <?php if($user->beneficiary_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                            <?php if($user->beneficiary_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->beneficiary_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->beneficiary_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?>
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                            <?php if(!empty($user->beneficiary_updated_at)): ?> <?php echo e(date("m/d/Y", strtotime($user->beneficiary_updated_at))); ?> <?php echo e('|'); ?> <?php echo e(date("h:i:A", strtotime($user->beneficiary_updated_at))); ?> <?php endif; ?>
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample">
                     
                     
                                <?php $__currentLoopData = $beneficiary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <?php if($k < 10): ?>
                             <div class="card-body">    
                               <center><h3>Beneficiary <?php echo e(++$k); ?></h3></center>
                                <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Citizenship</td>
                                    <td><?php echo e($details->country); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal First Name</td>
                                    <td><?php echo e($details->first_name); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal Last Name</td>
                                    <td><?php echo e($details->last_name); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Dote of Birth</td>
                                    <td><?php echo e($details->dob_day); ?><?php echo e('.'); ?><?php echo e($details->dob_month); ?><?php echo e('.'); ?><?php echo e($details->dob_year); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Occupation</td>
                                    <td><?php echo e($details->occupation); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Address</td>
                                    <td><?php echo e($details->building_number); ?> <?php echo e($details->street); ?> <?php echo e($companyDetails->city); ?> <?php echo e($companyDetails->state); ?> <?php echo e($details->country); ?> <?php echo e($details->zip_code); ?></td>
                                  </tr>
                                  <?php if(!empty($details->passport_doc)): ?>
                                  <tr>
                                      <td><?php echo e(isset($details->doc_type)); ?></td>
                                    <td><?php echo e($details->real_passport_doc); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->passport_doc); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                   <?php if(!empty($details->identity_card)): ?>
                                  <tr>
                                      <td><?php echo e(__('Identity Card')); ?></td>
                                    <td><?php echo e($details->real_identity_card); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->identity_card); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->driving_licence)): ?>
                                  <tr>
                                      <td><?php echo e(__('Driving Licence')); ?></td>
                                    <td><?php echo e($details->real_driving_licence); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->driving_licence); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->residence_permit)): ?>
                                  <tr>
                                      <td><?php echo e(__('Residence Permit')); ?></td>
                                    <td><?php echo e($details->real_residence_permit); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->residence_permit); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php if(!empty($details->address_proof)): ?>
                                  <tr>
                                      <td><?php echo e(__('Address Proof')); ?></td>
                                    <td><?php echo e($details->real_address_proof); ?> </td>  
                                   <td><a href="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->address_proof); ?>" target="_blank">View</a></td>
                                  </tr>
                                  <?php endif; ?>
                                  </tbody>
                            </table> 
                          
                            </div>
                            <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                    </div>
                        <hr>
                       <div class="card-header" id="heading8">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                          
                          <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-globe fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-4">
                            <h3 class="mb-0">Project (Website) Information</h3>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mb-0"> 
                            <?php if($user->project_status == 1): ?><span class="badge badge-pill badge-success">Verified</span><?php endif; ?>
                            <?php if($user->project_status == 0): ?><span class="badge badge-pill badge-warning">Not Verified</span><?php endif; ?>
                            <?php if($user->project_status == 2): ?><span class="badge badge-pill badge-danger">Rejected</span><?php endif; ?>
                            <?php if($user->project_status == 4): ?><span class="badge badge-pill badge-warning">Pending</span><?php endif; ?>
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                           <?php if(!empty($user->project_updated_at)): ?> <?php echo e(date("m/d/Y", strtotime($user->project_updated_at))); ?> <?php echo e('|'); ?> <?php echo e(date("h:i:A", strtotime($user->project_updated_at))); ?> <?php endif; ?>
                            </div> 
                         
                    </div>
                        </div>
                    </div>
                    <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordionExample">
                     
                     
                                <?php $__currentLoopData = $project_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <?php if($k < 10): ?>
                             <div class="card-body">    
                               <center><h3>Project(Website) <?php echo e(++$k); ?></h3></center>
                                <table class="table">
                                <tbody>
                                   <?php if(!empty($details->image)): ?>
                                  <tr>
                                    <td><?php echo e(__('Logo')); ?></td>
                                    <td><img src="<?php echo e(url('asset/profile')); ?>/<?php echo e($details->image); ?>" onerror="this.onerror=null;this.src='<?php echo e(url('asset/profile')); ?>/person.jpg';" width="50"></td>
                                  </tr>
                                  <?php endif; ?>
                                   <tr>
                                    <td>Project Key</td>
                                    <td><?php echo e($details->merchant_key); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Project Name</td>
                                    <td><?php echo e($details->name); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Site URL</td>
                                    <td><?php echo e($details->site_url); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Description</td>
                                    <td><?php echo e($details->description); ?></td>
                                  </tr>
                                  
                                  
                                  <tr>
                                    <td>Revenue Minimum Transaction Amount</td>
                                    <td><?php echo e($currency->symbol.$details->revenue_min_trx_amt); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Revenue Avrage Transaction Amount</td>
                                    <td><?php echo e($currency->symbol.$details->revenue_avg_trx_amt); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Revenue Maximun Transaction Amount</td>
                                    <td><?php echo e($currency->symbol.$details->revenue_max_trx_amt); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Revenue Exp monthly Volume</td>
                                    <td><?php echo e($currency->symbol.$details->revenue_exp_monthly_vol); ?></td>
                                  </tr>
                                  </tbody>
                            </table> 
                          
                            </div>
                            <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                    </div>
                  </div>
                </div>
      </div>
      </div>
      <?php endif; ?>
       <?php if($user->send_for_verification == 0): ?>
      <div class="row" style="">
          <div class="col-md-4">
              
            <div class="card">
                <style>
                li {
                    
                    color:#000;
                }
                a.active{
                        color: #ffc10d;
                    }
                 a.active .red{
                        color: red;
                    }    
                a.disabled {
                  pointer-events: none;
                  cursor: default;
                }
                .click_tab {
                    padding: 20px;
                }
                .red {
                    color: red;
                }
                li.active {
                    color: #ffc10d;
                }
                </style>
               <div class="card-header header-elements-inline">
                   
            <h2 class="mb-0"><?php echo e(__('Enterprise Information')); ?></h2>
          </div>
          <span class="testing active"></span>
               <ul class="nav nav-tabs tabs-left sideways">
            <?php if(!empty(Session::get('tab_active'))): ?><li  onclick="clickFunction()" class="click_tab <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Business_verification'): ?><?php echo e('active'); ?> style="text-decoration:underline;" <?php endif; ?> <?php else: ?> <?php echo e('active'); ?> <?php endif; ?>"><a data-toggle="tab" href="#home-v" style="color:black;" <?php if($user->company_registration_no != "NULL"): ?> class="disabled" <?php endif; ?> >Company Information</a></li><?php else: ?> <li class="click_tab active" id="active_tab_1">Business Information</li><?php endif; ?>
            <?php if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Company_docs'): ?><li  onclick="clickFunction()" class="click_tab <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Company_docs'): ?><?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" data-toggle="tab" href="#profile-v">Company Documents</li> <?php else: ?> <li class="click_tab" onclick="ComplateStepErrorFunction()" style="cursor:pointer" id="active_tab_1"> Company Documents</li> <?php endif; ?>
            <?php if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Additional_docs'): ?> <li  onclick="clickFunction()" class="click_tab <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Additional_docs'): ?><?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" data-toggle="tab" href="#messages-v">Additional Documents(Optional)</li> <?php else: ?> <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_2">Additional Documents(Optional)</li>  <?php endif; ?>
            <?php if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Representative_director'): ?> <li  onclick="clickFunction()" class="click_tab <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Representative_director'): ?><?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" data-toggle="tab" href="#settings-v">Representative/Director</li> <?php else: ?> <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_3">Representative/Director</li>  <?php endif; ?>
            <?php if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Share_holder'): ?><li  onclick="clickFunction()" class="click_tab <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Share_holder'): ?><?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" data-toggle="tab" href="#shareholder-v">Shareholders</li> <?php else: ?> <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_4"> Shareholders</li>  <?php endif; ?>
             <?php if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Beneficiary'): ?> <li onclick="clickFunction()" class="click_tab <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Beneficiary'): ?><?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" data-toggle="tab" href="#beneficiary-v">Beneficiary</li> <?php else: ?> <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_5"> Beneficiary</li>  <?php endif; ?>
             <h3 class="mb-0" style="margin-left:20px;">Project(Website) Profile</h3>
              <?php if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Beneficiary'): ?> <li data-toggle="tab" onclick="clickFunction()" class="click_tab <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Project_info'): ?><?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" data-toggle="tab" href="#project-v">Project Information</li> <?php else: ?> <li class="click_tab" style="cursor:pointer" onclick="ComplateStepErrorFunction()"> Project Information</li>  <?php endif; ?>
          </ul>
             <script>
             function ComplateStepErrorFunction()
                {
                     //alert();
                     $('li.active').addClass('red');
                    $('li.active').removeClass('active');
                   // $('#shubhan').addClass('red');
                  //element.classList.add("my-class");

                    //$('ul nav-tabs tabs-left sideways').addClass('red');
                    //$(this).addClass('active');
                   
                }
  
            function clickFunction()
                { 
                    $('li a.active').removeClass('active');
                    $(this).addClass('active');
                    //$(this).toggleClass('active');
                }; 
               /* $(document).ready(function()
                    {
                        $('.click_tab').click(function()
                        {     
                            $('#nav ul li.active').removeClass('active');
                            alert();
                            //$("ul.li.active").not(this).removeClass('active');
                            //$(this).toggleClass("active");
                        });
                    });*/
             </script>
              <a href="<?php echo e(url('user/open-ticket')); ?>" style="margin-left:21px;"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
 Need help?</a>
          </div>
        </div>
        <div class="col-md-8 card" >
             <div class="tab-content">
            <div class="tab-pane <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Business_verification'): ?> <?php echo e('active'); ?> <?php endif; ?> <?php else: ?> <?php echo e('active'); ?> <?php endif; ?>" id="home-v">
                <!--1st START-->
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Enterprise Verification')); ?></h3>
                  </div>
                  <form action="<?php echo e(url('user/business_profile')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="<?php echo e($country->iso_code); ?>" <?=($country->iso_code =='US') ? 'selected' : ''?>><?php echo e($country->name); ?></option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Company legal name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="business_name" class="form-control" value="<?php echo e(old('business_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('business_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('business_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Company registration number<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="company_registration_no" class="form-control"  value="<?php echo e(old('company_registration_no')); ?>" required>
                            </div>
                            <?php if($errors->has('company_registration_no')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('company_registration_no')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">How would you classify your business?<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            </br>
                            <br>
                            <div class="input-group">
                              <!--input type="text" name="link_online_registration" class="form-control" value="<?php echo e(old('link_online_registration')); ?>" -->
                              <div class="radio">
                              <label style="color:black;"><input type="radio" name="business_type" checked value="Business">&nbsp;&nbsp;Business</span></label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="radio">
                              <label style="color:black;"><input type="radio" name="business_type" value="Government">&nbsp;&nbsp;Government</label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="radio">
                              <label style="color:black;"><input type="radio" name="business_type" value="Non-profit">&nbsp;&nbsp;Non-profit </label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="radio">
                              <label style="color:black;"><input type="radio" name="business_type" value="Publicly Traded">&nbsp;&nbsp;Publicly Traded</label>
                            </div>
                            </div>
                             <?php if($errors->has('business_type')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('business_type')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">How would you categorize your business?<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <!--input type="text" name="link_online_registration" class="form-control" value="<?php echo e(old('link_online_registration')); ?>" -->
                              <select name="business_category" required class="form-control" id="industry-717c46dc-3275-4157-a4e0-735ec420ec73___form-2" required="" class="hs-input invalid error is-placeholder" name="industry" data-reactid=".hbspt-forms-0.1:$3.$industry.0">
                                     <option value="" disabled="" selected="" data-reactid=".hbspt-forms-0.1:$3.$industry.0.0">Please Select Industry*</option>
                                    <option>Gifts & Flowers</option>
                                   
                                    <option>Home & Garden</option>
                                    <option>Health & personal care</option>
                                    <option>Computer Accessories & Services</option>
                                    <option>Financial Services & Products</option>
                                    <option>Vehicle Sales</option>
                                    <option>Education</option>
                                    <option>Electronic & Communication</option>
                                    <option>Sports & Outdoor</option>
                                    <option value="Accelerator" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Accelerator">Accelerator</option><option value="Accountancy / Business Finance" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Accountancy / Business Finance">Accountancy / Business finance</option><option value="Acquirer" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Acquirer">Acquirer</option><option value="Agritech" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Agritech">Agritech</option><option value="Banking" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Banking">Banking</option><option value="Charitable giving" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Charitable giving">Charitable giving</option><option value="Consulting" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Consulting">Consulting</option><option value="Credit scoring" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Credit scoring">Credit scoring</option><option value="Cryptocurrency" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Cryptocurrency">Cryptocurrency</option><option value="Ecommerce / Retail" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Ecommerce / Retail">Ecommerce / Retail</option><option value="Education" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Education">Education</option><option value="Forex" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Forex">Forex</option><option value="Fraud Detection / KYC" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Fraud Detection / KYC">Fraud detection / KYC</option><option value="Government" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Government">Government</option><option value="iGaming" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$iGaming">iGaming</option><option value="Infrastructure as a service" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Infrastructure as a service">Infrastructure as a service</option><option value="Insights / Data" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Insights / Data">Insights / Data</option><option value="Insurance" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Insurance">Insurance</option><option value="Legal" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Legal">Legal</option><option value="Lending" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Lending">Lending</option><option value="Marketplace" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Marketplace">Marketplace</option><option value="Media / Association" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Media / Association">Media / Association</option><option value="Money Transfer" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Money Transfer">Remittance</option><option value="Payment Service Provider" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Payment Service Provider">Payment service provider</option><option value="PFMs (Personal Finance)" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$PFMs (Personal Finance)">PFMs (Personal Finance)</option><option value="Platform partner" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Platform partner">Platform partner</option><option value="Rental / Property" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Rental / Property">Rental / Property</option><option value="Rewards / Cashback" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Rewards / Cashback">Rewards / Cashback</option><option value="Security" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Security">Security</option><option value="Subscription management" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Subscription management">Subscription management</option><option value="Telecom" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Telecom">Telecom</option><option value="Trading" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Trading">Trading</option><option value="Travel" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Travel">Travel</option><option value="Utilities" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Utilities">Utilities</option><option value="Venture capital" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Venture capital">Venture capital</option><option value="Wealth / Investment" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Wealth / Investment">Wealth / Investment</option><option value="Other" data-reactid=".hbspt-forms-0.1:$3.$industry.0.1:$Other">Other</option></select>
                            
                            </div>
                             <?php if($errors->has('link_online_registration')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('link_online_registration')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">What is your business website?</span>
                            <div class="input-group">
                              <input type="url" name="link_online_registration" class="form-control" value="<?php echo e(old('link_online_registration')); ?>" >
                            </div>
                             <?php if($errors->has('link_online_registration')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('link_online_registration')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                       
                              <span style="font-size:14px;color:#000;">Date of incorporation<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input autocomplete='off' class='form-control card-cvc daysinputvalue' name="date_incorporation_day" placeholder='DD' type='text' minlength="1" maxlength="2" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    <span class="days_error_msg" style="color:red"></span>
                                    <?php if($errors->has('date_incorporation_day')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('date_incorporation_day')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <select class="form-control" name="date_incorporation_month"  required>
                                         <option name="" value="" style="display:none;">Select Month</option>
                                          <option name="January" value="Jan">January</option>
                                          <option name="February" value="Feb">February</option>
                                          <option name="March" value="Mar">March</option>
                                          <option name="April" value="Apr">April</option>
                                        	<option name="May" value="May">May</option>
                                          <option name="June" value="Jun">June</option>
                                          <option name="July" value="Jul">July</option>
                                          <option name="August" value="Aug">August</option>
                                        	<option name="September" value="Sep">September</option>
                                          <option name="October" value="Oct">October</option>
                                          <option name="November" value="Nov">November</option>
                                          <option name="December" value="Dec">December</option>
        </select>
                                        </select>
                                        <?php if($errors->has('date_incorporation_day')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('date_incorporation_day')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year corp_year_cls' name="date_incorporation_year" value="<?php echo e(old('date_incorporation_year')); ?>" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    
                                     <span class="corp_error_msg" style="color:red"></span>
                                    <?php if($errors->has('date_incorporation_year')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('date_incorporation_year')); ?></span>
                          <?php endif; ?>
                                    </div>
                                  </div>
                          
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Tax ID/ VAT<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="tax_id" class="form-control" placeholder="" value="<?php echo e(old('tax_id')); ?>" required>
                            </div>
                            <?php if($errors->has('tax_id')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('tax_id')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                       <hr>
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Business Address')); ?></h3>
                  </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                <input type="text" name="building_number" class="form-control"  placeholder="" value="<?php echo e(old('building_number')); ?>" required>
                             <?php if($errors->has('building_number')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('building_number')); ?></span>
                          <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control"  placeholder="" value="<?php echo e(old('street')); ?>">
                               <?php if($errors->has('street')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('street')); ?></span>
                          <?php endif; ?>
                            </div>
                           
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" value="<?php echo e(old('city')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                              <?php if($errors->has('city')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('city')); ?></span>
                          <?php endif; ?>
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="state" class="form-control"  placeholder="" value="<?php echo e(old('state')); ?>" required onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');">
                              <?php if($errors->has('state')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('state')); ?></span>
                          <?php endif; ?>
                            </div>
                            
                            
                            
                            
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="number" name="zip_code" class="form-control"  placeholder="" required>
                            <?php if($errors->has('zip_code')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('zip_code')); ?></span>
                          <?php endif; ?>
                            </div>
                          </div> 
          
                             <div class="custom-control custom-control-alternative custom-checkbox">
                          <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                          <label class="custom-control-label" for=" customCheckLogin">
                            <span class="text-muted">Agree to <a href="<?php echo e(route('terms')); ?>">Terms & Conditions</a></span>
                          </label>
                        </div>
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm" type="submit"><?php echo e(__('Next')); ?>  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                <!--1st END-->
            </div>
            <div class="tab-pane <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Company_docs'): ?> <?php echo e('active'); ?><?php endif; ?> <?php endif; ?>" id="profile-v">
               <!--2nd START-->
                               
                   
                      <div class="card-header header-elements-inline">
                        <h3 class="mb-0"><?php echo e(__('Company Documents')); ?></h3>
                      </div>
                      <div class="card-body">
                        <form method="post" action="<?php echo e(url('user/business_docs')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        
                             <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3"><?php echo e(__('Incorporation')); ?><span style="color:red"><?php echo e(__('*')); ?></span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang1" name="Incorporation"  onchange="checkFileExtenion()" required-->
                                        <!--label class="custom-file-label sdsd" for="customFileLang1"><?php echo e(__('Upload')); ?></label-->
                                         <div class="row"><label for="files_2" class="btn">Upload</label><span id="files_2_2" style="margin-top: 9px;"></span></div>
                                         <input id="files_2" style="visibility:hidden;" type="file" name="Incorporation" onchange="checkFileExtenion()" required>
                                         
                                    </div> 
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3"><?php echo e(__('Ownership')); ?><span style="color:red"><?php echo e(__('*')); ?></span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang2" name="Ownership" onchange="checkFileExtenion()" required-->
                                        <!--label class="custom-file-label sdsd4" for="customFileLang2"><?php echo e(__('Upload')); ?></label-->
                                         <div class="row"><label for="files_1" class="btn">Upload</label><span id="files_1_1" style="margin-top: 9px;"></span></div>
                                         <input id="files_1" style="visibility:hidden;" type="file" name="Ownership" onchange="checkFileExtenion()" required>
                                         
                                    </div> 
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3"><?php echo e(__('Bank account statement')); ?><span style="color:red"><?php echo e(__('*')); ?></span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang" name="Bank_account_statement" onchange="checkFileExtenion()" required-->
                                        <div class="row"><label for="files_3" class="btn">Upload</label><span id="files_3_3" style="margin-top: 9px;"></span></div>
                                         <input id="files_3" style="visibility:hidden;" type="file" name="Bank_account_statement" onchange="checkFileExtenion()" required>
                                        <!--label class="custom-file-label sdsd3" for="customFileLang"><?php echo e(__('Upload')); ?></label-->
                                    </div> 
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3"><?php echo e(__('Processing history')); ?><span style="color:red"><?php echo e(__('*')); ?></span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang3" name="Processing_history" onchange="checkFileExtenion()" required-->
                                        <div class="row"><label for="files_4" class="btn">Upload</label><span id="files_4_4" style="margin-top: 9px;"></span></div>
                                         <input id="files_4" style="visibility:hidden;" type="file" name="Processing_history" onchange="checkFileExtenion()" required>
                                        <!--label class="custom-file-label sdsd2" for="customFileLang3"><?php echo e(__('Upload')); ?></label-->
                                    </div> 
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <small>(Document format supported PDF, JPG, JPEG, PNG files,<br> Max Size: 10MB each document,<br>Latest bank statement or utility bill (within 90 days)</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit"  style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="busi_doc_submit_btn_id"><?php echo e(__('Next')); ?></button>
                            </div>
                        </form>
                      </div>
                    
  
                 <!--2nd END-->
                </div>
            <div class="tab-pane <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Additional_docs'): ?> <?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" id="messages-v">
                <!--3rd Start-->
                  
                               
                   
                      <div class="card-header header-elements-inline">
                        <h3 class="mb-0"><?php echo e(__('Additional documents (optional)')); ?></h3>
                        <span style="color:#ffc10d;font-size;12px">You can submit up to 20 Additional document.</span>
                      </div>
                      <div class="card-body">
                        <form method="post" action="<?php echo e(url('user/additional_business_docs')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3"><?php echo e(__('Additional docs')); ?></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="form-control" id="fileinut" name="additionalDocs[]" onchange="checkFileExtenion()" required-->
                                        <div class="row"><label for="files_5" class="btn">Upload</label><span id="files_5_5" style="margin-top: 9px;"></span></div>
                                         <input id="files_5" style="visibility:hidden;" type="file" name="additionalDocs[]" onchange="checkFileExtenion()">
                                        <!--label class="custom-file-label sdsd" for="customFileLang"><?php echo e(__('Upload')); ?></label-->
                                         <span id="new_chq"></span>
                                          <input type="hidden" value="1" id="total_chq">
                                    </div> 
                                </div>
                              </div>

                       
                            </div>
                                                        <span style="float:right"> 
                               <i class="fa fa-plus" aria-hidden="true" onclick="addFunction()" style="cursor:pointer"></i>&nbsp;&nbsp;
                                <i class="fa fa-trash" aria-hidden="true" onclick="removeFunction()" style="cursor:pointer"></i>
                            </span>
                            
                            <div class="form-group row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <small>Document format supported PDF, JPG, JPEG, PNG files,<br> Max Size: 10MB each document,<br>latest bank statement or utlity bill (within 90 days)</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit"  style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button"><?php echo e(__('Next')); ?></button>
                            </div>
                        </form>
                       
                      </div>
                    
              

 

                <!--3rd END-->
            </div>
            <div class="tab-pane <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Representative_director'): ?> <?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" id="settings-v">
                <!--4 START-->
                <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Representative_director'): ?>
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Representative/Director Information')); ?></h3>
                    <span style="color:#ffc10d;font-size;12px">You can submit up to 10 Representative / Director.</span>
                  </div>
                  <form action="<?php echo e(url('user/business_representative_director')); ?>" method="POST" enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>
                     
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="<?php echo e($country->iso_code); ?>" <?=($country->iso_code =='US') ? 'selected' : ''?>><?php echo e($country->name); ?></option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal First name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="first_name" class="form-control" value="<?php echo e(old('first_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('first_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('first_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal Last name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="last_name" class="form-control" value="<?php echo e(old('last_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('last_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('last_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        
                       
                              <span style="font-size:14px;color:#000;">Date of Birth<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input autocomplete='off' class='form-control card-cvc daysinputvalue' value="<?php echo e(old('dob_day')); ?>"  name="dob_day" placeholder='DD' type='text' format minlength="1" maxlength="2" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                  <center> <span class="days_error_msg" style="color:red"></span></center>
                                    <?php if($errors->has('dob_day')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_day')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <select class="form-control" name="dob_month"  required>
                                         <option name="" value="" style="display:none;">Select Month</option>
                                          <option name="January" value="Jan">January</option>
                                          <option name="February" value="Feb">February</option>
                                          <option name="March" value="Mar">March</option>
                                          <option name="April" value="Apr">April</option>
                                        	<option name="May" value="May">May</option>
                                          <option name="June" value="Jun">June</option>
                                          <option name="July" value="Jul">July</option>
                                          <option name="August" value="Aug">August</option>
                                        	<option name="September" value="Sep">September</option>
                                          <option name="October" value="Oct">October</option>
                                          <option name="November" value="Nov">November</option>
                                          <option name="December" value="Dec">December</option>
        </select>
                                        </select>
                                        <?php if($errors->has('dob_month')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_month')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year  dob_year_cls'  name="dob_year" value="<?php echo e(old('dob_year')); ?>" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    <center> <span class="year_error_msg" style="color:red"></span></center>
                                    <?php if($errors->has('dob_year')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_year')); ?></span>
                          <?php endif; ?>
                                    </div>
                                  </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Designation(Director/CEO/CFO/President - Owner)<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="occupation" class="form-control" maxlength="100" value="<?php echo e(old('occupation')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('occupation')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('occupation')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div> 
                        
                       <hr>
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Address')); ?></h3>
                  </div>
                  <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                <input type="text" name="building_number" class="form-control"  placeholder="" maxlength="150" value="<?php echo e(old('building_number')); ?>" required>
                             <?php if($errors->has('building_number')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('building_number')); ?></span>
                          <?php endif; ?>
                            </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control"  placeholder="" maxlength="150" value="<?php echo e(old('street')); ?>" >
                               <?php if($errors->has('street')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('street')); ?></span>
                          <?php endif; ?>
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" maxlength="50" value="<?php echo e(old('city')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                            
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="state" class="form-control"  placeholder="" maxlength="50" value="<?php echo e(old('state')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                              <?php if($errors->has('state')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('state')); ?></span>
                          <?php endif; ?>
                            </div>
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="zip_code" class="form-control" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" required>
                            <?php if($errors->has('zip_code')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('zip_code')); ?></span>
                          <?php endif; ?>
                            </div>
                          </div> 
                            <hr>
                            <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Upload Identification Documents')); ?></h3>
                            
                            <br>
                           <span style="color:#ffc10d;font-size;12px">You can upload one document of your choice: passport/ID Card/Driving Licence/Residence Permit</span>
                             <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                          </div>
                          
                          <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Identity<span style="color:red"><?php echo e(__('*')); ?></span></span>
                             <select class="form-control" name="doc_type" required>
                                 <option value="">Select Document Type</option>
                                 <option value="Passport">Passport</option>
                                 <option value="Identity Card">Identity Card</option>
                                 <option value="Driving Licence">Driving Licence</option>
                                 <option value="Residence Permit">Residence Permit</option>
                             </select>
                            <?php if($errors->has('identity_card')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('identity_card')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                          <div class="col-lg-12">
                                 <!--span style="font-size:14px;color:#000;">Passport</span-->
                              <!--input type="file" name="passport_doc" class="form-control"  onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_7" class="btn">Upload</label><span id="files_7_7" style="margin-top: 9px;"></span></div>
                              <input id="files_7" style="visibility:hidden;" type="file" name="passport_doc" onchange="checkFileExtenion()" required>
                            <?php if($errors->has('zip_code')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('zip_code')); ?></span>
                          <?php endif; ?>
                          
                            </div>
                          
                            <!--br>
                             <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Identity Card</span>
                              <input type="file" name="identity_card" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('identity_card')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('identity_card')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                             <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Driving Licence</span>
                              <input type="file" name="driving_licence" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('driving_licence')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('driving_licence')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                             <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Residence Permit</span>
                              <input type="file" name="residence_permit" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('residence_permit')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('residence_permit')); ?></span>
                          <?php endif; ?>
                            </div-->
                            
                             <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Upload Proof of Address')); ?></h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload <b>utility bill Bank Statement or other government issued documents not older than 3 months</b></span>
                          </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Address<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <!--input type="file" name="address_proof" class="form-control"  placeholder="" onchange="checkFileExtenion()" required-->
                              
                              <div class="row"><label for="files_6" class="btn">Upload</label><span id="files_6_6" style="margin-top: 9px;"></span></div>
                              <input id="files_6" style="visibility:hidden;" type="file" name="address_proof" onchange="checkFileExtenion()" required>
                              
                              <!--div class="row"><label for="files_6" class="btn">Upload</label><span id="files_6_6" style="margin-top: 9px;" ></span></div>
                              <input id="files_6" style="visibility:hidden;"  type="file" name="address_proof" onchange="checkFileExtenion()"  requried-->
                                         
                            <?php if($errors->has('address_proof')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('address_proof')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="diretor_submit_btn_id" type="submit"><?php echo e(__('Next')); ?>  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                <!--4 END-->
                <?php endif; ?>
                    <?php endif; ?>
                    
                
            </div>
            <div class="tab-pane <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Share_holder'): ?> <?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" id="shareholder-v">
                <!--5 START-->
               
               <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Share_holder'): ?>
                
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Shareholder')); ?> <?php if(count($representativeDirectors) < 11 ): ?>
     <a class="btn" href="<?php echo e(url('user/add_another/Representative_director')); ?>" style="float:right;background-color: #1d0d44;color:white">Add Another Director</a> <?php endif; ?></h3>
                    <span style="color:#ffc10d;font-size;12px">You can submit up to 10 Shareholders.</span>
                  </div>
                  <form action="<?php echo e(url('user/business_representative_shareholder')); ?>" method="POST" enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="<?php echo e($country->iso_code); ?>" <?=($country->iso_code =='US') ? 'selected' : ''?>><?php echo e($country->name); ?></option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal First name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="first_name" maxlength="50" class="form-control" value="<?php echo e(old('first_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('first_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('first_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal Last name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="last_name" maxlength="50" class="form-control" value="<?php echo e(old('last_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('last_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('last_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        
                       
                              <span style="font-size:14px;color:#000;">Date of Birth<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input autocomplete='off' class='form-control card-cvc daysinputvalue' value="<?php echo e(old('dob_day')); ?>"  name="dob_day" placeholder='DD' type='text' minlength="1" maxlength="2" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    <center> <span class="days_error_msg" style="color:red"></span></center>
                                    <?php if($errors->has('dob_day')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_day')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <select class="form-control" name="dob_month"  required>
                                         <option name="" value="" style="display:none;">Select Month</option>
                                          <option name="January" value="Jan">January</option>
                                          <option name="February" value="Feb">February</option>
                                          <option name="March" value="Mar">March</option>
                                          <option name="April" value="Apr">April</option>
                                        	<option name="May" value="May">May</option>
                                          <option name="June" value="Jun">June</option>
                                          <option name="July" value="Jul">July</option>
                                          <option name="August" value="Aug">August</option>
                                        	<option name="September" value="Sep">September</option>
                                          <option name="October" value="Oct">October</option>
                                          <option name="November" value="Nov">November</option>
                                          <option name="December" value="Dec">December</option>
        </select>
                                        </select>
                                        <?php if($errors->has('dob_month')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_month')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year dob_year_cls' name="dob_year" value="<?php echo e(old('dob_year')); ?>" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    <center> <span class="year_error_msg" style="color:red"></span></center>

                                    <?php if($errors->has('dob_year')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_year')); ?></span>
                          <?php endif; ?>
                                    </div>
                                  </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Designation(Director/CEO/CFO/President - Owner)<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="occupation" class="form-control" value="<?php echo e(old('occupation')); ?>" required>
                            </div>
                             <?php if($errors->has('occupation')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('occupation')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div> 
                        
                       <hr>
                       <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Percentages(%) of Shares<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="number" maxlength="3" max="100" name="share_percentage" class="form-control" value="<?php echo e(old('share_percentage')); ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                            </div>
                             <?php if($errors->has('share_percentage')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('share_percentage')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div> 
                        <hr>
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Address')); ?></h3>
                  </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                <input type="text" name="building_number" class="form-control"  placeholder="" maxlength="150" value="<?php echo e(old('building_number')); ?>" required>
                             <?php if($errors->has('building_number')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('building_number')); ?></span>
                          <?php endif; ?>
                            </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control" maxlength="150" placeholder="" value="<?php echo e(old('street')); ?>" >
                               <?php if($errors->has('street')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('street')); ?></span>
                          <?php endif; ?>
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" maxlength="50" value="<?php echo e(old('city')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="state" class="form-control"  maxlength="50" placeholder="" value="<?php echo e(old('state')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                              <?php if($errors->has('state')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('state')); ?></span>
                          <?php endif; ?>
                            </div>
                            
                            
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="zip_code" class="form-control" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" required>
                            <?php if($errors->has('zip_code')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('zip_code')); ?></span>
                          <?php endif; ?>
                            </div>
                          </div> 
                            <hr>
                            <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Upload Identification Documents')); ?></h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload one document of your choice: passport/ID Card/Driving Licence/Residence Permit</span>
                            <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                          </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Identity<span style="color:red"><?php echo e(__('*')); ?></span></span>
                             <select class="form-control" name="doc_type" required>
                                 <option value="">Select Document Type</option>
                                 <option value="Passport">Passport</option>
                                 <option value="Identity Card">Identity Card</option>
                                 <option value="Driving Licence">Driving Licence</option>
                                 <option value="Residence Permit">Residence Permit</option>
                             </select>
                            <?php if($errors->has('identity_card')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('identity_card')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                          <div class="col-lg-12">
                                 <!--span style="font-size:14px;color:#000;">Passport</span-->
                              <!--input type="file" name="passport_doc" class="form-control"  placeholder="" onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_8" class="btn">Upload</label><span id="files_8_8" style="margin-top: 9px;"></span></div>
                              <input id="files_8" style="visibility:hidden;" type="file" name="passport_doc" onchange="checkFileExtenion()" required>
                            <?php if($errors->has('zip_code')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('zip_code')); ?></span>
                          <?php endif; ?>
                            </div>
                            <!--br>
                            <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Identity Card</span>
                              <input type="file" name="identity_card" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('identity_card')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('identity_card')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                            <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Driving Licence</span>
                              <input type="file" name="driving_licence" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('driving_licence')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('driving_licence')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                            <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Residence Permit</span>
                              <input type="file" name="residence_permit" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('residence_permit')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('residence_permit')); ?></span>
                          <?php endif; ?>
                            </div-->
                             <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Upload Proof of Address')); ?></h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload <b>utility bill Bank Statement or other government issued documents not older than 3 months</b></span>
                          </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Address<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <!--input type="file" name="address_proof" class="form-control"  placeholder="" onchange="checkFileExtenion()" required-->
                              <div class="row"><label for="files_9" class="btn">Upload</label><span id="files_9_9" style="margin-top: 9px;"></span></div>
                              <input id="files_9" style="visibility:hidden;" type="file" name="address_proof" onchange="checkFileExtenion()" required>
                            <?php if($errors->has('address_proof')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('address_proof')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="shareholder_submit_btn_id" type="submit"><?php echo e(__('Next')); ?>  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    
                     <!--5 END-->
            </div>
            <div class="tab-pane <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Beneficiary'): ?> <?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" id="beneficiary-v">
                <!--6 START-->
                <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Beneficiary'): ?>
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Beneficiary')); ?> <?php if(count($shareHolders) < 11 ): ?><a class="btn" href="<?php echo e(url('user/add_another/Share_holder')); ?>" style="float:right;background-color: #1d0d44;color:white">Add Another Shareholder</a> <?php endif; ?> </h3>
                  </div>
                  <form action="<?php echo e(url('user/business_representative_beneficiary')); ?>" method="POST" enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="<?php echo e($country->iso_code); ?>" <?=($country->iso_code =='US') ? 'selected' : ''?>><?php echo e($country->name); ?></option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal First name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="first_name" class="form-control" maxlength="50" value="<?php echo e(old('first_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('first_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('first_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal Last name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="last_name" maxlength="50" class="form-control" value="<?php echo e(old('last_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('last_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('last_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        
                       
                              <span style="font-size:14px;color:#000;">Date of Birth<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input  class='form-control card-cvc daysinputvalue' value="<?php echo e(old('dob_day')); ?>"  name="dob_day" placeholder='DD' type='text' minlength="1" maxlength="3" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    <center> <span class="days_error_msg" style="color:red"></span></center>

                                    <?php if($errors->has('dob_day')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_day')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <select class="form-control" name="dob_month"  required>
                                         <option name="" value="" style="display:none;">Select Month</option>
                                          <option name="January" value="Jan">January</option>
                                          <option name="February" value="Feb">February</option>
                                          <option name="March" value="Mar">March</option>
                                          <option name="April" value="Apr">April</option>
                                        	<option name="May" value="May">May</option>
                                          <option name="June" value="Jun">June</option>
                                          <option name="July" value="Jul">July</option>
                                          <option name="August" value="Aug">August</option>
                                        	<option name="September" value="Sep">September</option>
                                          <option name="October" value="Oct">October</option>
                                          <option name="November" value="Nov">November</option>
                                          <option name="December" value="Dec">December</option>
        </select>
                                        </select>
                                        <?php if($errors->has('dob_month')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_month')); ?></span>
                          <?php endif; ?>
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year dob_year_cls' name="dob_year" value="<?php echo e(old('dob_year')); ?>" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    <center> <span class="year_error_msg" style="color:red"></span></center>
                                    <?php if($errors->has('dob_year')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('dob_year')); ?></span>
                          <?php endif; ?>
                                    </div>
                                  </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Designation(Director/CEO/CFO/President - Owner)<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="occupation" class="form-control" maxlength="100" value="<?php echo e(old('occupation')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('occupation')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('occupation')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div> 
                        
                       <hr>
                      
                       
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Address')); ?></h3>
                  </div>
                           
                           
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                <input type="text" name="building_number" class="form-control"  maxlength="100" value="<?php echo e(old('building_number')); ?>" required>
                             <?php if($errors->has('building_number')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('building_number')); ?></span>
                          <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control"  placeholder="" maxlength="100" value="<?php echo e(old('street')); ?>" >
                               <?php if($errors->has('street')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('street')); ?></span>
                          <?php endif; ?>
                            </div>
                          
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" maxlength="50" value="<?php echo e(old('city')); ?>" required>
                               <?php if($errors->has('city')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('city')); ?></span>
                          <?php endif; ?>
                            </div>
                             <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="text" name="state" class="form-control"  placeholder="" maxlength="50" value="<?php echo e(old('state')); ?>" required>
                              <?php if($errors->has('state')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('state')); ?></span>
                          <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <input type="number" name="zip_code" class="form-control"  placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                            <?php if($errors->has('zip_code')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('zip_code')); ?></span>
                          <?php endif; ?>
                            </div>
                          </div> 
                            <hr>
                            <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Upload Identification Documents')); ?></h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload one document of your choice: passport/ID Card/Driving Licence/Residence Permit</span>
                            <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                          </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Identity<span style="color:red"><?php echo e(__('*')); ?></span></span>
                             <select class="form-control" name="doc_type" required>
                                 <option value="">Select Document Type</option>
                                 <option value="Passport">Passport</option>
                                 <option value="Identity Card">Identity Card</option>
                                 <option value="Driving Licence">Driving Licence</option>
                                 <option value="Residence Permit">Residence Permit</option>
                             </select>
                            <?php if($errors->has('identity_card')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('identity_card')); ?></span>
                          <?php endif; ?>
                            </div>
                          <br>
                          <div class="col-lg-12">
                                 <!--span style="font-size:14px;color:#000;">Passport</span-->
                              <!--input type="file" name="passport_doc" class="form-control"  placeholder="" onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_11" class="btn">Upload</label><span id="files_11_11" style="margin-top: 9px;"></span></div>
                              <input id="files_11" style="visibility:hidden;" type="file" name="passport_doc" onchange="checkFileExtenion()" required>
                            <?php if($errors->has('zip_code')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('zip_code')); ?></span>
                          <?php endif; ?>
                            </div>
                            
                            
                            
                             <!--center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Identity Card</span>
                              <input type="file" name="identity_card" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('identity_card')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('identity_card')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                             <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Driving Licence</span>
                              <input type="file" name="driving_licence" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('driving_licence')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('driving_licence')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                             <center> <?php echo e(__('OR')); ?></center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Residence Permit</span>
                              <input type="file" name="residence_permit" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            <?php if($errors->has('residence_permit')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('residence_permit')); ?></span>
                          <?php endif; ?>
                            </div-->
                             <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Upload Proof of Address')); ?></h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload <b>utility bill Bank Statement or other government issued documents not older than 3 months</b></span>
                          </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Address<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <!--input type="file" name="address_proof" class="form-control"  placeholder="" required onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_12" class="btn">Upload</label><span id="files_12_12" style="margin-top: 9px;"></span></div>
                              <input id="files_12" style="visibility:hidden;" type="file" name="address_proof" onchange="checkFileExtenion()" required>
                            <?php if($errors->has('address_proof')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('address_proof')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="beneficiary_submit_btn_id" type="submit"><?php echo e(__('Next')); ?>  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                       <?php endif; ?>
                    <?php endif; ?>
                    
                <!--6 END-->
            </div>
             <div class="tab-pane <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Project_info'): ?> <?php echo e('active'); ?> <?php endif; ?> <?php endif; ?>" id="project-v">
                 <!--7 START-->
               <?php if(!empty(Session::get('tab_active'))): ?> <?php if(Session::get('tab_active') == 'Project_info' && empty(Session::get('FINAL_STATUS'))): ?> 
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Project Information')); ?> <?php if(count($shareHolders) < 11 ): ?> <a class="btn" href="<?php echo e(url('user/add_another/Beneficiary')); ?>" style="float:right;background-color: #1d0d44;color:white">Add Another Share Beneficiary</a> <?php endif; ?> </h3>
                    <span>You can submit up to 6 Projects.</span>                
                    </div>
                  <form action="<?php echo e(url('user/business_project_info')); ?>" method="POST" enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>
                         <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Logo<span style="color:red"><?php echo e(__('*')); ?></span></span>
                              <!--input type="file" name="image" class="form-control"  placeholder="" onchange="checkFileExtenion()" required-->
                              <div class="row"><label for="files_13" class="btn">Upload</label><span id="files_13_13" style="margin-top: 9px;"></span></div>
                              <input id="files_13" style="visibility:hidden;" type="file" name="image" onchange="checkFileExtenion()" required>
                            <?php if($errors->has('image')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('image')); ?></span>
                          <?php endif; ?>
                            </div>
                            <br>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Project Name<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="text" name="merchant_name" class="form-control" maxlength="80" value="<?php echo e(old('merchant_name')); ?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             <?php if($errors->has('merchant_name')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('merchant_name')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Site URL<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="url" name="site_link" class="form-control" value="<?php echo e(old('site_link')); ?>" required>
                            </div>
                             <?php if($errors->has('site_link')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('site_link')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Description<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                    <textarea type="text" class="form-control" rows="4" placeholder="Project description or extra instructions"  name="merchant_description" required></textarea>
                            </div>
                             <?php if($errors->has('merchant_description')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('merchant_description')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Send Notifications To<span style="color:red"><?php echo e(__('*')); ?></span></span>
                            <div class="input-group">
                              <input type="email" name="email" class="form-control" placeholder="If provided, this email address will get transaction notices" required>
                            </div>
                             <?php if($errors->has('email')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('email')); ?></span>
                          <?php endif; ?>
                          </div>
                        </div>
                       
                        
                       <hr>
                      
                       
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0"><?php echo e(__('Revenue Information')); ?></h3>
                  </div>
                           
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">Minimum Transaction Amount(<?php echo e($currency->symbol); ?>)<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                <select class="form-control" name="revenue_min_trx_amt" required>
                                    <option><?php echo e(__('1000-5000')); ?></option>
                                    <option><?php echo e(__('5000-10,000')); ?></option>
                                    <option><?php echo e(__('25,000-50,000')); ?></option>
                                    <option><?php echo e(__('100,000-200,000')); ?></option>
                                    <option><?php echo e(__('200,000-300,000')); ?></option>
                                    <option><?php echo e(__('300,000-500,000')); ?></option>
                                    <option><?php echo e(__('1 Million Above')); ?></option>
                                </select>    
                              <!--input type="text" name="revenue_min_trx_amt" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" value="<?php echo e(old('city')); ?>" required-->
                            </div>
                            <div class="col-lg-12">
                               
                                 <span style="font-size:14px;color:#000;">Average Transaction Amount(<?php echo e($currency->symbol); ?>)<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                 <select class="form-control" name="revenue_avg_trx_amt" required>
                                    <option><?php echo e(__('1000-5000')); ?></option>
                                    <option><?php echo e(__('5000-10,000')); ?></option>
                                    <option><?php echo e(__('25,000-50,000')); ?></option>
                                    <option><?php echo e(__('100,000-200,000')); ?></option>
                                    <option><?php echo e(__('200,000-300,000')); ?></option>
                                    <option><?php echo e(__('300,000-500,000')); ?></option>
                                     <option><?php echo e(__('1 Million Above')); ?></option>
                                </select>
                               <!--input type="text" name="revenue_avg_trx_amt" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" value="<?php echo e(old('revenue_avg_trx_amt')); ?>" required-->
                               <?php if($errors->has('revenue_avg_trx_amt')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('revenue_avg_trx_amt')); ?></span>
                          <?php endif; ?>
                          
                            </div>
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Maximum Transaction Amount(<?php echo e($currency->symbol); ?>)<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                 <select class="form-control" name="revenue_max_trx_amt" required>
                                    <option><?php echo e(__('1000-5000')); ?></option>
                                    <option><?php echo e(__('5000-10,000')); ?></option>
                                    <option><?php echo e(__('25,000-50,000')); ?></option>
                                    <option><?php echo e(__('100,000-200,000')); ?></option>
                                    <option><?php echo e(__('200,000-300,000')); ?></option>
                                    <option><?php echo e(__('300,000-500,000')); ?></option>
                                     <option><?php echo e(__('1 Million Above')); ?></option>
                                </select>
                                <!--input type="text" name="revenue_max_trx_amt" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php echo e(old('revenue_max_trx_amt')); ?>" required-->
                             <?php if($errors->has('revenue_max_trx_amt')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('revenue_max_trx_amt')); ?></span>
                          <?php endif; ?>
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Expected Monthly Volume(<?php echo e($currency->symbol); ?>)<span style="color:red"><?php echo e(__('*')); ?></span></span>
                                 <select class="form-control" name="revenue_exp_monthly_vol" required>
                                    <option><?php echo e(__('1000-5000')); ?></option>
                                    <option><?php echo e(__('5000-10,000')); ?></option>
                                    <option><?php echo e(__('25,000-50,000')); ?></option>
                                    <option><?php echo e(__('100,000-200,000')); ?></option>
                                    <option><?php echo e(__('200,000-300,000')); ?></option>
                                    <option><?php echo e(__('300,000-500,000')); ?></option>
                                     <option><?php echo e(__('1 Million Above')); ?></option>
                                </select>
                              <!--input type="number" name="revenue_exp_monthly_vol" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" required-->
                            <?php if($errors->has('revenue_exp_monthly_vol')): ?>
                            <span class="error form-error-msg " style="color:red"><?php echo e($errors->first('revenue_exp_monthly_vol')); ?></span>
                          <?php endif; ?>
                            </div>
                          </div> 
                            <hr>
                            
                            
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="project_submit_btn_id" type="submit"><?php echo e(__('Next')); ?>  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                    <?php endif; ?>
                    <?php endif; ?>
                     <?php if(!empty(Session::get('FINAL_STATUS'))): ?> <?php if(Session::get('FINAL_STATUS') == 'FINAL_TAB'): ?>
                     <br>
                     <br>
                     <br>
                     <br>
                      <div class="card-header header-elements-inline">
                   <?php if(count($project_info) < 7): ?> <center><h3 class="mb-0"> <a class="btn" href="<?php echo e(url('user/add_another/Project_info')); ?>" style="background-color: #1d0d44;color:white">Add Another Project</a> </h3></center><?php endif; ?>
                  </div>
                  <br>
                  <br>
                  <center><i class="fa fa-check-circle fa-4x" style="color:green;" aria-hidden="true"></i><br><br>
                  <span style="color:green;">Details saved successfully</span></center><br><br>
                      <!--div class="card-body">
                           <table class="table">
                                <thead>
                                  <tr>
                                   
                                    <td>Lastname</td>
                                    <td>Email</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                   
                                    <td>Doe</td>
                                    <td>john@example.com</td>
                                  </tr>
                                  <tr>
                                   
                                    <td>Moe</td>
                                    <td>mary@example.com</td>
                                  </tr>
                                  <tr>
                                    
                                    <td>Dooley</td>
                                    <td>july@example.com</td>
                                  </tr>
                                </tbody>
                            </table>
                           
                            <center><button  onclick="addAunother('Reinfo_added')">Add Another</button></center-->
                            <center><a href="<?php echo e(url('user/send_for_verification')); ?>"  class="btn btn-success"><?php echo e(__('Submit for Verification')); ?></a></center>
                      </div>
                      <?php endif; ?>
                      <?php endif; ?>
                      
                <!--7 END-->
             </div>     
            
          </div>
           <?php endif; ?>
             
              

      </div>
      </div>
<style>
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}
.tabs-left {
  border-right: 1px solid #ddd;
}
.tabs-right {
  border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
}
.tabs-right>li {
  margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
  border-bottom: 1px solid #ddd;
  border-left-color: transparent;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
}
.tabs-right>li>a {
  border-radius: 0 4px 4px 0;
  margin-right: 0;
}
</style>
      
   <script>
   
               $(document).ready(function() {
                    //alert('sfsdfds');
                    $('#fileinut').change('on',function(){
                        var value = $('#fileinut').val();
                         var arr = ['jpg','jpeg','pdf','png'];
                         var filename = value.split('.').pop();
                        // alert(filename);
                         
                    });
                }); 
               /* function checkFileExtenion()
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
                            $('input[type="file"]').val('');
                    }
                });
                
               } */
              
               $('.daysinputvalue').on('change',function(){
                    if($('.daysinputvalue').val() < 32 )
                    {
                        $('.days_error_msg').html('');
                       //alert($('.daysinputvalue').val());
                    } else {
                        $('.daysinputvalue').val('');
                        $('.days_error_msg').html('Invalid input!');
                    }
               });
               
               $('.dob_year_cls').on('change',function(){
                   
                 var currentDate = new Date();
                  var age = 18;
                  var userYear= parseInt($('.dob_year_cls').val())+parseInt(age);
                  
                  var currentYear = currentDate.getFullYear();
                  if(userYear < currentYear)
                  {
                      $('.year_error_msg').html(' ');
                  }else
                  {
                      $('.year_error_msg').html('Invalid year!');
                      $('.dob_year_cls').val('');
                      
                  }
                 
               });
               
               $('.corp_year_cls').on('change',function(){
                   
                 var currentDate = new Date();
                  //var age = -1;
                  var userYear= parseInt($('.corp_year_cls').val());
                  
                  var currentYear = currentDate.getFullYear();
                  if(userYear <= currentYear)
                  {
                      $('.year_error_msg').html(' ');
                  }else
                  {
                      $('.corp_error_msg').html('Invalid year!');
                      $('.corp_year_cls').val('');
                      
                  }
                 
               });
               
            </script>    
    <script>
 
function addFunction() { 
  var new_chq_no = parseInt($('#total_chq').val()) + 1;
 
  //<input type="file" class="custom-file-input" id="customFileLang" name="Incorporation">
                                       // <label class="custom-file-label sdsd" for="customFileLang"><?php echo e(__('Upload')); ?></label>
  //var new_input = "<input type='file' id='new_" + new_chq_no + "'>";
  
  //
  var new_input = "<div class='row'><label onclick='UploadFileNameAppend(this.id)' id='files_m" +new_chq_no + "' for='m_files_m" +new_chq_no + "' class='btn'>Upload</label><span id='text_m_files_m" +new_chq_no + "' style='margin-top: 9px;'></span></div><input  id='m_files_m"+new_chq_no + "' style='visibility:hidden;' type='file' name='additionalDocs[]' onclick='checkFileExtenion()' onchange='checkFileExtenion_1(this.id)'  required>";
  //var new_input = "<input type='file' class='form-control' id='new_" + new_chq_no + "' name='additionalDocs[]'>";

  $('#new_chq').append(new_input);
  
  $('#total_chq').val(new_chq_no);
  
  
}

function UploadFileNameAppend(value)
{
    //alert(value);
    //
    
}

function checkFileExtenion_1(value2)
{ 
 
  var fullPath = document.getElementById(value2).value;
      /*var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
   var filename = fullPath.substring(startIndex);
        filename = filename.substring(1);
        $('#text_'+value2).html(filename);
        */
        filename = document.getElementById(value2).files[0].name
     // alert(document.getElementById(value2).files[0].size);
          if(document.getElementById(value2).files[0].size > 10485760)
          {
             $('#text_'+value2).css('color','red');
             $('#text_'+value2).html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($('#'+value2).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#text_'+value2).css('color','red');
                      $('#text_'+value2).html($('#'+value2).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#text_'+value2).css('color','black');
                    $('#text_'+value2).html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }  
}

function removeFunction() {
  var last_chq_no = $('#total_chq').val();

  if (last_chq_no > 1) {
    $('#files_m'+last_chq_no).remove();
    $('#total_chq').val(last_chq_no - 1);
  }
}

    
    function ShowHideDivFunction(value)
    {
        alert(value);
    }
    
   /*  $(function() {
                $('input[type="file"]').change(function() {
                var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     //alert($(this).val().split('.').pop().toLowerCase());
                      $('.image_error_html').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                       this.value = '';
                       $('input[type="file"]').val(' ');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('.image_error_html').html('');
                    $('.company_docs_submit_button').attr('disabled', false);
                }
                })
                })
                */
    $("#files_1").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_1_1').css('color','red');
             $('#files_1_1').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
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
    $("#files_2").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_2_2').css('color','red');
             $('#files_2_2').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_2_2').css('color','red');
                      $('#files_2_2').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_2_2').css('color','black');
                    $('#files_2_2').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }    
        });
    $("#files_3").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_3_3').css('color','red');
             $('#files_3_3').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_3_3').css('color','red');
                      $('#files_3_3').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_3_3').css('color','black');
                    $('#files_3_3').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }    
        });
        $("#files_4").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_4_4').css('color','red');
             $('#files_4_4').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_4_4').css('color','red');
                      $('#files_4_4').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_4_4').css('color','black');
                    $('#files_4_4').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }    
        });
        
        $("#files_5").change(function() {
         filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_5_5').css('color','red');
             $('#files_5_5').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_5_5').css('color','red');
                      $('#files_5_5').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_5_5').css('color','black');
                    $('#files_5_5').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }    
        });
        $("#files_6").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_6_6').css('color','red');
             $('#files_6_6').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_6_6').css('color','red');
                      $('#files_6_6').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_6_6').css('color','black');
                    $('#files_6_6').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }    
        });
       
         $("#shareholder_submit_btn_id").click(function() {
             if(document.getElementById("files_9").files.length == 0)
             {
                 $('#files_9_9').css('color','red');
                 $('#files_9_9').html('Required filed missing!');
                 $('.company_docs_submit_button').attr('disabled', true);
                 //alert('NULL');
             } else {
                 //$('#files_6_6').css('color','red');
                 //$('#files_6_6').html(' ');
                 //alert('NOT NULL');
             }
             
         }); 
         $("#beneficiary_submit_btn_id").click(function() {
             if(document.getElementById("files_12").files.length == 0)
             {
                 $('#files_12_12').css('color','red');
                 $('#files_12_12').html('Required filed missing!');
                 $('.company_docs_submit_button').attr('disabled', true);
                 //alert('NULL');
             } else {
                 //$('#files_6_6').css('color','red');
                 //$('#files_6_6').html(' ');
                 //alert('NOT NULL');
             }
             
         }); 
         $("#project_submit_btn_id").click(function() {
             if(document.getElementById("files_13").files.length == 0)
             {
                 $('#files_13_13').css('color','red');
                 $('#files_13_13').html('Required filed missing!');
                 $('.company_docs_submit_button').attr('disabled', true);
                 //alert('NULL');
             } else {
                 //$('#files_6_6').css('color','red');
                 //$('#files_6_6').html(' ');
                 //alert('NOT NULL');
             }
             
         }); 
        $("#files_7").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_7_7').css('color','red');
             $('#files_7_7').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_7_7').css('color','red');
                      $('#files_7_7').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_7_7').css('color','black');
                    $('#files_7_7').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }   
        });
        $("#files_8").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_8_8').css('color','red');
             $('#files_8_8').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_8_8').css('color','red');
                      $('#files_8_8').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_8_8').css('color','black');
                    $('#files_8_8').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }   
        });
        $("#files_9").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_9_9').css('color','red');
             $('#files_9_9').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_9_9').css('color','red');
                      $('#files_9_9').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_9_9').css('color','black');
                    $('#files_9_9').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
        $("#files_10").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_10_10').css('color','red');
             $('#files_10_10').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_10_10').css('color','red');
                      $('#files_10_10').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_10_10').css('color','black');
                    $('#files_10_10').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
        $("#files_11").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_11_11').css('color','red');
             $('#files_11_11').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_11_11').css('color','red');
                      $('#files_11_11').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_11_11').css('color','black');
                    $('#files_11_11').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
        $("#files_12").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_12_12').css('color','red');
             $('#files_12_12').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_12_12').css('color','red');
                      $('#files_12_12').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_12_12').css('color','black');
                    $('#files_12_12').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
        $("#files_13").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_13_13').css('color','red');
             $('#files_13_13').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_13_13').css('color','red');
                      $('#files_13_13').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_13_13').css('color','black');
                    $('#files_13_13').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
        $("#files_14").change(function() {
          filename = this.files[0].name
          if(this.files[0].size > 10485760)
          {
             $('#files_14_14').css('color','red');
             $('#files_14_14').html('File size should be less then 10MB!'); 
          } else {
           var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 ) {
                     $('.company_docs_submit_button').attr('disabled', true);
                     $('#files_14_14').css('color','red');
                      $('#files_14_14').html($(this).val().split('.').pop().toLowerCase()+ ' file format is not allowed!');
                //alert("Only '.jpeg','.jpg', '.png', '.gif', '.bmp' formats are allowed.");
                } else {
                    $('#files_14_14').css('color','black');
                    $('#files_14_14').html(filename);
                    $('.company_docs_submit_button').attr('disabled', false);
                }
          }
        });
     $("#busi_doc_submit_btn_id").click(function() {
             if(document.getElementById("files_2").files.length == 0 && document.getElementById("files_1").files.length == 0 && document.getElementById("files_3").files.length == 0 && document.getElementById("files_4").files.length == 0)
             { 
                 $('.image_error_html').css('color','red');
                 $('.image_error_html').html('Required filed missing!');
                // $('.company_docs_submit_button').attr('disabled', true);
                 //alert('NULL');
             } else {
                 $('.image_error_html').html('');
                 //$('#files_6_6').css('color','red');
                 //$('#files_6_6').html(' ');
                 //alert('NOT NULL');
             }
             
         });  
         
         $("#diretor_submit_btn_id").click(function() {
             if(document.getElementById("files_6").files.length == 0 )
             { 
                 $('#files_6_6').css('color','red');
                 $('#files_6_6').html('Required filed missing!');
                // $('.company_docs_submit_button').attr('disabled', true);
                 //alert('NULL');
             } else {
                 $('#files_6_6').html('');
                 //$('#files_6_6').css('color','red');
                 //$('#files_6_6').html(' ');
                 //alert('NOT NULL');
             }
             
         });  
  </script>
  
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/verification/index.blade.php ENDPATH**/ ?>