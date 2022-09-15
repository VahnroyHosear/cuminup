
@extends('userlayout')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
@section('content')

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
              <a href="{{route('user.add-merchant')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Add website')}}</a>
              <a href="{{route('user.merchant-documentation')}}"  class="btn btn-sm btn-success">{{__('Documentation')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div-->
    
    @if($user->send_for_verification == 1)
    <div class="row">  
      <div class="col-md-12">
                    <div class="accordion" id="accordionExample">
                       
     
                    <h3 class="mb-0" style="padding: 15px;">Enterprise Verification <span class="mb-0" style="float:right;">Account Status @if($user->kyc_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                           
                            @if($user->kyc_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->kyc_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->kyc_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif</span></h3> 
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
                            @if($user->business_info_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($user->business_info_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->business_info_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->business_info_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                            
                           @if(!empty($user->business_info_updated_at))  {{date("m/d/Y", strtotime($user->business_info_updated_at))}} {{'|'}} {{date("h:i:A", strtotime($user->business_info_updated_at))}} @endif
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
                                    <td>{{$companyDetails->business_name}}</td>
                                  </tr>
                                  <tr>
                                    <th>Company Registration No</th>
                                    <td>{{$companyDetails->company_registration_no}}</td>
                                  </tr>
                                   <tr>
                                    <th>Business Type</th>
                                    <td>{{$companyDetails->business_type}}</td>
                                  </tr>
                                   <tr>
                                    <th>Business Category</th>
                                    <td>{{$companyDetails->business_category}}</td>
                                  </tr>
                                  <tr>
                                    <th>Website</th>
                                    <td>{{$companyDetails->link_online_registration}}</td>
                                  </tr>
                                  <tr>
                                    <th>Date of Incorporation</th>
                                    <td>{{$companyDetails->date_incorporation_day}}{{'.'}}{{$companyDetails->date_incorporation_month}}{{'.'}}{{$companyDetails->date_incorporation_year}}</td>
                                  </tr>
                                  <tr>
                                    <th>Tax ID / VAT</th>
                                    <td>{{$companyDetails->tax_id}}</td>
                                  </tr>
                                  <tr>
                                    <th>Address</th>
                                    <td>{{$companyDetails->building_number}} {{$companyDetails->street}} {{$companyDetails->city}} {{$companyDetails->state}} {{$companyDetails->country}} {{$companyDetails->zip_code}}</td>
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
                            @if($user->business_docs_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($user->business_docs_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->business_docs_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->business_docs_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                             @if(!empty($user->business_docs_updated_at)) {{date("m/d/Y", strtotime($user->business_docs_updated_at))}} {{'|'}} {{date("h:i:A", strtotime($user->business_docs_updated_at))}} @endif
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
                                    <td>{{$companyDetails->real_Incorporation}}</td>
                                    <td><a href="{{url('asset/profile')}}/{{$companyDetails->Incorporation}}" target="_blank">View</a></td>
                                  </tr>
                                  <tr>
                                    <td>Ownership</td>
                                    <td>{{$companyDetails->real_Ownership}}</td>
                                     <td><a href="{{url('asset/profile')}}/{{$companyDetails->Ownership}}" target="_blank">View</a></td>
                                  </tr>
                                  <tr>
                                    <td>Bank Account Statement</td>
                                    <td>{{$companyDetails->real_Bank_account_statement}}</td>
                                     <td><a href="{{url('asset/profile')}}/{{$companyDetails->Bank_account_statement}}" target="_blank">View</a></td>
                                  </tr>
                                  <tr>
                                      <td>Processing History</td>
                                      <td>{{$companyDetails->real_Processing_history}}</td>
                                       <td><a href="{{url('asset/profile')}}/{{$companyDetails->Processing_history}}" target="_blank">View</a></td>
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
                            @if($user->additional_docs_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($user->additional_docs_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->additional_docs_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->additional_docs_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                           @if(!empty($user->additional_docs_updated_at))  {{date("m/d/Y", strtotime($user->additional_docs_updated_at))}} {{'|'}} {{date("h:i:A", strtotime($user->additional_docs_updated_at))}} @endif
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                           <table class="table">
                                
                                <tbody>
                                    @foreach($additionalDocs as $details)
                                   <tr>
                                    <td>{{$details->doc_type}}</td>
                                    <td>{{$details->file_real_name}}</td>
                                    <td><a href="{{url('asset/profile')}}/{{$details->doc_name}}" target="_blank">View</a></td>
                                  </tr>
                                  @endforeach
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
                            @if($user->representative_director_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($user->representative_director_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->representative_director_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->representative_director_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                            @if(!empty($user->representative_director_updated_at))  {{date("m/d/Y", strtotime($user->representative_director_updated_at))}} {{'|'}} {{date("h:i:A", strtotime($user->representative_director_updated_at))}} @endif
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                     
                     
                                @foreach($representativeDirectors as $k=>$details) 
                                @if($k < 10)
                             <div class="card-body">    
                               <center><h3>Representative / Director {{++$k}}</h3></center>
                                <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Citizenship</td>
                                    <td>{{$details->country}}</td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal First Name</td>
                                    <td>{{$details->first_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal Last Name</td>
                                    <td>{{$details->last_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Dote of Birth</td>
                                    <td>{{$details->dob_day}}{{'.'}}{{$details->dob_month}}{{'.'}}{{$details->dob_year}}</td>
                                  </tr>
                                  <tr>
                                    <td>Designation</td>
                                    <td>{{$details->occupation}}</td>
                                  </tr>
                                  <tr>
                                    <td>Address</td>
                                    <td>{{$details->building_number}} {{$details->street}} {{$companyDetails->city}} {{$companyDetails->state}} {{$details->country}} {{$details->zip_code}}</td>
                                  </tr>
                                  @if(!empty($details->passport_doc))
                                  <tr>
                                    <td>{{$details->doc_type}}</td>  
                                    <td>{{$details->real_passport_doc}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->passport_doc}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                   @if(!empty($details->identity_card))
                                  <tr>
                                      <td>{{__('Identity Card')}}</td>  
                                    <td>{{$details->real_identity_card}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->identity_card}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->driving_licence))
                                  <tr>
                                      <td>{{__('Driving Licence')}}</td> 
                                    <td>{{$details->real_driving_licence}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->driving_licence}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->residence_permit))
                                  <tr>
                                       <td>{{__('Residence Permit')}}</td> 
                                    <td>{{$details->real_residence_permit}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->residence_permit}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->address_proof))
                                  <tr>
                                       <td>{{__('Address Proof')}}</td> 
                                    <td>{{$details->real_address_proof}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->address_proof}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  </tbody>
                            </table> 
                          
                            </div>
                            @endif
                                  @endforeach
                     
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
                            @if($user->share_holder_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($user->share_holder_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->share_holder_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->share_holder_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                             @if(!empty($user->share_holder_updated_at)) {{date("m/d/Y", strtotime($user->share_holder_updated_at))}} {{'|'}} {{date("h:i:A", strtotime($user->share_holder_updated_at))}} @endif
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                     
                     
                                @foreach($shareHolders as $k=>$details) 
                                @if($k < 10)
                             <div class="card-body">    
                               <center><h3>Shareholder {{++$k}}</h3></center>
                                <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Citizenship</td>
                                    <td>{{$details->country}}</td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal First Name</td>
                                    <td>{{$details->first_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal Last Name</td>
                                    <td>{{$details->last_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Dote of Birth</td>
                                    <td>{{$details->dob_day}}{{'.'}}{{$details->dob_month}}{{'.'}}{{$details->dob_year}}</td>
                                  </tr>
                                  <tr>
                                    <td>Occupation</td>
                                    <td>{{$details->occupation}}</td>
                                  </tr>
                                  <tr>
                                    <td>Address</td>
                                    <td>{{$details->building_number}} {{$details->street}} {{$companyDetails->city}} {{$companyDetails->state}} {{$details->country}} {{$details->zip_code}}</td>
                                  </tr>
                                  @if(!empty($details->passport_doc))
                                  <tr>
                                     <td>{{$details->doc_type}}</td> 
                                    <td>{{$details->real_passport_doc}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->passport_doc}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                   @if(!empty($details->identity_card))
                                  <tr>
                                      <td>{{__('Identity Card')}}</td>
                                    <td>{{$details->real_identity_card}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->identity_card}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->driving_licence))
                                  <tr>
                                      <td>{{__('Driving Licence')}}</td>
                                    <td>{{$details->real_driving_licence}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->driving_licence}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->residence_permit))
                                  <tr>
                                      <td>{{__('Residence Permit')}}</td>
                                    <td>{{$details->real_residence_permit}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->residence_permit}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->address_proof))
                                  <tr>
                                      <td>{{__('Address Proof')}}</td>
                                    <td>{{$details->real_address_proof}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->address_proof}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  </tbody>
                            </table> 
                          
                            </div>
                            @endif
                                  @endforeach
                     
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
                            @if($user->beneficiary_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($user->beneficiary_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->beneficiary_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->beneficiary_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                            @if(!empty($user->beneficiary_updated_at)) {{date("m/d/Y", strtotime($user->beneficiary_updated_at))}} {{'|'}} {{date("h:i:A", strtotime($user->beneficiary_updated_at))}} @endif
                            </div> 
                    </div>
                        </div>
                    </div>
                    <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample">
                     
                     
                                @foreach($beneficiary as $k=>$details) 
                                @if($k < 10)
                             <div class="card-body">    
                               <center><h3>Beneficiary {{++$k}}</h3></center>
                                <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Citizenship</td>
                                    <td>{{$details->country}}</td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal First Name</td>
                                    <td>{{$details->first_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Full Legal Last Name</td>
                                    <td>{{$details->last_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Dote of Birth</td>
                                    <td>{{$details->dob_day}}{{'.'}}{{$details->dob_month}}{{'.'}}{{$details->dob_year}}</td>
                                  </tr>
                                  <tr>
                                    <td>Occupation</td>
                                    <td>{{$details->occupation}}</td>
                                  </tr>
                                  <tr>
                                    <td>Address</td>
                                    <td>{{$details->building_number}} {{$details->street}} {{$companyDetails->city}} {{$companyDetails->state}} {{$details->country}} {{$details->zip_code}}</td>
                                  </tr>
                                  @if(!empty($details->passport_doc))
                                  <tr>
                                      <td>{{isset($details->doc_type)}}</td>
                                    <td>{{$details->real_passport_doc}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->passport_doc}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                   @if(!empty($details->identity_card))
                                  <tr>
                                      <td>{{__('Identity Card')}}</td>
                                    <td>{{$details->real_identity_card}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->identity_card}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->driving_licence))
                                  <tr>
                                      <td>{{__('Driving Licence')}}</td>
                                    <td>{{$details->real_driving_licence}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->driving_licence}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->residence_permit))
                                  <tr>
                                      <td>{{__('Residence Permit')}}</td>
                                    <td>{{$details->real_residence_permit}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->residence_permit}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  @if(!empty($details->address_proof))
                                  <tr>
                                      <td>{{__('Address Proof')}}</td>
                                    <td>{{$details->real_address_proof}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->address_proof}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                  </tbody>
                            </table> 
                          
                            </div>
                            @endif
                                  @endforeach
                     
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
                            @if($user->project_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($user->project_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($user->project_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($user->project_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                        <div class="col-sm-3">
                           @if(!empty($user->project_updated_at)) {{date("m/d/Y", strtotime($user->project_updated_at))}} {{'|'}} {{date("h:i:A", strtotime($user->project_updated_at))}} @endif
                            </div> 
                         
                    </div>
                        </div>
                    </div>
                    <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordionExample">
                     
                     
                                @foreach($project_info as $k=>$details) 
                                @if($k < 10)
                             <div class="card-body">    
                               <center><h3>Project(Website) {{++$k}}</h3></center>
                                <table class="table">
                                <tbody>
                                   @if(!empty($details->image))
                                  <tr>
                                    <td>{{__('Logo')}}</td>
                                    <td><img src="{{url('asset/profile')}}/{{$details->image}}" onerror="this.onerror=null;this.src='{{url('asset/profile')}}/person.jpg';" width="50"></td>
                                  </tr>
                                  @endif
                                   <tr>
                                    <td>Project Key</td>
                                    <td>{{$details->merchant_key}}</td>
                                  </tr>
                                  <tr>
                                    <td>Project Name</td>
                                    <td>{{$details->name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Site URL</td>
                                    <td>{{$details->site_url}}</td>
                                  </tr>
                                  <tr>
                                    <td>Description</td>
                                    <td>{{$details->description}}</td>
                                  </tr>
                                  
                                  
                                  <tr>
                                    <td>Revenue Minimum Transaction Amount</td>
                                    <td>{{$currency->symbol.$details->revenue_min_trx_amt}}</td>
                                  </tr>
                                  <tr>
                                    <td>Revenue Avrage Transaction Amount</td>
                                    <td>{{$currency->symbol.$details->revenue_avg_trx_amt}}</td>
                                  </tr>
                                  <tr>
                                    <td>Revenue Maximun Transaction Amount</td>
                                    <td>{{$currency->symbol.$details->revenue_max_trx_amt}}</td>
                                  </tr>
                                  <tr>
                                    <td>Revenue Exp monthly Volume</td>
                                    <td>{{$currency->symbol.$details->revenue_exp_monthly_vol}}</td>
                                  </tr>
                                  </tbody>
                            </table> 
                          
                            </div>
                            @endif
                                  @endforeach
                     
                    </div>
                  </div>
                </div>
      </div>
      </div>
      @endif
       @if($user->send_for_verification == 0)
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
                   
            <h2 class="mb-0">{{__('Enterprise Information')}}</h2>
          </div>
          <span class="testing active"></span>
               <ul class="nav nav-tabs tabs-left sideways">
            @if(!empty(Session::get('tab_active')))<li  onclick="clickFunction()" class="click_tab @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Business_verification'){{'active'}} style="text-decoration:underline;" @endif @else {{'active'}} @endif"><a data-toggle="tab" href="#home-v" style="color:black;" @if($user->company_registration_no != "NULL") class="disabled" @endif >Company Information</a></li>@else <li class="click_tab active" id="active_tab_1">Business Information</li>@endif
            @if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Company_docs')<li  onclick="clickFunction()" class="click_tab @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Company_docs'){{'active'}} @endif @endif" data-toggle="tab" href="#profile-v">Company Documents</li> @else <li class="click_tab" onclick="ComplateStepErrorFunction()" style="cursor:pointer" id="active_tab_1"> Company Documents</li> @endif
            @if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Additional_docs') <li  onclick="clickFunction()" class="click_tab @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Additional_docs'){{'active'}} @endif @endif" data-toggle="tab" href="#messages-v">Additional Documents(Optional)</li> @else <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_2">Additional Documents(Optional)</li>  @endif
            @if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Representative_director') <li  onclick="clickFunction()" class="click_tab @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Representative_director'){{'active'}} @endif @endif" data-toggle="tab" href="#settings-v">Representative/Director</li> @else <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_3">Representative/Director</li>  @endif
            @if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Share_holder')<li  onclick="clickFunction()" class="click_tab @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Share_holder'){{'active'}} @endif @endif" data-toggle="tab" href="#shareholder-v">Shareholders</li> @else <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_4"> Shareholders</li>  @endif
             @if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Beneficiary') <li onclick="clickFunction()" class="click_tab @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Beneficiary'){{'active'}} @endif @endif" data-toggle="tab" href="#beneficiary-v">Beneficiary</li> @else <li onclick="ComplateStepErrorFunction()" style="cursor:pointer" class="click_tab" id="active_tab_5"> Beneficiary</li>  @endif
             <h3 class="mb-0" style="margin-left:20px;">Project(Website) Profile</h3>
              @if(!empty(Session::get('tab_active')) && Session::get('tab_active') == 'Beneficiary') <li data-toggle="tab" onclick="clickFunction()" class="click_tab @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Project_info'){{'active'}} @endif @endif" data-toggle="tab" href="#project-v">Project Information</li> @else <li class="click_tab" style="cursor:pointer" onclick="ComplateStepErrorFunction()"> Project Information</li>  @endif
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
              <a href="{{url('user/open-ticket')}}" style="margin-left:21px;"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
 Need help?</a>
          </div>
        </div>
        <div class="col-md-8 card" >
             <div class="tab-content">
            <div class="tab-pane @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Business_verification') {{'active'}} @endif @else {{'active'}} @endif" id="home-v">
                <!--1st START-->
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Enterprise Verification')}}</h3>
                  </div>
                  <form action="{{url('user/business_profile')}}" method="POST">
                      @csrf
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red">{{__('*')}}</span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="{{$country->iso_code}}" <?=($country->iso_code =='US') ? 'selected' : ''?>>{{$country->name}}</option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Company legal name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="business_name" class="form-control" value="{{old('business_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('business_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('business_name')}}</span>
                          @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Company registration number<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="company_registration_no" class="form-control"  value="{{old('company_registration_no')}}" required>
                            </div>
                            @if ($errors->has('company_registration_no'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('company_registration_no')}}</span>
                          @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">How would you classify your business?<span style="color:red">{{__('*')}}</span></span>
                            </br>
                            <br>
                            <div class="input-group">
                              <!--input type="text" name="link_online_registration" class="form-control" value="{{old('link_online_registration')}}" -->
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
                             @if ($errors->has('business_type'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('business_type')}}</span>
                          @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">How would you categorize your business?<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <!--input type="text" name="link_online_registration" class="form-control" value="{{old('link_online_registration')}}" -->
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
                             @if ($errors->has('link_online_registration'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('link_online_registration')}}</span>
                          @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">What is your business website?</span>
                            <div class="input-group">
                              <input type="url" name="link_online_registration" class="form-control" value="{{old('link_online_registration')}}" >
                            </div>
                             @if ($errors->has('link_online_registration'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('link_online_registration')}}</span>
                          @endif
                          </div>
                        </div>
                       
                              <span style="font-size:14px;color:#000;">Date of incorporation<span style="color:red">{{__('*')}}</span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input autocomplete='off' class='form-control card-cvc daysinputvalue' name="date_incorporation_day" placeholder='DD' type='text' minlength="1" maxlength="2" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    <span class="days_error_msg" style="color:red"></span>
                                    @if ($errors->has('date_incorporation_day'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('date_incorporation_day')}}</span>
                          @endif
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
                                        @if ($errors->has('date_incorporation_day'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('date_incorporation_day')}}</span>
                          @endif
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year corp_year_cls' name="date_incorporation_year" value="{{old('date_incorporation_year')}}" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    
                                     <span class="corp_error_msg" style="color:red"></span>
                                    @if ($errors->has('date_incorporation_year'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('date_incorporation_year')}}</span>
                          @endif
                                    </div>
                                  </div>
                          
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Tax ID/ VAT<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="tax_id" class="form-control" placeholder="" value="{{old('tax_id')}}" required>
                            </div>
                            @if ($errors->has('tax_id'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('tax_id')}}</span>
                          @endif
                          </div>
                        </div>
                       <hr>
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Business Address')}}</h3>
                  </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red">{{__('*')}}</span></span>
                                <input type="text" name="building_number" class="form-control"  placeholder="" value="{{old('building_number')}}" required>
                             @if ($errors->has('building_number'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('building_number')}}</span>
                          @endif
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control"  placeholder="" value="{{old('street')}}">
                               @if ($errors->has('street'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('street')}}</span>
                          @endif
                            </div>
                           
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" value="{{old('city')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                              @if ($errors->has('city'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('city')}}</span>
                          @endif
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="state" class="form-control"  placeholder="" value="{{old('state')}}" required onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');">
                              @if ($errors->has('state'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('state')}}</span>
                          @endif
                            </div>
                            
                            
                            
                            
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red">{{__('*')}}</span></span>
                              <input type="number" name="zip_code" class="form-control"  placeholder="" required>
                            @if ($errors->has('zip_code'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('zip_code')}}</span>
                          @endif
                            </div>
                          </div> 
          
                             <div class="custom-control custom-control-alternative custom-checkbox">
                          <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                          <label class="custom-control-label" for=" customCheckLogin">
                            <span class="text-muted">Agree to <a href="{{route('terms')}}">Terms & Conditions</a></span>
                          </label>
                        </div>
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm" type="submit">{{__('Next')}}  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                <!--1st END-->
            </div>
            <div class="tab-pane @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Company_docs') {{'active'}}@endif @endif" id="profile-v">
               <!--2nd START-->
                               
                   
                      <div class="card-header header-elements-inline">
                        <h3 class="mb-0">{{__('Company Documents')}}</h3>
                      </div>
                      <div class="card-body">
                        <form method="post" action="{{url('user/business_docs')}}" enctype="multipart/form-data">
                        @csrf
                        
                             <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3">{{__('Incorporation')}}<span style="color:red">{{__('*')}}</span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang1" name="Incorporation"  onchange="checkFileExtenion()" required-->
                                        <!--label class="custom-file-label sdsd" for="customFileLang1">{{__('Upload')}}</label-->
                                         <div class="row"><label for="files_2" class="btn">Upload</label><span id="files_2_2" style="margin-top: 9px;"></span></div>
                                         <input id="files_2" style="visibility:hidden;" type="file" name="Incorporation" onchange="checkFileExtenion()" required>
                                         
                                    </div> 
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3">{{__('Ownership')}}<span style="color:red">{{__('*')}}</span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang2" name="Ownership" onchange="checkFileExtenion()" required-->
                                        <!--label class="custom-file-label sdsd4" for="customFileLang2">{{__('Upload')}}</label-->
                                         <div class="row"><label for="files_1" class="btn">Upload</label><span id="files_1_1" style="margin-top: 9px;"></span></div>
                                         <input id="files_1" style="visibility:hidden;" type="file" name="Ownership" onchange="checkFileExtenion()" required>
                                         
                                    </div> 
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3">{{__('Bank account statement')}}<span style="color:red">{{__('*')}}</span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang" name="Bank_account_statement" onchange="checkFileExtenion()" required-->
                                        <div class="row"><label for="files_3" class="btn">Upload</label><span id="files_3_3" style="margin-top: 9px;"></span></div>
                                         <input id="files_3" style="visibility:hidden;" type="file" name="Bank_account_statement" onchange="checkFileExtenion()" required>
                                        <!--label class="custom-file-label sdsd3" for="customFileLang">{{__('Upload')}}</label-->
                                    </div> 
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3">{{__('Processing history')}}<span style="color:red">{{__('*')}}</span></label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="custom-file-inpu" id="customFileLang3" name="Processing_history" onchange="checkFileExtenion()" required-->
                                        <div class="row"><label for="files_4" class="btn">Upload</label><span id="files_4_4" style="margin-top: 9px;"></span></div>
                                         <input id="files_4" style="visibility:hidden;" type="file" name="Processing_history" onchange="checkFileExtenion()" required>
                                        <!--label class="custom-file-label sdsd2" for="customFileLang3">{{__('Upload')}}</label-->
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
                                <button type="submit"  style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="busi_doc_submit_btn_id">{{__('Next')}}</button>
                            </div>
                        </form>
                      </div>
                    
  
                 <!--2nd END-->
                </div>
            <div class="tab-pane @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Additional_docs') {{'active'}} @endif @endif" id="messages-v">
                <!--3rd Start-->
                  
                               
                   
                      <div class="card-header header-elements-inline">
                        <h3 class="mb-0">{{__('Additional documents (optional)')}}</h3>
                        <span style="color:#ffc10d;font-size;12px">You can submit up to 20 Additional document.</span>
                      </div>
                      <div class="card-body">
                        <form method="post" action="{{url('user/additional_business_docs')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-3">{{__('Additional docs')}}</label>
                              <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--input type="file" class="form-control" id="fileinut" name="additionalDocs[]" onchange="checkFileExtenion()" required-->
                                        <div class="row"><label for="files_5" class="btn">Upload</label><span id="files_5_5" style="margin-top: 9px;"></span></div>
                                         <input id="files_5" style="visibility:hidden;" type="file" name="additionalDocs[]" onchange="checkFileExtenion()">
                                        <!--label class="custom-file-label sdsd" for="customFileLang">{{__('Upload')}}</label-->
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
                                <button type="submit"  style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button">{{__('Next')}}</button>
                            </div>
                        </form>
                       
                      </div>
                    
              

 

                <!--3rd END-->
            </div>
            <div class="tab-pane @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Representative_director') {{'active'}} @endif @endif" id="settings-v">
                <!--4 START-->
                @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Representative_director')
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Representative/Director Information')}}</h3>
                    <span style="color:#ffc10d;font-size;12px">You can submit up to 10 Representative / Director.</span>
                  </div>
                  <form action="{{url('user/business_representative_director')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                     
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red">{{__('*')}}</span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="{{$country->iso_code}}" <?=($country->iso_code =='US') ? 'selected' : ''?>>{{$country->name}}</option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal First name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('first_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('first_name')}}</span>
                          @endif
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal Last name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('last_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('last_name')}}</span>
                          @endif
                          </div>
                        </div>
                        
                       
                              <span style="font-size:14px;color:#000;">Date of Birth<span style="color:red">{{__('*')}}</span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input autocomplete='off' class='form-control card-cvc daysinputvalue' value="{{old('dob_day')}}"  name="dob_day" placeholder='DD' type='text' format minlength="1" maxlength="2" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                  <center> <span class="days_error_msg" style="color:red"></span></center>
                                    @if ($errors->has('dob_day'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_day')}}</span>
                          @endif
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
                                        @if ($errors->has('dob_month'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_month')}}</span>
                          @endif
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year  dob_year_cls'  name="dob_year" value="{{old('dob_year')}}" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    <center> <span class="year_error_msg" style="color:red"></span></center>
                                    @if ($errors->has('dob_year'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_year')}}</span>
                          @endif
                                    </div>
                                  </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Designation(Director/CEO/CFO/President - Owner)<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="occupation" class="form-control" maxlength="100" value="{{old('occupation')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('occupation'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('occupation')}}</span>
                          @endif
                          </div>
                        </div> 
                        
                       <hr>
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Address')}}</h3>
                  </div>
                  <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red">{{__('*')}}</span></span>
                                <input type="text" name="building_number" class="form-control"  placeholder="" maxlength="150" value="{{old('building_number')}}" required>
                             @if ($errors->has('building_number'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('building_number')}}</span>
                          @endif
                            </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control"  placeholder="" maxlength="150" value="{{old('street')}}" >
                               @if ($errors->has('street'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('street')}}</span>
                          @endif
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" maxlength="50" value="{{old('city')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                            
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="state" class="form-control"  placeholder="" maxlength="50" value="{{old('state')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                              @if ($errors->has('state'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('state')}}</span>
                          @endif
                            </div>
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="zip_code" class="form-control" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" required>
                            @if ($errors->has('zip_code'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('zip_code')}}</span>
                          @endif
                            </div>
                          </div> 
                            <hr>
                            <div class="card-header header-elements-inline">
                            <h3 class="mb-0">{{__('Upload Identification Documents')}}</h3>
                            
                            <br>
                           <span style="color:#ffc10d;font-size;12px">You can upload one document of your choice: passport/ID Card/Driving Licence/Residence Permit</span>
                             <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                          </div>
                          
                          <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Identity<span style="color:red">{{__('*')}}</span></span>
                             <select class="form-control" name="doc_type" required>
                                 <option value="">Select Document Type</option>
                                 <option value="Passport">Passport</option>
                                 <option value="Identity Card">Identity Card</option>
                                 <option value="Driving Licence">Driving Licence</option>
                                 <option value="Residence Permit">Residence Permit</option>
                             </select>
                            @if ($errors->has('identity_card'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('identity_card')}}</span>
                          @endif
                            </div>
                            <br>
                          <div class="col-lg-12">
                                 <!--span style="font-size:14px;color:#000;">Passport</span-->
                              <!--input type="file" name="passport_doc" class="form-control"  onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_7" class="btn">Upload</label><span id="files_7_7" style="margin-top: 9px;"></span></div>
                              <input id="files_7" style="visibility:hidden;" type="file" name="passport_doc" onchange="checkFileExtenion()" required>
                            @if ($errors->has('zip_code'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('zip_code')}}</span>
                          @endif
                          
                            </div>
                          
                            <!--br>
                             <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Identity Card</span>
                              <input type="file" name="identity_card" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('identity_card'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('identity_card')}}</span>
                          @endif
                            </div>
                            <br>
                             <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Driving Licence</span>
                              <input type="file" name="driving_licence" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('driving_licence'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('driving_licence')}}</span>
                          @endif
                            </div>
                            <br>
                             <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Residence Permit</span>
                              <input type="file" name="residence_permit" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('residence_permit'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('residence_permit')}}</span>
                          @endif
                            </div-->
                            
                             <div class="card-header header-elements-inline">
                            <h3 class="mb-0">{{__('Upload Proof of Address')}}</h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload <b>utility bill Bank Statement or other government issued documents not older than 3 months</b></span>
                          </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Address<span style="color:red">{{__('*')}}</span></span>
                              <!--input type="file" name="address_proof" class="form-control"  placeholder="" onchange="checkFileExtenion()" required-->
                              
                              <div class="row"><label for="files_6" class="btn">Upload</label><span id="files_6_6" style="margin-top: 9px;"></span></div>
                              <input id="files_6" style="visibility:hidden;" type="file" name="address_proof" onchange="checkFileExtenion()" required>
                              
                              <!--div class="row"><label for="files_6" class="btn">Upload</label><span id="files_6_6" style="margin-top: 9px;" ></span></div>
                              <input id="files_6" style="visibility:hidden;"  type="file" name="address_proof" onchange="checkFileExtenion()"  requried-->
                                         
                            @if ($errors->has('address_proof'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('address_proof')}}</span>
                          @endif
                            </div>
                            <br>
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="diretor_submit_btn_id" type="submit">{{__('Next')}}  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                <!--4 END-->
                @endif
                    @endif
                    {{--  @if(!empty(Session::get('added_status'))) @if(Session::get('added_status') != 'Project_info_added')
                      <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Representative/Director Details')}}</h3>
                  </div>
                      <div class="card-body">
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
                            <center><button  onclick="addAunother('Reinfo_added')" >Add Another</button></center>&nbsp;
                            <center><button onclick="nextFunction('Next_tab_share_holder')" >Next</button></center>
                      </div>
                      @endif
                      @endif
                      --}}
                
            </div>
            <div class="tab-pane @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Share_holder') {{'active'}} @endif @endif" id="shareholder-v">
                <!--5 START-->
               
               @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Share_holder')
                
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Shareholder')}} @if(count($representativeDirectors) < 11 )
     <a class="btn" href="{{url('user/add_another/Representative_director')}}" style="float:right;background-color: #1d0d44;color:white">Add Another Director</a> @endif</h3>
                    <span style="color:#ffc10d;font-size;12px">You can submit up to 10 Shareholders.</span>
                  </div>
                  <form action="{{url('user/business_representative_shareholder')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red">{{__('*')}}</span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="{{$country->iso_code}}" <?=($country->iso_code =='US') ? 'selected' : ''?>>{{$country->name}}</option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal First name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="first_name" maxlength="50" class="form-control" value="{{old('first_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('first_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('first_name')}}</span>
                          @endif
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal Last name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="last_name" maxlength="50" class="form-control" value="{{old('last_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('last_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('last_name')}}</span>
                          @endif
                          </div>
                        </div>
                        
                       
                              <span style="font-size:14px;color:#000;">Date of Birth<span style="color:red">{{__('*')}}</span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input autocomplete='off' class='form-control card-cvc daysinputvalue' value="{{old('dob_day')}}"  name="dob_day" placeholder='DD' type='text' minlength="1" maxlength="2" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    <center> <span class="days_error_msg" style="color:red"></span></center>
                                    @if ($errors->has('dob_day'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_day')}}</span>
                          @endif
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
                                        @if ($errors->has('dob_month'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_month')}}</span>
                          @endif
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year dob_year_cls' name="dob_year" value="{{old('dob_year')}}" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    <center> <span class="year_error_msg" style="color:red"></span></center>

                                    @if ($errors->has('dob_year'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_year')}}</span>
                          @endif
                                    </div>
                                  </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Designation(Director/CEO/CFO/President - Owner)<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="occupation" class="form-control" value="{{old('occupation')}}" required>
                            </div>
                             @if ($errors->has('occupation'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('occupation')}}</span>
                          @endif
                          </div>
                        </div> 
                        
                       <hr>
                       <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Percentages(%) of Shares<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="number" maxlength="3" max="100" name="share_percentage" class="form-control" value="{{old('share_percentage')}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                            </div>
                             @if ($errors->has('share_percentage'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('share_percentage')}}</span>
                          @endif
                          </div>
                        </div> 
                        <hr>
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Address')}}</h3>
                  </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red">{{__('*')}}</span></span>
                                <input type="text" name="building_number" class="form-control"  placeholder="" maxlength="150" value="{{old('building_number')}}" required>
                             @if ($errors->has('building_number'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('building_number')}}</span>
                          @endif
                            </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control" maxlength="150" placeholder="" value="{{old('street')}}" >
                               @if ($errors->has('street'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('street')}}</span>
                          @endif
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" maxlength="50" value="{{old('city')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="state" class="form-control"  maxlength="50" placeholder="" value="{{old('state')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                              @if ($errors->has('state'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('state')}}</span>
                          @endif
                            </div>
                            
                            
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="zip_code" class="form-control" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" required>
                            @if ($errors->has('zip_code'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('zip_code')}}</span>
                          @endif
                            </div>
                          </div> 
                            <hr>
                            <div class="card-header header-elements-inline">
                            <h3 class="mb-0">{{__('Upload Identification Documents')}}</h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload one document of your choice: passport/ID Card/Driving Licence/Residence Permit</span>
                            <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                          </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Identity<span style="color:red">{{__('*')}}</span></span>
                             <select class="form-control" name="doc_type" required>
                                 <option value="">Select Document Type</option>
                                 <option value="Passport">Passport</option>
                                 <option value="Identity Card">Identity Card</option>
                                 <option value="Driving Licence">Driving Licence</option>
                                 <option value="Residence Permit">Residence Permit</option>
                             </select>
                            @if ($errors->has('identity_card'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('identity_card')}}</span>
                          @endif
                            </div>
                            <br>
                          <div class="col-lg-12">
                                 <!--span style="font-size:14px;color:#000;">Passport</span-->
                              <!--input type="file" name="passport_doc" class="form-control"  placeholder="" onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_8" class="btn">Upload</label><span id="files_8_8" style="margin-top: 9px;"></span></div>
                              <input id="files_8" style="visibility:hidden;" type="file" name="passport_doc" onchange="checkFileExtenion()" required>
                            @if ($errors->has('zip_code'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('zip_code')}}</span>
                          @endif
                            </div>
                            <!--br>
                            <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Identity Card</span>
                              <input type="file" name="identity_card" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('identity_card'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('identity_card')}}</span>
                          @endif
                            </div>
                            <br>
                            <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Driving Licence</span>
                              <input type="file" name="driving_licence" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('driving_licence'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('driving_licence')}}</span>
                          @endif
                            </div>
                            <br>
                            <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Residence Permit</span>
                              <input type="file" name="residence_permit" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('residence_permit'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('residence_permit')}}</span>
                          @endif
                            </div-->
                             <div class="card-header header-elements-inline">
                            <h3 class="mb-0">{{__('Upload Proof of Address')}}</h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload <b>utility bill Bank Statement or other government issued documents not older than 3 months</b></span>
                          </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Address<span style="color:red">{{__('*')}}</span></span>
                              <!--input type="file" name="address_proof" class="form-control"  placeholder="" onchange="checkFileExtenion()" required-->
                              <div class="row"><label for="files_9" class="btn">Upload</label><span id="files_9_9" style="margin-top: 9px;"></span></div>
                              <input id="files_9" style="visibility:hidden;" type="file" name="address_proof" onchange="checkFileExtenion()" required>
                            @if ($errors->has('address_proof'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('address_proof')}}</span>
                          @endif
                            </div>
                            <br>
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="shareholder_submit_btn_id" type="submit">{{__('Next')}}  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                    @endif
                    @endif
                    {{-- @if(!empty(Session::get('added_status'))) @if(Session::get('added_status') != 'ReLoadShareHolder_added' && Session::get('tab_active') == 'Share_holder')
                     <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Shareholder Details')}}</h3>
                  </div>
                      <div class="card-body">
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
                           <center><button  onclick="addAunother('ReLoadShareHolder_added')">Add Another</button></center>
                           <center><button onclick="nextFunction('Next_tab_beneficiary')" >Next</button></center>
                      </div>
                      @endif
                      @endif
                      --}}
                     <!--5 END-->
            </div>
            <div class="tab-pane @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Beneficiary') {{'active'}} @endif @endif" id="beneficiary-v">
                <!--6 START-->
                @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Beneficiary')
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Beneficiary')}} @if(count($shareHolders) < 11 )<a class="btn" href="{{url('user/add_another/Share_holder')}}" style="float:right;background-color: #1d0d44;color:white">Add Another Shareholder</a> @endif </h3>
                  </div>
                  <form action="{{url('user/business_representative_beneficiary')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Citizenship<span style="color:red">{{__('*')}}</span></span>
                            <?php $countries =DB::table('countries')->where('active',1)->orderby('name','ASC')->get(); ?>
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php foreach($countries as $country){?>
                                        <option value="{{$country->iso_code}}" <?=($country->iso_code =='US') ? 'selected' : ''?>>{{$country->name}}</option>
                                        <?php }?>
                                    </select>  
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal First name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="first_name" class="form-control" maxlength="50" value="{{old('first_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('first_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('first_name')}}</span>
                          @endif
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Full Legal Last name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="last_name" maxlength="50" class="form-control" value="{{old('last_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('last_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('last_name')}}</span>
                          @endif
                          </div>
                        </div>
                        
                       
                              <span style="font-size:14px;color:#000;">Date of Birth<span style="color:red">{{__('*')}}</span></span>
                            <div class='form-group row' id="add_new_card2">
                                
                                    <div class='col form-group cvc'>
                                      <input  class='form-control card-cvc daysinputvalue' value="{{old('dob_day')}}"  name="dob_day" placeholder='DD' type='text' minlength="1" maxlength="3" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    <center> <span class="days_error_msg" style="color:red"></span></center>

                                    @if ($errors->has('dob_day'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_day')}}</span>
                          @endif
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
                                        @if ($errors->has('dob_month'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_month')}}</span>
                          @endif
                                    </div>
                                    <div class='col form-group expiration required'>
                                      <input class='form-control card-expiry-year dob_year_cls' name="dob_year" value="{{old('dob_year')}}" placeholder='YYYY' minlength="4" maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  required>
                                    <center> <span class="year_error_msg" style="color:red"></span></center>
                                    @if ($errors->has('dob_year'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('dob_year')}}</span>
                          @endif
                                    </div>
                                  </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Designation(Director/CEO/CFO/President - Owner)<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="occupation" class="form-control" maxlength="100" value="{{old('occupation')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('occupation'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('occupation')}}</span>
                          @endif
                          </div>
                        </div> 
                        
                       <hr>
                      
                       
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Address')}}</h3>
                  </div>
                           
                           
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Address Line 1<span style="color:red">{{__('*')}}</span></span>
                                <input type="text" name="building_number" class="form-control"  maxlength="100" value="{{old('building_number')}}" required>
                             @if ($errors->has('building_number'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('building_number')}}</span>
                          @endif
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Street</span>
                               <input type="text" name="street" class="form-control"  placeholder="" maxlength="100" value="{{old('street')}}" >
                               @if ($errors->has('street'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('street')}}</span>
                          @endif
                            </div>
                          
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">City<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="city" class="form-control"  placeholder="" maxlength="50" value="{{old('city')}}" required>
                               @if ($errors->has('city'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('city')}}</span>
                          @endif
                            </div>
                             <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">State<span style="color:red">{{__('*')}}</span></span>
                              <input type="text" name="state" class="form-control"  placeholder="" maxlength="50" value="{{old('state')}}" required>
                              @if ($errors->has('state'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('state')}}</span>
                          @endif
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">ZIP Code or Postal Code<span style="color:red">{{__('*')}}</span></span>
                              <input type="number" name="zip_code" class="form-control"  placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                            @if ($errors->has('zip_code'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('zip_code')}}</span>
                          @endif
                            </div>
                          </div> 
                            <hr>
                            <div class="card-header header-elements-inline">
                            <h3 class="mb-0">{{__('Upload Identification Documents')}}</h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload one document of your choice: passport/ID Card/Driving Licence/Residence Permit</span>
                            <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                          </div>
                           <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Identity<span style="color:red">{{__('*')}}</span></span>
                             <select class="form-control" name="doc_type" required>
                                 <option value="">Select Document Type</option>
                                 <option value="Passport">Passport</option>
                                 <option value="Identity Card">Identity Card</option>
                                 <option value="Driving Licence">Driving Licence</option>
                                 <option value="Residence Permit">Residence Permit</option>
                             </select>
                            @if ($errors->has('identity_card'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('identity_card')}}</span>
                          @endif
                            </div>
                          <br>
                          <div class="col-lg-12">
                                 <!--span style="font-size:14px;color:#000;">Passport</span-->
                              <!--input type="file" name="passport_doc" class="form-control"  placeholder="" onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_11" class="btn">Upload</label><span id="files_11_11" style="margin-top: 9px;"></span></div>
                              <input id="files_11" style="visibility:hidden;" type="file" name="passport_doc" onchange="checkFileExtenion()" required>
                            @if ($errors->has('zip_code'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('zip_code')}}</span>
                          @endif
                            </div>
                            
                            
                            
                             <!--center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Identity Card</span>
                              <input type="file" name="identity_card" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('identity_card'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('identity_card')}}</span>
                          @endif
                            </div>
                            <br>
                             <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Driving Licence</span>
                              <input type="file" name="driving_licence" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('driving_licence'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('driving_licence')}}</span>
                          @endif
                            </div>
                            <br>
                             <center> {{__('OR')}}</center>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Residence Permit</span>
                              <input type="file" name="residence_permit" class="form-control"  placeholder="" onchange="checkFileExtenion()">
                            @if ($errors->has('residence_permit'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('residence_permit')}}</span>
                          @endif
                            </div-->
                             <div class="card-header header-elements-inline">
                            <h3 class="mb-0">{{__('Upload Proof of Address')}}</h3>
                            <br>
                            <span style="color:#ffc10d;font-size;12px">You can upload <b>utility bill Bank Statement or other government issued documents not older than 3 months</b></span>
                          </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Proof of Address<span style="color:red">{{__('*')}}</span></span>
                              <!--input type="file" name="address_proof" class="form-control"  placeholder="" required onchange="checkFileExtenion()"-->
                              <div class="row"><label for="files_12" class="btn">Upload</label><span id="files_12_12" style="margin-top: 9px;"></span></div>
                              <input id="files_12" style="visibility:hidden;" type="file" name="address_proof" onchange="checkFileExtenion()" required>
                            @if ($errors->has('address_proof'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('address_proof')}}</span>
                          @endif
                            </div>
                            <br>
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="beneficiary_submit_btn_id" type="submit">{{__('Next')}}  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                       @endif
                    @endif
                    {{--
                     @if(!empty(Session::get('added_status'))) @if(Session::get('added_status') != 'Project_info_added' && Session::get('tab_active') == 'Beneficiary')
                      <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Beneficiary Details')}}</h3>
                  </div>
                      <div class="card-body">
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
                            <center><button  onclick="addAunother('Reinfo_added')">Add Another</button></center>
                            <center><button onclick="nextFunction('Next_tab_project_info')" >Next</button></center>
                      </div>
                      @endif
                      @endif
                      --}}
                <!--6 END-->
            </div>
             <div class="tab-pane @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Project_info') {{'active'}} @endif @endif" id="project-v">
                 <!--7 START-->
               @if(!empty(Session::get('tab_active'))) @if(Session::get('tab_active') == 'Project_info' && empty(Session::get('FINAL_STATUS'))) 
                <div  id="company_info_div_id"> 
                   <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Project Information')}} @if(count($shareHolders) < 11 ) <a class="btn" href="{{url('user/add_another/Beneficiary')}}" style="float:right;background-color: #1d0d44;color:white">Add Another Share Beneficiary</a> @endif </h3>
                    <span>You can submit up to 6 Projects.</span>                
                    </div>
                  <form action="{{url('user/business_project_info')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                         <div class="row"><div class="col-sm-3"></div><center><div class="image_error_html" style="color:red"></div></center></div>
                            <br>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Logo<span style="color:red">{{__('*')}}</span></span>
                              <!--input type="file" name="image" class="form-control"  placeholder="" onchange="checkFileExtenion()" required-->
                              <div class="row"><label for="files_13" class="btn">Upload</label><span id="files_13_13" style="margin-top: 9px;"></span></div>
                              <input id="files_13" style="visibility:hidden;" type="file" name="image" onchange="checkFileExtenion()" required>
                            @if ($errors->has('image'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('image')}}</span>
                          @endif
                            </div>
                            <br>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Project Name<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="text" name="merchant_name" class="form-control" maxlength="80" value="{{old('merchant_name')}}" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" required>
                            </div>
                             @if ($errors->has('merchant_name'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('merchant_name')}}</span>
                          @endif
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Site URL<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="url" name="site_link" class="form-control" value="{{old('site_link')}}" required>
                            </div>
                             @if ($errors->has('site_link'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('site_link')}}</span>
                          @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Description<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                    <textarea type="text" class="form-control" rows="4" placeholder="Project description or extra instructions"  name="merchant_description" required></textarea>
                            </div>
                             @if ($errors->has('merchant_description'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('merchant_description')}}</span>
                          @endif
                          </div>
                        </div>
                         <div class="form-group row">
                          <div class="col-lg-12">
                              <span style="font-size:14px;color:#000;">Send Notifications To<span style="color:red">{{__('*')}}</span></span>
                            <div class="input-group">
                              <input type="email" name="email" class="form-control" placeholder="If provided, this email address will get transaction notices" required>
                            </div>
                             @if ($errors->has('email'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('email')}}</span>
                          @endif
                          </div>
                        </div>
                       
                        
                       <hr>
                      
                       
                         <div class="form-group row" id="card_type_div_id">
                            
                            <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Revenue Information')}}</h3>
                  </div>
                           
                            <div class="col-lg-12" style="margin-bottom:10px">
                                <span style="font-size:14px;color:#000;">Minimum Transaction Amount({{$currency->symbol}})<span style="color:red">{{__('*')}}</span></span>
                                <select class="form-control" name="revenue_min_trx_amt" required>
                                    <option>{{__('1000-5000')}}</option>
                                    <option>{{__('5000-10,000')}}</option>
                                    <option>{{__('25,000-50,000')}}</option>
                                    <option>{{__('100,000-200,000')}}</option>
                                    <option>{{__('200,000-300,000')}}</option>
                                    <option>{{__('300,000-500,000')}}</option>
                                    <option>{{__('1 Million Above')}}</option>
                                </select>    
                              <!--input type="text" name="revenue_min_trx_amt" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" value="{{old('city')}}" required-->
                            </div>
                            <div class="col-lg-12">
                               
                                 <span style="font-size:14px;color:#000;">Average Transaction Amount({{$currency->symbol}})<span style="color:red">{{__('*')}}</span></span>
                                 <select class="form-control" name="revenue_avg_trx_amt" required>
                                    <option>{{__('1000-5000')}}</option>
                                    <option>{{__('5000-10,000')}}</option>
                                    <option>{{__('25,000-50,000')}}</option>
                                    <option>{{__('100,000-200,000')}}</option>
                                    <option>{{__('200,000-300,000')}}</option>
                                    <option>{{__('300,000-500,000')}}</option>
                                     <option>{{__('1 Million Above')}}</option>
                                </select>
                               <!--input type="text" name="revenue_avg_trx_amt" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" value="{{old('revenue_avg_trx_amt')}}" required-->
                               @if ($errors->has('revenue_avg_trx_amt'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('revenue_avg_trx_amt')}}</span>
                          @endif
                          
                            </div>
                            
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Maximum Transaction Amount({{$currency->symbol}})<span style="color:red">{{__('*')}}</span></span>
                                 <select class="form-control" name="revenue_max_trx_amt" required>
                                    <option>{{__('1000-5000')}}</option>
                                    <option>{{__('5000-10,000')}}</option>
                                    <option>{{__('25,000-50,000')}}</option>
                                    <option>{{__('100,000-200,000')}}</option>
                                    <option>{{__('200,000-300,000')}}</option>
                                    <option>{{__('300,000-500,000')}}</option>
                                     <option>{{__('1 Million Above')}}</option>
                                </select>
                                <!--input type="text" name="revenue_max_trx_amt" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{old('revenue_max_trx_amt')}}" required-->
                             @if ($errors->has('revenue_max_trx_amt'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('revenue_max_trx_amt')}}</span>
                          @endif
                            </div>
                            <div class="col-lg-12">
                                 <span style="font-size:14px;color:#000;">Expected Monthly Volume({{$currency->symbol}})<span style="color:red">{{__('*')}}</span></span>
                                 <select class="form-control" name="revenue_exp_monthly_vol" required>
                                    <option>{{__('1000-5000')}}</option>
                                    <option>{{__('5000-10,000')}}</option>
                                    <option>{{__('25,000-50,000')}}</option>
                                    <option>{{__('100,000-200,000')}}</option>
                                    <option>{{__('200,000-300,000')}}</option>
                                    <option>{{__('300,000-500,000')}}</option>
                                     <option>{{__('1 Million Above')}}</option>
                                </select>
                              <!--input type="number" name="revenue_exp_monthly_vol" class="form-control" maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="" required-->
                            @if ($errors->has('revenue_exp_monthly_vol'))
                            <span class="error form-error-msg " style="color:red">{{$errors->first('revenue_exp_monthly_vol')}}</span>
                          @endif
                            </div>
                          </div> 
                            <hr>
                            
                            
                             
                            <br>
                            <center> <div class="text-center">
                                       <input type="hidden" id="browser_client_secret" value=""> 
                                    <button style="background-color:#30206c" class="btn btn-success btn-sm company_docs_submit_button" id="project_submit_btn_id" type="submit">{{__('Next')}}  </button><br>
                                   
                                  </div></center>
                                  <br>
                                  <br>
                    </form>      
                     </div>
                    @endif
                    @endif
                     @if(!empty(Session::get('FINAL_STATUS'))) @if(Session::get('FINAL_STATUS') == 'FINAL_TAB')
                     <br>
                     <br>
                     <br>
                     <br>
                      <div class="card-header header-elements-inline">
                   @if(count($project_info) < 7) <center><h3 class="mb-0"> <a class="btn" href="{{url('user/add_another/Project_info')}}" style="background-color: #1d0d44;color:white">Add Another Project</a> </h3></center>@endif
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
                            <center><a href="{{url('user/send_for_verification')}}"  class="btn btn-success">{{__('Submit for Verification')}}</a></center>
                      </div>
                      @endif
                      @endif
                      
                <!--7 END-->
             </div>     
            
          </div>
           @endif
             
              

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
                                       // <label class="custom-file-label sdsd" for="customFileLang">{{__('Upload')}}</label>
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
  
   
@stop