
@extends('userlayout')

@section('content')
<style>
div.dt-top-container {
  display: grid;
  grid-template-columns: 100px auto auto;
}

div.dt-center-in-div {
 /* margin: 0 auto;  */
}

div.dt-filter-spacer {
  margin: 10px 0;
}
</style>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('All Transactions')}}</h3>
      </div>
      @if(count($transactions) > 0)
      <div class="table-responsive py-4">
           <div class="row"> 
                 <div class="col-sm-6"></div>
                   
                    <div class="col-sm-3">
                    <select class="form-control" onchange="selectedValue(this.value)">
                        <option value="">Select by Services</option>
                        <option> Deposit</option> 
                        <option> Donation</option>
                         <option> Prepaid Card</option>
                          <option> Prepaid Card Plan</option>
                           <option> Subscribe</option>
                           <option> Transfer</option>
                        
                    </select> 
                    </div>
                   
                    
                    
                </div>
        <table class="table table-flush" id="datatable-buttons_3434">
          <thead class="">
            <tr>
              <th>{{__('Date')}}</th>
              <th>{{__('Type')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Charge')}}</th>
              <th>{{__('Total')}}</th>
               <th>{{__('DR/CR')}}</th>
              <th>{{__('Status')}}</th>
             <th>{{__('Details')}}</th>
             
            </tr>
          </thead>
          <tbody>  
            @foreach($transactions as $k=>$val)
              <tr>
                 <td class="shorting_1"><span style="display:none;">{{strtotime($val->created_at)}}</span>{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                <td>
                    @if($val->type == 1)
                    {{__('Deposit')}}
                    @elseif($val->type == 2)
                    {{__('Donation')}}
                    @elseif($val->type == 3)
                    {{__('Invoice')}}
                    @elseif($val->type == 4)
                    {{__('Prepaid Card')}}
                    @elseif($val->type == 5)
                    {{__('Prepaid Card Plan')}}
                    @elseif($val->type == 11)
                    {{__('Single Charge')}}
                    @else
                    {{__('NA')}}
                    @endif
                </td>
                <td>#{{$val->ref_id}}</td>
                <td>{{$currency->symbol.number_format($val->amount-$val->charge,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->charge,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                 <td>
                     
                     @if($val->type == 1)
                    <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                    @elseif($val->type == 2)
                    <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                    @elseif($val->type == 3)
                    {{__('Invoice')}}
                    @elseif($val->type == 4)
                   <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                    @elseif($val->type == 5)
                   <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                    @elseif($val->type == 11)
                   <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                    @else
                    {{__('NA')}}
                    @endif
                    
                </td>
                <td>@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</td>
               <td><button class="btn btn-default" data-toggle="modal" data-target="#myModal{{$val->ref_id}}">{{__('View')}}</button></td>
               
                <!-- Modal -->
                  <div class="modal fade" id="myModal{{$val->ref_id}}" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">{{__('View Transaction Details')}}</h4>
                          <button type="button" class="close" data-dismiss="modal" style="float:right;margin-top: -20px;">&times;</button>
                        </div>
                        <div class="modal-body" style="margin-top:-20px;">
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Created')}}</div>
                             <div class="col-6" style="border: 1px solid;">{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Transaction Type')}}</div>
                             <div class="col-6" style="border: 1px solid;"> @if($val->type == 1)
                                {{__('Deposit')}}
                                @elseif($val->type == 2)
                                {{__('Donation')}}
                                @elseif($val->type == 3)
                                {{__('Invoice')}}
                                @elseif($val->type == 4)
                                {{__('Prepaid Card')}}
                                @elseif($val->type == 5)
                                {{__('Prepaid Card Plan')}}
                                @elseif($val->type == 11)
                                {{__('Single Charge')}}
                                @else
                                {{__('NA')}}
                                @endif
                            </div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Debit/Credit')}}</div>
                             <div class="col-6" style="border: 1px solid;"> 
                                @if($val->type == 1)
                                <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                                @elseif($val->type == 2)
                                <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                                @elseif($val->type == 3)
                                {{__('Invoice')}}
                                @elseif($val->type == 4)
                               <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                                @elseif($val->type == 5)
                               <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                                @elseif($val->type == 11)
                               <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                                @else
                                {{__('NA')}}
                                @endif
                            </div>
                         </div>
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Amount')}}</div>
                             <div class="col-6" style="border: 1px solid ;">{{$currency->symbol.number_format($val->amount-$val->charge,2)}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Status')}}</div>
                             <div class="col-6" style="border: 1px solid;">@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('User')}}</div>
                             <div class="col-6" style="border: 1px solid;">{{__('Own Wallet')}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Reference ID')}}</div>
                             <div class="col-6" style="border: 1px solid;">#{{$val->ref_id}}</div>
                         </div> 
                        </div>
                       
                      </div>
                    <!--END MODEL-->  
                    </div>
                  </div>
            @endforeach
            
            @foreach($transfers as $k=>$val)
              <tr>
               <td class="shorting_1"><span style="display:none;">{{strtotime($val->created_at)}}</span>{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                <td>
                    {{__('Transfer')}}
                </td>
                <td>#{{$val->ref_id}}</td>
                <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->charge,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->amount+$val->charge,2)}}</td>
                  <td>
                      @if($val->receiver_id == Auth::id())
                       <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                       @elseif($val->sender_id == Auth::id())
                        <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                       @endif
                  </td>
                <td>@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</td>
                
                 <td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$val->ref_id}}">{{__('View')}}</a></td>
                 <!-- Modal -->
                  <div class="modal fade" id="myModal{{$val->ref_id}}" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">{{__('View Transaction Details')}}</h4>
                          <button type="button" class="close" data-dismiss="modal" style="float:right;margin-top: -20px;">&times;</button>
                        </div>
                        <div class="modal-body" style="margin-top:-20px;">
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Created')}}</div>
                             <div class="col-6" style="border: 1px solid;">{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Transaction Type')}}</div>
                             <div class="col-6" style="border: 1px solid;"> {{__('Transfer')}}
                                
                            </div>
                         </div> 
                          <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Debit/Credit')}}</div>
                             <div class="col-6" style="border: 1px solid;"> @if($val->receiver_id == Auth::id())
                       <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                       @elseif($val->sender_id == Auth::id())
                        <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                       @endif
                                
                            </div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Amount')}}</div>
                             <div class="col-6" style="border: 1px solid ;">{{$currency->symbol.number_format($val->amount,2)}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Status')}}</div>
                             <div class="col-6" style="border: 1px solid;">@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('User')}}</div>
                             <div class="col-6" style="border: 1px solid;">@if(!empty($val->receiver['email']))
                          @if($val->receiver['email']!=null)
                          <p class="text-sm text-dark mb-0">{{$val->receiver['email']}}</p>
                          @else
                          <p class="text-sm text-dark mb-0">{{$val->temp}}</p>
                          @endif
                          @endif</div>
                         </div>
                         @if($val->sender_id != Auth::id())
                         @php $userDetails = DB::table('users')->where('id',$val->sender_id)@endphp
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('User Email')}}</div>
                             <div class="col-6" style="border: 1px solid;">{{$userDetails->email}}</div>
                         </div>
                         @endif
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Reference ID')}}</div>
                             <div class="col-6" style="border: 1px solid;">#{{$val->ref_id}}</div>
                         </div> 
                        </div>
                       
                      </div>
                    <!--END MODEL--> 
            @endforeach
            
            @foreach($subscribers as $k=>$val)
              <tr>
               <td class="shorting_1"> <span style="display:none;">{{strtotime($val->created_at)}}</span>{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                <td>
                    {{__('Subscribe')}}
                </td>
                <td>#{{$val->ref_id}}</td>
                <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->charge,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->amount+$val->charge,2)}}</td>
                  <td>
                      <span class="badge badge-pill badge-danger">Debit</span>
                   </td>
                <td>@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</td>
                 
                 <td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$val->ref_id}}">{{__('View')}}</a></td>
                 
                   <!-- Modal -->
                  <div class="modal fade" id="myModal{{$val->ref_id}}" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">{{__('View Transaction Details')}}</h4>
                          <button type="button" class="close" data-dismiss="modal" style="float:right;margin-top: -20px;">&times;</button>
                        </div>
                        <div class="modal-body" style="margin-top:-20px;">
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Created')}}</div>
                             <div class="col-6" style="border: 1px solid;">{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Transaction Type')}}</div>
                             <div class="col-6" style="border: 1px solid;"> {{__('Subscribe')}}
                                
                            </div>
                         </div>
                         
                          <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Plan Name')}}</div>
                             <div class="col-6" style="border: 1px solid;"> {{$val->plan['name']}} 
                                
                            </div>
                         </div>
                          <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Debit/Credit')}}</div>
                             <div class="col-6" style="border: 1px solid;"> @if($val->receiver_id == Auth::id())
                       <span class="badge badge-pill badge-success">{{__('Credit')}}</span>
                       @elseif($val->user_id == Auth::id())
                        <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                       @endif
                                
                            </div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Amount')}}</div>
                             <div class="col-6" style="border: 1px solid ;">{{$currency->symbol.number_format($val->amount,2)}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Status')}}</div>
                             <div class="col-6" style="border: 1px solid;">@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('User')}}</div>
                             <div class="col-6" style="border: 1px solid;">
                          @if(!empty($val->plan['user_id']))
                         @php $senderDetails =  DB::table('users')->where('id',$val->plan['user_id'])->first(); @endphp
                         {{$senderDetails->first_name}} {{$senderDetails->last_name}}
                         @else
                         {{'NA'}}
                          @endif</div>
                         </div>
                         
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Reference ID')}}</div>
                             <div class="col-6" style="border: 1px solid;">#{{$val->ref_id}}</div>
                         </div> 
                        </div>
                       
                      </div>
                    <!--END MODEL--> 
            @endforeach
            
            
          </tbody>
        </table>
      </div>
      @else
      <center>
           <div class="col-lg-12">
              <br>
                <p class="text-center card-text mt-8">{{__('No deposit log Found!')}}</p>
               <h3>{{__('Let’s Create your first deposit log')}}</h3>
             <a href="{{url('user/transfer')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Get Started')}}</a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
            
          </div></center>
      @endif
    </div>

@stop
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>



<script>
function selectedValue(selectedvalue)
{
    var oTable = $('#datatable-buttons_3434').DataTable();
    oTable.search(selectedvalue).draw();

}
$(document).ready(function() {
    $('#datatable-buttons_3434').DataTable( {
        dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<ip>',
        "autoWidth": true,
            "lengthChange": true,
            "pageLength": 25,
           
      
       "order": [[ 0, "desc" ]], //or asc 
    "columnDefs" : [{"targets":0, "type":"date-eu"}],
        buttons: [
            'copy','csv' ,'excel' ,'print'
            ,{
            extend: 'pdfHtml5',
                //orientation: 'landscape',
               // pageSize: 'LEGAL'
               }
        ],
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
    } );
} );


       
</script>