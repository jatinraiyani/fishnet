<!-- Option 1: Bootstrap Bundle with Popper -->
<footer>
    <div class="container">
      <div class="footer-wrap">
          <div class="footer-box footer-brand">
            <a class="navbar-footer" href="#"> <img
              src="{{ asset('public/front/images/footer-logo.png') }}" class="navbar-footer"
              alt=""></a>
          </div>
          <div class="footer-box">
             <div class="footer-icon">
              <img src="{{ asset('public/front/images/footer-address.svg') }}" class="img-fluid" alt="">
              </div>
              <!-- <h3>ADDRESS</h3>
            <p>{{$headerData['address']}}<p> -->
            <h3>OFFICE ADDRESS</h3>
            <p>AGASTYA MARINE
PLOT 314, WARD – 3, SURVEY NO. 3476
NAKALANK STREET, JURIBAG
PORBANDAR, GUJRAT – 360575
CALL- <a href="tel:7046445050">7046445050</a>
          </div>
          <div class="footer-box">

          <div class="footer-icon">
              <img src="{{ asset('public/front/images/phone-call.svg') }}" class="img-fluid" alt="">
            </div>
            <h3>WORKSHOP ADDRESS</h3>
            <p>AGASTYA NET SYSTEM
OPP. NAVARANG SEA FOOD
SUBASH NAGAR, PORBANDR
GUJRAT – 360575
CALL - <a href="tel:8401934536">8401934536</a></p>
            <!-- <h3>CALL US</h3>
            <p>Order Inquiries: <a href="tel:{{$headerData['contact']}}">{{$headerData['contact']}}</a></p>             -->
          </div>
          <div class="footer-box">
          <div class="footer-icon">
              <img src="{{ asset('public/front/images/mail-inbox-app.svg') }}" class="img-fluid" alt="">
            </div>
            <h3>EMAIL US</h3>
              <a href="mailto:{{$headerData['email']}}">{{$headerData['email']}}</a>
              <ul class="apandplay">
                <li><a href="javascript:void(0)"><img src="{{ asset('public/front/images/appstore.png') }}" alt=""></a></li>
                <li><a href="javascript:void(0)"><img src="{{ asset('public/front/images/googleplay.png') }}" alt=""></a></li>
              </ul>
              <div class="mt-2"><a href="{{URL::to('privacy-policy')}}">Privacy & Policy</a></div>
          </div>
          
          {{-- <div class="footer-box">
            <h3>SUBSCRIBE NEWSLETTER</h3>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Email Address" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">Go</span>
              </div>
          </div> --}}
          </div>
      </div>
    </div>
    <div class="footer-bottom">
</div>
 </footer>
 
