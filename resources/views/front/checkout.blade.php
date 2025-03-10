@extends('layouts.app')
@section('title')
AgastyaMarine | Checkout
@endsection
@section('content')
<!-- banner -->
<secction class="product-detail-banner">
    <div class="container">
       <div class="product-banner">
          <h1>You’re almost done</h1>
          <h6>Checkout</h6>
       </div>
    </div>
 </secction>
 <section class="section-graping shipping-detailpage">
    <div class="container">
       <div class="row">
          <div class="col-md-8">
             <h2 class="mb-4">Shipping Details</h2>
             <form class="row g-3" id="checkoutform" name="checkout" method="POST" action="{{ URL::to('do-checkout') }}" autocomplete="off">
               @if(!empty($errors->all()))
                  <div class="alert alert-danger">
                     <button class="close" data-close="alert"></button>
                     @foreach($errors->all() as $error)
                           <span> {{ $error }} </span><br>
                     @endforeach
                  </div>
               @endif   
               @csrf 
               <div class="col-md-6">
                   <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Name">
                </div>                
                <div class="col-md-6">
                   <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email Address">
                </div>
                <div class="col-md-6">
                   <input type="text" name="contact" id="contact" value="{{ Auth::user()->contact }}" class="form-control" placeholder="Mobile Phone Number">
                </div>
                <div class="col-md-6">
                   <textarea name="address" id="address" class="form-control" placeholder="Address" rows="5">{{ old('address') }}</textarea>
                </div>
                <div class="col-md-6">
                  <select class="form-select" name="state"  id="state" aria-label="Default select example">            
                     @foreach(\Config::get('constants.state') as $s => $state_row)
                        <option value="{{ $s }}" <?= (Auth::user()->state == $s) ? "selected" : "" ?>>{{ $state_row }}</option>               
                     @endforeach
                   </select>
                </div>                
                <div class="col-md-6">
                  <select class="form-select" name="city"  id="city" aria-label="Default select example">            
                     @foreach(\Config::get('constants.city') as $c => $city_row)
                        <option value="{{ $c }}" <?= (Auth::user()->city == $c) ? "selected" : "" ?>>{{ $city_row }}</option>               
                     @endforeach
                   </select>
                </div>
                <div class="col-md-6">
                  <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode') }}" class="form-control" placeholder="Postcode/ZIP">
                </div>
                <div class="col-md-12 ">
                   <textarea name="note" class="form-control" id="note" rows="5" placeholder="Notes">{{ old('note') }}</textarea>
                </div>               
          </div>
          <div class="col-md-4">
             <div class="myorder-box">
                <h3>My Order</h3>
                @foreach($cart_product as $row)
                <div class="cart-box">
                   <div class="cart-img">
                      <img src="{{ $row['image'] }}" class="img-fluid" alt="{{ $row['uniqueId'] }}">
                   </div>
                   <div class="cart-body">
                      <h5>{{ $row['name'] }}</h5>
                      <p>SIZE: {{ strtoupper($row['size']) }}</p> 
                      <p>Quanity: {{ $row['qty'] }}</p> 
                   </div>
                   <h4>₹{{ number_format($row['price'],2) }}</h4>
                </div>
                @endforeach               
                <div class="sub-total">
                   <div class="row justify-content-between ">
                      <div class="col">
                         <h4>Subtotal</h4>
                      </div>
                      <div class="col text-end">
                         <h4>₹{{ number_format($cart_total,2) }}</h4>
                      </div>
                   </div>
                   
                </div>
                <div class="row justify-content-between">
                      <div class="col">
                         <h4>Subtotal</h4>
                      </div>
                      <div class="col text-end">
                         <h4>₹{{ number_format($cart_total,2) }}</h4>
                      </div>
                   </div>                                       
                   <div class="text-center">
                      <button class="secondary-button w-100" id="checkoutPay">Pay</button>
                </div>
               </form>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- emd  modal and to cart-->

 <!-- START BANK INFO MODAL START-->
 <div class="modal fade" id="banktransfermodal" tabindex="-1" role="dialog" aria-labelledby="banktransfermodal" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h3 class="modal-title" id="exampleModalLongTitle">Bank Details</h3>
         {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button> --}}
       </div>
       <div class="modal-body bank-info">          
         <p><b>BANK :</b> HDFC BANK</p>
         <p><b>CO. NAME :</b> AGASTYA MARINE</p>
         <p><b>A/C NO :</b> 50200055015280</p>
         <p><b>IFSC :</b> HDFC0002416</p>
         <p><b>CONTACT :</b> +91 7046425050</p>
       </div>
       {{-- <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>         
       </div> --}}
     </div>
   </div>
 </div>
 <!-- START BANK INFO MODAL END-->

@endsection
@section('js')
<script src="{{ asset('public/front/js/validate.min.js') }}" ></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
      $("form[name='checkout']").validate({
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
            address: {                  
               required: true
            },
            zipcode: {
               required:true,
               number: true
            },
            state: {
               required: true
            },
            city: {
               required: true
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
         address: {         
            zipcode: "Address is required",
         },
         zipcode: {         
            required: "Please enter a valid Zipcode",
            number: "Zipcode Should Be Only In Numbers",
         },
         contact: {
            number: "Mobile Number Should Be Only In Numbers",
            min: "mobile number is in minimum 10 digits",
            max: "mobile number is in maximum 10 digits",
         },
         state: {
            required: "State is required",
         },
         city: {
            required: "City is required",
         }
       },
       submitHandler: function(form) {
         form.submit();
       }
      });
   });
   
   // allow only numbers in contact START
      $("#contact,#zipcode").keypress(function (e) {
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