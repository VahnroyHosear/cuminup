
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Bank Accounts')}}</h3>
        <a style="float:right;margin-top:30px!important;margin-right:20px" data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Add account')}}</a>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Bank')}}</th>
              <th>{{__('Name')}}</th>
              <th>{{__('Type')}}</th>
              <th>{{__('Account No.')}}</th>
              <th>{{__('ABA Routing')}}</th>
              <th>{{__('Created')}}</th>
              <th>{{__('Action')}}</th>
            </tr>
          </thead>
          <tbody>  
                @foreach($bank as $k=>$val)
                    @if(!empty($val->acct_no))
                        <tr>
                            <td>{{++$k}}.</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->acct_name}}</td>
                            <td>
                                @if($val->status==0)
                                    <a href="{{route('bank.default', ['id' => $val->id])}}" class="badge badge-pill badge-danger">{{__('Make Default')}}</a>
                                @else
                                    <span class="badge badge-pill badge-success">{{__('Default')}}</span>
                                @endif
                            </td>
                            <td>{{$val->acct_no}}</td>
                            <td>{{$val->swift}}</td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                            <td style="display: flex;">
                                        <a data-toggle="modal" data-target="#verify-form{{$val->id}}" href="#" class="btn btn-sm btn-neutral">{{__('Verify')}}</a>
                                        <!--<a data-toggle="modal" data-target="#modal-form{{$val->id}}"href="#" class="btn btn-sm btn-neutral">{{__('Edit')}}</a>-->
                                          
                                        @if($val['lithic_status'] == 'DELETED')
                                            <a class="btn btn-sm btn-warning">{{__('Disabled')}}</a>
                                        @else
                                            <form action="{{url('user/delete_bank')}}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <input type="hidden" name="id" value="{{$val['id']}}">
                                                <input type="hidden" name="state" value="DELETED">
                                                <button type="submit" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
                                            </form>
                                        @endif
                    
                                    </div>
                                </div>
                            </td> 
                        </tr>
                    @endif
                    
                    <div class="modal fade" id="modal-form{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card border-0 mb-0">
                                <div class="card-header">
                                  <h3 class="mb-0">{{__('Edit Bank')}} <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                                </div>
                                <div class="card-body">
                                  <form role="form" action="{{url('user/edit_bank')}}" method="post"> 
                                  @csrf
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2">{{__('Bank')}}</label>
                                        <div class="col-lg-10">
                                          <input type="text" name="name" placeholder="Bank name" class="form-control" value="{{$val['name']}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2">{{__('Acct Name')}}</label>
                                          <div class="col-lg-10">
                                        <input type="text" name="acct_name" placeholder="Account name" class="form-control" value="{{$val['acct_name']}}">
                                      </div>
                                    </div>                           
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2">{{__('Account No')}}</label>
                                          <div class="col-lg-10">
                                        <input type="number" name="acct_no" placeholder="Account number" class="form-control" value="{{$val['acct_no']}}">
                                        <input type="hidden" name="id" value="{{$val['id']}}">
                                      </div>
                                    </div>                    
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2">{{__('Swift')}}</label>
                                          <div class="col-lg-10">
                                        <input type="text" name="swift" placeholder="Swift code" class="form-control" value="{{$val['swift']}}">
                                        <input type="hidden" name="id" value="{{$val['id']}}">
                                      </div>
                                    </div>
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-success btn-sm">{{__('Update Acount')}}</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                      
                    <div class="modal fade" id="verify-form{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card border-0 mb-0">
                                <div class="card-header">
                                  <h3 class="mb-0">{{__('Validate Bank')}} <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                                </div>
                                <div class="card-body">
                                  <form role="form" action="{{url('user/verify_bank')}}" method="post"> 
                                  @csrf
                                    <input type="hidden" name="id" value="{{$val['id']}}">
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2">{{__('Amount 1')}}</label>
                                        <div class="col-lg-10">
                                          <input type="text" name="amount1" placeholder="Amount 1" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-form-label col-lg-2">{{__('Amount 2')}}</label>
                                          <div class="col-lg-10">
                                        <input type="text" name="amount2" placeholder="Amount 2" class="form-control" required>
                                      </div>
                                    </div>  
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-success btn-sm">{{__('Validate Bank')}}</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card border-0 mb-0">
                                <div class="card-header">
                                  <h3 class="mb-0">{{__('Add Account')}} <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                                </div>
                                <div class="card-body">
                                  <form role="form" action="{{url('user/add_bank')}}" method="post"> 
                                  @csrf
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2">{{__('Bank')}}</label>
                                      <div class="col-lg-10">
                                        <input type="text" name="name" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2">{{__('Acct Name')}}</label>
                                      <div class="col-lg-10">
                                        <input type="text" name="acct_name" class="form-control" required>
                                      </div>
                                    </div>                                                                      
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2">{{__('Account No')}}</label>
                                      <div class="col-lg-10">
                                        <input type="number" name="acct_no" class="form-control" required>
                                      </div>
                                    </div>                        
                                    <div class="form-group row">
                                      <label class="col-form-label col-lg-2">{{__('ABA Routing #')}}</label>
                                      <div class="col-lg-10">
                                        <input type="text" name="swift" class="form-control" required>
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
                        </div>
                    </div>
      
                @endforeach
          </tbody>
        </table>
      </div>
    </div>

@stop