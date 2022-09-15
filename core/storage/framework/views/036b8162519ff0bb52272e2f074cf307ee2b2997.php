<?php $__env->startSection('content'); ?>
<head>
<style>

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
</head>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card" >
      <div class="card-header">
            <h3 class="mb-0"><?php echo e(__('Send Promotional Emails')); ?></h3>
            <a href="<?php echo e(url('admin/send_push_notification')); ?>">Send Notification</a>
        </div>
    </div>
    
 
   <div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Send to All Users</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Send to Selected Users</button>
</div>

<div id="London" class="tabcontent">
     <div class="card">
    <div class="card-header">
            <h3 class="mb-0"><?php echo e(__('Send email to all users')); ?></h3>
            
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('user.promo.send')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="email_type" value="all">
                <div class="form-group row">
                    <label class="col-form-label col-lg-2"><?php echo e(__('Subject')); ?>:</label>
                    <div class="col-lg-10">
                        <input type="text" name="subject" maxlength="200" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2"><?php echo e(__('Message')); ?>:</label>
                    <div class="col-lg-10">
                        <textarea type="text" name="message" rows="8" class="form-control tinymce"></textarea>
                    </div>
                </div>          
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Send')); ?></button>
                </div>
            </form>
        </div>
    </div>    
</div>

<div id="Paris" class="tabcontent">
     <div class="card">
        <div class="card-header">
            <h3 class="mb-0"><?php echo e(__('Send email to selected users')); ?></h3>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('user.promo.send')); ?>" method="post">
            <?php echo csrf_field(); ?> 
            <input type="hidden" name="email_type" value="selected">
            <div class="form-group row">
                    <label class="col-form-label col-lg-2"><?php echo e(__('Select Users(Hold Ctrl then Select)')); ?>:</label>
                    <div class="col-lg-10">
                        <select name="user_id[]" class="form-control" multiple="multiple">
                           
                            <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($userDetails->id); ?>"><?php echo e($userDetails->first_name); ?> <?php echo e($userDetails->last_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>    
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2"><?php echo e(__('Subject')); ?>:</label>
                    <div class="col-lg-10">
                        <input type="text" name="subject" maxlength="200" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2"><?php echo e(__('Message')); ?>:</label>
                    <div class="col-lg-10">
                        <textarea type="text" name="message" rows="8" class="form-control tinymce"></textarea>
                    </div>
                </div>          
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Send')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
    
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/admin/user/promo.blade.php ENDPATH**/ ?>