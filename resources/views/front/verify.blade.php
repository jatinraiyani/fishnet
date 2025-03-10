@extends('layouts.app')
@section('title')
AgastyaMarine | Verify
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/front/css/toastr.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6">
            <div class="card otp-box p-5">
                {{-- <div class="card-header">{{ __('Verify Your Phone Number') }}</div> --}}
                
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                    @endif
                    
                   <p class="text-center mb-2"> Please enter the OTP sent to your number: +91{{$contact}}</p>
                    <form action="{{route('do-verify')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            {{-- <label for="verification_code"
                                class="col-md-12 col-form-label text-md-right">{{ __('contact') }}</label> --}}
                            <div class="col-md-12">
                                <input type="hidden" name="contact" value="{{$contact}}">
                                <input id="verification_code" maxlength="4" pattern="\d{4}" type="tel"
                                    class="form-control @error('verification_code') is-invalid @enderror"
                                    name="verification_code" value="{{ old('verification_code') }}" required>
                                @error('verification_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="secondary-button w-100">
                                    {{ __('Verify Phone Number') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{URL::to('otp-resend/'.$contact)}}">Resend OTP</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('public/front/js/toastr.min.js')}}"></script>
@endsection