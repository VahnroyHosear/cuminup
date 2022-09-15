


<?php $__env->startSection('content'); ?>
<!-- Page content -->

<?php
    $address1 = Auth::user()->address1;
    $address2 = Auth::user()->address2;
    $city = Auth::user()->city;
    $state = Auth::user()->state;
    $country = Auth::user()->country;
    $zip_code = Auth::user()->zip_code;
?>

<style>
    .searchf {
    padding-bottom: 15px;
    padding-top: 15px;padding-left: 12px;
}
.mainsearch {
    width: 94%;
    border: 1px solid #f3f3f3;
    padding: 8px;
    border-radius: 8px;
}
.mainbtn {
    border: 1px solid #e1e1e1;
    padding: 7px 9px;
    border-radius: 6px;
}
</style>

<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <?php if(empty($address1) || empty($address2) || empty($city) || empty($state) || empty($country) || empty($zip_code)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Alert!</strong> Please update your Warehouse/Shop/Office address (Shipping company will pickup the item from this address ).
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <a href="<?php echo e(url('user/profile')); ?>">
                  <button type="button" style="padding: 3px 10px; background-color: #000; color: white; font-size: 12px; margin: 0px; border: 1px solid #000; float: right; font-weight: 600;">
                    Take Action
                  </button>
              </a>
            </div>
        <?php endif; ?>
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral" style="font-size: 1.2rem;"><i class="fa fa-plus"></i><?php echo e(__('Add Your Services/Products')); ?></a>
              <a href="<?php echo e(route('user.list')); ?>" class="btn btn-sm btn-success" style="font-size: 1.2rem;"><i class="fa fa-braille"></i><?php echo e(__(' All Orders')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('New Product')); ?> <button type="button" class="close" style="float:right" data-dismiss="modal">&times;</button></h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="<?php echo e(route('submit.product')); ?>" id="form" method="post" enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Name')); ?><span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                          <input type="text" name="name" class="form-control" placeholder="The name of your product" required>
                        </div>
                      </div>       
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?><span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                          <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                            <input type="number" step="any" name="amount" maxlength="10" class="form-control" required="">
                          </div>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Quantity')); ?><span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                          <input type="number" name="quantity" class="form-control" value="1" required>
                        </div>
                      </div> 
                      
                      <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Image')); ?><span class="text-danger">*</span></label>
                          <div class="col-lg-10">
                              <div class="custom-file text-center">
                                  <input type="file" class="custom-file-input" name="file" accept="image/*" id="customFileLang">
                                  <label class="custom-file-label" for="customFileLang"><?php echo e(__('Choose Media')); ?></label>
                              </div>
                          </div>
                          <p style="color: #ff9900; font-size: 14px; margin-left: 15px;">Upload image size must be more than 200 x 200</p>
                      </div>
              
              
                      <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
      
      <div class="col-md-12">
        <div class="modal fade" id="modal-socialdetails" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                      <h1 class="mb-3"><?php echo e(__(' Your product is ready to sell')); ?></h1>
                    <h3 class="mb-0"><?php echo e(__(' Product Details')); ?></h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                      <?php if(isset($productdetails)) {?>
                       <div class="row mb-3">
                          <div class="col-4">
                            <!--<span class="form-text text-xl"><?php echo e($currency->symbol); ?> <?php echo e(number_format($productdetails->amount)); ?>.00</span>-->
                            <span class="form-text text-xl"><?php echo e($currency->symbol); ?> <?php echo e(number_format($productdetails->amount, 2)); ?></span>
                          </div>
                          <div class="col-8 text-right">
                             
                            <?php if($productdetails): ?>
                            
                            <a href="<?php echo e(url('/')); ?>/user/edit-product/<?php echo e($productdetails->id); ?>" class="btn btn-sm btn-success" title="Edit Product"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="<?php echo e(url('/')); ?>/user/orders/<?php echo e($productdetails->id); ?>" class="btn btn-sm btn-neutral" title="Orders"><i class="fa fa-spinner"></i> Orders</a>
                            <?php endif; ?>
                            <a data-toggle="modal" data-target="#delete<?php echo e($productdetails->id); ?>" href="" class="btn btn-neutral btn-sm text-danger" title="Delete link"><i class="fa fa-trash"></i> Delete</a>
                             <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> <?php echo e(__('Close')); ?></button>
                          </div>
                        </div>
                        <div class="row align-items-center">
                            <?php if(empty($productdetails->length) || empty($productdetails->width) || empty($productdetails->height) || empty($productdetails->weight) || $productdetails->shipping_status == 0): ?>
                                <div class="row align-items-center">
                                    <div class="alert alert-warning" role="alert" style="width: 100%; padding: 5px 15px;">
                                      <strong>Alert!</strong> Please update your Shipping package details(i.e Length/Width/Hieght & Weight).
                                      <a href="<?php echo e(url('/')); ?>/user/edit-product/<?php echo e($productdetails->id); ?>">
                                          <button type="button" style="padding: 2px 10px; background-color: #000; color: white; font-size: 11px; margin: 0px; border: 1px solid #000; float: right; font-weight: 600;">
                                            Take Action
                                          </button>
                                      </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <!-- Avatar -->
                            <a href="javascript:void;" class="avatar avatar-l">
                              <img               
                              <?php if($productdetails->new==0): ?>
                               
                                
                                src="<?php echo e(url('/')); ?>/asset/images/default_product.png"
                                
                                
                              <?php else: ?>
                                <?php
                                $image=App\Models\Productimage::whereproduct_id($productdetails->id)->first();
                                ?>
                                src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($image['image']); ?>"
                              <?php endif; ?> alt="Image placeholder">
                            </a>
                          </div>
                          <div class="col">
                            <p class="text-sm text-dark mb-0" style="font-size: 25px !important; text-transform: capitalize;"><?php echo e($productdetails->name); ?></p>
                            <p class="text-sm text-dark mb-0">Stock: <?php echo e($productdetails->quantity); ?></p>
                            <?php if($productdetails->status==1): ?>
                                <span class="badge badge-pill badge-success my-3"><?php echo e(__('Active')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-pill badge-danger my-3"><?php echo e(__('Disabled')); ?></span>
                            <?php endif; ?>
                            <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(route('product.link', ['id' => $productdetails->ref_id])); ?>" title="Copy" style="border-radius: 50px; padding: 3px 7px 3px 7px; background-color: #256278; color: white; font-size: 17px; margin: 10px 0px;"><?php echo e(__('Copy Product Link')); ?></button></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="font-size:18px; padding-top: 10px; text-align:center;">
                                Sell your item by Social Media
                            </div>
                            <div class="share text-center">
                            	<div>
                            		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(route('product.link', ['id' => $productdetails->ref_id]))); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook" style="font-size:20px" ><img src="<?php echo e(url('/')); ?>/asset/social/fb.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(route('product.link', ['id' => $productdetails->ref_id]))); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/twitter.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="Copy Product Link & Post on Instagram" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/insta.png" style="width: 40px; margin-right: 7px;"></a>
                                </div>
                                <div>
                                    <div style="font-size: 20px;">Or</div>
                            		<a href="http://www.reddit.com/submit?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Reddit" style="font-size:20px" ><img src="<?php echo e(url('/')); ?>/asset/social/reddit.png" style="width: 40px; margin-right: 7px;"></a>
                                	<a href="https://pinterest.com/pin/create/button/?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'media' => '','description' => $productdetails->name])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Pinterest" style="font-size:20px" ><img src="<?php echo e(url('/')); ?>/asset/social/pinterest.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.linkedin.com/shareArticle?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,'mini' => true])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="LinkedIn" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/linkedin.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.tumblr.com/share?<?php echo e(http_build_query(['u' => route('product.link', ['id' => $productdetails->ref_id]),'t' => $productdetails->name,'v' => 3])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="tumblr" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/tumblr.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://vk.com/share.php?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,'image' => '','noparse' => false])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="VK" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/vk.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.digg.com/submit?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Digg" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/digg.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="http://www.viadeo.com/?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $productdetails->ref_id]),'title' => $productdetails->name,'image' => ''])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Viadeo" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/viadeo.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="whatsapp://send?text=<?php echo e(rawurlencode($productdetails->name ." | ". route('product.link', ['id' => $productdetails->ref_id]))); ?>" data-toggle="tooltip" data-placement="top" title="WhatsApp" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/whatsapp.png" style="width: 40px; margin-right: 7px;"></a>
                                    <a href="mailto:?subject=<?php echo e($productdetails->name); ?>&amp;body=<?php echo e(route('product.link', ['id' => $productdetails->ref_id])); ?>" data-toggle="tooltip" data-placement="top" title="Email" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/gmail.png" style="width: 40px; margin-right: 7px;"></a>
                            	</div>
                            	<div class="addthis_native_toolbox"></div>
                            </div>
                        </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
      
    </div>
    

    
    <div class="row m-0">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <span class="text-sm text-dark mb-0" style="color: #ffad33!important;"><i class="fa fa-wallet"></i> <?php echo e(__('Received')); ?></span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($received)); ?>.00</span><br>
              </div>
            </div>
          </div>
        </div> 
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                  <span class="surtitle" style="text-transform: capitalize;"><?php echo e(__('Pending')); ?></span><br>
                  <span class="surtitle" style="text-transform: capitalize;"><?php echo e(__('Total')); ?></span>
              </div>
              <div class="col-auto">
                  <span class="surtitle " style="    font-size: 20px;"><?php echo e($currency->name); ?> 0.00</span><br>
                  <span class="surtitle " style="    font-size: 20px;"><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
        
    <form action="<?php echo e(route('product.result')); ?>" method="GET" id="search-form_3" class="searchf">
        <?php echo e(csrf_field()); ?>

        <input type="text" placeholder="Search Product.." name="searchTerm" class="mainsearch" value="<?php echo e(isset($searchTerm) ? $searchTerm : ''); ?>">
        <button type="submit" class="mainbtn"><i class="fa fa-search"></i></button>
    </form>
                          
    <div class="row">  
      <div class="col-md-12">
        <?php if(isset($product) && count($product) > 0): ?>
            <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <div class="card">
                    <?php if(empty($val->length) || empty($val->width) || empty($val->height) || empty($val->weight) || $val->shipping_status == 0): ?>
                        <div class="row align-items-center">
                            <div class="alert alert-warning" role="alert" style="width: 100%; padding: 5px 15px; margin: 0px 15px;">
                              <strong>Alert!</strong> Please update your Shipping package details(i.e Length/Width/Hieght & Weight).
                              <a href="<?php echo e(url('/')); ?>/user/edit-product/<?php echo e($val->id); ?>">
                                  <button type="button" style="padding: 2px 10px; background-color: #000; color: white; font-size: 11px; margin: 0px; border: 1px solid #000; float: right; font-weight: 600;">
                                    Take Action
                                  </button>
                              </a>
                            </div>
                        </div>
                    <?php endif; ?>
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <!--<span class="form-text text-xl"><?php echo e($currency->symbol); ?> <?php echo e(number_format($val->amount)); ?>.00</span>-->
                        <span class="form-text text-xl" style="color: rgb(3 168 78); font-weight: bold;"><?php echo e($currency->symbol); ?> <?php echo e(number_format($val->amount, 2)); ?></span>
                      </div>
                      <div class="col-8 text-right">
                        <?php if($val->status==1): ?>
                        <a href="<?php echo e(url('/')); ?>/user/edit-product/<?php echo e($val->id); ?>" class="btn btn-sm btn-success" title="Edit Product"><i class="fa fa-pen"></i> Edit</a>
                        <a href="<?php echo e(url('/')); ?>/user/orders/<?php echo e($val->id); ?>" class="btn btn-sm btn-neutral" title="Orders"><i class="fa fa-spinner"></i> Orders</a>
                        <?php endif; ?>
                        <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a>
                      </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6" style="border-right: 1px solid #dfdfdf;">
                            <div class="row">
                              <div class="col-md-3">
                                <!-- Avatar -->
                                <a href="javascript:void;" class="avatar avatar-l">
                                  <img               
                                  <?php if($val->new==0): ?>
                                   
                                    src="<?php echo e(url('/')); ?>/asset/images/default_product.png"
                                  <?php else: ?>
                                    <?php
                                    $image=App\Models\Productimage::whereproduct_id($val->id)->first();
                                    ?>
                                    src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($image['image']); ?>"
                                  <?php endif; ?> alt="Image placeholder" style="height: 55px;">
                                </a>
                              </div>
                              <div class="col-md-9">
                                <p class="text-sm text-dark mb-0" style="font-size: 20px !important; text-transform: capitalize;"><?php echo e($val->name); ?></p>
                                <p class="text-sm text-dark mb-0">Stock: <?php echo e($val->quantity); ?></p>
                                <?php if($val->status==1): ?>
                                    <span class="badge badge-pill badge-success my-3"><?php echo e(__('Active')); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-danger my-3"><?php echo e(__('Disabled')); ?></span>
                                <?php endif; ?>
                                <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(route('product.link', ['id' => $val->ref_id])); ?>" title="Copy"style="border-radius: 50px; padding: 3px 7px 3px 7px; background-color: #256278; color: white; font-size: 17px; margin: 10px 0px;"><?php echo e(__('Copy Product Link')); ?></button></p>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div style="font-size:18px; text-align:center;">
                                Sell your item by Social Media
                          </div>
                          <div class="share text-center">
                            	<div>
                            		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(route('product.link', ['id' => $val->ref_id]))); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook" style="font-size:20px" ><img src="<?php echo e(url('/')); ?>/asset/social/fb.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(route('product.link', ['id' => $val->ref_id]))); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/twitter.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="Copy Product Link & Post on Instagram" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/insta.png" style="width: 35px; margin-right: 7px;"></a>
                                </div>
                                <div style="font-size: 20px;">Or</div>
                                <div>
                            		<a href="http://www.reddit.com/submit?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Reddit" style="font-size:20px" ><img src="<?php echo e(url('/')); ?>/asset/social/reddit.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="https://pinterest.com/pin/create/button/?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'media' => '','description' => $val->name])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Pinterest" style="font-size:20px" ><img src="<?php echo e(url('/')); ?>/asset/social/pinterest.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="http://www.linkedin.com/shareArticle?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,'mini' => true])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="LinkedIn" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/linkedin.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="http://www.tumblr.com/share?<?php echo e(http_build_query(['u' => route('product.link', ['id' => $val->ref_id]),'t' => $val->name,'v' => 3])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="tumblr" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/tumblr.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="http://vk.com/share.php?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,'image' => '','noparse' => false])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="VK" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/vk.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="http://www.digg.com/submit?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Digg" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/digg.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="http://www.viadeo.com/?<?php echo e(http_build_query(['url' => route('product.link', ['id' => $val->ref_id]),'title' => $val->name,'image' => ''])); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="Viadeo" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/viadeo.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="whatsapp://send?text=<?php echo e(rawurlencode($val->name ." | ". route('product.link', ['id' => $val->ref_id]))); ?>" data-toggle="tooltip" data-placement="top" title="WhatsApp" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/whatsapp.png" style="width: 35px; margin-right: 7px;"></a>
                                    <a href="mailto:?subject=<?php echo e($val->name); ?>&amp;body=<?php echo e(route('product.link', ['id' => $val->ref_id])); ?>" data-toggle="tooltip" data-placement="top" title="Email" style="font-size:20px"><img src="<?php echo e(url('/')); ?>/asset/social/gmail.png" style="width: 35px; margin-right: 7px;"></a>
                            	</div>
                            	<div class="addthis_native_toolbox"></div>
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
                                      <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this will also be deleted')); ?></span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                      <a  href="<?php echo e(route('delete.product', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($product->links()); ?>

        <?php else: ?>
        <center><div class="col-md-12">
              <br>
                <p class="text-center card-text mt-5"><?php echo e(__('No product found!')); ?></p>
               <h3><?php echo e(__('Let’s Sell Your First product!')); ?></h3>
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral" style="font-size: 1.2rem;"><i class="fa fa-plus"></i> <?php echo e(__('Get Started')); ?></a>
              <p class="text-center text-muted card-text mt-0"></p>
             <img src="https://cards.getvirtualcard.co.uk/asset/profile/nodata.png" width="30%">
          </div></center>
        <!--div class="col-md-12">
            <p style="background: #fff; padding: 10px; border-radius: 7px;">Let’s Sell Your First Item!.</p>
            <div class="card">
             
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col" style="text-align:center">
                    <img src="<?php echo e(url('asset/profile/nodata.png')); ?>" width="30%">
                  </div>
                 
                </div>
                
              </div>
            </div>
          </div-->
        <?php endif; ?>
      </div>
      
      
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">
	var _URL = window.URL || window.webkitURL;
    
    function isSupportedBrowser() {
        return window.File && window.FileReader && window.FileList && window.Image;
    }
    
    function getSelectedFile() {
        var fileInput = document.getElementById("customFileLang");
        var fileIsSelected = fileInput && fileInput.files && fileInput.files[0];
        if (fileIsSelected)
            return fileInput.files[0];
        else
            return false;
    }
    
    function isGoodImage(file) {
        var deferred = jQuery.Deferred();
        var image = new Image();
    
        image.onload = function() {
            // Check if image is bad/invalid
            if (this.width + this.height === 0) {
                this.onerror();
                return;
            }
    
            // Check the image resolution
            if (this.width >= 200 && this.height >= 200) {
                deferred.resolve(true);
            } else {
                alert("The image resolution must be more than 200*200.");
                deferred.resolve(false);
            }
        };
    
        image.onerror = function() {
            alert("Invalid image. Please select an image file.");
            deferred.resolve(false);
        }
    
        image.src = _URL.createObjectURL(file);
    
        return deferred.promise();
    }
    
    
    $("#form").submit(function(event) {
        var form = this;
    
        if (isSupportedBrowser()) {
            event.preventDefault(); //Stop the submit for now
    
            var file = getSelectedFile();
            if (!file) {
                alert("Please select an image file.");
                return;
            }
    
            isGoodImage(file).then(function(isGood) {
                if (isGood)
                    form.submit();
            });
        }
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/vcard/core/resources/views/user/product/index.blade.php ENDPATH**/ ?>