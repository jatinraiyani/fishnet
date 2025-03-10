@extends('layouts.app')
@section('title')
AgastyaMarine | About Us
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/front/css/toastr.css')}}">
@endsection
@section('content')
<!-- banner -->
<secction class="product-detail-banner">
    <div class="container">
       <div class="product-banner">
          <h1>Contact us</h1>
          
       </div>
    </div>
 </secction>
 <section class="section-graping shipping-detailpage">
    <div class="container">
       <div class="row">
             <div class="col-md-4">
                   <div class="contact-box">
                         <span><i class="fal fa-phone-alt"></i></span>
                         <h3>PHONE</h3>
                         <p>Order Inquiries: <a href="tel:+918401934536">+91 8401934536</a></p>
                          <p>Account Issue : <a href="tel:+917046445050">+91 7046445050 </a> </p>
                   </div>
 </div>
 <div class="col-md-4">
                   <div class="contact-box">
                         <span><i class="fal fa-envelope"></i></span>
                         <h3>EMAIL</h3>
                         <a href="agastyamarine45@gmail.com">agastyamarine45@gmail.com</a>
                      
                   </div>
                   </div>
 <div class="col-md-4">
                   <div class="contact-box">
                         <span><i class="fal fa-map-marker-alt"></i></span>
                         <h3>ADDRESS</h3>
                         <p>
                           AGASTYA NET SYSTEM,</br>
                           OPP. NAVARANG SEA FOOD,</br>
                           SUBASH NAGAR, PORBANDR,</br>
                           GUJRAT – 360575
                          </p>
                      
                   </div>
             </div>
       <div>
          <div class="contact-form-box">
             <h3>Contact Form</h3>
             <form class="row g-4" name="contactus" method="post" action="{{ URL::to('do-contactus') }}">
               @csrf
                <div class="col-md-12">
                   <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="col-md-12">
                   <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                </div>
                <div class="col-md-12">
                   <input type="text" name="contact" id="contact" class="form-control" placeholder="Phone number">
                   &nbsp;<span id="errmsg"></span>
                  </div>
              
                <div class="col-md-12 ">
                   <textarea class="form-control" name="message" id="message" placeholder="Message" rows="5"></textarea>
                </div>
                <div class="col-md-12 ">
                <div class="text-center">
                   <button type="submit" class="secondary-button w-100">SEND</button>
                </div>
                </div>
             </form>
          </div>
    </div>
 </section>
 <!-- emd  modal and to cart-->

@endsection
@section('js')
<script src="{{asset('public/front/js/toastr.min.js')}}"></script>
<script src="{{ asset('public/front/js/validate.min.js') }}" ></script>
<script>

$.validator.addMethod(
  "regex",
  function(value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  },
  "Please check your input."
);   

$(function() {
   $("form[name='contactus']").validate({
      rules: {
         name : {
            required: true,
            regex: "^[a-zA-Z ]+$"
         },        
         email: {                  
            email: true
         },
         contact: {
            required:true,
            number: true,
            minlength: 10,
            maxlength: 10
         },
         message:{
            required:true
         }
   },
   messages: {
      name: {
         required: "Please Enter Your Full Name",
         regex: "Name Should Be Only In Alphabet"
      },
      email: {         
         email: "Please enter a valid email address",
      },
      contact: {
         number: "Mobile Number Should Be Only In Numbers",
         min: "mobile number is in minimum 10 digits",
         max: "mobile number is in maximum 10 digits",
      },
      message: {
         required: "Please Enter Message"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
   });
});

// allow only numbers in contact START
   $("#contact").keypress(function (e) {
      //if the letter is not digit then display error and don't type anything
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
         //display error message
         $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
      }
   });
// allow only numbers in contact END

</script>
@endsection