
@extends('master')

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
    
     
    @if($send_for_verification->send_for_verification == 1)
    <div class="row">  
      <div class="col-md-12">
                    <div class="accordion" id="accordionExample">
                    <h3 class="mb-0" style="padding: 15px;">{{ucfirst($send_for_verification->first_name??'')}} {{ucfirst($send_for_verification->last_name??'')}}- Business Verification
                     <a class="badge badge-warning" style="float:right;color:black;"href="{{url('admin/manage-user',$send_for_verification->id)}}" ><i class="fa fa-angle-double-left"></i> Back</a></h3>
                  <div class="card bg-white border-0 mb-0">
                    <div class="card-header" id="headingOne">
                      <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="row">
                        <div class="col-sm-2"><i class="fa fa-info-circle fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-6">
                            <h3 class="mb-0">General Information</h3>
                        </div>
                        <div class="col-sm-2">
                            <h3 class="mb-0">Status: 
                            @if($send_for_verification->business_info_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($send_for_verification->business_info_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($send_for_verification->business_info_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($send_for_verification->business_info_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                          <div class="col-sm-2">
                              <a data-toggle="modal" data-target="#change_status_1{{$send_for_verification->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="modal fade" id="change_status_1{{$send_for_verification->id}}" style="background-color: gray;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Status')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.verification.kyc_status')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$send_for_verification->id}}">
                                                         <input type="hidden" name="status_type" value="business_info_status">
                                                        <div class="form-group">
                                                        <select class="form-control" name="status">
                                                            <option>Select Status</option>
                                                            <option value="1" @if($send_for_verification->business_info_status == 1 ) {{'Selected'}} @endif>Verified</option>
                                                             <option value="3" @if($send_for_verification->business_info_status == 3 ) {{'Selected'}} @endif>Not Verified</option>
                                                             <option value="4" @if($send_for_verification->business_info_status == 2 ) {{'Selected'}} @endif>Pending</option>
                                                             <option value="2" @if($send_for_verification->business_info_status == 4 ) {{'Selected'}} @endif>Rejected</option>
                                                        </select> 
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-center">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
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
                        <div class="col-sm-2">
<i class="fa fa-file-text fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-6">
                            <h3 class="mb-0">{{__('Company Documents')}}</h3>
                            
                        </div>
                        <div class="col-sm-2">
                            <h3 class="mb-0">Status: 
                            @if($send_for_verification->business_docs_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($send_for_verification->business_docs_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($send_for_verification->business_docs_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($send_for_verification->business_info_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            </h3>
                        </div>
                          <div class="col-sm-2">
                              <a data-toggle="modal" data-target="#change_status_2{{$send_for_verification->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="modal fade" id="change_status_2{{$send_for_verification->id}}" style="background-color: gray;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Status')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.verification.kyc_status')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$send_for_verification->id}}">
                                                         <input type="hidden" name="status_type" value="business_docs_status">
                                                        <div class="form-group">
                                                        <select class="form-control" name="status">
                                                            <option>Select Status</option>
                                                            <option value="1" @if($send_for_verification->business_docs_status == 1 ) {{'Selected'}} @endif>Verified</option>
                                                             <option value="3" @if($send_for_verification->business_docs_status == 3 ) {{'Selected'}} @endif>Not Verified</option>
                                                             <option value="4" @if($send_for_verification->business_docs_status == 2 ) {{'Selected'}} @endif>Pending</option>
                                                             <option value="2" @if($send_for_verification->business_docs_status == 4 ) {{'Selected'}} @endif>Rejected</option>
                                                        </select> 
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-center">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
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
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body text-left">
                         
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
                        <div class="col-sm-2">
                            <i class="fa fa-file fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-6">
                            <h3 class="mb-0">Additional documents (optional)</h3>
                            
                        </div>
                        <div class="col-sm-2">
                            <h3 class="mb-0">Status: 
                            @if($send_for_verification->additional_docs_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($send_for_verification->additional_docs_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($send_for_verification->additional_docs_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                             @if($send_for_verification->additional_docs_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            
                            </h3>
                        </div>
                          <div class="col-sm-2">
                              <a data-toggle="modal" data-target="#change_status_3{{$send_for_verification->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="modal fade" id="change_status_3{{$send_for_verification->id}}" style="background-color: gray;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Status')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.verification.kyc_status')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$send_for_verification->id}}">
                                                         <input type="hidden" name="status_type" value="additional_docs_status">
                                                        <div class="form-group">
                                                        <select class="form-control" name="status">
                                                            <option>Select Status</option>
                                                            <option value="1" @if($send_for_verification->additional_docs_status == 1 ) {{'Selected'}} @endif>Verified</option>
                                                             <option value="3" @if($send_for_verification->additional_docs_status == 3 ) {{'Selected'}} @endif>Not Verified</option>
                                                             <option value="4" @if($send_for_verification->additional_docs_status == 2 ) {{'Selected'}} @endif>Pending</option>
                                                             <option value="2" @if($send_for_verification->additional_docs_status == 4 ) {{'Selected'}} @endif>Rejected</option>
                                                        </select> 
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-center">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
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
                        <div class="col-sm-2">
                            <i class="fa fa-user fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-6">
                            <h3 class="mb-0">Representative / Director</h3>
                            
                        </div>
                        <div class="col-sm-2">
                            <h3 class="mb-0">Status: 
                            @if($send_for_verification->representative_director_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($send_for_verification->representative_director_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($send_for_verification->representative_director_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                             @if($send_for_verification->representative_director_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            </h3>
                        </div>
                          <div class="col-sm-2">
                              <a data-toggle="modal" data-target="#change_status_4{{$send_for_verification->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="modal fade" id="change_status_4{{$send_for_verification->id}}" style="background-color: gray;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Status')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.verification.kyc_status')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$send_for_verification->id}}">
                                                         <input type="hidden" name="status_type" value="representative_director_status">
                                                        <div class="form-group">
                                                        <select class="form-control" name="status">
                                                            <option>Select Status</option>
                                                            <option value="1" @if($send_for_verification->representative_director_status == 1 ) {{'Selected'}} @endif>Verified</option>
                                                             <option value="3" @if($send_for_verification->representative_director_status == 3 ) {{'Selected'}} @endif>Not Verified</option>
                                                             <option value="4" @if($send_for_verification->representative_director_status == 2 ) {{'Selected'}} @endif>Pending</option>
                                                             <option value="2" @if($send_for_verification->representative_director_status == 4 ) {{'Selected'}} @endif>Rejected</option>
                                                        </select> 
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-center">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
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
                                    <td>{{__('Designation')}}</td>
                                    <td>{{$details->occupation}}</td>
                                  </tr>
                                  <tr>
                                    <td>Address</td>
                                    <td>{{$details->building_number}} {{$details->street}} {{$companyDetails->city}} {{$companyDetails->state}} {{$details->country}} {{$details->zip_code}}</td>
                                  </tr>
                                  @if(!empty($details->passport_doc))
                                  <tr>
                                      <td>{{__('Passport')}}</td>
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
                        <div class="col-sm-2">
                            <i class="fa fa-users fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-6">
                            <h3 class="mb-0">Shareholder</h3>
                        </div>
                         <div class="col-sm-2">
                            <h3 class="mb-0">Status: 
                            @if($send_for_verification->share_holder_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($send_for_verification->share_holder_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($send_for_verification->share_holder_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                             @if($send_for_verification->share_holder_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            </h3>
                        </div>
                          <div class="col-sm-2">
                              <a data-toggle="modal" data-target="#change_status_5{{$send_for_verification->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="modal fade" id="change_status_5{{$send_for_verification->id}}" style="background-color: gray;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Status')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.verification.kyc_status')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$send_for_verification->id}}">
                                                         <input type="hidden" name="status_type" value="share_holder_status">
                                                        <div class="form-group">
                                                        <select class="form-control" name="status">
                                                            <option>Select Status</option>
                                                            <option value="1" @if($send_for_verification->share_holder_status == 1 ) {{'Selected'}} @endif>Verified</option>
                                                             <option value="3" @if($send_for_verification->share_holder_status == 3 ) {{'Selected'}} @endif>Not Verified</option>
                                                             <option value="4" @if($send_for_verification->share_holder_status == 2 ) {{'Selected'}} @endif>Pending</option>
                                                             <option value="2" @if($send_for_verification->share_holder_status == 4 ) {{'Selected'}} @endif>Rejected</option>
                                                        </select> 
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-center">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
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
                                      <td>{{__('Passport')}}</td>
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
                        <div class="col-sm-2">
                            <i class="fa fa-user fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-6">
                            <h3 class="mb-0">Beneficiary</h3>
                        </div>
                         <div class="col-sm-2">
                            <h3 class="mb-0">Status: 
                            @if($send_for_verification->beneficiary_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($send_for_verification->beneficiary_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($send_for_verification->beneficiary_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                             @if($send_for_verification->beneficiary_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            </h3>
                        </div>
                          <div class="col-sm-2">
                              <a data-toggle="modal" data-target="#change_status_6{{$send_for_verification->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="modal fade" id="change_status_6{{$send_for_verification->id}}" style="background-color: gray;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Status')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.verification.kyc_status')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$send_for_verification->id}}">
                                                         <input type="hidden" name="status_type" value="beneficiary_status">
                                                        <div class="form-group">
                                                        <select class="form-control" name="status">
                                                            <option>Select Status</option>
                                                            <option value="1" @if($send_for_verification->beneficiary_status == 1 ) {{'Selected'}} @endif>Verified</option>
                                                             <option value="3" @if($send_for_verification->beneficiary_status == 3 ) {{'Selected'}} @endif>Not Verified</option>
                                                             <option value="4" @if($send_for_verification->beneficiary_status == 2 ) {{'Selected'}} @endif>Pending</option>
                                                             <option value="2" @if($send_for_verification->beneficiary_status == 4 ) {{'Selected'}} @endif>Rejected</option>
                                                        </select> 
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-center">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
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
                                      <td>{{__('Passport')}}</td>
                                    <td>{{$details->real_passport_doc}} </td>  
                                   <td><a href="{{url('asset/profile')}}/{{$details->passport_doc}}" target="_blank">View</a></td>
                                  </tr>
                                  @endif
                                   @if(!empty($details->identity_card))
                                  <tr>
                                      <td>{{__('Identity card')}}</td>
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
                        <div class="col-sm-2">
                            <i class="fa fa-globe fa-2x" aria-hidden="true" style="color:blue"></i></div>      
                        <div class="col-sm-6">
                            <h3 class="mb-0">Project (Website) Information</h3>
                        </div>
                         <div class="col-sm-2">
                            <h3 class="mb-0">Status: 
                            @if($send_for_verification->project_status == 1)<span class="badge badge-pill badge-success">Verified</span>@endif
                            @if($send_for_verification->project_status == 0)<span class="badge badge-pill badge-warning">Not Verified</span>@endif
                            @if($send_for_verification->project_status == 2)<span class="badge badge-pill badge-danger">Rejected</span>@endif
                            @if($send_for_verification->project_status == 4)<span class="badge badge-pill badge-warning">Pending</span>@endif
                            </h3>
                        </div>
                          <div class="col-sm-2">
                              <a data-toggle="modal" data-target="#change_status_7{{$send_for_verification->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="modal fade" id="change_status_7{{$send_for_verification->id}}" style="background-color: gray;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Status')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.verification.kyc_status')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$send_for_verification->id}}">
                                                         <input type="hidden" name="status_type" value="project_status">
                                                        <div class="form-group">
                                                        <select class="form-control" name="status">
                                                            <option>Select Status</option>
                                                            <option value="1" @if($send_for_verification->project_status == 1 ) {{'Selected'}} @endif>Verified</option>
                                                             <option value="3" @if($send_for_verification->project_status == 3 ) {{'Selected'}} @endif>Not Verified</option>
                                                             <option value="4" @if($send_for_verification->project_status == 2 ) {{'Selected'}} @endif>Pending</option>
                                                             <option value="2" @if($send_for_verification->project_status == 4 ) {{'Selected'}} @endif>Rejected</option>
                                                        </select> 
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-center">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
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
       @if($send_for_verification->send_for_verification == 0)
     <center> <div class="row" style="margin-top:20px;">
           <div class="col-2"></div>
               <div class="col-8"> <h3>No Data received Yet!</h3>
                <img src="{{url('/')}}/asset/profile/nodata.png" width="30%">
                </div>
            
             
          </div></center>
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
 
function addFunction() { 
  var new_chq_no = parseInt($('#total_chq').val()) + 1;
 
  //<input type="file" class="custom-file-input" id="customFileLang" name="Incorporation">
                                       // <label class="custom-file-label sdsd" for="customFileLang">{{__('Upload')}}</label>
  //var new_input = "<input type='file' id='new_" + new_chq_no + "'>";
  var new_input = "<input type='file' class='form-control' id='new_" + new_chq_no + "' name='additionalDocs[]'>";

  $('#new_chq').append(new_input);
  
  $('#total_chq').val(new_chq_no);
}

function removeFunction() {
  var last_chq_no = $('#total_chq').val();

  if (last_chq_no > 1) {
    $('#new_' + last_chq_no).remove();
    $('#total_chq').val(last_chq_no - 1);
  }
}

    
    function ShowHideDivFunction(value)
    {
        alert(value);
    }
    </script>
   
@stop