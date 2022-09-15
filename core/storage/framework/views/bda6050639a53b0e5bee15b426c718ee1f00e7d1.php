<?php $__env->startSection('content'); ?>
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
   
    </head>
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
    background: #f5b716;
}

.dvc{    padding: 10px;
    background: #f4f7fc;
    border-radius: 5px;}
<?php $__currentLoopData = $AllvCardDesigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $DesignDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
.card-body2<?php echo e($DesignDetails->id); ?>{
background: <?php echo e($DesignDetails->class_name); ?>;
  
     padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
   
    }
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
/**FOR SLIDER**/
.card .carousel-item {
  height: 50%;
}
.card .carousel-caption {
  padding: 0;
  right: 0;
  left: 0;
  color: #3d3d3d;
}
.card .carousel-caption h3 {
  color: #3d3d3d;
}
.card .carousel-caption p {
  line-height: 30px;
}
.card .carousel-caption .col-sm-3 {
  display: flex;
  align-items: center;
}
.card .carousel-caption .col-sm-9 {
  text-align: left;
}
.navi a {
    text-decoration:none;
}
a > .ico {
    background-color: grey;
    padding: 10px;
    
}
a:hover > .ico {
    background-color: #666;
}
.newicon .btn {
    background-color:#dcdde0;
}
</style>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
     
      
      <div class="row">
      <div class="col-md-8">
           <!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button-->
          <?php if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2): ?>
          <div class="row boxbg">
              <div class="col-md-12">
                  <form action="#" class="searchf">
      <input type="text" placeholder="Search.." name="search" class="mainsearch">
      <button type="submit" class="mainbtn"><i class="fa fa-search"></i></button>
    </form>
              </div>
          </div>
          
          
          <div class="mapp">
           <div class="row boxbg"> 
          <div class="col-6 newicon" style="text-align: center;">
         <a href="#">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/shopping-cart.png">
            </div>
            <h4>eStore</h4>
            </a>
            </div>
           
             <div class="col-6 newicon" style="text-align: center;">
                <a href="<?php echo e(url('/')); ?>/user/invoice">
         <div class="row align-items-center">
            <img class="di" src="<?php echo e(url('/')); ?>/asset/images/quotation.png">
            </div>
           <h4>e-Invoice</h4>
           </a>
            </div>
            </div>
             <div class="row boxbg"> 
           <div class="col-6 newicon" style="text-align: center;">
               <a href="<?php echo e(url('/')); ?>/user/sc-links">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/dashboard.png">
            </div>
           <h4>Payment URLs</h4>
           </a>
            </div>
            
                 <div class="col-6 newicon" style="text-align: center;">
               
               
           <?php if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2): ?>
                
           <a href="<?php echo e(url('/')); ?>/user/virtualcard">
         <div class="row align-items-center">
          <img class="di" src="<?php echo e(url('/')); ?>/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>
            <?php else: ?>
              <a href="<?php echo e(url('/')); ?>/user/virtualcard" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
          <img class="di" src="<?php echo e(url('/')); ?>/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>  
            <?php endif; ?>
            </div>
             </div>
              <div class="row boxbg"> 
             <div class="col-6 newicon" style="text-align: center;">
                 
            <?php if(Auth::user()->user_type == 1): ?>
            <a href="<?php echo e(url('/')); ?>/user/transfer" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            <?php else: ?>
               <a href="<?php echo e(url('/')); ?>/user/transfer">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            <?php endif; ?>
            </div>
            
            
             <div class="col-6 newicon" style="text-align: center;">
                 
            <?php if(Auth::user()->user_type == 1): ?>
            <a href="<?php echo e(url('/')); ?>/user/request" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            <?php else: ?>
                <a href="<?php echo e(url('/')); ?>/user/request">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            <?php endif; ?>
            </div>
            </div>
          
          </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          <div class="dapp">
           
      <div class="row boxbg"> 
      <div class="col-lg-2 newicon" style="text-align: center;">
               
               
           <?php if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2): ?>
           <a href="<?php echo e(url('/')); ?>/user/virtualcard">
         <div class="row align-items-center">
          <img class="di" src="<?php echo e(url('/')); ?>/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>
                
            <?php else: ?>
              <a href="<?php echo e(url('/')); ?>/user/virtualcard" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
          <img class="di" src="<?php echo e(url('/')); ?>/asset/images/credit-card.png">
            </div>
           <h4>Virtual Cards</h4>
           </a>  
            <?php endif; ?>
            </div>
     
            
           
            
      
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                  <?php if(Auth::user()->user_type == 2): ?>
                <a href="<?php echo e(url('/')); ?>/user/invoice">
         <div class="row align-items-center">
            <img class="di" src="<?php echo e(url('/')); ?>/asset/images/quotation.png">
            </div>
           <h4>e-Invoice</h4>
           </a>
           <?php else: ?>
           <a href="#" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
            <img class="di" src="<?php echo e(url('/')); ?>/asset/images/quotation.png">
            </div>
           <h4>e-Invoice</h4>
           </a>
           <?php endif; ?>
            </div>
            
           <div class="col-lg-2 newicon" style="text-align: center;">
              <?php if(Auth::user()->user_type == 2): ?>
               <a href="<?php echo e(url('/')); ?>/user/sc-links" style="width: 110px;">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/dashboard.png">
            </div>
           <h4>Payment URLs</h4>
           </a>
           <?php else: ?>
           <a href="#" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm" style="width: 110px;">
            <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/dashboard.png" style="width: 43%;">
            </div>
           <h4>Payment URL</h4>
           </a>
            <?php endif; ?>   
            </div>
            
                 
            <div class="col-lg-2 newicon" style="text-align: center;">
            <?php if(Auth::user()->user_type == 2): ?>    
         <a href="<?php echo e(url('/user/product')); ?>">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/shopping-cart.png">
            </div>
            <h4>Sell Online</h4>
            </a>
            <?php else: ?>
            <a href="#" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
                <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/shopping-cart.png">
            </div>
            <h4>Sell Online</h4>
            </a>    
            <?php endif; ?>
            </div>
            
            
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                 
            <?php if(Auth::user()->user_type == 1): ?>
            <a href="<?php echo e(url('/')); ?>/user/transfer" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            <?php else: ?>
               <a href="<?php echo e(url('/')); ?>/user/transfer">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            <?php endif; ?>
            </div>
            
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                 
            <?php if(Auth::user()->user_type == 1): ?>
            <a href="<?php echo e(url('/')); ?>/user/request" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            <?php else: ?>
                <a href="<?php echo e(url('/')); ?>/user/request">
         <div class="row align-items-center">
           <img class="di" src="<?php echo e(url('/')); ?>/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            <?php endif; ?>
            </div>
            
         
            
            </div>
            </div>
     
        <!--div class="row boxbg">  
                    <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">No Money Request Found</p>
            </div>
                  </div--> 
        <?php endif; ?>
        <div class="card">
          <?php if(count($transactions) > 0): ?>
          <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Recent Transactions')); ?></h3>
      </div>
      <div class="table-responsive py-4" style="margin-top: -63px;">
        <table class="table table-flush" id="datatable-buttons_3434">
          <thead class="">
            <tr>
              <th><?php echo e(__('Date')); ?></th>
              <th><?php echo e(__('Type')); ?></th>
              <!--th><?php echo e(__('Reference ID')); ?></th-->
              <th><?php echo e(__('Amount')); ?></th>
              <!--th><?php echo e(__('Charge')); ?></th-->
              <!--th><?php echo e(__('Total')); ?></th-->
               <th><?php echo e(__('DR/CR')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
             <th><?php echo e(__('Details')); ?></th>
             
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                  
                 <td class="shorting_1"><span style="display:none;"><?php echo e(strtotime($val->created_at)); ?></span><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></td>
                <td>
                    <?php if($val->type == 1): ?>
                    <?php echo e(__('Deposit')); ?>

                    <?php elseif($val->type == 2): ?>
                    <?php echo e(__('Donation')); ?>

                    <?php elseif($val->type == 3): ?>
                    <?php echo e(__('Invoice')); ?>

                    <?php elseif($val->type == 4): ?>
                    <?php echo e(__('Prepaid Card')); ?>

                    <?php elseif($val->type == 5): ?>
                    <?php echo e(__('Prepaid Card Plan')); ?>

                    <?php elseif($val->type == 11): ?>
                    <?php echo e(__('Single Charge')); ?>

                    <?php else: ?>
                    <?php echo e(__('NA')); ?>

                    <?php endif; ?>
                </td>
                <!--td>#<?php echo e($val->ref_id); ?></td-->
                <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
                 <!--td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td-->
                 <!--td><?php echo e($currency->symbol.number_format($val->amount+$val->charge,2)); ?></td-->
                 <td>
                     
                     <?php if($val->type == 1): ?>
                    <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                    <?php elseif($val->type == 2): ?>
                    <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                    <?php elseif($val->type == 3): ?>
                    <?php echo e(__('Invoice')); ?>

                    <?php elseif($val->type == 4): ?>
                   <span class="badge badge-pill badge-danger"><?php echo e(__('Debit')); ?></span>
                    <?php elseif($val->type == 5): ?>
                   <span class="badge badge-pill badge-danger"><?php echo e(__('Debit')); ?></span>
                    <?php elseif($val->type == 11): ?>
                   <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                    <?php else: ?>
                    <?php echo e(__('NA')); ?>

                    <?php endif; ?>
                    
                </td>
                <td><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></td>
               <td><button class="btn btn-default" data-toggle="modal" data-target="#myModal<?php echo e($val->ref_id); ?>"><?php echo e(__('View')); ?></button></td>
               
                <!-- Modal -->
                  <div class="modal fade" id="myModal<?php echo e($val->ref_id); ?>" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?php echo e(__('View Transaction Details')); ?></h4>
                          <button type="button" class="close" data-dismiss="modal" style="float:right;margin-top: -20px;">&times;</button>
                        </div>
                        <div class="modal-body" style="margin-top:-20px;">
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Created')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Transaction Type')); ?></div>
                             <div class="col-6" style="border: 1px solid;"> <?php if($val->type == 1): ?>
                                <?php echo e(__('Deposit')); ?>

                                <?php elseif($val->type == 2): ?>
                                <?php echo e(__('Donation')); ?>

                                <?php elseif($val->type == 3): ?>
                                <?php echo e(__('Invoice')); ?>

                                <?php elseif($val->type == 4): ?>
                                <?php echo e(__('Prepaid Card')); ?>

                                <?php elseif($val->type == 5): ?>
                                <?php echo e(__('Prepaid Card Plan')); ?>

                                <?php elseif($val->type == 11): ?>
                                <?php echo e(__('Single Charge')); ?>

                                <?php else: ?>
                                <?php echo e(__('NA')); ?>

                                <?php endif; ?>
                            </div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Debit/Credit')); ?></div>
                             <div class="col-6" style="border: 1px solid;"> 
                                <?php if($val->type == 1): ?>
                                <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                                <?php elseif($val->type == 2): ?>
                                <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                                <?php elseif($val->type == 3): ?>
                                <?php echo e(__('Invoice')); ?>

                                <?php elseif($val->type == 4): ?>
                               <span class="badge badge-pill badge-danger"><?php echo e(__('Debit')); ?></span>
                                <?php elseif($val->type == 5): ?>
                               <span class="badge badge-pill badge-danger"><?php echo e(__('Debit')); ?></span>
                                <?php elseif($val->type == 11): ?>
                               <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                                <?php else: ?>
                                <?php echo e(__('NA')); ?>

                                <?php endif; ?>
                            </div>
                         </div>
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Amount')); ?></div>
                             <div class="col-6" style="border: 1px solid ;"><?php echo e($currency->symbol.number_format($val->amount,2)); ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Status')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></div>
                         </div> 
                         <?php if($val->type == 1): ?>
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('User')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Own Wallet')); ?></div>
                         </div> 
                         <?php endif; ?>
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Reference ID')); ?></div>
                             <div class="col-6" style="border: 1px solid;">#<?php echo e($val->ref_id); ?></div>
                         </div> 
                        </div>
                       
                      </div>
                    <!--END MODEL-->  
                    </div>
                  </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
               <td class="sorting_1"><span style="display:none;"><?php echo e(strtotime($val->created_at)); ?></span><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></td>
                <td>
                    <?php echo e(__('Transfer')); ?>

                </td>
                <!--td>#<?php echo e($val->ref_id); ?></td-->
                <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
                 <!--td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td-->
                 <!--td><?php echo e($currency->symbol.number_format($val->amount+$val->charge,2)); ?></td-->
                  <td>
                      <?php if($val->receiver_id == Auth::id()): ?>
                       <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                       <?php elseif($val->sender_id == Auth::id()): ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('Debit')); ?></span>
                       <?php endif; ?>
                  </td>
                <td><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></td>
                
                 <td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal<?php echo e($val->ref_id); ?>"><?php echo e(__('View')); ?></a></td>
                 <!-- Modal -->
                  <div class="modal fade" id="myModal<?php echo e($val->ref_id); ?>" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?php echo e(__('View Transaction Details')); ?></h4>
                          <button type="button" class="close" data-dismiss="modal" style="float:right;margin-top: -20px;">&times;</button>
                        </div>
                        <div class="modal-body" style="margin-top:-20px;">
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Created')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Transaction Type')); ?></div>
                             <div class="col-6" style="border: 1px solid;"> <?php echo e(__('Transfer')); ?>

                                
                            </div>
                         </div> 
                          <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Debit/Credit')); ?></div>
                             <div class="col-6" style="border: 1px solid;"> <?php if($val->receiver_id == Auth::id()): ?>
                       <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                       <?php elseif($val->sender_id == Auth::id()): ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('Debit')); ?></span>
                       <?php endif; ?>
                                
                            </div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Amount')); ?></div>
                             <div class="col-6" style="border: 1px solid ;"><?php echo e($currency->symbol.number_format($val->amount,2)); ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Status')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('User')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php if(!empty($val->receiver['email'])): ?>
                          <?php if($val->receiver['email']!=null): ?>
                          <p class="text-sm text-dark mb-0"><?php echo e($val->receiver['email']); ?></p>
                          <?php else: ?>
                          <p class="text-sm text-dark mb-0"><?php echo e($val->temp); ?></p>
                          <?php endif; ?>
                          <?php endif; ?></div>
                         </div>
                         <?php if($val->sender_id != Auth::id()): ?>
                         <?php $userDetails = DB::table('users')->where('id',$val->sender_id)?>
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('User Email')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php echo e($userDetails->email); ?></div>
                         </div>
                         <?php endif; ?>
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Reference ID')); ?></div>
                             <div class="col-6" style="border: 1px solid;">#<?php echo e($val->ref_id); ?></div>
                         </div> 
                        </div>
                       
                      </div>
                    <!--END MODEL--> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <?php $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
               <td class="shorting_1"><span style="display:none;"><?php echo e(strtotime($val->created_at)); ?></span><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></td>
                <td>
                    <?php echo e(__('Subscribe')); ?>

                </td>
                <!--td>#<?php echo e($val->ref_id); ?></td-->
                <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
                 <!--td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td-->
                 <!--td><?php echo e($currency->symbol.number_format($val->amount+$val->charge,2)); ?></td-->
                  <td>
                      <span class="badge badge-pill badge-danger">Debit</span>
                   </td>
                <td><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></td>
                 
                  <td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal<?php echo e($val->ref_id); ?>"><?php echo e(__('View')); ?></a></td>
                 
                   <!-- Modal -->
                  <div class="modal fade" id="myModal<?php echo e($val->ref_id); ?>" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?php echo e(__('View Transaction Details')); ?></h4>
                          <button type="button" class="close" data-dismiss="modal" style="float:right;margin-top: -20px;">&times;</button>
                        </div>
                        <div class="modal-body" style="margin-top:-20px;">
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Created')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Transaction Type')); ?></div>
                             <div class="col-6" style="border: 1px solid;"> <?php echo e(__('Subscribe')); ?>

                                
                            </div>
                         </div>
                         
                          <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Plan Name')); ?></div>
                             <div class="col-6" style="border: 1px solid;"> <?php echo e($val->plan['name']); ?> 
                                
                            </div>
                         </div>
                          <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Debit/Credit')); ?></div>
                             <div class="col-6" style="border: 1px solid;"> <?php if($val->receiver_id == Auth::id()): ?>
                       <span class="badge badge-pill badge-success"><?php echo e(__('Credit')); ?></span>
                       <?php elseif($val->user_id == Auth::id()): ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('Debit')); ?></span>
                       <?php endif; ?>
                                
                            </div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Amount')); ?></div>
                             <div class="col-6" style="border: 1px solid ;"><?php echo e($currency->symbol.number_format($val->amount,2)); ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Status')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('User')); ?></div>
                             <div class="col-6" style="border: 1px solid;">
                          <?php if(!empty($val->plan['user_id'])): ?>
                         <?php $senderDetails =  DB::table('users')->where('id',$val->plan['user_id'])->first(); ?>
                         <?php echo e($senderDetails->first_name); ?> <?php echo e($senderDetails->last_name); ?>

                         <?php else: ?>
                         <?php echo e('NA'); ?>

                          <?php endif; ?></div>
                         </div>
                         
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Reference ID')); ?></div>
                             <div class="col-6" style="border: 1px solid;">#<?php echo e($val->ref_id); ?></div>
                         </div> 
                        </div>
                       
                      </div>
                    <!--END MODEL--> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
          </tbody>
        </table>
       <a href="<?php echo e(url('user/all-transactions')); ?>" class="btn btn-default" style="float:right;margin-top: -43px;"><?php echo e(__('View All Transactions')); ?></a>
      </div>
      <?php else: ?>
      <center>
           <div class="col-lg-12">
              <br>
                <p class="text-center card-text mt-8"><?php echo e(__('No deposit log Found!')); ?></p>
               <h3><?php echo e(__('Let’s Create your first deposit log')); ?></h3>
             <a href="<?php echo e(url('user/transfer')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="50%">
            
          </div></center>
      <?php endif; ?>
      </div>
            <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('All Card Activites')); ?><a style="float:right;" href="<?php echo e(url('user/virtualcard')); ?>" class="badge badge-pill badge-success"><?php echo e(__('New Card')); ?></a></h3>
      </div>
      <div class="table-responsive py-4">
          <div class="pc_view_table_id">
        <table class="table table-flush" id="datatable-button">
          <thead>
            <tr >
              <th><?php echo e(__('Merchant')); ?></th>
              <th><?php echo e(__('Card Last 4 Digit')); ?></th>
               <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Date')); ?></th>
              

            </tr>
          </thead>
          <tbody>
              <?php if(count($AlltrxList) > 0): ?>
              <?php $__currentLoopData = $AlltrxList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$trxDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $CardDetails = DB::table('virtual_cards')->where('last_four_digit',$trxDetails->card_last_four)->first();?>
              <?php if($k < 9): ?>
              <tr data-toggle="modal" data-target="#modal-more<?php echo e($trxDetails->id); ?>" style="cursor: pointer;">
                  <td><?php echo e($trxDetails->merchant_descriptor); ?></td>
                  <td><?php echo e('XXXXXX'); ?><?php echo e($trxDetails->card_last_four); ?></td>
                  <td><?php echo e($trxDetails->trx_status); ?></td>
                  <td><?php echo e($currency->symbol.number_format($trxDetails->amount,2)); ?></td>
                  <td><?php echo e(date("Y/m/d h:i:A", strtotime($trxDetails->created_at))); ?></td>
                 </tr>
            
            <?php endif; ?> 
           
            
          
            <!--START MODEL-->
               <div class="modal fade" id="modal-more<?php echo e($trxDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-sm-4" >
                <div class="card bg-white border-0 mb-0" style="padding:10px;">
                <!--div class="card-header">
                    <h3 class="mb-0 font-weight-bolder"><?php echo e($trxDetails->card_memo); ?> Card Details</h3>
                    
                </div-->
               <div class="card-body2<?php echo e($CardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
 <?php if($CardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($CardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('PENDING'); ?><?php endif; ?></span>                  </div>
               
              </div>             
              <div class="my-3">
                <span class="h6 surtitle text-white mb-2">
                <?php echo e($trxDetails->card_memo); ?>

                </span>
                <div class="text-primary">
                  <div style="color:white"><?php echo e(substr($CardDetails->pan,0,4)); ?> <?php echo e(substr($CardDetails->pan,4,4)); ?> <?php echo e(substr($CardDetails->pan,8,4)); ?> <?php echo e(substr($CardDetails->pan,12,4)); ?></div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php if(empty($CardDetails->exp_month)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e($CardDetails->exp_month); ?><?php endif; ?> / <?php if(empty($CardDetails->exp_year)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e(substr($CardDetails->exp_year,2,4)); ?><?php endif; ?></span><br>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php if(empty($CardDetails->cvv)): ?><?php echo e('XXX'); ?><?php else: ?><?php echo e($CardDetails->cvv); ?><?php endif; ?></span><br>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-1 openn">
                Nick Name
                </span>
                <div class="text-primary openname">
                   <span style="color: grey;">Nickname</span><br>
                  <div style="color: black!important;font-size:22px"><?php echo e($trxDetails->card_memo); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc">
               
                <div class="text-primary openname" >
                      <span style="color: grey;">Total Spend Limit</span><br>
                  <div style="color: black!important;font-size:22px"><?php echo e($currency->symbol.number_format($trxDetails->card_spend_limit,2)); ?> / <?php echo e($currency->symbol.number_format($trxDetails->card_spend_limit,2)); ?></div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
               
                <div class="text-primary openname">
                   <span style="color: grey;">Funding Source</span><br>
                  <p style="color: black!important;font-size:22px">xxxx xxx xxx </p>
                </div>
              </div>
            <div class="row" style="width: 100%;
    margin: 0px auto;
    border: 1px solid grey;
    border-radius: 8px;
    background: black;">
                <div class="col-md-6">
                 <?php if($CardDetails->is_paused_by_admin == 0): ?>    
                  <?php if($CardDetails->card_state == 'PAUSED'): ?>
                    <a data-toggle="modal" data-target="#opencard-model<?php echo e($CardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    <?php endif; ?>
                    <?php if($CardDetails->card_state == 'OPEN'): ?>
                    <a data-toggle="modal" data-target="#myModal2<?php echo e($CardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    <?php endif; ?>

                </div>
                <div class="col-md-6">
                     <?php if($CardDetails->card_state != 'CLOSED'): ?>

                    <a data-toggle="modal" data-target="#closecard-model<?php echo e($CardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Close</strong></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
                </div>
                </div>
                <div class="col-sm-8">
                    <button type="button" class="close" data-dismiss="modal" style="padding:10px" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Transactions')); ?>                                           <?php if(count($AlltrxList) > 7): ?>
                     <a href="<?php echo e(url('/')); ?>/user/virtualtransactions/<?php echo e($trxDetails->card_token); ?>" style="float:right" class="">See All Transactions</a>
                     <?php endif; ?>  </h3>

      </div>
      <div class="table table-flush">
       <?php $__currentLoopData = $AlltrxList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$trxDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <?php if($k < 10 && $trxDetails->card_last_four == $CardDetails->last_four_digit): ?>
                    <div class="row " style="font-size:12px;margin-bottom:10px;">
                        <div class="col-sm-3"><?php echo e($trxDetails->merchant_descriptor); ?></div>
                        <div class="col-sm-3"><?php echo e(date("Y/m/d h:i:A", strtotime($trxDetails->created_at))); ?></div>
                        <div class="col-sm-3"><?php echo e($currency->symbol.number_format($trxDetails->amount,2)); ?></div>
                         <div class="col-sm-3"><?php echo e($trxDetails->trx_status); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                  </div>  
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      <!--END MODEL-->
      <!--START PAUSE MODEL-->
         <div class="modal fade" data-id="pausecard-model<?php echo e($CardDetails->id); ?>" id="myModal2<?php echo e($CardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.pause_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                 
                    <input type="hidden" name="card_token" value="<?php echo e($CardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--END PAUSE MODEL-->
           <div class="modal fade" id="opencard-model<?php echo e($CardDetails->id); ?>" style="z-index: 1060;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  
                
                    <input type="hidden" name="card_token" value="<?php echo e($CardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model<?php echo e($CardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Close Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.close_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  
                
                    <input type="hidden" name="card_token" value="<?php echo e($CardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    $(document).ready(function () {

    

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


});
    </script>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if(count($AlltrxList) < 1): ?>
            <tbody>
             <tr>
                 <td></td>
                 <td></td>
                <td><center><b>No Activity Found!</b></center></td>
            </tr> 
            </tbody>
            
            <?php endif; ?>
          </tbody>
        </table>
        <?php if(count($AlltrxList) < 1): ?>
        <center><img src="<?php echo e(url('/')); ?>/asset/profile/nodata.png" style="width:30%"></center>
        <?php endif; ?>
        <?php if(count($AlltrxList) > 0 ): ?>
        <center> <a href="<?php echo e(url('/')); ?>/user/virtualcard" class="btn btn-default">See All Activity</a> </center> 
        <?php endif; ?>
 </div>
   
    
  


      </div> 
      
      </div> 
      <!--START FOR BUSINESS-->
      <?php if(Auth::user()->user_type == 2): ?>
            <div class="row boxbg" style="    padding-top: 13px;">  
                  
                  <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Wallet
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($user->balance)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Sent</span><br>
                  <span class="surtitle " style="color: #323131!important;">Received</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($sendMoney_sent)); ?>.00</span><br>
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($request_sent)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
               Sale Online
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($estore_received)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> 0.00</span><br>
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($estore_total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Settlements
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($settlements_received)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($settlements_pending)); ?>.00</span><br>
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($settlements_total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Send Money
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($sendMoney_sent)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle" style="color: #323131!important;">Returned</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($sendMoney_pending)); ?>.00</span><br>
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($sendMoney_rebursed)); ?>.00</span><br>
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($sendMoney_total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Request
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($request_sent)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($request_pending)); ?>.00</span><br>
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($request_total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
               Invoices
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($invoice_received)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($invoice_pending)); ?>.00</span><br>
                  <span class="surtitle " style="color: #323131!important;"><?php echo e($currency->name); ?> <?php echo e(number_format($invoice_total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
     
                  
                  </div> 
                  <?php endif; ?>
                  <!--END FOR BUSINESS-->
     </div>
     
      <div class="col-md-4">
          
          
          
           <?php if(count($virtualCardsList) == 0): ?>
    
          <div class="card-body" style="    background: white;
    border-radius: 5px;"> 
          <h3>Virtual Cards</h3>
           

            <div class="card-body1">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <span class="badge badge-pill badge-success">Card Details</span>                </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">No Card Found</span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <div style="color: #ffffff !important;margin-top:15px">
                     
                      <?php if(Auth::user()->user_type == 1): ?>
                      <a href="<?php echo e(url('/')); ?>/user/virtualcard" class="dvc">Create Virtual Card</a>
          <?php else: ?>
                <a href="<?php echo e(url('/')); ?>/user/virtualcard" class="dvc">Create Virtual Card</a>
            <?php endif; ?>
                      </div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <br>
                  
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <br>
                  <span class="text-primary"></span>
                </div>     
                <div class="col">
                    <img src="<?php echo e(url('/')); ?>/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
         
    </div>
    
    <?php endif; ?>
          
          
          
        
        <div class="card" style="background-color:transparent;box-shadow:none">
          
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="100000">
    <div class="w-100 carousel-inner" role="listbox">
    
      
    
    <?php $__currentLoopData = $virtualCardsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $CardDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($k< 10): ?>
  
    <div class="card-body" style="padding: 0.4rem;"> 

           <a href="#" data-toggle="modal" data-target="#modal-more<?php echo e($CardDetails->id); ?>" style="cursor: pointer;">
            <div class="card-body2<?php echo e($CardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                <span class="badge badge-pill badge-success"><?php if($CardDetails->card_state == 'OPEN'): ?><?php echo e('Active'); ?><?php elseif($CardDetails->card_state == 'CLOSED'): ?><?php echo e('CLOSED'); ?><?php else: ?><?php echo e('Inactive'); ?><?php endif; ?></span>               
                  </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">
               <?php echo e($CardDetails->host_name); ?>

                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX   <?php echo e($CardDetails->last_four_digit); ?></div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;"><?php echo e($currency->symbol); ?><?php echo e(number_format($CardDetails->restAmount/100,2)); ?> / <span class="text-gray" style="color: #ffffff !important;"><?php echo e($currency->symbol); ?><?php echo e(number_format($CardDetails->spend_limit,2)); ?></span></span>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="h6 surtitle text-gray">XXX</span>
                </div>     
                <div class="col">
                    <img src="<?php echo e(url('/')); ?>/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
            </a>
           
          
    </div> 
    
              <!--START MODEL-->
               <div class="modal fade" id="modal-more<?php echo e($CardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-sm-4" >
                <div class="card bg-white border-0 mb-0" style="padding:10px;">
                
               <div class="card-body2<?php echo e($CardDetails->design_id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
 <?php if($CardDetails->card_state == 'OPEN'): ?> <span class="badge badge-pill badge-success"><?php echo e('Active'); ?></span>
                 <?php elseif($CardDetails->card_state == 'CLOSED'): ?><span class="badge badge-pill badge-danger"><?php echo e('CLOSED'); ?></span>
                 <?php else: ?><span class="badge badge-pill badge-danger"><?php echo e('PENDING'); ?><?php endif; ?></span>                  </div>
               
              </div>             
              <div class="my-3">
                <span class="h6 surtitle text-white mb-2">
                <?php if(!empty($trxDetails->card_memo)): ?>
                <?php echo e($trxDetails->card_memo); ?>

                <?php else: ?>
                 <?php echo e('XXXXXX'); ?>

                <?php endif; ?>
                </span>
                <div class="text-primary">
                  <div style="color:white"><?php echo e(substr($CardDetails->pan,0,4)); ?> <?php echo e(substr($CardDetails->pan,4,4)); ?> <?php echo e(substr($CardDetails->pan,8,4)); ?> <?php echo e(substr($CardDetails->pan,12,4)); ?></div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white"><?php if(empty($CardDetails->exp_month)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e($CardDetails->exp_month); ?><?php endif; ?> / <?php if(empty($CardDetails->exp_year)): ?><?php echo e('XX'); ?><?php else: ?><?php echo e(substr($CardDetails->exp_year,2,4)); ?><?php endif; ?></span><br>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white"><?php if(empty($CardDetails->cvv)): ?><?php echo e('XXX'); ?><?php else: ?><?php echo e($CardDetails->cvv); ?><?php endif; ?></span><br>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-1 openn">
                Nick Name
                </span>
                <div class="text-primary openname">
                   <span style="color: grey;">Nickname</span><br>
                  <div style="color: black!important;font-size:22px"><?php if(!empty($trxDetails->card_memo)): ?>
                <?php echo e($trxDetails->card_memo); ?>

                <?php else: ?>
                 <?php echo e('XXXXXX'); ?>

                <?php endif; ?></div>
                </div>
              </div>
              
              <div class="my-4 openc">
               
                <div class="text-primary openname" >
                      <span style="color: grey;">Total Spend Limit</span><br>
                  <div style="color: black!important;font-size:22px"><?php if(!empty($trxDetails->card_spend_limit)): ?><?php echo e($currency->symbol.number_format($trxDetails->card_spend_limit,2)); ?><?php endif; ?> / <?php if(!empty($trxDetails->card_spend_limit)): ?><?php echo e($currency->symbol.number_format($trxDetails->card_spend_limit,2)); ?><?php endif; ?></div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
               
                <div class="text-primary openname">
                   <span style="color: grey;">Funding Source</span><br>
                  <p style="color: black!important;font-size:22px">xxxx xxx xxx </p>
                </div>
              </div>
            <div class="row" style="width: 100%;
    margin: 0px auto;
    border: 1px solid grey;
    border-radius: 8px;
    background: black;">
                <div class="col-md-6">
                 <?php if($CardDetails->is_paused_by_admin == 0): ?>
                 
                  <?php if($CardDetails->card_state == 'PAUSED'): ?>
                    <a data-toggle="modal" data-target="#opencard-model<?php echo e($CardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    <?php endif; ?>
                    <?php if($CardDetails->card_state == 'OPEN'): ?>
                    <a data-toggle="modal" data-target="#myModal2<?php echo e($CardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    <?php endif; ?>

                </div>
                <div class="col-md-6">
                     <?php if($CardDetails->card_state != 'CLOSED'): ?>

                    <a data-toggle="modal" data-target="#closecard-model<?php echo e($CardDetails->id); ?>" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Close</strong></a>
                    <?php endif; ?>
                </div>
                
                <?php endif; ?>
            </div>
                </div>
                </div>
                <div class="col-sm-8">
                    <button type="button" class="close" data-dismiss="modal" style="padding:10px" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Transactions')); ?>                                         
                     <a href="<?php echo e(url('/')); ?>/user/virtualtransactions/<?php echo e($CardDetails->token); ?>" style="float:right" class="">See All Transactions</a>
                      </h3>

      </div>
      <div class="table table-flush">
          <?php if(count($AlltrxList) > 0): ?>
       <?php $__currentLoopData = $AlltrxList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$trxDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <?php if($k < 10 && $trxDetails->card_last_four == $CardDetails->last_four_digit): ?>
                    <div class="row " style="font-size:12px;margin-bottom:10px;">
                        <div class="col-sm-3"><?php echo e($trxDetails->merchant_descriptor); ?></div>
                        <div class="col-sm-3"><?php echo e(date("Y/m/d h:i:A", strtotime($trxDetails->created_at))); ?></div>
                        <div class="col-sm-3"><?php echo e($currency->symbol.number_format($trxDetails->amount,2)); ?></div>
                         <div class="col-sm-3"><?php echo e($trxDetails->trx_status); ?></div>
                    </div>
                    <?php else: ?>
                    <?php if($k < 1): ?>
                    <div class="row">
                        <div class="col-sm-3"></div><center><p>No Transaction available!</></center>
                        </div>
                    <?php endif; ?>    
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
                  </div>  
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      <!--END MODEL-->
      <!--START PAUSE MODEL-->
         <div class="modal fade" data-id="pausecard-model<?php echo e($CardDetails->id); ?>" id="myModal2<?php echo e($CardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.pause_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($CardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--END PAUSE MODEL-->
           <div class="modal fade" id="opencard-model<?php echo e($CardDetails->id); ?>" style="z-index: 1060;" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.open_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="<?php echo e($CardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model<?php echo e($CardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Close Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="<?php echo e(route('user.close_virtual_card')); ?>">
                    <?php echo csrf_field(); ?>
                  
                
                    <input type="hidden" name="card_token" value="<?php echo e($CardDetails->token); ?>">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
   <?php if(count($virtualCardsList) > 0): ?>  
   <center> <a href="<?php echo e(url('/')); ?>/user/virtualcard" class="btn btn-default">See All Cards</a> </center> 
   <?php endif; ?>
     <br>
        
   
     </tbody>
     </table>
 
   </div>
      </div>
      
      </div>
          
      </div>
      
     
     
     
     
     
     
       </div>
       
       
            
      <!--TEST-->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center mt-5 pt-5 pb-4">
      <h3> <i class="fas fa-crown" style="color: #fff704; font-size: 20px;"></i> Upgrade to Enterprise</h3>
      <a href="<?php echo e(route('user.doc-verification')); ?>"><p>Click Here..</p></a>
    </div>
  </div>
</div>
 <script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
  <!--TEST-->
  <script>
  $(document).ready(function() {
    $('#trasactionTable_id').DataTable();
});
  </script>
  <script>

$(document).ready(function() {
    $('#datatable-buttons_3434').DataTable( {
      "pageLength": 10,
       "sDom": "lfrti",
       "lengthChange": false,
       "order": [[ 0, "desc" ]], //or asc 
    "columnDefs" : [{"targets":0, "type":"date-eu"}],
    } );
} );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/newdashboard/index.blade.php ENDPATH**/ ?>