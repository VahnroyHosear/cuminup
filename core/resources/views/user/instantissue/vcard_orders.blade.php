   
@extends('userlayout')

@section('content')
<head>
    <style>
    @media only screen and (max-width: 600px) {
              .for-mobile-view2 {
                display: none;
                
              }
              .pc_view_table_id
              {
                display: none;  
              }
            }
     @media only screen and (min-width: 600px) {
      .for-mobile-view {
        display: none;
      }
    }
    </style>        
</head>    
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <!--a data-toggle="modal" data-target="#create-plan" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Plan')}}</a-->
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
                    <h3 class="mb-0">{{__('Create New Plan')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <form action="{{route('submit.plan')}}" method="post" id="modal-details">
                      @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Plan Name')}}<span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">{{$currency->symbol}}</span>
                                    </span>
                                    <input type="number" class="form-control" name="amount" placeholder="0.00" min="10">
                                    <span class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </span>
                                </div>
                                <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Interval')}}</label>
                            <div class="col-lg-12">
                                <select class="form-control select" name="interval">
                                    <option value="1 Hour">{{__('Hourly')}}</option>
                                    <option value="1 Day">{{__('Daily')}}</option>
                                    <option value="1 Week">{{__('Weekly')}}</option>
                                    <option value="1 Month">{{__('Monthly')}}</option>
                                    <option value="4 Months">{{__('Quaterly')}}</option>
                                    <option value="6 Months">{{__('Every 6 Months')}}</option>
                                    <option value="1 Year">{{__('Yearly')}}</option>
                                </select>
                            </div>
                        </div>           
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Number of times to charge a subscriber?')}}</label>
                          <div class="col-lg-12">
                              <input type="text" name="times" class="form-control">
                              <span class="form-text text-xs">Leave empty to charge subscriber indefinitely</span>
                          </div>
                        </div> 
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details">{{__('Create plan')}}</button>
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
        <h3 class="mb-0">{{__('Orders')}}</h3>
                                            <a  style="float:right;margin-top:30px!important;margin-right:20px"  href="{{url('user/virtualcard')}}" class="btn btn-success">{{__('Create Virtual Card')}}</a>

      </div>
      <div class="table-responsive py-4">
          <div class="pc_view_table_id">
        <table class="table table-flush for-mobile-view2" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Order Ref No')}}</th>
               <th>{{__('Product Type')}}</th>
              <th>{{__('Plan name')}}</th>
              <th>{{__('Created / Total')}}</th>
              
              <th>{{__('Card Design')}}</th>
              <th>{{__('Card Fees')}}</th>
              <th>{{__('Status')}}</th>
              <th>{{__('Created')}}</th>

            </tr>
          </thead>
          <tbody>  
            @foreach($virtualCardsOrders as $k=>$OrderDetails)
           
              <tr>
                  <td>{{++$k}}.</td>
                  <td>{{$OrderDetails->order_ref_no}}</td>
                  <td>
                      @if(!empty($OrderDetails->product__type_id))
                      @php $productDetails = DB::table('virtual_cards_product_type')->where('id',$OrderDetails->product__type_id)->first(); @endphp
                      {{$productDetails->name}}
                      @endif
                      </td>
                  <td>@if(!empty($OrderDetails->plan_name))
                       
                      {{$OrderDetails->plan_name}}
                      @endif
                  
                  </td>
                  <td>
                      {{$OrderDetails->created_qty}} / @if(!empty($OrderDetails->plan_quantity)) {{$OrderDetails->plan_quantity}} @endif  {{__('Cards')}}
                      </td>
                 
                  <td>@if(!empty($OrderDetails->design_id))
                       @php $designDetails = DB::table('virtual_cards_design')->where('id',$OrderDetails->design_id)->first(); @endphp
                      
                      
<head>
        <style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}

.card-body{{$designDetails->id}} {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    height:100px;
    background: {{$designDetails->class_name}};
}


    .newicon{text-align: center;
    padding: 8px 16px;}
    .newicon1{    padding: 36px 10px;
    border-radius: 50px;}
    .mainsearch{    width: 94%;
    border:1px solid #f3f3f3;
    padding: 8px;
    border-radius: 8px;}
    .mainbtn{    border: 1px solid #e1e1e1;
    padding: 7px 9px;
    border-radius: 6px;}
    .searchf{      padding-bottom: 15px;
    padding-top: 15px;}
    .di{margin: 0px auto;
    padding: 14px;
    background: #f1f1f1;
    width: 50%;
    border-radius: 30px;}
    .boxbg{    background: white;
    border-radius: 10px;
    margin-bottom: 20px;}
    
    
    
</style>
</head> 
                      <div class="card-body{{$designDetails->id}}">
                          
              <div class="">
                <span class="h6 surtitle text-gray" style="    color: #ffffff !important;">
                {{__('Jhon Deo')}}
                </span>
                
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX  7086</div>
               
              </div>
              <div class="row">               
                <div class="col">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;">{{$currency->symbol}}0.00 / <span class="text-gray" style="color: #ffffff !important;">{{$currency->symbol}}0.00</span></span>
                </div>
                <!--div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="text-primary"></span>
                </div-->     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:200%;margin-top:15px;margin-left: -10px;">
                    </div>
              </div>
             
            </div>
                      
                      @endif
                      </td>
                  <td>{{$currency->symbol.number_format($OrderDetails->amount,2)}}</td>
                  <td>@if($OrderDetails->status==0) <span class="badge badge-pill badge-danger">Pending</span> @elseif($OrderDetails->status==1) <span class="badge badge-pill badge-success">Confirmed</span>@endif</td>
                  <td>{{date("Y/m/d h:i:A", strtotime($OrderDetails->created_at))}}</td>
                  <!--td><a class="btn-icon-clipboard text-primary" data-clipboard-text="{{route('subview.link', ['id' => $OrderDetails->id])}}" title="Copy">{{__('Copy Subscription Link')}}</a></td-->
                  
              </tr>
              
              </div> 
            @endforeach
          </tbody>
        </table>
        
 </div>
        <style>
 tr.hide-table-padding td {
  padding: 0;
}

.expand-button {
	position: relative;
}

.accordion-toggle .expand-button:after
{
  position: absolute;
  left:.75rem;
  top: 50%;
  transform: translate(0, -50%);
  content: '-';
}
.accordion-toggle.collapsed .expand-button:after
{
  content: '+';
}
 </style>    
    
  <table class="table table-flush for-mobile-view" id="datatable-buttons">
    <thead>
        
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Order Ref No')}}</th>
        <th scope="col">{{__('Product Type')}}</th>
        <th scope="col">{{__('Card Design')}}</th>
         
        
      </tr>
    </thead>
    <tbody>
    @foreach($virtualCardsOrders as $k=>$OrderDetails)  

      <tr class="accordion-toggle collapsed" id="accordion{{$k}}" data-toggle="collapse" data-parent="#accordion{{$k}}" href="#collapseOne{{$k}}">
<td class="expand-button"></td>
<td>{{$OrderDetails->order_ref_no}}</td>
                  <td>
                      @if(!empty($OrderDetails->product__type_id))
                      @php $productDetails = DB::table('virtual_cards_product_type')->where('id',$OrderDetails->product__type_id)->first(); @endphp
                      {{$productDetails->name}}
                      @endif
                      </td>
                       <td style="width:20%">@if(!empty($OrderDetails->design_id))
                       @php $designDetails = DB::table('virtual_cards_design')->where('id',$OrderDetails->design_id)->first(); @endphp
                      
                      
<head>
        <style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}

.card-body{{$designDetails->id}} {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    height:100px;
    background: {{$designDetails->class_name}};
}


    .newicon{text-align: center;
    padding: 8px 16px;}
    .newicon1{    padding: 36px 10px;
    border-radius: 50px;}
    .mainsearch{    width: 94%;
    border:1px solid #f3f3f3;
    padding: 8px;
    border-radius: 8px;}
    .mainbtn{    border: 1px solid #e1e1e1;
    padding: 7px 9px;
    border-radius: 6px;}
    .searchf{      padding-bottom: 15px;
    padding-top: 15px;}
    .di{margin: 0px auto;
    padding: 14px;
    background: #f1f1f1;
    width: 50%;
    border-radius: 30px;}
    .boxbg{    background: white;
    border-radius: 10px;
    margin-bottom: 20px;}
    
    
    
</style>
</head> 
                      <div class="card-body{{$designDetails->id}}">
                          
              <div class="">
                <span class="h6 surtitle text-gray" style="    color: #ffffff !important;">
                {{__('Jhon Deo')}}
                </span>
                
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX  7086</div>
               
              </div>
              <div class="row">               
                <div class="col">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;">$0 / <span class="text-gray" style="color: #ffffff !important;">$0</span></span>
                </div>
                <!--div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="text-primary"></span>
                </div-->     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:200%;margin-top:15px;margin-left: -10px;">
                    </div>
              </div>
             
            </div>
                      
                      @endif
                           
                           
                  
                  </td>
      

</tr>
<tr class="hide-table-padding">
<td></td>
<td colspan="3">
<div id="collapseOne{{$k}}" class="collapse in p-3">
  <div class="row">
    <div class="col-3">{{__('Created / Total')}}</div>
    <div class="col-6">{{$OrderDetails->created_qty}} /  @if(!empty($OrderDetails->plan_name)) {{$OrderDetails->plan_quantity}} @endif {{__('Cards')}}</div>
    
  </div>
  <div class="row">
    <div class="col-3">{{__('Plan name')}}</div>
    <div class="col-6">@if(!empty($OrderDetails->plan_name)) {{$OrderDetails->plan_name}} @endif</div>
  </div>
  <div class="row">
    <div class="col-3">{{__('Amount')}}</div>
    <div class="col-6">{{$currency->symbol.number_format($OrderDetails->amount,2)}}</div>
  </div>
  <div class="row">
    <div class="col-3">{{__('Status')}}</div>
    <div class="col-6">@if($OrderDetails->status==0) <span class="badge badge-pill badge-danger">Pending</span> @elseif($OrderDetails->status==1) <span class="badge badge-pill badge-success">Confirmed</span>@endif</div>
  </div>
  <div class="row">
    <div class="col-3">{{__('Created')}}</div>
    <div class="col-6">{{date("Y/m/d h:i:A", strtotime($OrderDetails->created_at))}}</div>
  </div>
  <div class="row">
    <div class="col-3">{{__('Updated')}}</div>
    <div class="col-6">{{date("Y/m/d h:i:A", strtotime($OrderDetails->updated_at))}}</div>
  </div>
 
             
</div></td>
</tr>
  @endforeach    
    </tbody>
  </table>



      </div>
    </div>
<script>
$(document).ready(function() {
    $('#exampleerewf').DataTable();
} );
</script>
@stop