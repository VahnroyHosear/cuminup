
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="parallax effect-section gray-bg">
        <div class="container position-relative">
            <div class="row screen-65 align-items-center justify-content-center p-100px-tb">
                <div class="col-lg-10 text-center">
                    <h6 class="white-color-black font-w-500"><?php echo e($set->title); ?></h6>
                    <h1 class="display-4 black-color m-20px-b"><?php echo e($post->title); ?></h1>
                </div>
            </div>
        </div>
        <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: -100;"><div style="background-size: cover; background-image: url(&quot;file:///Users/mac/Documents/Templates/themeforest-cDhKHVPF-raino-multipurpose-responsive-template/template/static/img/1600x900.jpg&quot;); position: absolute; top: 0px; left: 0px; width: 1440px; height: 420px; overflow: hidden; pointer-events: none; margin-top: 31.5px; transform: translate3d(0px, -74.5px, 0px); background-position: 50% 50%; background-repeat: no-repeat no-repeat;">
        </div>
    </div>
</section>
<section class="section gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-40px-r lg-p-15px-r md-m-15px-tb">
                <div class="article box-shadow">
                    <div class="article-img">
                        <img src="<?php echo e(url('/')); ?>/asset/thumbnails/<?php echo e($post->image); ?>" title="" alt="">
                    </div>
                    <div class="article-content">
                    <p><?php echo $post->details; ?></p>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/front/single.blade.php ENDPATH**/ ?>