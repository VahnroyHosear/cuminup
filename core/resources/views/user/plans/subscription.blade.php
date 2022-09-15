
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Subscriptions List')}}</h3>
      </div>
      @if(count($sub) > 0)
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Plan')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Expiring Date')}}</th>
              <th>{{__('Renewal')}}</th>
              <th>{{__('Created')}}</th>
            </tr>
          </thead>
          <tbody>  
            @foreach($sub as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>@if($val->plan['amount']==null){{$currency->symbol.$val->amount}} @else {{$currency->symbol.$val->plan['amount']}} @endif</td>
                <td>{{$val->plan['name']}}</td>
                <td>#{{$val->ref_id}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</td>
                <td>@if($val->times>0 && $val->status==1) Yes @else No @endif</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
       <center><div class="col-md-12">
              <br>
                <p class="text-center card-text mt-5">{{__('No subscriptions found!')}}</p>
               
              <!--a data-toggle="modal" data-target="#single-charge" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Get Started')}}</a-->
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
          </div></center>
      @endif
    </div>

@stop