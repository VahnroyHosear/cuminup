
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('All Activites')}}</h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Log')}}</th>
              <th>{{__('Created')}}</th>
            </tr>
          </thead>
          <tbody>  
            @foreach($audit as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>#{{$val->trx}}</td>
                <td>{{$val->log}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

@stop