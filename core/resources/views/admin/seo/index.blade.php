@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="">
              <div class="card-body">
                <div class="">
                  <a data-toggle="modal" data-target="#create-plan" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Create')}}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="modal fade" id="create-plan" tabindex="-1" role="dialog" aria-labelledby="create-plan" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-body p-0">
                    <div class="card bg-white border-0 mb-0">
                      <div class="card-header">
                        <h3 class="mb-0">{{__('Create New Seo')}}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="card-body">
                        <form action="{{route('admin.seo.create')}}" method="post" id="modal-details">
                          @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{__('Page')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="page" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{__('Title')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{__('Key Words')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="key_words" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{__('Content')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="content" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{__('Status')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inctive</option>
                                    </select>
                                </div>
                            </div> 
                            
                            <div class="text-right">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm" form="modal-details">{{__('Create')}}</button>
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
    
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0">{{__('SEO Details')}}</h3>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-buttons">
                    <thead>
                        <tr>
                            <th>{{__('S/N')}}</th>
                            <th>{{__('Page')}}</th>
                            <th>{{__('Title')}}</th>
                             <th>{{__('Description')}}</th>  
                            <th>{{__('Key Words')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>    
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($seo_details as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td>{{$val->page}}</td>
                            <td>{{$val->title}}</td>
                            <td>{{$val->content}}</td>
                            <td>{{$val->key_words}}</td>
                            
                            <td>
                                @if($val->status==0)
                                    <span class="badge badge-pill badge-info">{{__('inactive')}}</span>
                                @elseif($val->status==1)
                                    <span class="badge badge-pill badge-success">{{__('Active')}}</span> 
                                @endif
                            </td>  
                            <td>
                                <div class="dropdown">
                                    <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a data-toggle="modal" data-target="#edit{{$val->id}}" href="" class="dropdown-item">{{__('Edit')}}</a>
                                        <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                    </div>
                                </div>
                            </td>                   
                        </tr>
                        
                        <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card bg-white border-0 mb-0">
                                            <div class="card-header">
                                                <h3 class="mb-0">{{__('Update')}}</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('admin.seo.update', ['id' => $val->id])}}" method="post" id="modal-update{{ $val->id }}">
                                                  @csrf
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12">{{__('Page')}}<span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="page" class="form-control" value="{{ $val->page }}" required>
                                                        </div>
                                                    </div> 
                            
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12">{{__('Title')}}<span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="title" class="form-control" value="{{ $val->title }}" required>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12">{{__('Key Words')}}<span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="key_words" class="form-control" value="{{ $val->key_words }}" required>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12">{{__('Content')}}<span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="content" class="form-control" value="{{ $val->content }}" required>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12">{{__('Status')}}<span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <select name="status" class="form-control">
                                                                <option value="1" <?php if($val->status == 1){ echo "selected"; } ?>>Active</option>
                                                                <option value="0" <?php if($val->status == 0){ echo "selected"; } ?>>Inctive</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm" form="modal-update{{ $val->id }}">{{__('Update')}}</button>
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
                                                <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                            </div>
                                            <div class="card-body px-lg-5 py-lg-5 text-right">
                                                <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                <a  href="{{route('admin.seo.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
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