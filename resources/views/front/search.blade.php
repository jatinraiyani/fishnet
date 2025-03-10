@extends('layouts.app')
@section('title')
AgastyaMarine | Search
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('public/front/css/toastr.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
@endsection
@section('content')

<section class="banner">
    <div class="owl-carousel owl-theme banner-owl">        
            @foreach($banner as $banner_row)
            <div class="item">
            <img src="{{ asset('storage/app/public/slider/'.$banner_row->image) }}" alt="" class="img-fluid banenr-img">
             <div class="banner-text">
                <div class="banner-img">
                    <img src="{{ asset('public/front/images/banner-fish.svg') }}" alt="" class="img-fluid">
                </div>
                <h1>{{ $banner_row->title }}</h1>
                <p>{!! htmlspecialchars_decode($banner_row->description) !!}</p>
            </div> 
        </div>        
    
    @endforeach
</div>
</section>

<!-- product list -->
<section class="product-shop">
    <div class="container">
        <div class="title-section">
            <h2 class="text-white">Searched Products</h2>
        </div>

        <div class="row" id="post_data">
            @forelse($product as $product_row)
            <!-- product box 1 -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="product-box">
                    @if($product_row->stock_status == 'available')
                        <span class="badge bg-success">Available</span>
                    @elseif($product_row->stock_status == 'out_of_stock')
                        <span class="badge bg-danger">Out Of Stock</span>
                    @elseif($product_row->stock_status == 'few_available')
                        <span class="badge bg-warning text-dark">Few Available</span>
                    @elseif($product_row->stock_status == 'pre_order')
                        <span class="badge bg-info text-dark">Pre Order</span>
                    @else 
                    @endif
                    <div class="product-shop-img">                       
                        @foreach($product_row->product_image as $k => $imgs)
                        @if($k == 0)
                        <img src="{{ asset('storage/app/public/product/'.$imgs->image) }}" class="img-fluid" alt="{{ $product_row->name }}">
                        @endif
                        @endforeach                       
                    </div>
                    <h5>{{ $product_row->name }}</h5>
                            @if($product_row->product_unit == 'qty')
                            <div class="del-price"><h3>₹<del>{{$product_row->old_price}}</del></h3><h3>₹{{ $product_row->price }}</h3></div><h6>per Piece</h6>
                            @else
                            <div class="del-price"><h3>₹<del>{{$product_row->old_price}}</del></h3><h3>₹{{ $product_row->price }}</h3></div><h6>per KG</h6>
                            @endif 
                            <span class="badge bg-info text-dark"><small>{{$product_row->discount_title}}</small></span>
                    <div class="product-hover">
                        <div class="add-box">
                            @if($product_row->product_unit == 'qty')
                            <div class="del-price"><h3>₹<del>{{$product_row->old_price}}</del></h3><h3>₹{{ $product_row->price }}</h3></div><h6>per Piece</h6>
                            @else
                            <div class="del-price"><h3>₹<del>{{$product_row->old_price}}</del></h3><h3>₹{{ $product_row->price }}</h3></div><h6>per KG</h6>
                            @endif 
                        @if($product_row->stock_status != 'out_of_stock')  
                            <button type="button" class="addtocart" id="addtocart" data-product="{{ $product_row->id }}">Add to Cart</button>
                        @else 
                            <button type="button" class="addtocart outofstockbutton">Add to Cart</button>
                        @endif  
                        </div>
                    </div>
                </div>
            </div>

            @empty
            No Product Found
            @endforelse            
        </div>

        {{-- <div class="row mt-4">
            <div class="col-md-12 justify-content-center text-center">
                {!! $product->links() !!}
            </div>
        </div> --}}

    </div>
</section>

@endsection

@section('js')
<script src="{{asset('public/front/js/toastr.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>

// product out of stock button popup START

$('body').on('click','.outofstockbutton',function(){
    swal('This Product is Out of stock');
    return false;
});
// product out of stock button popup END

</script>
@endsection
