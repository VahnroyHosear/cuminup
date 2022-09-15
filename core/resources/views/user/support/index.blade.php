@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="text-right">
              <a href="{{route('open.ticket')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Create Ticket')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="row">
      @if(count($ticket)>0)
       <div class="card">
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Ticket ID')}}</th>
               <th>{{__('Ticket For')}}</th>
              <th>{{__('Subject')}}</th>
              <th>{{__('Trx Ref')}}</th>
              <th>{{__('Priority')}}</th>
               <th>{{__('Status')}}</th>
             <th>{{__('Created')}}</th>
              <!--th>{{__('Updated')}}</th-->
              <th>{{__('Action')}}</th>
             
            </tr>
          </thead>
          <tbody>  
        @foreach($ticket as $k=>$val)
        <tr>
        <td>{{++$k}}</td>
                <td>{{$val->ticket_id}}</td>
                 <td>{{$val->type}}</td>
                <td>{{$val->subject}}</td>
                <td>@if($val->ref_no==null){{__('Not submitted')}} @else {{$val->ref_no}} @endif</td>
                <td>{{$val->priority}}</td>
                <td> @if($val->status==0) <span class="badge badge-pill badge-success">{{__('Open')}}</span> @elseif($val->status==1) <span class="badge badge-pill badge-danger">{{__('Closed')}}</span> @elseif($val->status==2) <span class="badge badge-pill badge-warning">{{__('Resolved')}}</span> @endif
                            </td>
               <td>{{date("h:i:A j, M Y", strtotime($val->created_at))}}</td>
                <!--td>{{date("h:i:A j, M Y", strtotime($val->updated_at))}}</td-->
                <td><a href="{{url('/')}}/user/reply-ticket/{{$val->id}}" class="btn btn-sm btn-neutral">{{__('Reply')}}</a>
                      <!--a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="btn btn-sm btn-danger">{{__('Delete')}}</a--></td>
            </tr>     
          <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-body p-0">
                          <div class="card bg-white border-0 mb-0">
                              <div class="card-header">
                                  <span class="mb-0 text-sm">{{__('Are you sure you want to delete this?, all transaction related to this will also be deleted')}}</span>
                              </div>
                              <div class="card-body px-lg-5 py-lg-5 text-right">
                                  <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                  <a  href="{{route('ticket.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        @endforeach
        </tbody>
        </table>
      @else
      <!--div class="col-md-12">
        <p class="text-center text-muted card-text mt-8">No Support Ticket Found</p>
        <center><img src="{{url('/')}}/asset/profile/nodata.png" width="30%"></center>
      </div-->
       <center>
           <div class="col-lg-12">
              <br>
                <p class="text-center card-text mt-8">{{__('No Support Ticket Found!')}}</p>
               <h3>{{__('Let’s Create your first support ticket')}}</h3>
             <a href="{{route('open.ticket')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Get Started')}}</a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
            
          </div></center>
      @endif
    </div>
    
@stop