@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0"> {{ __('e-Sign Consent')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('e-sign.update')}}" method="post">
                @csrf
                    <div class="form-group row">
                        <div class="col-lg-12">
                        <textarea type="text" name="details" class="tinymce form-control">{{$value->e_signconsent}}</textarea>
                        </div>
                    </div>                
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm">{{ __('Save')}}</button>
                    </div>
                </form>
            </div>
        </div> 
@stop