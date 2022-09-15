
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Invoice Charge')}}</h3>
      </div>
      @if(count($invoice) > 0)
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Name')}}</th>
              <th>{{__('From')}}</th>
              <th>{{__('IP Address')}}</th>
              <th>{{__('Type')}}</th>
              <th>{{__('Status')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Charge')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Payment Type')}}</th>
              <th>{{__('Created')}}</th>
              <th>{{__('updated')}}</th>
            </tr>
          </thead>
          <tbody>  
            @foreach($invoice as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>{{$val->inplan['item']}}</td>
                <td>@if($val->sender_id!=null) {{$val->sender->first_name.' '.$val->sender->last_name}} [{{$val->sender->email}}] @else {{$val->first_name.' '.$val->last_name}} [{{$val->email}}] @endif</td>
                <td>{{$val->ip_address}}</td>
                <td>@if($val->sender_id==$user->id) Paid @else Received @endif</td>
                <td>@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</td>
                <td>{{$currency->symbol.$val->amount}}</td>
                <td>@if($val->sender_id==$user->id || $val->charge==null) - @else {{$currency->symbol.$val->charge}} @endif</td>
                <td>{{$val->ref_id}}</td>
                <td>{{$val->payment_type}} @if($val->payment_type=='card') - XXXX XXXX XXXX {{substr($val->card_number, 12)}} @endif</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <center>
           <div class="col-lg-12">
              <br>
                <p class="text-center card-text mt-5">{{__('No invoice Found!')}}</p>
               <h3>{{__('Let’s Create your first invoice')}}</h3>
             <a href="{{url('user/invoice')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Get Started')}}</a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
            
          </div></center>
      @endif
    </div>

@stop