@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <!-- Card body -->
          <div class="card-body">
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <img src="{{url('/')}}/asset/profile/{{$merchant->image}}" alt="Image placeholder" width="150">
              </div>
              <div class="col-auto">
                <span class="text-dark">{{__('Invoice No')}} #{{$invoice->invoice_no}}</span>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{__('FROM')}}{{':'}} {{$invoice->user->email}}</span><br>
                  <span class="surtitle ">{{__('TO')}}{{':'}} @if(!empty($invoice->customer_name)) {{$invoice->customer_name}} @endif {{'('}}{{$invoice->email}}{{')'}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{__('DUE DATE')}} {{$invoice->due_date}}</span>
                </div>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle ">{{__('INVOICE ITEM')}}</span><br>
                  <span class="surtitle ">{{__('QUANTITY')}}</span><br>
                  <span class="surtitle ">{{__('AMOUNT')}}</span><br>
                  @if($invoice->notes!=null)
                  <span class="surtitle ">{{__('NOTES')}}</span>
                  @endif
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$invoice->item}}</span><br>
                  <span class="surtitle ">{{$invoice->quantity}}</span><br>
                  <span class="surtitle ">{{$currency->symbol.number_format($invoice->amount,2)}}</span><br>
                  @if($invoice->notes!=null)
                  <span class="surtitle ">{{$invoice->notes}}</span>
                  @endif
                </div>
              </div>
            </div>
            <hr>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle ">{{__('SUBTOTAL')}}</span><br>
                  <span class="surtitle ">{{__('DISCOUNT')}}</span></br>
                  <span class="surtitle ">{{__('TAX')}}</span><br>
                  <span class="surtitle ">{{__('CHARGE')}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle" style="margin-left: 54px;">{{$currency->symbol.number_format($invoice->amount*$invoice->quantity,2)}}</span><br>
                  <span class="surtitle" style="margin-left: 10px;">({{$invoice->discount}}%)&nbsp;&nbsp;&nbsp; - {{$currency->symbol.number_format($invoice->amount*$invoice->quantity*$invoice->discount/100,2)}} </span><br>
                  <span class="surtitle ">({{$invoice->tax}}%)&nbsp;&nbsp;&nbsp; + {{$currency->symbol}}{{($invoice->amount*$invoice->quantity*$invoice->tax/100)}}</span><br>
                  <span class="surtitle " style="">({{$set->invoice_charge}}%)&nbsp;&nbsp;&nbsp; + {{$currency->symbol}}{{($invoice->charge)}}</span>
                </div>
              </div>
            </div>
            <hr>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{__('TOTAL')}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->symbol.number_format($invoice->total,2)}}</span>
                </div>
              </div>
            </div>
            <form action="{{route('submit.preview')}}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$invoice->id}}">                                                         
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm">{{__('Send')}}</a>
              </div>         
            </form>
          </div>
        </div>
      </div>
    </div>
@stop