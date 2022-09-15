@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0">{{__('Create Ticket')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('submit-ticket')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Subject')}}</label>
                            <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                <input type="text" name="subject" class="form-control" required="">
                                </div>
                            </div>
                        </div>                       
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Reference')}} </label>
                            <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                <input type="text" name="ref_no" class="form-control" placeholder="Transaction reference number">
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Priority')}}</label>
                            <div class="col-lg-10">
                                <select class="form-control select" name="priority" required>
                                    <option  value="Low">{{__('Low')}}</option>
                                    <option  value="Medium">{{__('Medium')}}</option> 
                                    <option  value="High">{{__('High')}}</option>  
                                </select>
                            </div>
                        </div>                      
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Type')}}</label>
                            <div class="col-lg-10">
                                <select class="form-control select" name="type" required>
                                    <option  value="Virtual Card">{{__('Virtual Card')}}</option>
                                    <option  value="Subscription">{{__('Subscription')}}</option>
                                    <option  value="Money Transfer">{{__('Money Transfer')}}</option> 
                                    <option  value="Request Money">{{__('Request Money')}}</option>  
                                    <option  value="Settlement">{{__('Settlement')}}</option>  
                                    <option  value="Store">{{__('Store')}}</option>  
                                    <option  value="Single Charge">{{__('Single Charge')}}</option>  
                                    <option  value="Donation">{{__('Donation')}}</option>  
                                    <option  value="Invoice">{{__('Invoice')}}</option>  
                                    <option  value="Charges">{{__('Charges')}}</option>  
                                    <option  value="Bank Transfer">{{__('Bank transfer')}}</option>  
                                    <option  value="Deposit">{{__('Deposit')}}</option>  
                                    <option  value="Others">{{__('Others')}}</option>  
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Details')}}</label>
                            <div class="col-lg-10">
                                <textarea name="details" class="form-control" rows="6" required placeholder="Description"></textarea>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Select a file')}} <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileLang" name="image[]" multiple required>
                                    <label class="custom-file-label" for="customFileLang">{{__('Choose Media')}}</label>
                                    <small>Format supported: PDF, JPG, JPEG, PNG files,
Max Size: 10MB.</small>
                                </div> 
                            </div>
                        </div>                
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
@stop