@extends('master')

@section('content')
   
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0">{{__('All Enterprise Pending Customers')}}</h3>
            </div>
            <div class="table-responsive py-4">
                <form id="frm-example" action="{{url('admin/multi_user_update')}}" method="POST">
                <table class="table table-flush" id="datatable-buttons_3434">
                    <thead>
                        <tr>
                            <th>{{__('S/N')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Business name')}}</th>
                           
                            <th>{{__('Email')}}</th> 
                            <th>{{__('Phone No')}}</th>
                             <th>{{__('Account Type')}}</th>
                              <th>{{__('Enterprise Status')}}</th>
                            <th>{{__('Status')}}</th>
                            <!--th>{{__('Available Balance')}}</th-->
                            
                            <th>{{__('Current Location')}}</th>
                            <!--th>{{__('Last Login Location')}}</th>
                            <th>{{__('SignUp Location')}}</th>
                            <th>{{__('Created')}}</th>
                            <th>{{__('Updated')}}</th-->
                            <th class="scope"></th>    
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td><a href="{{route('user.manage', ['id' => $val->id])}}" class="dropdown-item" style="color:blue;">{{$val->first_name.' '.$val->last_name}}</a></td>
                            <td>{{$val->business_name}}</td>
                            
                            <td>{{$val->email}}</td>
                            <td>{{'+'}}{{$val->prefix}}{{$val->phone}}</td>
                            <td>
                                @if($val->user_type == 1)
                                <span class="badge badge-pill badge-info">{{__('Standard')}}</span>
                                @elseif($val->user_type == 2)
                                <span class="badge badge-pill badge-success">{{__('Enterprise')}}</span>
                                @endif
                            </td>
                              <td>
                                
                                <span class="badge badge-pill badge-warning">{{__('Pending')}}</span>
                               
                            </td>   
                            <td>
                                @if($val->pre_status==0)
                                    <span class="badge badge-pill badge-warning">{{__('Inactive')}}</span>
                                @elseif($val->status==1)
                                    <span class="badge badge-pill badge-danger">{{__('Blocked')}}</span> 
                                @elseif($val->pre_status==1 && $val->status== 0)
                                    <span class="badge badge-pill badge-info">{{__('Active')}}</span>
                                @else
                                <span class="badge badge-pill badge-warning">{{__('Pending')}}</span>
                                @endif
                            </td>   
                            <!--td>{{$currency->symbol.number_format($val->balance,2)}}</td--> 
                            
                            <td>
                                <?php
                                    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$val->ip_address));
                                    //dd($query);
                                    if($query)
                                    {
                                        echo $query['city']." | ".$query['country']." | ".$val->ip_address;
                                    }
                                ?>
                            </td>
                            <!--td>
                                <?php
                                    $query2 = @unserialize(file_get_contents('http://ip-api.com/php/'.$val->last_login_ip));
                                    //dd($query);
                                    if($query2)
                                    {
                                         echo $query2['city']." | ".$query2['country']." | ".$val->last_login_ip;
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                if(!empty($val->signup_ip))
                                {
                                    $query2 = @unserialize(file_get_contents('http://ip-api.com/php/'.$val->signup_ip));
                                    //dd($query);
                                    if($query2)
                                    {
                                         echo $query2['city']." | ".$query2['country']." | ".$val->signup_ip;
                                    }
                                } else {
                                    echo "NA | NA";
                                }    
                                ?>
                            </td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                            <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td-->
                            <td class="text-right">
                            <div class="dropdown">
                                    <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a href="{{route('user.manage', ['id' => $val->id])}}" class="dropdown-item">{{__('Manage customer')}}</a>
                                         <a href="{{url('admin/verification-kyc', ['id' => $val->id])}}" class="dropdown-item">{{__('View Enterprise Info')}}</a>
                                       
                                        <a href="{{route('admin.email', ['email' => $val->email, 'name' => $val->business_name])}}" class="dropdown-item">{{__('Send email')}}</a>
                                        @if($val->status==0)
                                            <a class='dropdown-item' href="{{route('user.block', ['id' => $val->id])}}">{{__('Block')}}</a>
                                        @else
                                            <a class='dropdown-item' href="{{route('user.unblock', ['id' => $val->id])}}">{{__('Unblock')}}</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                    </div>
                                </div>
                            </td>                   
                        </tr>
                        <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card bg-white border-0 mb-0">
                                            <div class="card-header">
                                                <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                            </div>
                                            <div class="card-body px-lg-5 py-lg-5 text-center">
                                                <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                <a  href="{{route('user.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach               
                    </tbody>                    
                </table>
                <!--p><button>Submit</button></p>

<p><b>Selected rows data:</b></p>
<pre id="example-console-rows"></pre>

<p><b>Form data as submitted to the server:</b></p>
<pre id="example-console-form"></pre-->
                </form>
            </div>
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
$(document).ready(function() {
    $('#datatable-buttons_3434').DataTable( {
        'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']],
        dom: 'Bfrtip',
        "autoWidth": true,
            "lengthChange": true,
            "pageLength": 25,
        buttons: [
            'copy','csv' ,'excel' ,'print'
            ,{
            extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'}
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

$(document).ready(function() {
 
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;
      
      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production
      
      // Output form data to a console     
      $('#example-console-rows').text(rows_selected.join(","));
      
      // Output form data to a console     
      $('#example-console-form').text($(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });   
});
</script>
