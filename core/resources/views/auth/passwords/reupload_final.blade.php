@extends('loginlayout')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-5 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark">{{ __("Thanks for sending us a new photo.") }}</h1>
            </div>
            
          </div>
          <div class="card-header bg-transparent pb-3">
                 We'll get back to processing your company's application.
            </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-9">
             @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> {{ $error }}
                </div>
            @endforeach
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('type') }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                    </button>
                    {{ session()->get('message') }}
                </div>
            @endif
            @if (session()->has('status'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                    </button>
                    {{ session()->get('status') }}
                </div>
            @endif
          <br><br>
          <br><br>
        </div>
      </div>
    </div><br><br>
<script>
function uploadtypeCheck(value)
{
    if(value == 'Form of ID')
    {
        $('#passport_div').hide();
        $('#default_div').show();

    }
    if(value == 'Passport')
    {
         $('#passport_div').show();
        $('#default_div').hide();
    }
    if(value == 'Driving Licence')
    {
        
    }
    if(value == 'State ID')
    {
        
    }
}
</script>
@stop