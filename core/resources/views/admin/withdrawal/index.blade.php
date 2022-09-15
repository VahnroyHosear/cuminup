@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Settlements')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th>{{__('Ref')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Amount')}}</th>                                                                     
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Bank')}}</th>
                                    <th>{{__('Acct No')}}</th>
                                    <th>{{__('Acct Name')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Last Update')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($withdraw as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>#{{$val->reference}}</td>
                                    <td><a href="{{url('admin/manage-user')}}/{{$val->user['id']}}">{{$val->user['first_name'].' '.$val->user['last_name']}}</a></td>
                                    <td>{{$currency->symbol.number_format($val->amount)}}</td>
                                    <td>
                                        @if($val->status==0)
                                            <span class="badge badge-pill badge-danger">{{__('Unpaid')}}</span>
                                        @elseif($val->status==1)
                                            <span class="badge badge-pill badge-success">{{__('Paid')}}</span> 
                                        @elseif($val->status==2)
                                            <span class="badge badge-pill badge-info">{{__('Declined')}}</span>
                                        @endif
                                    </td> 
                                    <td>{{$val->dbank['name']}}</td>
                                    <td>{{$val->dbank['acct_no']}}</td>
                                    <td>{{$val->dbank['acct_name']}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                                    @if($val->status==0)
                                                        <a class='dropdown-item' href="{{route('withdraw.decline', ['id' => $val->id])}}">{{__('Decline')}}</a>
                                                        <a class='dropdown-item' href="{{route('withdraw.approve', ['id' => $val->id])}}">{{__('Approve')}}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                    
                                </tr>
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
                                                        <a  href="{{route('withdraw.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
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
            </div>
        </div>
    </div>
</div>
@stop