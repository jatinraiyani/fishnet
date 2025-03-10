@extends('layouts.admin')
@section('title')
FishNet | Category
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('public/admin/css/slim.min.css') }}">
<link href="{{ URL::asset('public/admin/js/summernote/summernote.min.css') }}"
    rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12 col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit CMS</h5>
                @if(!empty($errors->all()))
                    @foreach($errors->all() as $error)
                        <div class="alert alert-card alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card-body">
                {{ Form::open(array('url'=>'admin/cms/update','method'=>'POST','files' => 'true')) }}
                @csrf
                <div class="form-group">
                    <label class="form-label">Address</label>
                    {{ Form::textarea('address',$address,array('class'=>'form-control','placeholder'=>'Enter Address')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">Contact</label>
                    {{ Form::text('contact',$contact,array('class'=>'form-control','id'=>'contact','maxlength'=>10,'minlength'=>10,'placeholder'=>'Enter Contact Number')) }}
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    {{ Form::email('email',$email,array('class'=>'form-control','placeholder'=>'Enter Contact Number')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">Logo</label>
                    <div id="img-preview">
                        <div class="slim Event-add" data-instant-edit="true" data-ratio="free" data-download="false">
                            <input type="file" id="image" name="logo" />
                            <img width="100" height="100"
                                src="{{ asset('storage/app/public/logo/'.$logo) }}"
                                alt="logo" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Privacy</label>
                    {{ Form::textarea('privacy',$privacy,array('class'=>'form-control privacy','placeholder'=>'Enter Privacy')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">Terms</label>
                    {{ Form::textarea('terms',$terms,array('class'=>'form-control terms','placeholder'=>'Enter Terms')) }}
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
    $('.privacy,.terms').summernote({
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
