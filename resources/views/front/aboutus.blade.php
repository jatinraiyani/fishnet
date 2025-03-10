@extends('layouts.app')
@section('title')
AgastyaMarine | About Us
@endsection
@section('content')
<!-- banner -->
<secction class="product-detail-banner">
    <div class="container">
        <div class="product-banner">
            <h1>About Us</h1>

        </div>
    </div>
</secction>
<section class="section-graping ">
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-xxl-10">
                <div class="row align-items-center mb-5">
            <div class="col-md-7">
                <div class="about-img">
                    <img src="{{ asset('public/front/images/about-img.jpg') }}" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-text about-right">
                    <h3>Welcome To Our Store</h3>
                    <p>WE STARTED OUR JOURNEY IN 1992. MR. HIRALAL R. HODAR CO.FOUNDER OF FISHERMAN NET STARTED DESIGNING & MANUFACTURING TRAWL NETS. WE ARE DEALING IN TRAWL NET MORE THAN 25 YEARS. IN 2019 WE STARTED OUR NEW ORGANIZATION  AGASTYA NET SYSTEM . NOW WE ARE DEALING AND TRADING ALL KINDS OF FISHING NETS, FISHING ROPES, TWINES AND OTHER MARINE PRODUCTS. WE HAVE MORE THAN 300+ HAPPY CUSTOMERS ACROSS THE ALL GUJRAT’S MARINE PORTS. LOOKING TOWARD “EMERGACY & URGANCY” MARINE INDUSRTY WE STARED FIRST MARIEN E COMERCE WEBSITE FOR ALL KIND OF MARINE PRODUCTS.</p>
                    <a class="secondary-button ">Go to store </a>
                </div>
            </div>
        </div>
        <!-- <div class="row align-items-center mb-5">

            <div class="col-md-5 order-md-1 order-2">
                <div class="about-text about-left">
                    <h3>OUR MISSION STATEMENT</h3>
                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu.
</p>
                    <p>
                    Non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                    <a class="secondary-button ">Go to store </a>
                </div>
            </div>
            <div class="col-md-7  order-md-2 order-1">
                <div class="about-img">
                    <img src="{{ asset('public/front/images/about-img1.jpg')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div> -->
</div>
</div>
    </div>
</section>
<section class="section-graping meet-our ">
    <div class="container">
        <div class="text-center">
            <h2>Meet our Team</h2>
            <p>Our Great skilled workers</p>
            <div class="owl-carousel owl-theme about-carousel">
                <div class="item">
                    <div class="team-img">
                        <img src="{{ asset('public/front/images/chintanhhodar-min.JPG')}}" alt="chintanhhodar" class="img-fluid">
                    </div>

                    <div class="team-name">
                        <h4>Chintan H Hodar</h4>
                    </div>
                </div>
                <div class="item">
                    <div class="team-img">
                        <img src="{{ asset('public/front/images/abhishekhhodar-min.JPG')}}" alt="abhishekhhodar" class="img-fluid">
                    </div>
                    <div class="team-name">
                        <h4>Abhishek H Hodar</h4>
                    </div>
                </div>
                <div class="item">
                    <div class="team-img">
                        <img src="{{ asset('public/front/images/bhaveshbmalam-min.JPG')}}" alt="bhaveshbmalam" class="img-fluid">
                    </div>
                    <div class="team-name">
                        <h4>Bhavesh B Malam</h4>
                    </div>
                </div>                
                <div class="item">
                    <div class="team-img">
                        <img src="{{ asset('public/front/images/jaydjungi-min.JPG')}}" alt="jaydjungi" class="img-fluid">
                    </div>
                    <div class="team-name">
                        <h4>Jay D Jungi</h4>
                    </div>
                </div>
                <div class="item">
                    <div class="team-img">
                        <img src="{{ asset('public/front/images/mayurlmalam-min.JPG')}}" alt="mayurlmalam" class="img-fluid">
                    </div>
                    <div class="team-name">
                        <h4>Mayur L Malam</h4>
                    </div>
                </div>
                <div class="item">
                    <div class="team-img">
                        <img src="{{ asset('public/front/images/sajanmkotiya-min.JPG')}}" alt="sajanmkotiya" class="img-fluid">
                    </div>
                    <div class="team-name">
                        <h4>Sajan M Kotiya</h4>
                    </div>
                </div>
                <div class="item">
                    <div class="team-img">
                        <img src="{{ asset('public/front/images/yogeshkgirnari-min.JPG')}}" alt="yogeshkgirnari" class="img-fluid">
                    </div>
                    <div class="team-name">
                        <h4>Yogesh K Girnari</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<section class="graping-section feedback-clients">
    <div class="container">
        <div class="title-section">
            <h2>Words from our Clients</h2>
            <p>Feedback from our Trusted client</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="client-word">
                    <div class="client-img">
                        <img src="{{ asset('public/front/images/client-img.png')}}" class="img-fluid" alt="">
                    </div>
                    <div class="client-info">
                        <h4>Ryan Diaz</h4>
                        <p>Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                            Lorem Ipsum has been the industry’s Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                            Lorem Ipsum has
                            standard dummy.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="client-word">
                    <div class="client-img">
                        <img src="{{ asset('public/front/images/client-img.png')}}" class="img-fluid" alt="">
                    </div>
                    <div class="client-info">
                        <h4>Ryan Diaz</h4>
                        <p>Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                            Lorem Ipsum has been the industry’s Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                            Lorem Ipsum has
                            standard dummy.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection