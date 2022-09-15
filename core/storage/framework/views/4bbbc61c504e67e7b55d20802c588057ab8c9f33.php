<?php $__env->startSection('content'); ?>
<style>
div.dt-top-container {
  display: grid;
  grid-template-columns: 100px auto auto;
}

div.dt-center-in-div {
 /* margin: 0 auto;  */
}

div.dt-filter-spacer {
  margin: 10px 0;
}
</style>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('All Transactions')); ?></h3>
      </div>
      <?php if(count($transactions) > 0): ?>
      <div class="table-responsive py-4">
           <div class="row"> 
                 <div class="col-sm-6"></div>
                   
                    <div class="col-sm-3">
                    <select class="form-control" onchange="selectedValue(this.value)">
                        <option value="">Select by Services</option>
                        <option> Deposit</option> 
                        <option> Donation</option>
                         <option> Prepaid Card</option>
                          <option> Prepaid Card Plan</option>
                           <option> Subscribe</option>
                           <option> Transfer</option>
                        
                    </select> 
                    </div>
                   
                    
                    
                </div>
        <table class="table table-flush" id="datatable-buttons_3434">
          <thead class="">
            <tr>
              <th><?php echo e(__('Date')); ?></th>
              <th><?php echo e(__('Type')); ?></th>
              <th><?php echo e(__('Reference ID')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Charge')); ?></th>
              <th><?php echo e(__('Total')); ?></th>
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
                <td>#<?php echo e($val->ref_id); ?></td>
                <td><?php echo e($currency->symbol.number_format($val->amount-$val->charge,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
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
                             <div class="col-6" style="border: 1px solid ;"><?php echo e($currency->symbol.number_format($val->amount-$val->charge,2)); ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Status')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></div>
                         </div> 
                         <div class="row" >
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('User')); ?></div>
                             <div class="col-6" style="border: 1px solid;"><?php echo e(__('Own Wallet')); ?></div>
                         </div> 
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
               <td class="shorting_1"><span style="display:none;"><?php echo e(strtotime($val->created_at)); ?></span><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></td>
                <td>
                    <?php echo e(__('Transfer')); ?>

                </td>
                <td>#<?php echo e($val->ref_id); ?></td>
                <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->amount+$val->charge,2)); ?></td>
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
               <td class="shorting_1"> <span style="display:none;"><?php echo e(strtotime($val->created_at)); ?></span><?php echo e(date("d/m/Y h:i:A", strtotime($val->created_at))); ?></td>
                <td>
                    <?php echo e(__('Subscribe')); ?>

                </td>
                <td>#<?php echo e($val->ref_id); ?></td>
                <td><?php echo e($currency->symbol.number_format($val->amount,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td>
                 <td><?php echo e($currency->symbol.number_format($val->amount+$val->charge,2)); ?></td>
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

<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>



<script>
function selectedValue(selectedvalue)
{
    var oTable = $('#datatable-buttons_3434').DataTable();
    oTable.search(selectedvalue).draw();

}
$(document).ready(function() {
    $('#datatable-buttons_3434').DataTable( {
        dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<ip>',
        "autoWidth": true,
            "lengthChange": true,
            "pageLength": 25,
           
      
       "order": [[ 0, "desc" ]], //or asc 
    "columnDefs" : [{"targets":0, "type":"date-eu"}],
        buttons: [
            'copy','csv' ,'excel' ,'print'
            ,{
            extend: 'pdfHtml5',
                //orientation: 'landscape',
               // pageSize: 'LEGAL'
               }
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


       
</script>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/transactions/all_transactions.blade.php ENDPATH**/ ?>