
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="parallax effect-section">
    <div class="mask white-bg opacity-8"></div>
        <div class="container position-relative">
            <div class="row screen-65 align-items-center justify-content-center p-100px-tb">
                <div class="col-lg-10 text-center">
                    <h6 class="white-color-black font-w-500"><?php echo e($set->title); ?></h6>
                    <h1 class="display-4 black-color m-20px-b"><?php echo e(__('Cards')); ?></h1>
                </div>
            </div>
        </div>
        <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: -100;"><div style="background-size: cover; background-image: url(&quot;file:///Users/mac/Documents/Templates/themeforest-cDhKHVPF-raino-multipurpose-responsive-template/template/static/img/1600x900.jpg&quot;); position: absolute; top: 0px; left: 0px; width: 1440px; height: 420px; overflow: hidden; pointer-events: none; margin-top: 31.5px; transform: translate3d(0px, -74.5px, 0px); background-position: 50% 50%; background-repeat: no-repeat no-repeat;">
        </div>
    </div>
</section>
<section class="p-50px-b">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12 m-30px-b align-self-center">
                <p><b>Card On File Authorization</b></p>
                
<p>By linking a payment card to your CuminUp account, you authorize CuminUp to charge your linked payment card each time you initiate a transaction to add funds to your CuminUp account. If such charge is rejected or fails, CuminUp may charge your payment card again later without advance notice to you. You understand that your payment card information will be saved on file for future transactions on your account.
<br><p>If you choose to remove funds from your CuminUp account, you also authorize a credit to your payment card by CuminUp to accomplish that transaction.</p>
<br><p>You may unlink a payment card from your CuminUp account. However, unlinking your payment card will not cancel transactions that have already been authorized on that payment card.</p>
<br><p>All charges authorized using CuminUp are also subject to the terms and conditions set forth by the entities that issue your payment card. You are responsible for complying with those terms and conditions, and you are responsible for payment of all charges and related fees imposed by such entities pursuant to those terms and conditions.</p>
<br><p>Linking a payment card should only be done by the person whose name is on the card. Using payment cards of others is prohibited.</p>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/front/cards.blade.php ENDPATH**/ ?>