@extends('layouts.app')
@section('title')
AgastyaMarine | SignIn
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/front/css/toastr.css')}}">
@endsection
@section('content')
<!-- banner -->
<div class="box-white login-box">
    <h2>Let’s get something</h2 >
    <p>Good to see you back.</p>
    <form name="signin" action="{{ URL::to('do-login') }}" method="POST" autocomplete="off">
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
       <div class="mb-3"> 
          <input type="password" name="password" class="form-control" placeholder="Password" required>
       </div>
       <div class="text-center">
          <a href="{{ URL::to('forgot') }}" class="forgot-link">Forgot password?</a>
       </div>
       <div class="text-center">
          <button class="secondary-button  w-100">Login </button>
       </div>
    </form>
    <div class="text-center">
       <h6>Don’t have account? <a href="{{ URL::to('signup') }}">Register</a> </h6>
    </div>
 </div>
@endsection
@section('js')
<script src="{{asset('public/front/js/toastr.min.js')}}"></script>
@endsection