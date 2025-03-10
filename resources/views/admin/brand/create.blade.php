@extends('layouts.admin')
@section('title')
FishNet | Brand
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('public/admin/css/slim.min.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Brand</h5>
                @if(!empty($errors->all()))
                    @foreach($errors->all() as $error)
                        <div class="alert alert-card alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card-body">
                {{ Form::open(array('url'=>'admin/brand/store','method'=>'POST','files' => 'true')) }}
                @csrf
                <div class="form-group">
                    <label class="form-label">Brand Name</label>
                    {{ Form::text('name','',array('class'=>'form-control','placeholder'=>'Brand Name','required')) }}
                </div>
                <div class="form-group">
                <label class="form-label">Brand Image</label>
                <div id="img-preview">
                    <div class="slim Event-add" data-instant-edit="true" data-ratio="free" data-download="false">
                        <input type="file" id="files" name="image" />
                    </div>
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ URL::asset('public/admin/js/slim.kickstart.min.js') }}"></script>
@endsection
