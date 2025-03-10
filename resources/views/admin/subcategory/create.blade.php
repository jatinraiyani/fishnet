@extends('layouts.admin')
@section('title')
FishNet | SubCategory
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('public/admin/css/slim.min.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add SubCategory</h5>
                @if(!empty($errors->all()))
                    @foreach($errors->all() as $error)
                        <div class="alert alert-card alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card-body">
                {{ Form::open(array('url'=>'admin/subcategory/store','method'=>'POST','files' => 'true')) }}
                @csrf
                <div class="form-group">
                    <label class="form-label">Type</label>
                    {{ Form::select('type_id',$type,'',array('class'=>'form-control type','placeholder'=>'Type Name','required')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">Category Name</label>
                    {{ Form::select('category_id',[],'',array('class'=>'form-control category','placeholder'=>'Category Name','required')) }}
                </div>
                <div class="form-group">
                    <label class="form-label">SubCategory Name</label>
                    {{ Form::text('name','',array('class'=>'form-control','placeholder'=>'SubCategory Name','required')) }}
                </div>
                <div class="form-group">
                <label class="form-label">Category Image</label>
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

<script>

// get category by type START

$('body').on('change', '.type', function () {

var nettype = $(this).val();

$.ajax({
    type: 'POST',
    async: true,
    dataType: "json",
    url: "{{ URL::to('admin/subcategory/category-by-type') }}",
    data: {
        _token: '{{ csrf_token() }}',
        nettype: nettype
    },
    success: (response) => {

        $('.category').empty();
        $(".category").append('<option value="">Select Category</option>');
        if (response) {
            $.each(response, function (key, value) {
                $('.category').append($("<option/>", {
                    value: key,
                    text: value
                }));
            });
        }

    }
});
});
// get category by type END

</script>
@endsection
