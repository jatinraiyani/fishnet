@extends('layouts.app')
@section('title')
AgastyaMarine | Profile
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/front/css/toastr.css')}}">
<link rel="stylesheet" href="{{ URL::asset('public/admin/css/slim.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
@endsection
@section('content')
<!-- banner -->
<secction class="product-detail-banner">
    <div class="container">
        <div class="product-banner">
            <h1>My Profile</h1>
        </div>
    </div>
</secction>
<section class="section-graping myprofile-page">
    <div class="container">
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3 boxwhite p-3 nav-left" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#myprofile" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">My Profile</a>
                <a class="nav-link " id="v-pills-home-tab" data-bs-toggle="pill" href="#myorder" role="tab"
                    aria-controls="myorder" aria-selected="true">My Order</a>
                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#changepassword" role="tab"
                    aria-controls="v-pills-profile" aria-selected="false">Change password </a>
                {{-- <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#user-address" role="tab"
                    aria-controls="v-pills-profile" aria-selected="false">Address</a> --}}
                <a class="nav-link" href="{{ URL::to('logout') }}">Logout</a>
            </div>

            <div class="tab-content tab-content-myprofile" id="v-pills-tabContent">
                @if(!empty($errors->all()))
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        @foreach($errors->all() as $error)
                            <span> {{ $error }} </span><br>
                        @endforeach
                    </div>
                @endif 

                <div class="tab-pane fade show active" id="myprofile" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <div class="boxwhite">
                        <h3>Personal Information</h3>
                        <hr>
                        <form method="POST" name="profile" action="{{ URL::to('update-profile') }}"
                            enctype="multipart/form-data">                           
                            @csrf
                            <div class="row">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12 ">                                    
                                    <div id="img-preview">
                                        <div class="slim Event-add" data-instant-edit="true" data-ratio="free" data-download="false">
                                            <input type="file" id="files" name="profile" />
                                           @if(!empty($user->profile)) 
                                            <img width="100" height="100"
                                            src="{{ asset('storage/app/public/user/'.$user->profile) }}"
                                            alt="type-image" />
                                           @endif 
                                        </div>
                                    </div>
                                 </div>
                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control"
                                        placeholder="Email">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="contact" id="contact" value="{{ $user->contact }}" class="form-control"
                                        placeholder="Contact Number">
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="state"  id="state" aria-label="Default select example">            
                                        @foreach(\Config::get('constants.state') as $s => $state_row)
                                           <option value="{{ $s }}" <?= ($user->state == $s) ? "selected" : "" ?>>{{ $state_row }}</option>               
                                        @endforeach
                                      </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="city"  id="city" aria-label="Default select example">            
                                        @foreach(\Config::get('constants.city') as $c => $city_row)
                                           <option value="{{ $c }}" <?= ($user->city == $c) ? "selected" : "" ?>>{{ $city_row }}</option>               
                                        @endforeach
                                      </select>
                                </div>
                                <div class="col-md-4"> 
                                 {{ Form::select('business',['netmaker' => 'Net Maker','boatowner' => 'Boat Owner','supplier' => 'Supplier','shopkeeper' => 'Shop Keeper','exporter' => 'Exporter'],$user->business,array('class' => 'form-select')) }}
                               </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="secondary-button w-100">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="myorder" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="boxwhite">
                       <h3>My Order</h3>
                       <hr>
                       <div class="accordion" id="accordionExample">
                          @forelse($order as $kl => $order_row)
                          <div class="accordion-item">
                             <h2 class="accordion-header" id="heading{{ $kl }}">     
     
                                <div class="card-body bg-light accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $kl }}"
                                   aria-expanded="true" aria-controls="collapse{{ $kl }}">
                                   <div class="row w-100">
                                      <div class="col-6 col-lg-3">
     
                                         <!-- Heading -->
                                         <h6 class="heading-xxxs text-muted">Order No:</h6>
     
                                         <!-- Text -->
                                         <p class="mb-lg-0 font-size-sm font-weight-bold">
                                            {{ $order_row->ordernumber }}
                                         </p>
     
                                      </div>
                                      <div class="col-6 col-lg-3">
     
                                         <!-- Heading -->
                                         <h6 class="heading-xxxs text-muted">Order date:</h6>
     
                                         <!-- Text -->
                                         <p class="mb-lg-0 font-size-sm font-weight-bold">
                                            <time datetime="2019-10-01">
                                             {{ date('d F, Y', strtotime($order_row->created_at)) }} 
                                            </time>
                                         </p>
     
                                      </div>
                                      <div class="col-6 col-lg-3">
     
                                         <!-- Heading -->
                                         <h6 class="heading-xxxs text-muted">Status:</h6>
     
                                         <!-- Text -->
                                         <p class="mb-0 font-size-sm font-weight-bold">
                                             @if($order_row->order_status == 'pending_for_call')
                                                <span class="badge bg-warning">PENDING FOR CALL</span>                                              
                                             @elseif($order_row->order_status == 'ready_for_pay')
                                                <button class="secondary-button paymentoption" data-order="{{ $order_row->id }}" data-totalamount="{{ $order_row->grand_total }}" data-contact="{{ $order_row->order_user->contact }}" data-email="{{ $order_row->order_user->email }}">PAY</button>
                                             @elseif($order_row->order_status == 'pending') 
                                                <span class="badge bg-warning">PENDING</span>
                                             @elseif($order_row->order_status == 'confirm')
                                                <span class="badge bg-success">CONFIRMED</span>     
                                             @elseif($order_row->order_status == 'cancel')
                                                <span class="badge bg-danger">CANCELED</span>     
                                             @elseif($order_row->order_status == 'success')
                                                <span class="badge bg-success">SUCCESSED</span>     
                                             @elseif($order_row->order_status == 'slip_refuse')
                                                <span class="badge bg-dander">REFUSED</span>     
                                             @else
                                             <span class="badge bg-info">{{ str_replace('_',' ',strtoupper($order_row->order_status)) }}</span>
                                             @endif
                                         </p>
     
                                      </div>
                                      <div class="col-6 col-lg-3">
     
                                         <!-- Heading -->
                                         <h6 class="heading-xxxs text-muted">Order Amount:</h6>
     
                                         <!-- Text -->
                                         <p class="mb-0 font-size-sm font-weight-bold">
                                          ₹ {{ $order_row->grand_total }}
                                         </p>
     
                                      </div>
                                      @if(($order_row->payment_method == 'banktransfer' || $order_row->payment_method == 'angadia') && $order_row->order_status == 'pending')
                                       <div class="col-6 col-lg-12">
                                             <h6 class="heading-xxxs text-muted">Upload payment slip photo :</h6> 
                                             <input type="file" name="slip" id="slip" data-order="{{ $order_row->id }}">
                                             <span id="mgs_ta_{{ $order_row->id }}">    
                                             </span>
                                       </div>
                                      @endif
                                   </div>
                                </div>
                             </h2>

                             <div id="collapse{{ $kl }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $kl }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordionbody">
                                   <div class="card-footer ">
     
                                      <!-- Heading -->
                                      <h4 class="mb-3 mt-3">Order Items ({{ count($order_row->order_product) }})</h4>
     
                                      <!-- Divider -->
                                      <hr class="my-3">
     
                                      <!-- List group -->
                                      <ul class="list-group list-group-lg list-group-flush-y list-group-flush-x">

                                       @foreach($order_row->order_product as $product_row)
                                         <li class="list-group-item">
                                            <div class="row align-items-center">
                                               <div class="col-4 col-md-3 col-xl-2">

                                                @foreach($product_row->product_image->product_image as $k => $imgs)
                                                   @if($k == 0)
                                                      <img src="{{ asset('storage/app/public/product/'.$imgs->image) }}" class="img-fluid" alt="{{ $product_row->name }}">
                                                   @endif
                                                @endforeach      
                                                  
                                               </div>
                                               <div class="col">     
                                                  <!-- Title -->
                                                  <p class="mb-4 font-size-sm font-weight-bold">
                                                     <a class="text-body" href="#"> {{ $product_row->name }} </a> <br>
                                                     <span class="text-muted">₹ {{ number_format($product_row->price,2) }}</span>
                                                  </p>
     
                                                  <!-- Text -->
                                                  <div class="font-size-sm text-muted">
                                                     Size: {{ str_replace('-',' ',$product_row->size) }}
                                                  </div>     
                                               </div>
                                            </div>
                                         </li>
                                       @endforeach

                                      </ul>     
                                   </div>
                                   <!-- Total -->
                                   <div class="card card-lg mb-5 border">
                                      <div class="card-body">
     
                                         <!-- Heading -->
                                         <h6 class="mb-7">Order Total</h6>
     
                                         <!-- List group -->
                                         <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                            {{-- <li class="list-group-item d-flex">
                                               <span>Subtotal</span>
                                               <span class="ms-auto">₹ {{ number_format($order_row->subtotal,2) }}</span>
                                            </li> --}}
                                            {{-- <li class="list-group-item d-flex">
                                               <span>Tax</span>
                                               <span class="ms-auto">₹ 0.00</span>
                                            </li>
                                            <li class="list-group-item d-flex">
                                               <span>Shipping</span>
                                               <span class="ms-auto">₹ 0.00</span>
                                            </li> --}}
                                            <li class="list-group-item d-flex font-size-lg font-weight-bold">
                                               <span>Total</span>
                                               <span class="ms-auto">₹ {{ number_format($order_row->grand_total,2) }}</span>
                                            </li>
                                         </ul>
     
                                      </div>
                                   </div>
     
                                   <!-- Details -->
                                   <div class="card card-lg border">
                                      <div class="card-body">
     
                                         <!-- Heading -->
                                         <h6 class="mb-7">Billing &amp; Shipping Details</h6>
     
                                         <!-- Content -->
                                         <div class="row">
                                            <div class="col-12 col-md-12">
     
                                               <p class="mb-7 mb-md-0 text-gray-500">
                                                 Name : {{ $order_row->delivery_address->name}}<br>
                                                 Email : {{ $order_row->delivery_address->email }}<br>
                                                 Contact : {{ $order_row->delivery_address->contact}}<br>
                                                 Address : {{ $order_row->delivery_address->address }},<br>
                                                 {{ $order_row->delivery_address->city }},{{ $order_row->delivery_address->state }},{{ @$order_row->delivery_address->zipcode }}
                                                       
                                               </p>
     
                                            </div>                                            
                                          
                                         </div>   
     
     
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                          @empty
                          @endforelse
                       </div>
                       <!-- Order -->
                 
     
                    </div>
                 </div>
                <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="boxwhite">
                        <h3>Change password</h3>
                        <hr>

                        <form name="change-password" method="POST" action="{{ URL::to('change-password') }}" autocomplete="off">

                           
                            @csrf

                            <div class="mb-3">
                                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Confirm Password">
                            </div>
                            <div class="text-center">
                                <button class="secondary-button w-100">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="tab-pane fade show active" id="user-address" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <div class="boxwhite">
                        <h3>Add Address</h3>
                        <hr>
                        <form method="POST" name="addressform" action="{{ URL::to('add-address') }}">                           
                            @csrf
                            <div class="row">
                            </div>
                            <div class="row g-3">                                
                                <div class="col-md-4">
                                    <input type="text" name="name" id="add_name" value="" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-md-4">
                                    <input type="email" name="email" id="add_email" value="" class="form-control"
                                        placeholder="Email">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="contact" id="add_contact" value="" class="form-control"
                                        placeholder="Contact Number">
                                </div>
                                <div class="col-md-12">
                                 <textarea name="address" id="add_address" class="form-control" placeholder="Address"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="state"  id="ad_state" aria-label="Default select example">            
                                        @foreach(\Config::get('constants.state') as $s => $state_row)
                                           <option value="{{ $s }}" <?= ($user->state == $s) ? "selected" : "" ?>>{{ $state_row }}</option>               
                                        @endforeach
                                      </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="city"  id="ad_city" aria-label="Default select example">            
                                        @foreach(\Config::get('constants.city') as $c => $city_row)
                                           <option value="{{ $c }}" <?= ($user->city == $c) ? "selected" : "" ?>>{{ $city_row }}</option>               
                                        @endforeach
                                      </select>
                                </div>
                                <div class="col-md-4">
                                 <input name="zipcode" id="add_zipcode" class="form-control" placeholder="Zipcode"/>
                                </div>                                
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="secondary-button w-100">Update</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
<!-- emd  modal and to cart-->

<!-- PAYMENT INFO MODAL START-->

<div class="modal fade" id="paymentoptionmodal" tabindex="-1" role="dialog" aria-labelledby="paymentoptionmodal" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h3 class="modal-title" id="exampleModalLongTitle">Payment By</h3>
         {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button> --}}
       </div>
       <div class="modal-body bank-info">
         <form class="row g-3" id="submitpayment" name="submitpayment" method="POST" action="{{ URL::to('pay') }}" autocomplete="off">           
            @csrf           
         <div class="payment-box">            
            <div class="form-check">
              <input class="form-check-input paymentmethod" type="radio" name="payment_method" value="banktransfer" id="banktransfer">
              <label class="form-check-label" for="banktransfer">
                Direct Bank Transfer
              </label>
              </div>
              <div class="form-check">
                 <input class="form-check-input paymentmethod" type="radio" name="payment_method" value="online" id="online">
                 <label class="form-check-label" for="online">
                 Razorpay
                 </label>
              </div>
              <!-- <div class="form-check">
                 <input class="form-check-input paymentmethod" type="radio" name="payment_method" value="cashondelivery" id="cashondelivery" >
                 <label class="form-check-label" for="cashondelivery">
                 Cash on Delivery
                 </label>
              </div>  -->
              <div class="form-check">
                <input class="form-check-input paymentmethod" type="radio" name="payment_method" value="angadia" id="angadia">
                <label class="form-check-label" for="angadia">
                   Angadia
                </label>
             </div>
             <input type="hidden" name="transaction_id" id="transaction_id"> 
             <input type="hidden" name="total_amount" id="total_amount"> 
             <input type="hidden" name="pay_contact" id="pay_contact"> 
             <input type="hidden" name="pay_email" id="pay_email"> 
             <input type="hidden" name="pay_order" id="pay_order"> 
           </div>  
       </div>
       <div class="modal-footer">
         <button class="btn btn-secondary submitpayment" id="checkoutPay" disabled>PAY</button>         
       </div>
     </div>
   </form>
   </div>
 </div>


<!-- PAYMENT INFO MODAL END-->

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
<script src="{{asset('public/front/js/toastr.min.js')}}"></script>
<script src="{{ URL::asset('public/admin/js/slim.kickstart.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
   $("form[name='profile']").validate({
      rules: {
         name : {
            required: true,
            regex: "^[a-zA-Z ]+$"
         },        
         email: { 
            required: true,                 
            email: true
         },
         password: {
            required: true,
            minlength: 8
         },
         contact: {
            required:true,
            number: true,
            minlength: 10,
            maxlength: 10
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
         required: "Please Enter valid Email",         
         email: "Please enter a valid email address",
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

// Change Password

$("form[name='change-password']").validate({
      rules: {              
        new_password: {                  
            required: true,
            minlength: 8
         },
         new_password_confirmation: {
            required: true,
            minlength: 8
         }
   },
   messages: {
    new_password: {
         required: "Please Enter New Password",
         minlength: "Password should be atleast 8 character"
      },
      new_password_confirmation: {         
        required: "Please Enter Confirm Password",
        minlength:"Confirm Password should be atleast 8 character",
        equalTo : "#new_password"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
   });

//  Address Form

$("form[name='addressform']").validate({
      rules: {
         name : {
            required: true,
            regex: "^[a-zA-Z ]+$"
         },        
         email: { 
            required: true,                 
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
         state: {
            required: true
         },
         city: {
            required: true
         },
         zipcode: {
            required: true,
            number: true
         }
   },
   messages: {
      name: {
         required: "Please Enter Your Full Name",
         regex: "Name Should Be Only In Alphabet"
      },
      email: {
         required: "Please Enter valid Email",         
         email: "Please enter a valid email address",
      },
      contact: {
         number: "Mobile Number Should Be Only In Numbers",
         min: "mobile number is in minimum 10 digits",
         max: "mobile number is in maximum 10 digits",
      },
      address: {
         required: "Address is required",
      },
      state: {
         required: "State is required",
      },
      city: {
         required: "City is required",
      },
      zipcode: {
         required: "zipcode is required",
         number: "zipcode Should Be Only In Numbers",
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
   });

});

// allow only numbers in contact START
   $("#contact,#add_contact,#add_zipcode").keypress(function (e) {
      //if the letter is not digit then display error and don't type anything
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
         //display error message
         $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
      }
   });
// allow only numbers in contact END

// upload slip START
   $('body').on('change','#slip', function() {
         
      let order = $(this).data('order'); 
      var filedata = this.files[0];
      var imgtype = filedata.type;

      var match = ['image/jpeg','image/jpg','image/png'];

      if(!((imgtype == match[0]) || (imgtype == match[1]) || (imgtype == match[2]))){
        $('#mgs_ta_'+order).html('<p style="color:red">Plz select a valid type image..only jpg,jpeg,png allowed</p>');
 
    }else{
 
      $('#mgs_ta_'+order).empty();

      var postData = new FormData();
          postData.append('file',this.files[0]);     
          postData.append('order',order);     
          postData.append('_token','{{ csrf_token() }}');     

      $.ajax({        
        type: "POST",
        async: true,
        dataType: "json",
        contentType:false,
        processData:false,
        url: "{{URL::to('slip-upload')}}",
        data: postData,
        success: function(response) {
           
           if(response == 'uploaded'){
            $('#mgs_ta_'+order).html('<p style="color:green">Slip uploaded successfully</p>');
           }
        }

      });

   }      
   });
// upload slip END

// payment option modal START
$('body').on('click','.paymentoption',function(){

   let total = $(this).data('totalamount');
   let contact = $(this).data('pay_contact');
   let email = $(this).data('pay_email');
   let order = $(this).data('order');

   $('#total_amount').val(total);
   $('#pay_contact').val(contact);
   $('#pay_email').val(email);
   $('#pay_order').val(order);
   
   $('#paymentoptionmodal').modal('show');

});
// payment option modal END

// check and open option wise payment modal START
$('body').on('click','.paymentmethod',function(e){

let paymenttype = $(this).val();

$(".paymentmethod").prop('checked', false);
$("#"+paymenttype).prop('checked', true); 

if(paymenttype == 'banktransfer' || paymenttype == 'angadia'){  
   $('#banktransfermodal').modal('show');
   $('#checkoutPay').prop('disabled',false);
} 

// if(paymenttype == 'cashondelivery'){         
//    $('#checkoutPay').prop('disabled',false);
// } 

if(paymenttype == 'online'){

   var SITEURL = '{{URL::to('')}}';
   
   $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   }); 
   
     var totalAmount =  $('#total_amount').val();

     var options = {
     "key": "rzp_test_7v2wcER3a1wqzt",
     "amount": (totalAmount*100), // 2000 paise = INR 20
     "name": "fishnet",
     "description": "Payment",
     "image": "https://www.w3adda.com/wp-content/uploads/2019/07/w3a-fb-dp.png",
     "handler": function (response){              

      if(response.razorpay_payment_id){
         $('#transaction_id').val(response.razorpay_payment_id);         
         $(".paymentmethod").prop('checked', false);
         $("#"+paymenttype).prop('checked', true);
         $( "#submitpayment").submit();      
      } else {
         $('#checkoutPay').prop('disabled',true);
      }

     },
    "prefill": {
         "contact": '+91'+$('#contact').val(),
         "email": $('#email').val(),
     },
     "theme": {
         "color": "#528FF0"
     }
   };
   var rzp1 = new Razorpay(options);
   rzp1.open();
   e.preventDefault();        
}

});
// check and open option wise payment modal END

// payment submit START

$('body').on('click','.submitpayment',function(e){

   e.preventDefault();

   let total = $('#total_amount').val();
   let contact = $('#pay_contact').val();
   let email = $('#pay_email').val();
   let order = $('#pay_order').val();

   if(total == '' || order == '') {

      swal('Please Fill Or Select Proper Payment Options.');

      return false;
      
   } else {
      $("#submitpayment").submit();      
   }
  


});

// payment submit END

</script>
@endsection
