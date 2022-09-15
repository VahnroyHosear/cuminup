@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div><a  style="float:right;margin-top:30px!important;margin-right:20px" href="{{url('admin/virtual_cards')}}" class="btn btn-primary">{{__('Go Back')}}</a></div>

                    <div class="card-header">
                        <h3 class="card-title">{{__('Transactions List')}}</h3>
                    </div>
                    <div class="row"> 
                 <div class="col-sm-1"></div>
                   
                    <div class="col-sm-3">
                    <select class="form-control" onchange="selectedValue(this.value)">
                        <option value="">Select by Status</option>
                        
                        <option> APPROVED</option> 
                        <option> DECLINES</option> 
                        
                    </select> 
                    </div>
                    <div class="col-sm-3">
                    <select class="form-control" onchange="selectedValue(this.value)">
                        <option value="">Select by Merchant Name</option>
                         @foreach($AllTransactionsList as $k=>$TransactionsDetails)
                        <option> {{$TransactionsDetails->merchant->descriptor}}</option> 
                        @endforeach
                    </select> 
                    </div>
                    
                    
                </div>  
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                  <th>S / N</th>
                                  <th>User Name</th>
                                  <th>Name on Card</th>
                                  <th>Last Four</th>
                                  <th>Merchant</th>
                                  <th>Amount</th>
                                  <!--th>Spend Limit</th-->
                                  <th>Status</th>
                                  <th>Authorized</th>
                                  <th>Funded on</th>
                                  <th>Bank</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($AllTransactionsList as $k=>$TransactionsDetails)
                 <tr>
                <td>{{++$k}}</td>
                <td>
                    @php $virtualCardUserData = DB::table('virtual_cards')->where('last_four_digit',$TransactionsDetails->card->last_four)->first();@endphp
                    @if(!empty($virtualCardUserData))
                    @php $UserData = DB::table('users')->where('id',$virtualCardUserData->user_id)->first();@endphp
                    {{$UserData->first_name}} {{$UserData->last_name}}
                    @else
                    {{'NA'}}
                    @endif
                </td>
                <td>{{$TransactionsDetails->card->memo}}</td>
                <td>XXXX XXXX XXXX {{$TransactionsDetails->card->last_four}}</td>
                <td>{{$TransactionsDetails->merchant->descriptor}}</td>
                  <td>{{$currency->symbol.number_format($TransactionsDetails->amount/100,2)}} / {{$currency->symbol.number_format($TransactionsDetails->card->spend_limit/100,2)}}</td>
                 <!--td>{{$currency->symbol.number_format($TransactionsDetails->card->spend_limit)}}</td-->
                  <td>{{$TransactionsDetails->result}}</td>
                   <td>{{date("Y/m/d h:i:A", strtotime($TransactionsDetails->created))}}</td>
                    <td>{{date("Y/m/d h:i:A", strtotime($TransactionsDetails->card->funding->created))}}</td>
                     <td>{{$TransactionsDetails->card->funding->account_name}}</td>
                 </tr>        
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