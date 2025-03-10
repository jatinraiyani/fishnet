@extends('layouts.app')
@section('title')
AgastyaMarine | Reset Password
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/front/css/toastr.css')}}">
@endsection
@section('content')
<div class="box-white login-box">
    <h2>Let’s get link in</h2 >
    <p>your contact OR email.</p>
    <form action="{{ URL::to('reset-password') }}" method="POST" autocomplete="off">

      @if(!empty($errors->all()))
         <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            @foreach($errors->all() as $error)
               <span> {{ $error }} </span><br>
            @endforeach
         </div>
      @endif   
      @csrf
        <input type="hidden" name="user_id" value="{{ $checkDetail->user_id }}" required>
       <div class="mb-3"> 
          <input type="password" name="password" class="form-control" placeholder="Password" required>
       </div>  
       <div class="mb-3"> 
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
     </div>       
       <div class="text-center">
          <button class="secondary-button w-100">Reset</button>
       </div>
    </form>    
 </div>
@endsection
@section('js')
<script src="{{asset('public/front/js/toastr.min.js')}}"></script>
@endsection