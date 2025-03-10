@extends('layouts.app')
@section('title')
AgastyaMarine | Forgot Password
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/front/css/toastr.css')}}">
@endsection
@section('content')
<div class="box-white login-box">
    <h2>Let’s get link in</h2 >
    <p>your contact OR email.</p>
    <form name="forgot" action="{{ URL::to('forgot-link') }}" method="POST" autocomplete="off">

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
          <input type="text" name="email" class="form-control" placeholder="Email OR Contact" required>
       </div>       
       <div class="text-center">
          <button class="secondary-button w-100">Send</button>
       </div>

    </form>    
 </div>
@endsection
@section('js')
<script src="{{asset('public/front/js/toastr.min.js')}}"></script>
@endsection