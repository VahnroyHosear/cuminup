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
                    <!--<h1 class="display-4 black-color m-20px-b">{{$title}}</h1>-->
                    <h1 class="display-4 black-color m-20px-b">Physical Card</h1>
                </div>
            </div>
        </div>
        <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: -100;"><div style="background-size: cover; background-image: url(&quot;file:///Users/mac/Documents/Templates/themeforest-cDhKHVPF-raino-multipurpose-responsive-template/template/static/img/1600x900.jpg&quot;); position: absolute; top: 0px; left: 0px; width: 1440px; height: 420px; overflow: hidden; pointer-events: none; margin-top: 31.5px; transform: translate3d(0px, -74.5px, 0px); background-position: 50% 50%; background-repeat: no-repeat no-repeat;">
        </div>
    </div>
</section>


<section class="section effect-section" style=" padding: 0px 0;">
    <div class="container">
        <div class="row align-items-center">
          
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">We make it easier to manage physical cards for customers to use them.</h3>
                
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    
                  <p>Secure, simple to use, and save you the stress of having to carry your wallet around. Also, they’re easy to lock right from your phone if you are worried that your account has been compromised.</p>
                  
                    
                     
                </div>
          <div class="p-20px-t" style=" padding-top: 40px;">
                    <a class="m-btn m-btn-radius m-btn-theme" target="_blank" href="https://getvirtualcard.co.uk/register">
                        <span class="m-btn-inner-text">Apply Now</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
              <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://getvirtualcard.co.uk/asset/images/physical card (2).png" title="" alt="">
            </div>
        </div>
    </div>
</section>


<section class="gray-bg" style="padding-top: 50px;padding-bottom: 50px;">
   <div class="container">
       </div>
</section>


<section class="gray-bg">
   <div class="container">
      <div class="row justify-content-between">
           <div class="col-lg-6 m-15px-tb">
             <div>
                 <img src="https://getvirtualcard.co.uk/asset/images/Card-Production-2-1 (1).png" alt="" title="">
                  </div>
         </div>
         <div class="col-lg-6 m-15px-tb pt-3">
            
           <br> <h3 class="h1" style="
               padding-bottom: 22px;color:#171347;
               ">Benefits of Physical Card</h3>
            <li>Ability to use online and POS (point-of-sale) in store.</li>
            <li>Can be used all over the globe.</li>
            <li>Easy to create and use for your business. </li>
            <li>Improved oversight and accountability you receive over your business’ money.</li>
            <li>Full control over your payments</li>
            <li>Remain updated – Stay informed with alerts and reminders for payments.</li>
         </div>

</section>

<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 m-15px-tb">
                <br><br><h3 class="h1">Physical cards, accepted everywhere</h3>
                
               
                    <p class="font-2 p-0px-t">
                        Choose one of the world’s top card networks. We supports all the largest card schemes 
                    </p>
                     
                <div class="p-20px-t" style="padding-top: 40px;">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://getvirtualcard.co.uk/register">
                        <span class="m-btn-inner-text">Get Started</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-15px-tb text-center">
               <br><br> <img src="https://getvirtualcard.co.uk/asset/images/accept everywhere2.png" title="" alt="" style="    margin-bottom: 35px;">
            </div>
            
        </div>
    </div>
</section>

</section>
<section class="gray-bg" style="padding-top: 50px;padding-bottom: 50px;">
    <div class="container our-process">
       
</section>
@stop
<style>

.ecomm i {
    font-size: 50px;
    color: #171347;
}
    /* Create three columns of equal width */
.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

/* Style the list */
.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

/* Add shadows on hover */
.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

/* Pricing header */
.price .header-basic{
      background: rgba(51,142,204,0.89);
  color: white;
  font-size: 25px;
}
.price .header-adv {
      background: rgba(29,51,108,0.89) !important;
  color: white;
  font-size: 25px;
}
.price .header-special {
      background: rgba(20,205,125,0.89) !important;
  color: white;
  font-size: 25px;
}

/* List items */
.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

/* Grey list item */
.price .grey {
  background-color: #eee;
  font-size: 20px;
}
.price h1{
    color:#fff;
}

/* The "Sign Up" button */
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 12px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px
  border-radius: 20px;
}

/* Change the width of the three columns to 100%
(to stack horizontally on small screens) */
@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
   
   .col-lg-2.m-15px-tb.pt-3 {
    text-align: center;
}
}
</style>
