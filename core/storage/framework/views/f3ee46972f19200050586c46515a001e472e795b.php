<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        
        <div class="row">
          <div class="col-lg-12">
            <div class="">
              <div class="card-body">
                <div class="">
                  <a data-toggle="modal" data-target="#create-plan" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Create')); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="modal fade" id="create-plan" tabindex="-1" role="dialog" aria-labelledby="create-plan" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-body p-0">
                    <div class="card bg-white border-0 mb-0">
                      <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Create New Seo')); ?></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="card-body">
                        <form action="<?php echo e(route('admin.seo.create')); ?>" method="post" id="modal-details">
                          <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Page')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="page" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Title')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Key Words')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="key_words" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Content')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="content" class="form-control" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Status')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inctive</option>
                                    </select>
                                </div>
                            </div> 
                            
                            <div class="text-right">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Create')); ?></button>
                            </div>         
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>         
          </div>
        </div>
    
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0"><?php echo e(__('SEO Details')); ?></h3>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-buttons">
                    <thead>
                        <tr>
                            <th><?php echo e(__('S/N')); ?></th>
                            <th><?php echo e(__('Page')); ?></th>
                            <th><?php echo e(__('Title')); ?></th>
                             <th><?php echo e(__('Description')); ?></th>  
                            <th><?php echo e(__('Key Words')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>    
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $seo_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$k); ?>.</td>
                            <td><?php echo e($val->page); ?></td>
                            <td><?php echo e($val->title); ?></td>
                            <td><?php echo e($val->content); ?></td>
                            <td><?php echo e($val->key_words); ?></td>
                            
                            <td>
                                <?php if($val->status==0): ?>
                                    <span class="badge badge-pill badge-info"><?php echo e(__('inactive')); ?></span>
                                <?php elseif($val->status==1): ?>
                                    <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span> 
                                <?php endif; ?>
                            </td>  
                            <td>
                                <div class="dropdown">
                                    <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a data-toggle="modal" data-target="#edit<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Edit')); ?></a>
                                        <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Delete')); ?></a>
                                    </div>
                                </div>
                            </td>                   
                        </tr>
                        
                        <div class="modal fade" id="edit<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card bg-white border-0 mb-0">
                                            <div class="card-header">
                                                <h3 class="mb-0"><?php echo e(__('Update')); ?></h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <form action="<?php echo e(route('admin.seo.update', ['id' => $val->id])); ?>" method="post" id="modal-update<?php echo e($val->id); ?>">
                                                  <?php echo csrf_field(); ?>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12"><?php echo e(__('Page')); ?><span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="page" class="form-control" value="<?php echo e($val->page); ?>" required>
                                                        </div>
                                                    </div> 
                            
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12"><?php echo e(__('Title')); ?><span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="title" class="form-control" value="<?php echo e($val->title); ?>" required>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12"><?php echo e(__('Key Words')); ?><span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="key_words" class="form-control" value="<?php echo e($val->key_words); ?>" required>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12"><?php echo e(__('Content')); ?><span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <input type="text" name="content" class="form-control" value="<?php echo e($val->content); ?>" required>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-12"><?php echo e(__('Status')); ?><span class="text-danger">*</span></label>
                                                        <div class="col-lg-12">
                                                            <select name="status" class="form-control">
                                                                <option value="1" <?php if($val->status == 1){ echo "selected"; } ?>>Active</option>
                                                                <option value="0" <?php if($val->status == 0){ echo "selected"; } ?>>Inctive</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm" form="modal-update<?php echo e($val->id); ?>"><?php echo e(__('Update')); ?></button>
                                                    </div>         
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card bg-white border-0 mb-0">
                                            <div class="card-header">
                                                <h3 class="mb-0"><?php echo e(__('Are you sure you want to delete this?')); ?></h3>
                                            </div>
                                            <div class="card-body px-lg-5 py-lg-5 text-right">
                                                <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                <a  href="<?php echo e(route('admin.seo.delete', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
                    </tbody>                    
                </table>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/admin/seo/index.blade.php ENDPATH**/ ?>