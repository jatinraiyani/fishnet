@extends('layouts.admin')
@section('title')
FishNet | Slider
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('public/admin/css/slim.min.css') }}">
<link href="{{ URL::asset('public/admin/js/summernote/summernote.min.css') }}"
    rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Slider</h5>
                @if(!empty($errors->all()))
                    @foreach($errors->all() as $error)
                        <div class="alert alert-card alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card-body">
                {{ Form::open(array('url'=>'admin/slider/update/'.$data->id.'','method'=>'POST','files' => 'true')) }}
                @csrf
                <div class="form-group">
                    <label class="form-label">Slider Title</label>
                    {{ Form::text('title',$data->title,array('class'=>'form-control','placeholder'=>'Slider Title','required')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">Slider Description</label>
                    {{ Form::textarea('description',$data->description,array('class'=>'form-control description','placeholder'=>'Enter Description')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">Slider Image</label>
                    <div id="img-preview">
                        <div class="slim Event-add" data-instant-edit="true" data-ratio="free" data-download="false">
                            <input type="file" id="image" name="image" />
                            <img width="100" height="100"
                                src="{{ asset('storage/app/public/slider/'.$data->image) }}"
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
<script src="{{ URL::to('public/admin/js/summernote/summernote.min.js') }}"></script>
<script type="text/javascript">
    //summernote start 
    $('.description').summernote({
        fontNamesIgnoreCheck: ['toxico', 'roboto', 'PT Sans Narrow', 'Roboto', 'Hind', 'Sahara', 'Vonique64',
            'Bismillah Script', 'The Secret', 'Good Times Rg', 'Kruti Dev 010', 'Segoe UI', 'Sen',
            'Staccato 222', 'Lombok', 'Nexa'
        ],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']]
        ],
    });
    //summernote end
</script>
@endsection
