@extends('userlayout')

@section('content')
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
   
    </head>
<style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}

.card-body1 {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: #f5b716;
}

.dvc{    padding: 10px;
    background: #f4f7fc;
    border-radius: 5px;}
@foreach($AllvCardDesigns as $DesignDetails)   
.card-body2{{$DesignDetails->id}}{
background: {{$DesignDetails->class_name}};
  
     padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
   
    }
@endforeach
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
/**FOR SLIDER**/
.card .carousel-item {
  height: 50%;
}
.card .carousel-caption {
  padding: 0;
  right: 0;
  left: 0;
  color: #3d3d3d;
}
.card .carousel-caption h3 {
  color: #3d3d3d;
}
.card .carousel-caption p {
  line-height: 30px;
}
.card .carousel-caption .col-sm-3 {
  display: flex;
  align-items: center;
}
.card .carousel-caption .col-sm-9 {
  text-align: left;
}
.navi a {
    text-decoration:none;
}
a > .ico {
    background-color: grey;
    padding: 10px;
    
}
a:hover > .ico {
    background-color: #666;
}
.newicon .btn {
    background-color:#dcdde0;
}
</style>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
     
      
      <div class="row">
      <div class="col-md-8">
           <!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button-->
          @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
          <div class="row boxbg">
              <div class="col-md-12">
                  <form action="#" class="searchf">
      <input type="text" placeholder="Search.." name="search" class="mainsearch">
      <button type="submit" class="mainbtn"><i class="fa fa-search"></i></button>
    </form>
              </div>
          </div>
          
          
          <div class="mapp">
           <div class="row boxbg"> 
          <div class="col-6 newicon" style="text-align: center;">
         <a href="#">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/shopping-cart.png">
            </div>
            <h4>eStore</h4>
            </a>
            </div>
           
             <div class="col-6 newicon" style="text-align: center;">
                <a href="{{url('/')}}/user/invoice">
         <div class="row align-items-center">
            <img class="di" src="{{url('/')}}/asset/images/quotation.png">
            </div>
           <h4>e-Invoice</h4>
           </a>
            </div>
            </div>
             <div class="row boxbg"> 
           <div class="col-6 newicon" style="text-align: center;">
               <a href="{{url('/')}}/user/sc-links">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/dashboard.png">
            </div>
           <h4>Payment URLs</h4>
           </a>
            </div>
            
                 <div class="col-6 newicon" style="text-align: center;">
               
               
           @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
                
           <a href="{{url('/')}}/user/virtualcard">
         <div class="row align-items-center">
          <img class="di" src="{{url('/')}}/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>
            @else
              <a href="{{url('/')}}/user/virtualcard" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
          <img class="di" src="{{url('/')}}/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>  
            @endif
            </div>
             </div>
              <div class="row boxbg"> 
             <div class="col-6 newicon" style="text-align: center;">
                 
            @if(Auth::user()->user_type == 1)
            <a href="{{url('/')}}/user/transfer" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            @else
               <a href="{{url('/')}}/user/transfer">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            @endif
            </div>
            
            
             <div class="col-6 newicon" style="text-align: center;">
                 
            @if(Auth::user()->user_type == 1)
            <a href="{{url('/')}}/user/request" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            @else
                <a href="{{url('/')}}/user/request">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            @endif
            </div>
            </div>
          
          </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          <div class="dapp">
           
      <div class="row boxbg"> 
      <div class="col-lg-2 newicon" style="text-align: center;">
               
               
           @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
           <a href="{{url('/')}}/user/virtualcard">
         <div class="row align-items-center">
          <img class="di" src="{{url('/')}}/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>
                
            @else
              <a href="{{url('/')}}/user/virtualcard" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
          <img class="di" src="{{url('/')}}/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>  
            @endif
            </div>
     
            
           
            
      
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                  @if(Auth::user()->user_type == 2)
                <a href="{{url('/')}}/user/invoice">
         <div class="row align-items-center">
            <img class="di" src="{{url('/')}}/asset/images/quotation.png">
            </div>
           <h4>e-Invoice</h4>
           </a>
           @else
           <a href="#" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
            <img class="di" src="{{url('/')}}/asset/images/quotation.png">
            </div>
           <h4>e-Invoice</h4>
           </a>
           @endif
            </div>
            
           <div class="col-lg-2 newicon" style="text-align: center;">
              @if(Auth::user()->user_type == 2)
               <a href="{{url('/')}}/user/sc-links" style="width: 110px;">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/dashboard.png">
            </div>
           <h4>Payment URLs</h4>
           </a>
           @else
           <a href="#" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm" style="width: 110px;">
            <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/dashboard.png" style="width: 43%;">
            </div>
           <h4>Payment URL</h4>
           </a>
            @endif   
            </div>
            
                 
            <div class="col-lg-2 newicon" style="text-align: center;">
            @if(Auth::user()->user_type == 2)    
         <a href="{{url('/user/product')}}">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/shopping-cart.png">
            </div>
            <h4>Sell Online</h4>
            </a>
            @else
            <a href="#" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
                <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/shopping-cart.png">
            </div>
            <h4>Sell Online</h4>
            </a>    
            @endif
            </div>
            
            
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                 
            @if(Auth::user()->user_type == 1)
            <a href="{{url('/')}}/user/transfer" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            @else
               <a href="{{url('/')}}/user/transfer">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            @endif
            </div>
            
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                 
            @if(Auth::user()->user_type == 1)
            <a href="{{url('/')}}/user/request" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            @else
                <a href="{{url('/')}}/user/request">
         <div class="row align-items-center">
           <img class="di" src="{{url('/')}}/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            @endif
            </div>
            
         
            
            </div>
            </div>
     
        <!--div class="row boxbg">  
                    <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">No Money Request Found</p>
            </div>
                  </div--> 
        @endif
        <div class="card">
          @if(count($transactions) > 0)
          <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Recent Transactions')}}</h3>
      </div>
      <div class="table-responsive py-4" style="margin-top: -63px;">
        <table class="table table-flush" id="datatable-buttons_3434">
          <thead class="">
            <tr>
              <th>{{__('Date')}}</th>
              <th>{{__('Type')}}</th>
              <!--th>{{__('Reference ID')}}</th-->
              <th>{{__('Amount')}}</th>
              <!--th>{{__('Charge')}}</th-->
              <!--th>{{__('Total')}}</th-->
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
                <!--td>#{{$val->ref_id}}</td-->
                <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                 <!--td>{{$currency->symbol.number_format($val->charge,2)}}</td-->
                 <!--td>{{$currency->symbol.number_format($val->amount+$val->charge,2)}}</td-->
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
                             <div class="col-6" style="border: 1px solid ;">{{$currency->symbol.number_format($val->amount,2)}}</div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('Status')}}</div>
                             <div class="col-6" style="border: 1px solid;">@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</div>
                         </div> 
                         @if($val->type == 1)
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;">{{__('User')}}</div>
                             <div class="col-6" style="border: 1px solid;">{{__('Own Wallet')}}</div>
                         </div> 
                         @endif
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
               <td class="sorting_1"><span style="display:none;">{{strtotime($val->created_at)}}</span>{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                <td>
                    {{__('Transfer')}}
                </td>
                <!--td>#{{$val->ref_id}}</td-->
                <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                 <!--td>{{$currency->symbol.number_format($val->charge,2)}}</td-->
                 <!--td>{{$currency->symbol.number_format($val->amount+$val->charge,2)}}</td-->
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
               <td class="shorting_1"><span style="display:none;">{{strtotime($val->created_at)}}</span>{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                <td>
                    {{__('Subscribe')}}
                </td>
                <!--td>#{{$val->ref_id}}</td-->
                <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                 <!--td>{{$currency->symbol.number_format($val->charge,2)}}</td-->
                 <!--td>{{$currency->symbol.number_format($val->amount+$val->charge,2)}}</td-->
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
       <a href="{{url('user/all-transactions')}}" class="btn btn-default" style="float:right;margin-top: -43px;">{{__('View All Transactions')}}</a>
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
            <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('All Card Activites')}}<a style="float:right;" href="{{url('user/virtualcard')}}" class="badge badge-pill badge-success">{{__('New Card')}}</a></h3>
      </div>
      <div class="table-responsive py-4">
          <div class="pc_view_table_id">
        <table class="table table-flush" id="datatable-button">
          <thead>
            <tr >
              <th>{{__('Merchant')}}</th>
              <th>{{__('Card Last 4 Digit')}}</th>
               <th>{{__('Status')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Date')}}</th>
              

            </tr>
          </thead>
          <tbody>
              @if(count($AlltrxList) > 0)
              @foreach($AlltrxList as $k=>$trxDetails)
              @php $CardDetails = DB::table('virtual_cards')->where('last_four_digit',$trxDetails->card_last_four)->first();@endphp
              @if($k < 9)
              <tr data-toggle="modal" data-target="#modal-more{{$trxDetails->id}}" style="cursor: pointer;">
                  <td>{{$trxDetails->merchant_descriptor}}</td>
                  <td>{{'XXXXXX'}}{{$trxDetails->card_last_four}}</td>
                  <td>{{$trxDetails->trx_status}}</td>
                  <td>{{$currency->symbol.number_format($trxDetails->amount,2)}}</td>
                  <td>{{date("Y/m/d h:i:A", strtotime($trxDetails->created_at))}}</td>
                 </tr>
            
            @endif 
           
            
          
            <!--START MODEL-->
               <div class="modal fade" id="modal-more{{$trxDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-sm-4" >
                <div class="card bg-white border-0 mb-0" style="padding:10px;">
                <!--div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">{{$trxDetails->card_memo}} Card Details</h3>
                    
                </div-->
               <div class="card-body2{{$CardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
 @if($CardDetails->card_state == 'OPEN') <span class="badge badge-pill badge-success">{{'Active'}}</span>
                 @elseif($CardDetails->card_state == 'CLOSED')<span class="badge badge-pill badge-danger">{{'CLOSED'}}</span>
                 @else<span class="badge badge-pill badge-danger">{{'PENDING'}}@endif</span>                  </div>
               
              </div>             
              <div class="my-3">
                <span class="h6 surtitle text-white mb-2">
                {{$trxDetails->card_memo}}
                </span>
                <div class="text-primary">
                  <div style="color:white">{{substr($CardDetails->pan,0,4)}} {{substr($CardDetails->pan,4,4)}} {{substr($CardDetails->pan,8,4)}} {{substr($CardDetails->pan,12,4)}}</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">@if(empty($CardDetails->exp_month)){{'XX'}}@else{{$CardDetails->exp_month}}@endif / @if(empty($CardDetails->exp_year)){{'XX'}}@else{{substr($CardDetails->exp_year,2,4)}}@endif</span><br>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">@if(empty($CardDetails->cvv)){{'XXX'}}@else{{$CardDetails->cvv}}@endif</span><br>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-1 openn">
                Nick Name
                </span>
                <div class="text-primary openname">
                   <span style="color: grey;">Nickname</span><br>
                  <div style="color: black!important;font-size:22px">{{$trxDetails->card_memo}}</div>
                </div>
              </div>
              
              <div class="my-4 openc">
               
                <div class="text-primary openname" >
                      <span style="color: grey;">Total Spend Limit</span><br>
                  <div style="color: black!important;font-size:22px">{{$currency->symbol.number_format($trxDetails->card_spend_limit,2)}} / {{$currency->symbol.number_format($trxDetails->card_spend_limit,2)}}</div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
               
                <div class="text-primary openname">
                   <span style="color: grey;">Funding Source</span><br>
                  <p style="color: black!important;font-size:22px">xxxx xxx xxx </p>
                </div>
              </div>
            <div class="row" style="width: 100%;
    margin: 0px auto;
    border: 1px solid grey;
    border-radius: 8px;
    background: black;">
                <div class="col-md-6">
                 @if($CardDetails->is_paused_by_admin == 0)    
                  @if($CardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$CardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    @endif
                    @if($CardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#myModal2{{$CardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    @endif

                </div>
                <div class="col-md-6">
                     @if($CardDetails->card_state != 'CLOSED')

                    <a data-toggle="modal" data-target="#closecard-model{{$CardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Close</strong></a>
                    @endif
                </div>
                @endif
            </div>
                </div>
                </div>
                <div class="col-sm-8">
                    <button type="button" class="close" data-dismiss="modal" style="padding:10px" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Transactions')}}                                           @if(count($AlltrxList) > 7)
                     <a href="{{url('/')}}/user/virtualtransactions/{{$trxDetails->card_token}}" style="float:right" class="">See All Transactions</a>
                     @endif  </h3>

      </div>
      <div class="table table-flush">
       @foreach($AlltrxList as $k=>$trxDetails)
       @if($k < 10 && $trxDetails->card_last_four == $CardDetails->last_four_digit)
                    <div class="row " style="font-size:12px;margin-bottom:10px;">
                        <div class="col-sm-3">{{$trxDetails->merchant_descriptor}}</div>
                        <div class="col-sm-3">{{date("Y/m/d h:i:A", strtotime($trxDetails->created_at))}}</div>
                        <div class="col-sm-3">{{$currency->symbol.number_format($trxDetails->amount,2)}}</div>
                         <div class="col-sm-3">{{$trxDetails->trx_status}}</div>
                    </div>
                    @endif
                    @endforeach
                   
                  </div>  
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      <!--END MODEL-->
      <!--START PAUSE MODEL-->
         <div class="modal fade" data-id="pausecard-model{{$CardDetails->id}}" id="myModal2{{$CardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.pause_virtual_card')}}">
                    @csrf
                 
                    <input type="hidden" name="card_token" value="{{$CardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--END PAUSE MODEL-->
           <div class="modal fade" id="opencard-model{{$CardDetails->id}}" style="z-index: 1060;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  
                
                    <input type="hidden" name="card_token" value="{{$CardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model{{$CardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Close Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.close_virtual_card')}}">
                    @csrf
                  
                
                    <input type="hidden" name="card_token" value="{{$CardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    $(document).ready(function () {

    

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


});
    </script>
            @endforeach
            @endif
            @if(count($AlltrxList) < 1)
            <tbody>
             <tr>
                 <td></td>
                 <td></td>
                <td><center><b>No Activity Found!</b></center></td>
            </tr> 
            </tbody>
            
            @endif
          </tbody>
        </table>
        @if(count($AlltrxList) < 1)
        <center><img src="{{url('/')}}/asset/profile/nodata.png" style="width:30%"></center>
        @endif
        @if(count($AlltrxList) > 0 )
        <center> <a href="{{url('/')}}/user/virtualcard" class="btn btn-default">See All Activity</a> </center> 
        @endif
 </div>
   
    
  


      </div> 
      
      </div> 
      <!--START FOR BUSINESS-->
      @if(Auth::user()->user_type == 2)
            <div class="row boxbg" style="    padding-top: 13px;">  
                  
                  <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Wallet
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($user->balance)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Sent</span><br>
                  <span class="surtitle " style="color: #323131!important;">Received</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_sent)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($request_sent)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
               Sale Online
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($estore_received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} 0.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($estore_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Settlements
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($settlements_received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($settlements_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($settlements_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Send Money
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($sendMoney_sent)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle" style="color: #323131!important;">Returned</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_rebursed)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Request
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($request_sent)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($request_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($request_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
               Invoices
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($invoice_received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($invoice_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($invoice_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
     
                  
                  </div> 
                  @endif
                  <!--END FOR BUSINESS-->
     </div>
     
      <div class="col-md-4">
          
          
          
           @if(count($virtualCardsList) == 0)
    
          <div class="card-body" style="    background: white;
    border-radius: 5px;"> 
          <h3>Virtual Cards</h3>
           

            <div class="card-body1">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <span class="badge badge-pill badge-success">Card Details</span>                </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">No Card Found</span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <div style="color: #ffffff !important;margin-top:15px">
                     
                      @if(Auth::user()->user_type == 1)
                      <a href="{{url('/')}}/user/virtualcard" class="dvc">Create Virtual Card</a>
          @else
                <a href="{{url('/')}}/user/virtualcard" class="dvc">Create Virtual Card</a>
            @endif
                      </div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <br>
                  
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <br>
                  <span class="text-primary"></span>
                </div>     
                <div class="col">
                    <img src="{{url('/')}}/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
         
    </div>
    
    @endif
          
          
          
        
        <div class="card" style="background-color:transparent;box-shadow:none">
          
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="100000">
    <div class="w-100 carousel-inner" role="listbox">
    
      
    
    @foreach($virtualCardsList as $k=> $CardDetails)
    @if($k< 10)
  
    <div class="card-body" style="padding: 0.4rem;"> 

           <a href="#" data-toggle="modal" data-target="#modal-more{{$CardDetails->id}}" style="cursor: pointer;">
            <div class="card-body2{{$CardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                <span class="badge badge-pill badge-success">@if($CardDetails->card_state == 'OPEN'){{'Active'}}@elseif($CardDetails->card_state == 'CLOSED'){{'CLOSED'}}@else{{'Inactive'}}@endif</span>               
                  </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">
               {{$CardDetails->host_name}}
                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX   {{$CardDetails->last_four_digit}}</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;">{{$currency->symbol}}{{number_format($CardDetails->restAmount/100,2)}} / <span class="text-gray" style="color: #ffffff !important;">{{$currency->symbol}}{{number_format($CardDetails->spend_limit,2)}}</span></span>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="h6 surtitle text-gray">XXX</span>
                </div>     
                <div class="col">
                    <img src="{{url('/')}}/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
            </a>
           
          
    </div> 
    
              <!--START MODEL-->
               <div class="modal fade" id="modal-more{{$CardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-sm-4" >
                <div class="card bg-white border-0 mb-0" style="padding:10px;">
                
               <div class="card-body2{{$CardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
 @if($CardDetails->card_state == 'OPEN') <span class="badge badge-pill badge-success">{{'Active'}}</span>
                 @elseif($CardDetails->card_state == 'CLOSED')<span class="badge badge-pill badge-danger">{{'CLOSED'}}</span>
                 @else<span class="badge badge-pill badge-danger">{{'PENDING'}}@endif</span>                  </div>
               
              </div>             
              <div class="my-3">
                <span class="h6 surtitle text-white mb-2">
                @if(!empty($trxDetails->card_memo))
                {{$trxDetails->card_memo}}
                @else
                 {{'XXXXXX'}}
                @endif
                </span>
                <div class="text-primary">
                  <div style="color:white">{{substr($CardDetails->pan,0,4)}} {{substr($CardDetails->pan,4,4)}} {{substr($CardDetails->pan,8,4)}} {{substr($CardDetails->pan,12,4)}}</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">@if(empty($CardDetails->exp_month)){{'XX'}}@else{{$CardDetails->exp_month}}@endif / @if(empty($CardDetails->exp_year)){{'XX'}}@else{{substr($CardDetails->exp_year,2,4)}}@endif</span><br>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">@if(empty($CardDetails->cvv)){{'XXX'}}@else{{$CardDetails->cvv}}@endif</span><br>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-1 openn">
                Nick Name
                </span>
                <div class="text-primary openname">
                   <span style="color: grey;">Nickname</span><br>
                  <div style="color: black!important;font-size:22px">@if(!empty($trxDetails->card_memo))
                {{$trxDetails->card_memo}}
                @else
                 {{'XXXXXX'}}
                @endif</div>
                </div>
              </div>
              
              <div class="my-4 openc">
               
                <div class="text-primary openname" >
                      <span style="color: grey;">Total Spend Limit</span><br>
                  <div style="color: black!important;font-size:22px">@if(!empty($trxDetails->card_spend_limit)){{$currency->symbol.number_format($trxDetails->card_spend_limit,2)}}@endif / @if(!empty($trxDetails->card_spend_limit)){{$currency->symbol.number_format($trxDetails->card_spend_limit,2)}}@endif</div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
               
                <div class="text-primary openname">
                   <span style="color: grey;">Funding Source</span><br>
                  <p style="color: black!important;font-size:22px">xxxx xxx xxx </p>
                </div>
              </div>
            <div class="row" style="width: 100%;
    margin: 0px auto;
    border: 1px solid grey;
    border-radius: 8px;
    background: black;">
                <div class="col-md-6">
                 @if($CardDetails->is_paused_by_admin == 0)
                 
                  @if($CardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$CardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    @endif
                    @if($CardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#myModal2{{$CardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    @endif

                </div>
                <div class="col-md-6">
                     @if($CardDetails->card_state != 'CLOSED')

                    <a data-toggle="modal" data-target="#closecard-model{{$CardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Close</strong></a>
                    @endif
                </div>
                
                @endif
            </div>
                </div>
                </div>
                <div class="col-sm-8">
                    <button type="button" class="close" data-dismiss="modal" style="padding:10px" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Transactions')}}                                         
                     <a href="{{url('/')}}/user/virtualtransactions/{{$CardDetails->token}}" style="float:right" class="">See All Transactions</a>
                      </h3>

      </div>
      <div class="table table-flush">
          @if(count($AlltrxList) > 0)
       @foreach($AlltrxList as $k=>$trxDetails)
       @if($k < 10 && $trxDetails->card_last_four == $CardDetails->last_four_digit)
                    <div class="row " style="font-size:12px;margin-bottom:10px;">
                        <div class="col-sm-3">{{$trxDetails->merchant_descriptor}}</div>
                        <div class="col-sm-3">{{date("Y/m/d h:i:A", strtotime($trxDetails->created_at))}}</div>
                        <div class="col-sm-3">{{$currency->symbol.number_format($trxDetails->amount,2)}}</div>
                         <div class="col-sm-3">{{$trxDetails->trx_status}}</div>
                    </div>
                    @else
                    @if($k < 1)
                    <div class="row">
                        <div class="col-sm-3"></div><center><p>No Transaction available!</></center>
                        </div>
                    @endif    
                    @endif
                    @endforeach
                   @endif
                  </div>  
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      <!--END MODEL-->
      <!--START PAUSE MODEL-->
         <div class="modal fade" data-id="pausecard-model{{$CardDetails->id}}" id="myModal2{{$CardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.pause_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$CardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--END PAUSE MODEL-->
           <div class="modal fade" id="opencard-model{{$CardDetails->id}}" style="z-index: 1060;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$CardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model{{$CardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Close Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.close_virtual_card')}}">
                    @csrf
                  
                
                    <input type="hidden" name="card_token" value="{{$CardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    @endforeach
   
   @if(count($virtualCardsList) > 0)  
   <center> <a href="{{url('/')}}/user/virtualcard" class="btn btn-default">See All Cards</a> </center> 
   @endif
     <br>
        
   
     </tbody>
     </table>
 
   </div>
      </div>
      
      </div>
          
      </div>
      
     
     
     
     
     
     
       </div>
       
       
            
      <!--TEST-->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center mt-5 pt-5 pb-4">
      <h3> <i class="fas fa-crown" style="color: #fff704; font-size: 20px;"></i> Upgrade to Enterprise</h3>
      <a href="{{route('user.doc-verification')}}"><p>Click Here..</p></a>
    </div>
  </div>
</div>
 <script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
  <!--TEST-->
  <script>
  $(document).ready(function() {
    $('#trasactionTable_id').DataTable();
});
  </script>
  <script>

$(document).ready(function() {
    $('#datatable-buttons_3434').DataTable( {
      "pageLength": 10,
       "sDom": "lfrti",
       "lengthChange": false,
       "order": [[ 0, "desc" ]], //or asc 
    "columnDefs" : [{"targets":0, "type":"date-eu"}],
    } );
} );
</script>
@stop