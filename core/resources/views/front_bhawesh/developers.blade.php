@extends('layout')
@section('css')

@stop
@section('content')
<section class="parallax effect-section">
    <div class="mask white-bg opacity-8"></div>
        <div class="container position-relative">
            <div class="row screen-65 align-items-center justify-content-center p-100px-tb">
                <div class="col-lg-10 text-center">
                    <h6 class="white-color-black font-w-500">{{$set->title}}</h6>
                    <h1 class="display-4 black-color m-20px-b">{{__('Developers')}} {{$set->site_name}}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="p-50px-b">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12 m-30px-b align-self-center">
                <div class="wpb_single_image wpb_content_element vc_align_center">
		
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img width="800" height="533" src="https://getvirtualcard.co.uk/asset/images/developers.jpg" class="vc_single_image-img attachment-large" alt="" loading="lazy" srcset="https://getvirtualcard.co.uk/asset/images/developers.jpg 1536w" sizes="(max-width: 800px) 100vw, 800px"></div>
		</figure>
	</div>
	<br>
	<h2 style="text-align: center">Developer-First Platform</h2>
	<p style="text-align: center;">We first built this platform to meet our own engineering needs at Get Virtual Card, so you can bet it’s developer-first, not just developer-friendly.</p>
            <div class="row justify-content-between">
       <div class="col-lg-3 m-15px-tb pt-3" style="text-align: left;">
              <div class="wpb_single_image wpb_content_element vc_align_center">
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img class="vc_single_image-img " src="https://getvirtualcard.co.uk/asset/images/calculator.png" width="80" height="80" alt="6" title="6"></div>
		</figure>
	</div>
               <h5 class="pt-5">No Minimums or Year-Long Contracts</h5>
               <div class="sc_item_descr sc_title_descr sc_align_center"><p>A plug-and-play platform means less commitment, and less time spent considering if we’re right for you.</p>
</div>
            
           
         </div>
         <div class="col-lg-3 m-15px-tb pt-3" style="text-align: left;">
             <div class="wpb_single_image wpb_content_element vc_align_center">
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img class="vc_single_image-img " src="https://getvirtualcard.co.uk/asset/images/delivery.png" width="80" height="80" alt="4" title="4"></div>
		</figure>
	</div>
              <h5 class="pt-5">User Onboarding</h5>
              <div class="sc_item_descr sc_title_descr sc_align_center"><p>We have user KYC and fraud checks covered. Rolled your own? Bring your pre-approved users to our platform.</p>
</div>
          
         </div>
         <div class="col-lg-3 m-15px-tb pt-3" style="text-align: left;">
              <div class="wpb_single_image wpb_content_element vc_align_center">
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img class="vc_single_image-img " src="https://getvirtualcard.co.uk/asset/images/voucher.png" width="80" height="80" alt="2" title="2"></div>
		</figure>
	</div>
               <h5 class="pt-5">Transparent Pricing</h5>
               <div class="sc_item_descr sc_title_descr sc_align_center"><p>We break down our pricing so you can know exactly what you’re paying for. No ambiguous fees, and no surprises.</p>
</div>
           
            
         </div>
         <div class="col-lg-3 m-15px-tb pt-3" style="text-align: left;">
              <div class="wpb_single_image wpb_content_element vc_align_center">
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img class="vc_single_image-img " src="https://getvirtualcard.co.uk/asset/images/ui-design (1).png" width="80" height="80" alt="3" title="3"></div>
		</figure>
	</div>
               <h5 class="pt-5">Painless Setup</h5>
               <div class="sc_item_descr sc_title_descr sc_align_center"><p>Create active card numbers immediately for a few cents per card. Start building without buy-in today, and launch when your team is ready.</p>
</div>

           
         </div>
       
         </div>
            </div>
        </div>
    </div>
</section>

@stop