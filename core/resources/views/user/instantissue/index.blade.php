@extends('userlayout')

@section('content')
<head>
    <style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}
.card-body1 {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: #1093ff;
}
    .newicon{text-align: center;
    padding: 8px 16px;}
    .newicon1{    padding: 36px 10px;
    border-radius: 50px;}
    .mainsearch{    width: 94%;
    border:1px solid #f3f3f3;
    padding: 8px;
    border-radius: 8px;}
    .mainbtn{    border: 1px solid #e1e1e1;
    padding: 7px 9px;
    border-radius: 6px;}
    .searchf{      padding-bottom: 15px;
    padding-top: 15px;}
    .di{margin: 0px auto;
    padding: 14px;
    background: #f1f1f1;
    width: 50%;
    border-radius: 30px;}
    .boxbg{    background: white;
    border-radius: 10px;
    margin-bottom: 20px;}
    
</style>
</head>    
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div>


                    <div class="card-header">
                        <h2 class="card-title text-center">{{__('Step 1: Choose Your Card Type')}}</h2>
                       <center> <h3 style="margin-top: -12px;">Issue cards instantly<br>
Solution for quickly creating, distributing, and managing virtual and physical cards</h3></center>
 
 <div class="row" style="margin-top: 17px;"> 
 <div class="col-md-4">
        <div class="card">
          <div class="card-body">
              <div class="text-center"><i class="fa fa-rocket fa-3x" style="color:#1d0d44"  aria-hidden="true"></i></div>
              <br>
          <h3 class="text-center">Get started instantly</h3>
       <h4> Launch your card instantly. There are no setup fees or long-term contracts.</h4>
    </div>
    </div>
    </div>
    <div class="col-md-4">
        <div class="card">
          <div class="card-body"> 
           <div class="text-center"><i class="fa fa-cogs fa-3x" style="color:#1d0d44"  aria-hidden="true"></i></div>
              <br>
          <h3 class="text-center">Control your Cards</h3>
<h4>Create cards that work exactly as you’ve setup to manage - Set spending limits, Pause & Close </h4>
    </div>
    </div>
    </div>
    <div class="col-md-4">
        <div class="card">
          <div class="card-body"> 
           <div class="text-center"><i class="fa fa-credit-card-alt fa-3x" style="color:#1d0d44"  aria-hidden="true"></i></div>
              <br>
          <h3 class="text-center">Multiple Type of card</h3>
<h4>From buying online movies ticket  to pay your monthly bills-personal and business expenses.</h4>
    </div>
    </div>
    </div>
  </div>                            
 <div class="row" style="margin-top:-20px;"> 
 @foreach($virtualCardsProductType as $k => $productDetails)
    <div class="col-md-4">
        <div class="card">
           
          <div class="card-body"> 
          
            <div class="cardnbb">
            <!-- Card body -->
           
           
              <div class="row" style="margin-top: -16px;">
                <img src="{{url('asset/images/'.$productDetails->image)}}" width="100%">
                
              </div>             
             <br>
             
            
             
          </div>
          <div class="row" style='margin-bottom: -24px;'>
            <div class="col-sm-6">  
          <h3 style="font-size: 15px;">{{$productDetails->name}}</h3>
          </div>
          <div class="col-sm-6"> 
          <a  href="{{route('user.instant_issue_designs', ['id' => $productDetails->id])}}" class="btn btn-success" style="background-color:#1d0d44;margin-top: -8px;">Get Started<!--i class="fa fa-arrow-right" aria-hidden="true"></i-->
</a>
          </div>
          </div>
          <hr>
          <div style="margin-top: -28px;">
              {{$productDetails->description}}


            </div>  
    </div>
      
     
      
      </div>
      </div>
      
      <div class="modal fade" id="editDesign{{$productDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Card Design')}} </h3>
                                                    </div>
                                                      <form action="#" method="POST">
                                                        @csrf
                                                       <input type="hidden" name="design_id" value="{{$productDetails->id}}">
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Name')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="design_name" placeholder="Enter Card Type Name" value="{{$productDetails->name}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Status')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <select class="form-control" name="status">
                                                                     <option value="1">Active</option>
                                                                     <option value="0">Inactive</option>
                                                                </select>     
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Description')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description"  required>{{$productDetails->description}}</textarea>
                                                            </div>
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button  type="submit" class="btn btn-success">{{__('Update Now')}}</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="modal fade" id="delete{{$productDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <a  href="#" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
      
     @endforeach 
   

      </div>
                   
                            

                                                  
                                
                                
                                 
                                
                                             
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--ADD MODEL-->
 <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Add New Card Design')}} </h3>
                                                    </div>
                                                      <form action="#" method="POST">
                                                        @csrf
                                                       
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Design Name')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="design_name" placeholder="Enter Design Name" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Features')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description" required></textarea>
                                                            </div>
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button  type="submit" class="btn btn-success">{{__('Add Now')}}</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
@stop