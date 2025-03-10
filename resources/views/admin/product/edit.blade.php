@extends('layouts.admin')
@section('title')
FishNet | Product
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('public/admin/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/admin/css/slim.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('public/admin/css/ekko-lightbox.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{URL::asset('public/admin/js/summernote/summernote.min.css')}}"/>
<style>
    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    .remove:hover {
        background: white;
        color: black;
    }

</style>

@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Product</h5>
                @if(!empty($errors->all()))
                    @foreach($errors->all() as $error)
                        <div class="alert alert-card alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card-body">
                {{ Form::open(array('url'=>'admin/product/update/'.$data->id.'','method'=>'POST','files' => 'true','class' => 'row')) }}
                @csrf
                <div class="form-group col-6">
                    <label class="form-label">Product Name</label>
                    {{ Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Product Name','required')) }}
                </div>
                <div class="form-group col-6">
                    <label class="form-label">Brand</label>
                    {!! Form::select('brand[]',$brands,$selectedBrands,array('class' => 'form-control select2','multiple' =>
                    'multiple','required')) !!}
                </div>
                <div class="form-group col-3">
                    <label class="form-label">Type</label>
                    {{ Form::select('type_id',$type,$data->type_id,array('class'=>'form-control type','placeholder'=>'Type Name','required')) }}
                </div>
                <div class="form-group col-3">
                    <label class="form-label">Category Name</label>
                    {{ Form::select('category_id',$category,$selectedCategory,array('class'=>'form-control category','placeholder'=>'Category Name')) }}
                </div>
                <div class="form-group col-3">
                    <label class="form-label">Sub Category Name</label>
                    {{ Form::select('subcategory_id',$subCategory,$selectedSubCategory,array('class'=>'form-control subcategory','placeholder'=>'SubCategory Name')) }}
                </div>               
                <div class="form-group col-6"> 
                     <div class="field" align="left">
                        <h3>Upload Product images</h3>
                        <input type="file" id="files" name="images[]" multiple />
                        @foreach($data->product_image as $imgs)
                            <span class="pip" id="productimage-{{ $imgs->id }}"><img class="imageThumb"
                                    src="{{ asset('storage/app/public/product/'.$imgs->image) }}"
                                    title="product-image"><br>
                                <span class="remove removeExistImage" data-image="{{ $imgs->id }}">Remove
                                    image</span></span>
                        @endforeach
                    </div>
                        
                </div>
                <div class="form-group col-6">  
                    <label class="form-label">Description</label>                    
                    <textarea name="description" class="form-control description" required>{{ $data->description }}</textarea>
                </div>
                <div class="sizeMainDiv">
                    @foreach($data->product_size as $k => $size)
                    <div class="row col-12">

                        <input type="hidden" name="product_size_id[]" value="{{ $size->id }}">
                        <div class="form-group col-2">
                            @if($k == 0)
                            <label class="form-label">Size Unit</label>
                            @endif
                            {{ Form::select('size_unit[]',['cm' => 'CM','mm' => 'MM','ply' => 'PLY','mesh' => 'Mesh','kilogram' => 'Kilogram','gram' => 'Gram','meter' => 'Meter'],$size->size_unit,array('class'=>'form-control','placeholder'=>'Size Unit','required')) }}
                        </div>
                        <div class="form-group col-2">
                            @if($k == 0)
                            <label class="form-label">Size</label>
                            @endif                            
                            {{ Form::text('size[]',$size->size,array('class'=>'form-control size','placeholder'=>'Size','required')) }} 
                            
                        </div>
                        <div class="form-group col-3">
                            @if($k == 0)
                            <label class="form-label">Price</label>
                            @endif
                            {{ Form::text('size_price[]',$size->price,array('class'=>'form-control size_price','placeholder'=>'Price','required')) }}
                        </div>
                        <div class="form-group col-3">
                      
                            @if($k == 0)
                            <label class="form-label">Chart</label>
                            @endif            
                            <div class="chart-row">                
                                {{ Form::file('chart[]') }}  
                                <div class="img-chart">
                                    <a href="{{ asset('storage/app/public/chart/'.$size->chart) }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">    
                                        <img class="img-fluid" src="{{ asset('storage/app/public/chart/'.$size->chart) }}">
                                    </a>                          
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-2">
                            @if($k == 0)
                            <label class="form-label">Size Available</label>
                            @endif
                            <div class="d-flex align-items-center">
                                {{ Form::select('size_available[]',['yes' => 'YES','no' => 'NO'],$size->size_available,array('class'=>'form-control','required')) }}
                                @if($k == 0)
                                <button type="button" class="form-add-btn addSize">+</button>
                                @else
                                <button type="button" class="form-add-btn form-remove-btn removeSize" data-productsizeid="{{ $size->id }}">-</button>                                    
                                @endif
                           </div>
                        </div>
                    </div>
                    @endforeach
                </div>                
                <div class="form-group col-3">
                    <label class="form-label">Product Price</label>
                    {{ Form::text('price',$data->price,array('class'=>'form-control price','placeholder'=>'00.00','required')) }}
                </div>
                <div class="form-group col-3">
                    <label class="form-label">Product Old Price</label>
                    {{ Form::text('old_price',$data->old_price,array('class'=>'form-control old_price','placeholder'=>'00.00','required')) }}
                </div>
                <div class="form-group col-3">
                    <label class="form-label">Stock Status</label>
                    {{ Form::select('stock_status',[' ' => 'Select Stock Status','available' => 'Available','out_of_stock' => 'Out Of Stock','few_available' => 'Few Available','pre_order' => 'Pre Order'],$data->stock_status,array('class'=>'form-control','required')) }}
                </div>   
                <div class="form-group col-3">
                    <label class="form-label">Product Unit</label>
                    <div class="pro-unit">
                        <input type="radio" id="qty" name="product_unit" value="qty" <?= ($data->product_unit == 'qty') ? 'checked' : '' ?>>
                        <label for="qty" class="mr-3">QTY</label>

                        <input type="radio" id="weight" name="product_unit" value="weight" <?= ($data->product_unit == 'weight') ? 'checked' : '' ?>>
                        <label for="weight">Weight</label>
                    </div>
                </div> 
                <div class="form-group col-12">
                    <label class="form-label">Discount Title</label>
                    {{ Form::text('discount_title',$data->discount_title,array('class'=>'form-control discount_title')) }}
                </div>                   
                <button type="submit" class="btn btn-primary col-12">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ URL::asset('public/admin/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/slim.kickstart.min.js') }}"></script>
<script src="{{asset('public/admin/js/ekko-lightbox.min.js')}}"></script>
<script src="{{URL::asset('public/admin/js/summernote/summernote.min.js')}}"></script>
<script type="text/javascript">

    $('.description').summernote({            
        toolbar: [                
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']]               
        ],               	        
    });

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });

    // select2 start

    $('.select2').select2();

    // select2 start

    //add new size start
    $('body').on('click', '.addSize', function () {
        var size = '<div class="row col-12"><input type="hidden" name="product_size_id[]" value="0"><div class="appendedDiv form-group col-2">';
        size +=
            '{{ Form::select('size_unit[]',['cm' => 'CM','mm' => 'MM','ply' => 'PLY','mesh' => 'Mesh','kilogram' => 'Kilogram','gram' => 'Gram','meter' => 'Meter'],'',array('class'=>'form-control','placeholder'=>'Size Unit','required')) }}';
        size += '</div>';
        size += '<div class="form-group col-2">';        
        size +=
            '{{ Form::text('size[]','',array('class'=>'form-control size','placeholder'=>'Size','required')) }}';
        
        size += '</div>';
        size += '<div class="form-group col-3">';       
        size += '{{ Form::text('size_price[]',old('size_price'),array('class'=>'form-control size_price','placeholder'=>'Price')) }}';
        size += '</div>';
        size += '<div class="form-group col-3">';       
        size += '{{ Form::file('chart[]') }}';
        size += '</div>';		
        size += '<div class="form-group col-2">';        
        size += '<div class="d-flex align-items-center">';
        size += '{{ Form::select('size_available[]',['yes' => 'YES','no' => 'NO'],old('size_available'),array('class'=>'form-control','required')) }}';
        size += '<button type="button" class="form-add-btn form-remove-btn removeSize">-</button>';	
        size += '</div></div></div>';	

        $('.sizeMainDiv').append(size);
    });
    //add new size end 

    // remove appended size start

    $('body').on('click', '.removeSize', function () { 

        if($(this).data('productsizeid')) {

          var sizeId = $(this).data('productsizeid');

          $.ajax({
            type: 'POST',
            async: true,
            dataType: "json",
            url: "{{ URL::to('admin/product/remove-product-size') }}",
            data: {
                _token: '{{ csrf_token() }}',
                sizeId: sizeId
            },
            success: (response) => {
                
            }
        });           
        
        }    

        $(this).parent().parent().parent().remove();
    });

    // remove appended size end

    //add new color start
    // $('body').on('click', '.addColor', function () {

    //     var color = '<div class="d-flex align-items-center pro-color">';
    //     color +=
    //         '{{ Form::color('color_code[]','',array('class'=>'form-control','required')) }}';
    //     color += '<button type="button" class="form-add-btn form-remove-btn removeColor">-</button>';
    //     color += '</div>';

    //     $('.colorMainDiv').append(color);

    // });

    //add new color end   

    // remove appended color start

    // $('body').on('click', '.removeColor', function () {

    //     $(this).parent().remove();

    // });

    // remove appended color end

    // get category by type START

    $('body').on('change', '.type', function () {

        var nettype = $(this).val();

        $.ajax({
            type: 'POST',
            async: true,
            dataType: "json",
            url: "{{ URL::to('admin/product/category-by-type') }}",
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

    // get subcategory by category START

    $('body').on('change', '.category', function () {

        var category = $(this).val();

        $.ajax({
            type: 'POST',
            async: true,
            dataType: "json",
            url: "{{ URL::to('admin/product/subcategory-by-category') }}",
            data: {
                _token: '{{ csrf_token() }}',
                category: category
            },
            success: (response) => {

                $('.subcategory').empty();
                $(".subcategory").append('<option value="">Select SubCategory</option>');
                if (response) {
                    $.each(response, function (key, value) {
                        $('.subcategory').append($("<option/>", {
                            value: key,
                            text: value
                        }));
                    });
                }

            }
        });
    });

// get subcategory by category END

    // allow only number and decimal values in sizes and price START

    $("body").on("input", ".price,.size,.size_price", function (evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });
    // allow only number and decimal values in sizes and price END  
    
    // image upload plugin START
    $(document).ready(function () {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function (e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Remove image</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(function () {
                            $(this).parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });
    // image upload plugin END

    // delete image START

    $('.removeExistImage').on('click', function () {

        var imageId = $(this).data('image');

        $.ajax({
            type: 'POST',
            async: true,
            dataType: "json",
            url: "{{URL::to('admin/product/remove-image')}}",
            data: {
                _token: '{{ csrf_token() }}',
                imageId: imageId
            },
            success: function (response) {

                if (response == 'limit'){
                    alert('product has atleast one image..!');
                }
                if (response == 'success') {
                    $("#productimage-" + imageId).hide();
                }
            }
        });
    });

// delete images END   


</script>
@endsection
