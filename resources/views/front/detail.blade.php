@extends('layouts.app')
@section('title')
AgastyaMarine | Product Detail
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
@endsection
@section('content')
<section class="product-detail-banner">
    <div class="container">
        <div class="product-banner">
            <h1>Fishing Products</h1>
            <p>The very latest in globally-recognised fishing Products offers you with an exquisite range <br />
                of fishing net, rope, twine and coden at affordable price
            </p>
        </div>
    </div>
</section>
<section>
    <section class="product-detail-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="product-cat">
                        <h3>Product Categories</h3>
                        <div class="accordion" id="accordion">
                            @foreach($types as $K => $type_row)
                                <div class="accordion-item">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#category{{ $type_row->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $type_row->id }}">
                                        {{ ucfirst($type_row->name) }}
                                    </button>
                                    <div id="category{{ $type_row->id }}"
                                        class="accordion-collapse collapse <?= ($K == 0) ? "show" : "" ?>"
                                        aria-labelledby="heading{{ $type_row->id }}" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach($type_row->type_category as $category_row)
                                                    <li class="select-category"
                                                        data-category="{{ $category_row->id }}">
                                                        {{ ucfirst($category_row->name) }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <h3 class="mt-3">BRAND</h3>
                        <div class="brand-list">

                            @foreach($brand as $brand_row)
                                <div class="form-check ">
                                    <input class="form-check-input brandcheck" name="brand" type="checkbox" id="inlineCheckbox-{{ $brand_row->id }}"
                                        value="{{ $brand_row->id }}">
                                    <label class="form-check-label"
                                        for="inlineCheckbox-{{ $brand_row->id }}">{{ $brand_row->name }}</label>
                                </div>                            
                            @endforeach
                        </div>

                        <div class="">

                        </div>                        
                    </div>                    
                </div>

                <div class="col-md-9">
                    <div class="row" id="products-data">
                        <!-- product box 1 -->
                        @forelse($products as $products_row)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="product-box">
                                    @if($products_row->stock_status == 'available')
                                        <span class="badge bg-success">Available</span>
                                    @elseif($products_row->stock_status == 'out_of_stock')
                                        <span class="badge bg-danger">Out Of Stock</span>
                                    @elseif($products_row->stock_status == 'few_available')
                                        <span class="badge bg-warning text-dark">Few Available</span>
                                    @elseif($products_row->stock_status == 'pre_order')
                                        <span class="badge bg-info text-dark">Pre Order</span>
                                    @else 
                                    @endif
                                    <div class="product-shop-img">
                                        @foreach($products_row->product_image as $k => $imgs)
                                            @if($k == 0)
                                            <img src="{{ asset('storage/app/public/product/'.$imgs->image) }}" class="img-fluid" alt="{{ $products_row->name }}">
                                            @endif
                                        @endforeach   
                                    </div>
                                    <h5>{{ $products_row->name }}</h5>
                                    @if($products_row->product_unit == 'qty')
                                    <div class="del-price"><h3>₹<del>{{$products_row->old_price}}</del></h3><h3>₹{{ $products_row->price }}</h3></div><h6>per Piece</h6>
                                    @else
                                    <div class="del-price"><h3>₹<del>{{$products_row->old_price}}</del></h3><h3>₹{{ $products_row->price }}</h3></div><h6>per KG</h6> 
                                    @endif 
                                    <span class="badge bg-info text-dark"><small>{{$products_row->discount_title}}</small></span>
                                    <div class="product-hover">
                                        <div class="add-box">
                                            @if($products_row->product_unit == 'qty')
                                            <div class="del-price"><h3>₹<del>{{$products_row->old_price}}</del></h3><h3>₹{{ $products_row->price }}</h3></div><h6>per Piece</h6>
                                            @else
                                            <div class="del-price"><h3>₹<del>{{$products_row->old_price}}</del></h3><h3>₹{{ $products_row->price }}</h3></div><h6>per KG</h6>
                                            @endif 
                                            @if($products_row->stock_status != 'out_of_stock')  
                                                <button type="button" class="addtocart" id="addtocart" data-product="{{ $products_row->id }}">Add to Cart</button>
                                            @else 
                                                <button type="button" class="addtocart outofstockbutton">Add to Cart</button>
                                            @endif  
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        @empty
                        <div class="col-12 col-sm-6 col-md-6 col-lg-12">
                            <b>No Products Found</b>
                        </div>    
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>   

    <!-- end banner -->

    @endsection
    @section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">

    // get URL parameters START
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }
    // get URL parameters END

    // product out of stock button popup START
    $('body').on('click','.outofstockbutton',function(){
        swal('This Product is Out of stock');
        return false;
    });
    // product out of stock button popup END 

        // category filter

        $('body').on('click', '.select-category', function () {

            $('.select-category').removeClass('thisIsSelected');
            $(this).addClass('thisIsSelected');

            var category = $(this).data('category');           

            let brand = [];

            $('input[name="brand"]:checked').each(function() {                
                brand.push(this.value);
            });    

            var category_id = $.urlParam('category_id');        
            var subcategory_id = $.urlParam('subcategory_id');        

            filter_product(category,brand,category_id,subcategory_id);

        });

        // brand filter
        $('body').on('click', '.brandcheck', function () {

            let brand = [];

            $('input[name="brand"]:checked').each(function() {                
                brand.push(this.value);
            }); 
            
            var category = $('.thisIsSelected').data('category');

            var category_id = $.urlParam('category_id');        
            var subcategory_id = $.urlParam('subcategory_id');        

            filter_product(category,brand,category_id,subcategory_id);

        });

        function filter_product(category,brand,category_id,subcategory_id) {

            $.ajax({
                type: 'POST',
                url: "{{ URL::to('filter-product') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    category: category,
                    brand: brand,
                    category_id:category_id,
                    subcategory_id:subcategory_id
                },
                success: function(data){

                    var products = '';
                    
                if(data.data.length != 0) {

                    $.each(data.data, function (j, v) {

                        products += '<div class="col-12 col-sm-6 col-md-6 col-lg-4">';
                        products += '<div class="product-box">';

                        if(v.stock_status == 'available'){
                            products += '<span class="badge bg-success">Available</span>';
                        } else if(v.stock_status == 'out_of_stock'){
                            products += '<span class="badge bg-danger">Out Of Stock</span>';
                        } else if(v.stock_status == 'few_available'){
                            products += '<span class="badge bg-warning text-dark">Few Available</span>';
                        } else if(v.stock_status == 'pre_order'){
                            products += '<span class="badge bg-info text-dark">Pre Order</span>';
                        } else {

                        }

                        products += '<div class="product-shop-img">';

                        $.each(v.product_image,function(i,m){
                            if(i == 0){
                                var APP_URL = {!! json_encode(url('storage/app/public/product')) !!};
                                products += '<img src="' + APP_URL+'/'+m.image + '" class="img-fluid" alt="' + v.name +
                            '">';
                            }                            
                        });
                        
                        products += '</div>';
                        products += '<h5>' + v.name + '</h5>';
                        if(v.product_unit = 'qty'){
                            products += '<div class="del-price"><h3>₹<del>'+v.old_price+'</del></h3><h3>₹'+v.price+'</h3></div><h6>per Piece</h6>';
                        } else {
                            products += '<div class="del-price"><h3>₹<del>'+v.old_price+'</del></h3><h3>₹'+v.price+'</h3></div><h6>per KG</h6>';
                        }
                        products += '<span class="badge bg-info text-dark"><small>'+v.discount_title+'</small></span>';
                        products += '<div class="product-hover">';
                        products += '<div class="add-box">';
                        if(v.product_unit = 'qty'){
                            products += '<div class="del-price"><h3>₹<del>'+v.old_price+'</del></h3><h3>₹'+v.price+'</h3></div><h6>per Piece</h6>';
                        } else {
                            products += '<div class="del-price"><h3>₹<del>'+v.old_price+'</del></h3><h3>₹'+v.price+'</h3></div><h6>per KG</h6>';
                        }
                        if(v.stock_status != 'out_of_stock'){
                            products += '<button type="button" class="addtocart" id="addtocart" data-product="'+v.id+'">Add to Cart</button>';
                        } else {
                            products += '<button type="button" class="addtocart outofstockbutton">Add to Cart</button>';
                        }
                        products += '</div></div>';                        
                        products += '</div></div>';
                    });

                   } else {
                       products += '<div class="col-12 col-sm-6 col-md-6 col-lg-4">No Product Found</div>';
                   }

                    $('#products-data').html('');
                    $('#products-data').html(products);
                }
            });

        }
        
    </script>
    @endsection
