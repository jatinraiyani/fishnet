@extends('layouts.app')
@section('title')
AgastyaMarine | Home
@endsection
@section('content')
<!-- banner -->
<div class="wantbuy-box box-white" id="s_01">
    <h3 id="type-title">What do you want to buy?</h3>
    <ul>
        @foreach($type as $type_row)
            <li>
                <div class="form-check type-section go-continue" data-id="{{ $type_row->id }}" data-show-id="s_02">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                        value="option1">
                    <label class="form-check-label" for="exampleRadios1">
                        <img src="{{ asset('storage/app/public/type/'.$type_row->image) }}"
                            class="img-fluid" alt="{{ $type_row->name }}">
                    </label>
                    <button class="btn-black">{{ ucfirst($type_row->name) }}</button>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="text-center">
        {{-- <button class="secondary-button go-continue type-button" data-show-id="s_02">Continue</button> --}}
    </div>
</div>
<div class="categorybox2 box-white hidden" id="s_02">
    <img src="{{ asset('public/front/images/fishing-pana.svg') }}" class="img-fluid" alt="">
    <h3 id="category-title">Please Select Category
    </h3>
    <ul class="typeof-list">        

    </ul>
    <div class="text-center pt-3 d-block" id="typeof-list">

    </div>   
    <div class="text-center">
        {{-- <a class="secondary-button test-button go-continue category-button" data-show-id="s_03">Continue</a> --}}
    </div>
</div>

<div class="categorybox3 box-white hidden" id="s_03">
    <img src="{{ asset('public/front/images/fishing-pana.svg') }}" class="img-fluid" alt="">
    <h3 id="subcategory-title">Please Select Sub Category
    </h3>
    <ul class="subcat-list">

    </ul>
    <div class="text-center pt-3 d-block">
        <form method="GET" id="subcategory-form" action="{{ URL::to('product-by-category') }}">
            @csrf
            <input type="hidden" name="category_id" id="selected-category">
            <input type="hidden" name="subcategory_id" id="selected-subcategory">
            <button type="submit" class="secondary-button subcategory-button" style="display:none;">Procced</button>
        </form>
    </div>
</div>

<!-- emd  modal and to cart-->
@endsection
@section('js')
<script type="text/javascript">
    // var typeId = '';
   // homa page redirect type wise category START

   var typeId = localStorage.getItem('type');

    if(typeId != 0) {
        $('#s_01').hide();    
        typeId = localStorage.getItem('type');        
        $.ajax({
            type: 'GET',
            async: true,
            dataType: "json",
            url: "{{ URL::to('category-by-type') }}",
            data: {
                _token: '{{ csrf_token() }}',
                typeId: typeId
            },
            context: this,
            success: function (data) {
               
                var category = '';
                if(data.data.length != 0){

                    $.each(data.data, function (j, v) {
                        category += '<li class="selected-category go-continue" data-category="' + v.id +
                            '" data-show-id="s_03">';
                        category += '<div class="form-check">';
                        category +=
                            '<input class="form-check-input" type="radio" name="cat">';
                        category += '<label class="form-check-label" for="' + v.name + '">';
                        category += '<span>' + v.name.toUpperCase() + '</span>';
                        category += '</label></div></li>';
                    });      
                    $('.typeof-list').html(category);
                } else {
                    $('#category-title').html('Coming Soon.');
                    category += '<form method="GET" action="{{ URL::to('product-by-category') }}">';
                    category += '@csrf';
                    category += '<input type="hidden" name="category_id" id="selected-category">';
                    category += '<input type="hidden" name="subcategory_id" id="selected-subcategory">';
                    category += '<button type="submit" class="secondary-button subcategory-button">Procced</button>';
                    category += '</form>';

                    $('#typeof-list').html(category);
                }

                $('#s_02').show();   
                localStorage.setItem('type',0);     
                   
            }
        });        
    } 

   // homa page redirect type wise category END   

    $('body').on('click','.type-section', function () {

        typeId = $(this).data('id');
        $.ajax({
            type: 'GET',
            async: true,
            dataType: "json",
            url: "{{ URL::to('category-by-type') }}",
            data: {
                _token: '{{ csrf_token() }}',
                typeId: typeId
            },
            context: this,
            success: function (data) {            
               
                var category = '';
                if(data.data.length != 0){

                    $.each(data.data, function (j, v) {
                        category += '<li class="selected-category go-continue" data-category="' + v.id +
                            '" data-show-id="s_03">';
                        category += '<div class="form-check">';
                        category +=
                            '<input class="form-check-input" type="radio" name="cat">';
                        category += '<label class="form-check-label" for="' + v.name + '">';
                        category += '<span>' + v.name.toUpperCase() + '</span>';
                        category += '</label></div></li>';
                    });      
                    $('.typeof-list').html(category);
                } else {
                    $('#category-title').html('No categories found.');
                    category += '<form method="GET" action="{{ URL::to('product-by-category') }}">';
                    category += '@csrf';
                    category += '<input type="hidden" name="category_id" id="selected-category">';
                    category += '<input type="hidden" name="subcategory_id" id="selected-subcategory">';
                    category += '<button type="submit" class="secondary-button subcategory-button">Procced</button>';
                    category += '</form>';

                    $('#typeof-list').html(category);
                }
                   
            }
        })
    });

    $('body').on('click', '.selected-category', function () {

        var categoryId = $(this).data('category');
        $('#selected-category').val(categoryId);
        
        $.ajax({
            type: 'GET',
            async: true,
            dataType: "json",
            url: "{{ URL::to('subcategory-by-category') }}",
            data: {
                _token: '{{ csrf_token() }}',
                categoryId: categoryId
            },
            context: this,
            success: function (data) {    

              if(data.data.length == 0){
                $('#subcategory-title').html('Coming Soon.');
                $('.subcategory-button').css('display','block');
              }            
                var category = '';
                $.each(data.data, function (j, v) {                   
                    category += '<li class="selected-subcategory" data-subcategory="' + v.id +
                        '">';
                    category += '<div class="form-check">';
                    category +=
                        '<input class="form-check-input" type="radio" name="subcat">';
                    category += '<label class="form-check-label" for="' + v.name + '">';
                    category += '<span>' + v.name.toUpperCase() + '</span>';
                    category += '</label></div></li>';
                });

                $('.subcat-list').html(category);
            }
        })
    });

    $('body').on('click', '.selected-subcategory', function () {      

        var subcategoryId = $(this).data('subcategory');
        $('#selected-subcategory').val(subcategoryId);

        $('#subcategory-form').submit();

    });

</script>
@endsection
