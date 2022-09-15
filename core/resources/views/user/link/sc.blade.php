@extends('userlayout')

@section('content')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

</head>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#single-charge" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Single Charge')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="single-charge" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Create New Payment Link')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Single Charge allows you to create payment links for your customers, Transaction Charge is {{$set->single_charge}}% per transaction</span>

                  </div>
                  <div class="card-body">
                    <form action="{{route('submit.singlecharge')}}" method="post" id="modal-details">
                      @csrf
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12">{{__('Payment link name')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="number" class="form-control" name="amount" placeholder="0.00" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </span>
                                    </div>
                                    <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                </div>
                            </div>  
                        </div>  
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                          <input type="text" name="test_234" id="descript_input" style="visibility: hidden;" required>
                           <br><span id="description_error" style="color:red;margin-left:15px;"></span>
                          <div class="col-lg-12">
                              <textarea type="text" name="description" rows="4" class="tinymce form-control" id="description_id"></textarea>
                          </div>
                        </div>   
                        <hr>             
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Redirect after payment  - Optional')}}</label>
                          <div class="col-lg-12">
                              <input type="text" name="redirect_url" class="form-control" placeholder="https://google.com" >
                          </div>
                        </div> 
                        <div class="text-center">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details" id="submit_btn_id" onclick="CheckForm()">{{__('Create link')}}</button>
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
    <div class="row">
      <div class="col-md-12">
        <div class="row">  
          @if(count($links)>0)
            
             <div class="card">
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Payment URL')}}</th>
              <th>{{__('Status')}}</th>
              <th>{{__('Product Type')}}</th>
              <th>{{__('Price')}}</th>
              <th>{{__('Date')}}</th>
             <!--th>{{__('Updated')}}</th-->
             <th>{{__('Action')}}</th>
            </tr>
          </thead>
          <tbody>  
            @foreach($links as $k=>$val)
            <tr>
                <td>{{++$k}}</td>
                <td><a class="btn-icon-clipboard text-primary" data-clipboard-text="{{route('scview.link', ['id' => $val->ref_id])}}" title="Copy">{{route('scview.link', ['id' => $val->ref_id])}}</a></td>
                <td> @if($val->active==1)
                                <span class='badge badge-pill badge-success' >{{ __('Activate')}}</span>
                            @else
                                <span class='badge badge-pill badge-danger' >{{ __('Disable')}}</span>
                            @endif
                            </td>
                <td>{{$val->name}}</td>
                <td>@if($val->amount==null) Not fixed @else {{$currency->symbol.number_format($val->amount,2)}} @endif</td>
                <td>{{date("h:i:A j, M Y", strtotime($val->created_at))}}</td>
                <!--td>{{date("h:i:A j, M Y", strtotime($val->updated_at))}}</td-->
               <td>      <button type="button" class="btn btn-sm btn-neutral mr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-left">
                            @if($val->active==1)
                                <a class='dropdown-item' href="{{route('sclinks.unpublish', ['id' => $val->id])}}">{{ __('Disable')}}</a>
                            @else
                                <a class='dropdown-item' href="{{route('sclinks.publish', ['id' => $val->id])}}">{{ __('Activate')}}</a>
                            @endif
                            <a class="dropdown-item" href="{{route('user.sclinkstrans', ['id' => $val->id])}}">{{__('Transactions')}}</a>
                           
                            <a class="dropdown-item" data-toggle="modal" data-target="#edit{{$val->id}}" href="#">{{__('Edit')}}</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#delete{{$val->id}}" href="">{{__('Delete')}}</a>
                          </div></td>
            </tr>    
            <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0">{{__('Edit Payment Link')}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="{{route('update.sclinks')}}" method="post">
                            @csrf
                            <div class="form-group row">
                              <div class="col-lg-6">
                                  <label class="col-form-label col-lg-12">{{__('Payment link name')}}<span class="text-danger">*</span></label>
                                  <div class="col-lg-12">
                                      <input type="text" name="name" class="form-control" value="{{$val->name}}" required>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                                  <div class="col-lg-12">
                                      <div class="input-group">
                                          <span class="input-group-prepend">
                                              <span class="input-group-text">{{$currency->symbol}}</span>
                                          </span>
                                          <input type="number" class="form-control" name="amount" value="{{$val->amount}}" placeholder="0.00">
                                          <span class="input-group-append">
                                              <span class="input-group-text">.00</span>
                                          </span>
                                      </div>
                                      <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                  </div>
                              </div>  
                            </div>  
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                             
                              <div class="col-lg-12">
                                  <textarea type="text" name="description" rows="4" class="form-control tinymce">{{$val->description}}</textarea>
                              </div>
                            </div>   
                            <hr>             
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12">{{__('Redirect after payment  - Optional')}}</label>
                              <div class="col-lg-12">
                                  <input type="text" name="redirect_url" class="form-control" value="{{$val->redirect_link}}" placeholder="https://google.com" >
                              </div>
                            </div>  
                            <input type="hidden" name="id" value="{{$val->id}}">                                     
                            <div class="text-right">
                              <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-header">
                                      <span class="mb-0 text-sm">{{__('Are you sure you want to delete this?, all transaction related to this payment link will also be deleted')}}</span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                      <a  href="{{route('delete.user.link', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
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
          @else
          <center><div class="col-md-12">
              <br>
                <p class="text-center card-text mt-8">{{__('No payment url found!')}}</p>
               <h3>{{__('Create your first payment url')}}</h3>
              <a data-toggle="modal" data-target="#single-charge" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Get Started')}}</a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
          </div></center>
         
          @endif
        </div> 
        <div class="row">
          <div class="col-md-12">
          {{ $links->links() }}
          </div>
        </div>
      </div> 
    </div>
@stop

<script>
  function CheckForm()
{
    if(tinyMCE.get('description_id').getContent().length == 0)
    {
        $('#description_error').html('Required field missing!');
        $("#descript_input").val('');
        //$("#submit_btn_id").attr("disabled", true);
        //$('#submit_btn_id').prop('');
    } else {
        $("#descript_input").val('1');
        $('#description_error').html('');
    }
    
}

</script>
