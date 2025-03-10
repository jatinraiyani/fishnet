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
                <h5 class="card-title">Edit Brand</h5>
                @if(!empty($errors->all()))
                    @foreach($errors->all() as $error)
                        <div class="alert alert-card alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card-body">
                {{ Form::open(array('url'=>'admin/brand/update/'.$data->id.'','method'=>'POST','files' => 'true')) }}
                @csrf
                <div class="form-group">
                    <label class="form-label">Brand Name</label>
                    {{ Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Type Name','required')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">Brand Image</label>
                    <div id="img-preview">
                        <div class="slim Event-add" data-instant-edit="true" data-ratio="free" data-download="false">
                            <input type="file" id="image" name="image" />
                            <img width="100" height="100"
                                src="{{ asset('storage/app/public/brand/'.$data->image) }}"
                                alt="type-image" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ URL::asset('public/admin/js/slim.kickstart.min.js') }}"></script>
@endsection
