@extends('master')
<head>
  <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
</head>    
@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">{{ __('Country')}}</h3>
            </div>
            <div class=" py-4">
                <table class="table " id="datatable-buttons_3434">
                    <thead>
                        <tr>
                            <th>{{ __('S/N')}}</th>
                            <th>{{ __('Name')}}</th>
                           <th>{{__('Iso Code')}}</th>
                            <th>{{ __('Status')}}</th>
                            <th>{{ __('Created')}}</th>
                            <th>{{ __('Updated')}}</th>
                            
                            <th class="text-center">Action</th>    
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cur as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->iso_code}}</td>
                           
                           
                            <td>                                    
                                @if($val->active==1)
                                    <span class="badge badge-success">{{ __('Active')}}</span>
                                @else
                                    <span class="badge badge-danger">{{ __('Deactive')}}</span>
                                @endif
                            </td>  
                            <td>{{$val->created_at}}</td>
                            <td>{{$val->updated_at}}</td>
                            <td class="text-center">
                            
                                <div class="text-right">
                                    <div class="dropdown">
                                        <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                           @if($val->active==1)
                                            <a class='dropdown-item' href="{{route('change.decountry', ['id' => $val->id])}}">{{ __('Deactivate Now')}}</a>
                                        @endif 
                                        @if($val->active==0)
                                            <a class='dropdown-item' href="{{route('change.country', ['id' => $val->id])}}">{{ __('Active Now')}}</a>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                
                            </td>                 
                        </tr>
                        @endforeach               
                    </tbody>                    
                </table>
            </div>
        </div>
@stop

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
$(document).ready(function() {
   
     $('#datatable-buttons_3434 tbody').on( 'click', 'tr', function () {
        //$(this).toggleClass('selected');
    } );
    var table = $('#datatable-buttons_3434').DataTable({
            "autoWidth": true,
            "lengthChange": true,
            "pageLength": 25,
            "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
        
    });
 
} );
</script>
