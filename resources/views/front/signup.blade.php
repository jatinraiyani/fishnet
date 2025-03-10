@extends('layouts.app')
@section('title')
AgastyaMarine | SignUp
@endsection
@section('content')
<!-- banner -->
<div class="box-white  registration-page">
    <h2>Let’s get something</h2>
    <p>Create account to continue!.</p>
    <form name="signup" action="{{ URL::to('do-register') }}" method="POST" autocomplete="off">
      @if(!empty($errors->all()))
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            @foreach($errors->all() as $error)
                <span> {{ $error }} </span><br>
            @endforeach
        </div>
      @endif   
      @csrf
       <div class="mb-3"> 
          <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control" placeholder="Full Name">
       </div>
 
       <div class="mb-3"> 
          <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" placeholder="Email">
       </div>
       <div class="mb-3"> 
         <input type="text" name="contact" value="{{ old('contact') }}" id="contact" class="form-control" placeholder="Contact number">
         &nbsp;<span id="errmsg"></span>
      </div>
       <div class="mb-3"> 
          <input type="password" name="password"  class="form-control" id="password" placeholder="Enter your Password">
       </div>      
      
       <div class="mb-3">
          <select class="form-select" name="state" value="{{ old('state') }}" id="state" aria-label="Default select example">            
            @foreach(\Config::get('constants.state') as $s => $state_row)
               <option value="{{ $s }}">{{ $state_row }}</option>               
            @endforeach
          </select>
       </div>
       <div class="mb-3">
         <select class="form-select" name="city" value="{{ old('city') }}" id="city" aria-label="Default select example">            
            @foreach(\Config::get('constants.city') as $c => $city_row)
               <option value="{{ $c }}">{{ $city_row }}</option>               
            @endforeach
          </select>
       </div>
       <div class="mb-3"> 
         {{ Form::select('business',['netmaker' => 'Net Maker','boatowner' => 'Boat Owner','supplier' => 'Supplier','shopkeeper' => 'Shop Keeper','exporter' => 'Exporter'],'',array('class' => 'form-select')) }}
       </div>

       <div class="text-center">
          <button class="secondary-button  w-100">Register</button>
       </div>
    </form>
    <div class="text-center">
       <h6> Already have an account? <a href="{{ URL::to('signin') }}">Login</a> </h6>
       
    </div>
 </div>
@endsection
@section('js')
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
   $("form[name='signup']").validate({
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
         required: "Please Enter Valid Email",        
         email: "Please enter a valid email address",
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long"
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