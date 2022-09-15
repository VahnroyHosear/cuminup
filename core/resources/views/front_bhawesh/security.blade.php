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
                    <h1 class="display-4 black-color m-20px-b">{{$title}}</h1>
                </div>
            </div>
        </div>
        <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: -100;"><div style="background-size: cover; background-image: url(&quot;file:///Users/mac/Documents/Templates/themeforest-cDhKHVPF-raino-multipurpose-responsive-template/template/static/img/1600x900.jpg&quot;); position: absolute; top: 0px; left: 0px; width: 1440px; height: 420px; overflow: hidden; pointer-events: none; margin-top: 31.5px; transform: translate3d(0px, -74.5px, 0px); background-position: 50% 50%; background-repeat: no-repeat no-repeat;">
        </div>
    </div>
</section>
<!--<section class="p-50px-b">-->
<!--    <div class="container">-->
<!--        <div class="row flex-row-reverse">-->
<!--            <div class="col-lg-12 m-30px-b align-self-center">-->
<!--                <p style="text-align:center"><img src="https://cuminup.com/asset/images/comingsoon.png"></p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<section class="" style="padding-top: 50px;padding-bottom: 50px;">
    <div class="container">
        <h3 class="" style="color:#338ecc;text-align: center;">The Safest Way to Pay</h3>
        <div class="col-10 m-auto ">
            <p class="mb-3 text-justify">The security of your personal information and data is critical to everything that we do here at Privacy. Here are some relevant details about the safeguards we have built into our technology stack.</p>
      
        </div>
          <hr>
        </div>
</section>
<section class="" style="padding-bottom: 50px;">
    <div class="container">
        <h3 class="" style="color:#338ecc;text-align: center;">Overview</h3>
        <div class="col-10 m-auto">
            <p class="mb-3 text-justify">Our team includes people from some of the top payments and security companies (Get Virtual Card In UK), and we’re bringing that expertise to Privacy.Privacy is PCI-DSS compliant. We are held to the same rigorous security standards as your bank.</p>
            

 </section>
<section class="" style="padding-bottom: 50px;">
    <div class="container">
        <h3 class="" style="color:#338ecc;text-align: center;">Data At Rest / Infrastructure</h3>
        <div class="col-10 m-auto">
            <p class="mb-3 text-justify">Passwords are hashed using PBKDF2 with 100k iterations and salted to make rainbow table attacks more difficult.
Sensitive information is encrypted using split-key encryption with partial keys held by separate employees.
Customer data is stored on single-tenant hardware in private networks in at least three separate geographic locations and is inaccessible from the outside world.</p>
            
 </section>
<section class="" style="padding-bottom: 50px;">
    <div class="container">
        <h3 class="" style="color:#338ecc;text-align: center;">Data In Transit</h3>
        <div class="col-10 m-auto">
            <p class="mb-3 text-justify">Data is never sent in plaintext. All web traffic is sent over Transport Layer Security (TLS) HSTS for privacy and security.
Inter-data center communication protected via Internet Protocol Security (IPsec) with AES-256.</p>

</section>
<section class="" style="padding-bottom: 50px;">
    <div class="container">
        <h3 class="" style="color:#338ecc;text-align: center;">Policies</h3>
        <div class="col-10 m-auto">
            <p class="mb-3 text-justify">Aggressive biannual encryption key rotation schedule.
Servers are firewalled and regularly updated with the latest security patches.
We follow best practices and all code is peer-reviewed before deployment.
For access controls, we follow the principles of least privilege.</p>
            
            
        </div>
        </div>           
            
            
        </div>
        </div>

            </div>
            </div>
        </div>
        </div>
</section>
@stop