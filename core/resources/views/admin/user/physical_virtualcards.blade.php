@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div><a  style="float:right;margin-top:30px!important;margin-right:20px" href="{{url('admin/virtual_cards')}}" class="btn btn-primary">{{__('Go Back')}}</a></div>

                    <div class="card-header">
                        <h3 class="card-title">{{__('Physical Card List')}}</h3>
                    </div>
                    <div class="row"> 
                 <div class="col-sm-1"></div>
                   
                    <!--div class="col-sm-3">
                    <select class="form-control" onchange="selectedValue(this.value)">
                        <option value="">Select by Status</option>
                        
                        <option> APPROVED</option> 
                        <option> DECLINES</option> 
                        
                    </select> 
                    </div-->
                    <!--div class="col-sm-3">
                    <select class="form-control" onchange="selectedValue(this.value)">
                        <option value="">Select by Merchant Name</option>
                        
                    </select> 
                    </div-->
                    
                    
                </div>  
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                  <th>S / N</th>
                                  <th>User Name</th>
                                  <th>Card Last Digits</th>
                                  <th>Spend Limit</th>
                                  <th>Shipping Charge</th>
                                  <th>Address</th>
                                  <th>Delivery Status</th>
                                  <th>Created At</th>
                                  <th>Updated At</th>
                                  <th>Action</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($AllphysicalCardList as $k=>$details)
                                    <tr>
                                        <td>{{++$k}}</td>
                                        <td>
                                            @php 
                                                $virtualCardUserData = DB::table('virtual_cards')->where('id',$details->vcard_id)->first();
                                            @endphp
                                            
                                            @if(!empty($virtualCardUserData))
                                            @php $UserData = DB::table('users')->where('id',$virtualCardUserData->user_id)->first();@endphp
                                            {{$UserData->first_name??''}} {{$UserData->last_name??''}}
                                            @else
                                            {{'NA'}}
                                            @endif
                                        </td>
                                       
                                        <td>{{'XXXXXXXX'}}{{$virtualCardUserData->last_four_digit}}</td>
                                        <td>{{$currency->symbol.number_format($virtualCardUserData->spend_limit,2)}}</td>
                                        <td>{{$currency->symbol.number_format($details->shipping_charge,2)}}</td>
                                        <td>{{$details->postal_address}} {{$details->postal_city}} {{$details->postal_state}} {{$details->postal_country}} {{'-'}} {{$details->postal_zip_code}}</td>
                                         
                                        <td>
                                            @if($details->delivered_status == 1)
                                               {{'Delivered'}}
                                            @else($details->delivered_status == 0)
                                               {{'Undelivered'}}
                                            @endif
                                        </td>
                                        <td>{{date("Y/m/d h:i:A", strtotime($details->created_at))}}</td>
                                        <td>{{date("Y/m/d h:i:A", strtotime($details->updated_at))}}</td>
                                        <td>
                                            <div class="">
                                                <div class="dropdown">
                                                    <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a data-toggle="modal" data-target="#edit{{$details->id}}" href="" class="dropdown-item"><i class="fa fa-pen"></i>{{__('Edit')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>     
                                    </tr> 
                                    <div class="modal fade" id="edit{{$details->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card bg-white border-0 mb-0">
                                                        <div class="card-header">
                                                            <h3 class="mb-0">Update Status</h3>
                                                        </div>
                                                          <form action="{{route('admin.edit_virtual_card')}}" method="POST">
                                                            @csrf
                                                            
                                                            
                                                            <div class="row p-3">
                                                                <div class="col-sm-3">
                                                                    {{__('Delivery Status')}}</label>
                                                                </div>
                                                                 <div class="col-sm-9">
                                                                     <select class="form-control" name="delivery_status">
                                                                         <option>Select Status</option>
                                                                         <option value="0">Undelivered</option>
                                                                          <option value="1">Delivered</option>
                                                                        </select> 
                                                                </div>
                                                            </div>
                                                            
                                                        <div class="card-body px-lg-5 py-lg-5 text-right">
                                                            <button type="button" class="btn btn-neutral" data-dismiss="modal">{{__('Close')}}</button>
                                                            <button  type="submit" class="btn btn-success">{{__('Update Now')}}</button>
                                                        </div>
                                                        </form>
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
<script>
function selectedValue(selectedvalue)
{
    var oTable = $('#datatable-buttons').DataTable();
    oTable.search(selectedvalue).draw();

}
</script>
@stop