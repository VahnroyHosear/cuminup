
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Deposit logs')}}</h3>
      </div>
      @if(count($deposits) > 0)
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead class="">
            <tr>
              <th>{{__('S/N')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Charge')}}</th>
               <th>{{__('Total')}}</th>
              <th>{{__('Method')}}</th>
              <th>{{__('Status')}}</th>
              <th>{{__('Date')}}</th>
             
            </tr>
          </thead>
          <tbody>  
            @foreach($deposits as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>#{{$val->trx}}</td>
                <td>{{$currency->symbol.number_format($val->amount-$val->charge,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->charge,2)}}</td>
                 <td>{{$currency->symbol.number_format($val->amount,2)}}</td>
                <td>{!!$val->gateway['name']!!}</td>
                <td>@if($val->status==0) <span class="badge badge-pill badge-danger">failed</span> @elseif($val->status==1) <span class="badge badge-pill badge-success">successful</span> @elseif($val->status==2) refunded @endif</td>
              
                <td>
                     @php 
                     
                    // $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
                    // dd($query);
                   // date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime($val->created_at, new DateTimeZone('Asia/Kolkata'));
//echo $date->format('Y-m-d H:i:sP') . "\n";

$date->setTimezone(new DateTimeZone('Asia/Kolkata'));
//echo $date->format('Y-m-d H:i:sP') . "\n";
 @endphp
                 {{date('Y/m/d h:i:A', strtotime($val->created_at))}}</td>
               
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