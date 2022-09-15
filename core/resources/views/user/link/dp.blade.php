@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#donation-page" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Donation Page')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">   
        <div class="modal fade" id="donation-page" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Create New Donation Link')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Create a donation page for your customers, Transaction Charge is {{$set->donation_charge}}% per donation</span>

                  </div>
                  <div class="card-body">
                    <form action="{{route('submit.donationpage')}}"enctype="multipart/form-data" method="post" id="modal-detailx">
                      @csrf
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12">{{__('Name')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12">{{__('Goal')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="number" class="form-control" name="goal" placeholder="0.00" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </span>
                                    </div>
                                </div>
                            </div>  
                        </div> 
                        <div class="form-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" name="image" accept="image/*" required>
                            <label class="custom-file-label" for="customFileLang">{{__('Image')}}<span class="text-danger">*</span></label>
                          </div> 
                        </div>    
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                          <input type="text" name="test_234" id="descript_input" style="visibility: hidden;" required>
                           <br><span id="description_error" style="color:red;margin-left:15px;"></span>
                          <div class="col-lg-12">
                              <textarea type="text" name="description" rows="6" class="tinymce form-control" id="description_id"></textarea>
                          </div>
                        </div>  
                        <div class="text-center">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-detailx" id="submit_btn_id" onclick="CheckForm()">{{__('Create Page')}}</button>
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
              <th>{{__('Doners')}}</th>
              <th>{{__('Collected/Goal')}}</th>
              <th>{{__('Created')}}</th>
              <th>{{__('Action')}}</th>
            </tr>
          </thead>
          <tbody> 
          
         
               @foreach($links as $k=>$val)
                @php 
                  $donors=App\Models\Donations::wheredonation_id($val->id)->wherestatus(1)->get();
                  $donated=App\Models\Donations::wheredonation_id($val->id)->wherestatus(1)->sum('amount');
                  @endphp
            <tr>
                <td>{{++$k}}</td>
                <td><a class="btn-icon-clipboard text-primary" data-clipboard-text="{{route('dpview.link', ['id' => $val->ref_id])}}" title="Copy">{{route('dpview.link', ['id' => $val->ref_id])}}</a></td>
                <td> @if($val->active==1)
                              <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                          @else
                              <span class="badge badge-pill badge-danger">{{__('Disabled')}}</span>
                          @endif</td>
                <td>{{$val->name}}</td>          
                <td>{{count($donors)}}</td>
                <td>{{$currency->symbol.number_format($donated)}}/{{$currency->symbol.number_format($val->amount)}}</td>
                <td>{{date("h:i:A j, M Y", strtotime($val->created_at))}}</td>
               <td><button type="button" class="btn btn-sm btn-neutral mr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-left">
                            @if($val->active==1)
                                <a class='dropdown-item' href="{{route('dplinks.unpublish', ['id' => $val->id])}}">{{ __('Disable')}}</a>
                            @else
                                <a class='dropdown-item' href="{{route('dplinks.publish', ['id' => $val->id])}}">{{ __('Activate')}}</a>
                            @endif
                            <a class="dropdown-item" href="{{route('user.dplinkstrans', ['id' => $val->id])}}">{{__('Transactions')}}</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#donors{{$val->id}}" href="#">{{__('Donors')}}</a>
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
                          <h3 class="mb-0">{{__('Edit Payment')}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="{{route('update.dplinks')}}" method="post">
                            @csrf
                              <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label col-lg-12">{{__('Name')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" name="name" class="form-control" value="{{$val->name}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label col-lg-12">{{__('Goal')}}</label>
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" class="form-control" name="goal" value="{{$val->amount}}" min="{{$donated}}" placeholder="0.00" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                            <div class="form-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileLang" name="image" accept="image/*">
                                <label class="custom-file-label" for="customFileLang">{{__('Image')}}</label>
                              </div> 
                            </div> 
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                              <div class="col-lg-12">
                                  <textarea type="text" name="description" rows="5" class="tinymce form-control" required>{{$val->description}}</textarea>
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
              <div class="modal fade" id="donors{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-body px-lg-5 py-lg-5">
                                    <ul class="list-group list-group-flush list my--3">
                                      @if(count($donors)>0)
                                        @foreach($donors as $k=>$xval)
                                            <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="icon icon-shape text-white rounded-circle bg-success">
                                                        <i class="fa fa-bookmark-o"></i>
                                                    </div>
                                                </div>
                                                <div class="col ml--2">
                                                <h4 class="mb-0">
                                                    @if($xval->anonymous==0) 
                                                      @if($xval->user_id==null)
                                                          @php
                                                              $fff=App\Models\Transactions::whereref_id($xval->ref_id)->first();
                                                          @endphp
                                                          {{$fff->first_name.' '.$fff->last_name}}
                                                      @endif
                                                     @if(!empty($xval->user['first_name'])) {{$xval->user['first_name'].' '.$xval->user['last_name']}} @endif
                                                    @else 
                                                      Anonymous 
                                                    @endif
                                                </h4>
                                                <small>{{$currency->symbol.$xval->amount}} @ {{date("h:i:A j, M Y", strtotime($xval->created_at))}}</small>
                                                </div>
                                            </div>
                                            </li>
                                        @endforeach
                                      @else
                                        <li class="list-group-item px-0"><p class="text-sm">No Donors</p></li>
                                      @endif
                                    </ul>
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
            
          @else
            <center><div class="col-md-12">
              <br>
             
                <p class="text-center card-text mt-4">{{__('No donation page found!')}}</p>
               <h3>{{__('Create your first donation page')}}</h3>
              <a data-toggle="modal" data-target="#donation-page" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Get Started')}}</a>
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