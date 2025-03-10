<!-- HEADER START -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />    
    <meta name="title" content="Agastyamarine">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Provide all types of fishing nets in gujarat's all ports." />

    <meta name="target" content="all" />
    <meta name="language" content="en,gu,hi" />
    <meta name="expires" content="never" />
    <meta name="rating" content="General" />
    <meta name="coverage" content="porbandar,veraval,okha,mangrol,dwarka,vankbara,diu,una,kotda,gujarat,india,maharastra,karnataka,goa,bombay,manglore" />
    <meta name="distribution" content="Global" />
    <meta name="revisit-after" content="1 Day" />
    <meta name="robots" content="follow, index" />
    <meta name="classification" content="Business" />
    <meta name="copyright" content="©Agastyamarine" />
    <meta name="url" content="https://agastyamarine.in" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="reply-to" content="agastyamarine45@gmail.com" />
    <meta name="author" content="Agastyamarine, agastyamarine45@gmail.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="owner" content="Chintan Hojar,Abhishek Hojar" />
    <meta name="subtitle" content="All types of fishing net and marine products seller" />
    <meta name="keywords"
        content="All types of fishing net and marine products seller,net,marine,fish net,fishing net,marine net,HDPE fishing net,hdpe,SNG fishing net,sng,safayer fishing net,boat assesories,twine,hdpe twine,safayer twine,bahubali net,agastya,ocean,marsal,sujlon,garware,turfe,kohinur,amar,balaji,net,gps,radio,wireless,battery,chain,trawel net,oja,puchhda,sng net,safayer net,DHPE net,runner net,star net,kala pathhar,black marine,bahubali,breided,15 PLY NET,9 PLY NET,6 PLY NET,12 PLY NET,21 PLY NET,24 PLY NET,30 PLY NET,36 PLY NET,18 PLY NET,45 PLY NET,60 PLY NET,63 PLY NET,porbandar,veraval,okha,mangrol,dwarka,vankbara,diu,una,kotda,gujarat,india,maharastra,karnataka,goa,bombay,manglore" />

    <link rel="shortcut icon" href="{{URL::to('public/front/images/favicon.png')}}">
    <link rel="canonical" href="https://agastyamarine.in" />    
    @yield('meta')
    <!-- google font  -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link  rel="stylesheet" href="{{ asset('public/front/css/owl.carousel.min.css')}}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/css/font-awsome.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/front/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/front/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/front/css/responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 

    @yield('css')
    <title>@yield('title')</title>
</head>

<body>

    @include('include.front.header')

    <!-- HEADER END -->
  
     @yield('content')

     {{-- Product Modal START  --}}

     <!-- modal add to cart -->
 <div class="modal product-detail-modal" tabindex="-1" id="product-detail-modal">    
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg
                        xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='#fff'>
                        <path
                            d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z' />
                    </svg></button>
                <div id="modal-product">
                    <div class="product-box">
                        <div class="product-shop-img" id="product-detail-image">
                            {{-- <div class="owl-carousel product-owl" id="product-detail-image">
                                
                            </div> --}}
                        </div>
                        <h5 id="product-title"></h5>                        
                        <p class="p-small" id="product-description"></p>
                    </div>
                    <div class="product-size">
                        <div class="row">
                            <div class="col-md-6">
                                <label>SIZE</label>
                                <select class="form-select selectedsizeoption" id="product-size" name="productsize">
                                    
                                </select>
                            </div>
                            <div class="col-md-6" id="product-detail-qty-box">
                                <label>Quantity</label>
                                <div class="qty-box">
                                    <button type="button" id="sub" class="sub" disabled>-</button>
                                    <input type="text" id="qty" value="1" min="1" readonly/>
                                    <button type="button" id="add" class="add" disabled>+</button>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <h3 id="product-price"></h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- for cart data start --}}
                <input type="hidden" name="cart_product_id" id="cart_product_id">
                <input type="hidden" name="cart_product_unit_type" id="cart_product_unit_type">
                <input type="hidden" name="cart_type_id" id="cart_type_id">
                <input type="hidden" name="cart_category_id" id="cart_category_id">
                <input type="hidden" name="cart_subcategory_id" id="cart_subcategory_id">
                <input type="hidden" name="cart_price" id="cart_price">
                <input type="hidden" name="cart_size" id="cart_size">
                <input type="hidden" name="cart_qty" id="cart_qty" value="1">

                {{-- <input type="hidden" name="cart_item_total" id="cart_item_total">
                <input type="hidden" name="cart_item_grand_total" id="cart_item_grand_total"> --}}

                {{-- for cart data end --}}

                <button class="secondary-button w-100" id="add-cart">Add To Cart</button>

            </div>
        </div>
    </div>
</div>
<!-- emd  modal and to cart-->
     {{-- Product Modal END  --}}

{{-- Size image Modal start  --}}
<div class="modal" id="sizechartmodal" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Chart Image</h5>          
        </div>
        <div class="modal-body">
           <img id="chartimg" src="" class="img-fluid"> 
        </div>        
      </div>
    </div>
  </div>
{{-- Size image Modal end  --}}

    <!--Footer START   -->
    @include('include.front.footer')
    <!--Footer END   -->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('public/front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/front/js/owl.carousel.min.js')}}"></script>   
    <script src="{{ asset('public/front/js/custom.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
   

    @yield('js')
    <script type="text/javascript">

        @if(Session::has('message'))        
        // remove cart on successfull order START
        var msg = "{{ Session::get('message') }}";
        if(msg == "Order Placed Successfully,Admin will confirm you."){
            localStorage.removeItem("cart");
        }
        // remove cart on successfull order END

        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
    
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
    
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
    
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif                      
                 

    let search = localStorage.getItem('search');
                
    if(search != null) {
        $('#searchBar').val(search);
    }           

// ===================  CART START ====================================  //

//  validation of if checkout page then not to open cart popup START     

var pathname = window.location.pathname;   

if(pathname == '/checkout' || pathname == '/fishnet/checkout'){ 
    $('#cart-popup').hide();
} 

//  validation of if checkout page then not to open cart popup START 

// if page is not select product then type localstorag = 0 START

if(pathname != '/select-product'){ 
    localStorage.setItem('type',0);
} 

// if page is not select product then type localstorag = 0 END

// IF AUTH is set then add cart db data (which are not in local storage) in localstorage cart STRAT

$(window).on("load",function(){ 

  var auth_check = "{{{ (Auth::user()) ? Auth::user()->id : 'empty' }}}";
    
    if(auth_check != 'empty'){
        $.ajax({
            type:'GET',
            url:'{{ URL::to("cart-detail") }}',            
            success: function(response){   
             if(response.data.length > 0){

                let cartLocal = localStorage.getItem('cart');
                
                if(cartLocal != null && cartLocal.length > 0) {
                    cartLocal = JSON.parse(localStorage.getItem('cart'));
                }    
                 let addLocal = new Array();
                if(cartLocal == null) {                   
                    // if localstorage NULL & cart table not null 
                    let newArr = '';          
                        localStorage.setItem('cart','');    
                        $.each(response.data,function(s,w){
                            newArr = {
                                'uniqueId': w.uniqueId,
                                'product': w.product,
                                'product_unit':w.product_unit, 
                                'type': w.type,
                                'category': w.category,
                                'subcategory': (w.subcategory == null) ? '' : w.subcategory,
                                'price': w.price,
                                'size': w.size,
                                'qty': w.qty
                            };                           
                            addLocal.push(newArr);
                        });                                           
                            localStorage.setItem('cart',JSON.stringify(addLocal));                           

                } else if(cartLocal.length > 0){
                    $.each(response.data,function(s,w){
                        $.each(cartLocal,function(j,k){                            
                            // price and size are same
                            if(k.product == w.product && k.size == w.size && parseFloat(k.qty) != parseFloat(w.qty)){                                                           
                                k.qty = parseFloat(k.qty) + parseFloat(w.qty);                                
                            } else {                               
                                 newArr = {
                                    'uniqueId': w.uniqueId,
                                    'product': w.product,
                                    'product_unit':w.product_unit,  
                                    'type': w.type,
                                    'category': w.category,
                                    'subcategory': (w.subcategory == null) ? '' : w.subcategory,
                                    'price': w.price,
                                    'size': w.size,
                                    'qty': w.qty
                                };                                            
                                // addLocal.push(newArr);       
                            }                             
                        }); 
                        addLocal.push(newArr);                
                    });
                        $.merge(cartLocal,addLocal);

                        let newArray = [];
                        let uniqueObject = {}; // Declare an empty object 

                        for (let i in cartLocal) { // Loop for the array elements                            
                            objTitle = cartLocal[i]['uniqueId']; // Extract the title
                            uniqueObject[objTitle] = cartLocal[i];  // Use the title as the index
                        }   
                         
                        for (i in uniqueObject) { // Loop to push unique object into array
                            newArray.push(uniqueObject[i]); 
                        }
                                                
                        localStorage.setItem('cart',JSON.stringify(newArray));
                       
                } 
                
              }

            }    
        });
    }

    // set cart item count on page load START 

    var cartcount = JSON.parse(localStorage.getItem('cart'));
    if(cartcount != null && cartcount.length > 0) {        
        $('#cart-item-number').css('display','block');
        $('#cart-item-number').html(cartcount.length);
        $('#cart-footer').show();
    } else {
        $('#cart-item-number').css('display','none');       
        $('#cart-content-popup').html('No Product Found in cart');
        $('#cart-footer').hide();
    }

    // set cart item count on page load END 
});

// IF AUTH is set then add cart db data (which are not in local storage) in localstorage cart END

// set cart item count on page load START 

    var cartcount = JSON.parse(localStorage.getItem('cart'));
    if(cartcount != null && cartcount.length > 0) {        
        $('#cart-item-number').css('display','block');
        $('#cart-item-number').html(cartcount.length);
        $('#cart-footer').show();
    } else {
        $('#cart-item-number').css('display','none');       
        $('#cart-content-popup').html('No Product Found in cart');
        $('#cart-footer').hide();
    }

// set cart item count on page load END 

// modal product STRAT 
    $(document).on('click','#addtocart',function(e){        
        e.preventDefault();    
        var product = $(this).data('product');          

        $.ajax({
            type:'POST',
            url:'{{ URL::to("product-popup") }}',
            data:{
                _token:"{{ csrf_token() }}",
                product:product
                },
            success: function(data){

                // Fill cart details start

                $('#cart_product_id').val(data.id);
                $('#cart_product_unit_type').val(data.product_unit);
                $('#cart_type_id').val(data.type_id);
                $('#cart_category_id').val(data.category_id);
                $('#cart_subcategory_id').val(data.subcategory_id);
                // $('#cart_price').val(data.price);
                $('#cart_size').val(data.product_size[0].size+'-'+data.product_size[0].size_unit);
                $('#cart_item_total').val(data.price);                            
                

                // Fill cart details end

                $('#product-title').html('');
                $('#product-price').html('');
                $('#product-description').html('');
                // $('#product-image').attr("src",'');
                
                $('#product-title').html(data.name);
                $('#product-price').html(data.price);               
                $('#product-description').html(data.description);
                // $('#product-image').attr("src",data.image);

                var product_image = '<div class="owl-carousel product-owl">';               

                $.each(data.product_image,function(l,m){
                    product_image += '<div class="item"><img src="'+m.image+'" class="img-fluid" alt=""></div>';
                });
                    product_image += '</div">';

                $('#product-detail-image').html('');
                $('#product-detail-image').html(product_image);

                var modalSize = '<option value="">Select Size</option>';

                $.each(data.product_size,function(j,k){
                    if(k.size_available == 'yes'){
                        modalSize += '<option data-productunit="'+data.product_unit+'" data-chart="'+k.chart+'" value="'+k.size+'-'+k.size_unit+'" data-sizeprice="'+k.price+'">'+k.size+' '+k.size_unit+'</option>';
                    } else {
                        modalSize += '<option value="'+k.size+'-'+k.size_unit+'" disabled>'+k.size+' '+k.size_unit+'</option>';
                    }                    
                });                

                $('#product-size').html('');
                $('#product-size').html(modalSize);

                $('#sub').prop('disabled',true);
                $('#add').prop('disabled',true);
                $('#qty').prop('disabled',true);

                var qtybox = '<label>Quantity</label><div class="qty-box">';

                if(data.product_unit == 'qty'){                   
                    qtybox += '<button type="button" id="sub" class="sub" disabled>-</button>';
                    qtybox += '<input type="text" id="qty" value="1" min="1" readonly/>';
                    qtybox += '<button type="button" id="add" class="add" disabled>+</button>';
                    qtybox += '</div>';
                } else {                    
                    qtybox += '<input type="text" class="weightproduct" id="qty" value="1" min="1" disabled/>';
                }
                    qtybox += '</div>';
                $('#product-detail-qty-box').html('');
                $('#product-detail-qty-box').html(qtybox);

                $('#product-detail-modal').modal('show');

                $('.product-owl').owlCarousel({
                    loop:true,
                    nav:false,
                    dots:true,
                    loop: true,
                    items:1                       
                });
               
            }    
        }); 

    });    
// modal product END 

// add product in cart start
 $('body').on('click','#add-cart',function(e){

    let product = $('#cart_product_id').val();
    let product_unit = $('#cart_product_unit_type').val();
    let type = $('#cart_type_id').val();
    let category = $('#cart_category_id').val();
    let subcategory = $('#cart_subcategory_id').val();
    let price = $('#cart_price').val();
    let size = $('select[name=productsize] option').filter(':selected').val();
    
     if(size === ''){
        swal('please select product size properly');
        return false;
     }    
    let qty = $('#cart_qty').val();

    if(qty < 1){

        swal('please choose quantity atleast 1');
        return false;

    }    
    
    var productArray = {
            'uniqueId': new Date().getTime(),
            'product': product,
            'product_unit':product_unit, 
            'type': type,
            'category': category,
            'subcategory': subcategory,
            'price': price,
            'size': size,
            'qty': qty
                       };

    var cartArray = JSON.parse(localStorage.getItem('cart')); 

    	if(cartArray == null) {
			let arr = new Array(productArray);
			localStorage.setItem('cart', JSON.stringify(arr));
		} else {

			// check item with same adons exist or not start

			let check = null;            

			$.each(cartArray, function(key, value) {				

				if (value.product == productArray.product) {
					if (JSON.stringify(value.size) == JSON.stringify(productArray.size)) {

						// if product size is same   
						check = key;
						return false;
					}

				} else {
					check = null;
				}
			});

			// if check is null then product is new other wise product exist in cart then go to else.
			if (check == null) {
				cartArray.push(productArray);                
				localStorage.setItem('cart', JSON.stringify(cartArray));
			} else {
				let value = cartArray[check];
				value.qty = parseFloat(value.qty) + parseFloat(productArray.qty);
				value.grep;               
				localStorage.setItem('cart', JSON.stringify(cartArray));
			}

			// check item with same adons exist or not end
		}

    $('#qty').val(1);
    $('#cart_qty').val(1);
    $('#product-detail-modal').modal('hide');     

    // calculate grand total
    let cartupdate = JSON.parse(localStorage.getItem('cart'));

    let grand_total = 0;

    $.each(cartupdate,function(h,k){
        grand_total = grand_total + (k.qty * k.price);
    });

$('#grand_total').html('₹ '+grand_total.toFixed(2)); 
$('#cart-total').html('₹ '+grand_total.toFixed(2)); 

    // set cart item count on page load START    

    if(cartupdate != null && cartupdate.length > 0) {
        $('#cart-item-number').css('display', 'block');
        $('#cart-item-number').html(cartupdate.length);
    } 

    // set cart item count on page load END    

 });
// add product in cart end 

//update qty STRAT
 
 $('body').on('click','#add',function(){  

     $(this).prev().val(+$(this).prev().val() + 1);

     var qty = $('#qty').val();     
               $('#cart_qty').val(qty); // update qty in hidden field
     var price = $('#cart_price').val();
         price = price * qty;          
         $('#product-price').html(price.toFixed(2));
         $('#cart_item_total').val(price.toFixed(2)); // update item total      
    
 });

 $('body').on('click','#sub',function(){ 
     
    if ($(this).next().val() > 1) {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
    }

    var qty = $('#qty').val();
              $('#cart_qty').val(qty); // update qty in hidden field
    var price = $('#cart_price').val();
        price = price * qty;
        $('#product-price').html(price.toFixed(2));
        $('#cart_item_total').val(price.toFixed(2)); // update item total
        
 });

// update weight base product qty in product popup START
$('body').on('keyup','.weightproduct',function(){
 
     var qty = $(this).val();
               $('#cart_qty').val(qty); // update qty in hidden field
     var price = $('#cart_price').val();0
         price = price * qty;
         $('#product-price').html(price.toFixed(2));
         $('#cart_item_total').val(price.toFixed(2)); // update item total
         
  });

// update weight base product qty in product popup END 

//update qty END


// show cart product list in cart icon START
 
 $('body').on('click','#cart-popup',function(){ 
  

    var cart = JSON.parse(localStorage.getItem('cart'));
    var cartDetail = '';

    if(cart != null && cart.length > 0){
        $.ajax({
        type: "POST",
        async: true,
        dataType: "json",
        url: "{{URL::to('cart-detail')}}",
        data: {
            _token: '{{ csrf_token() }}',
            cart: cart
        },
        success: function(response) {            
            
            $.each(response.data,function(j,v){

                cartDetail += '<div class="cart-box" id="cart_box_'+v.uniqueId+'">';
                cartDetail += '<div class="cart-img">';                
                cartDetail += '<div class="cartimg-inner"><img src="'+v.image+'" class="img-fluid" alt="+v.name+"></div>';
                cartDetail += '</div>';
                cartDetail += '<div class="cart-body">';
                cartDetail += '<h5>'+v.name+'</h5>';
                cartDetail += '<div class="v-chart"><p>SIZE: '+v.size+'</p></div>';               
                cartDetail += '<div class="q-trash">';
                cartDetail += '<div class="qty-box">';                   
                if(v.product_unit == 'qty'){
                 cartDetail += '<button type="button" data-unique="'+v.uniqueId+'" data-price="'+v.price+'" class="sub pop_sub">-</button>';
                 cartDetail += '<input type="text" id="pop_qty_'+v.uniqueId+'" value="'+v.qty+'" min="1" readonly/>';
                 cartDetail += '<button type="button" data-unique="'+v.uniqueId+'" data-price="'+v.price+'" class="add pop_add">+</button>';
                } else {
                 cartDetail += '<input type="text" class="weightinput" data-unique="'+v.uniqueId+'" data-price="'+v.price+'" id="pop_qty_'+v.uniqueId+'" value="'+v.qty+'" min="1"/>';    
                }
                
                cartDetail += '</div>';
                cartDetail += '<div class="edite-delete ms-3">';
                cartDetail += '<button class="btn delete_cart" data-unique="'+v.uniqueId+'"><i class="fal fa-trash-alt"></i></button>';
                cartDetail += '</div></div></div>';
                cartDetail += '<div class="price-box">';
                cartDetail += '<h4>₹ '+v.price+'</h4>';
                cartDetail += '<p class="text-right" id="product_total_'+v.uniqueId+'">₹ '+v.product_total.toFixed(2)+'</p>';
                cartDetail += '</div></div>';

            });

            $('#cart-content-popup').html(cartDetail);
            $('#cart-footer').show();

            // calculate grand total   
            if(response.cart_total){                    
                $('#grand_total').html('₹ '+response.cart_total.toFixed(2)); 
                $('#cart-total').html('₹ '+response.cart_total.toFixed(2));
            }
            
        },
        error: function() {
            console.log('something went wrong..!');
        }
    });

    } else {
        return false;
    }
      
    
 });

// show cart product list in cart icon END



// qty management in SHOPPING CART popup START

$('body').on('click','.pop_add',function(){   

    let uniqueId = $(this).data('unique');
    let price = $(this).data('price');
    let qty = $('#pop_qty_'+uniqueId).val();
    let new_qty = parseFloat(qty) + 1;
              $('#pop_qty_'+uniqueId).val(new_qty); 
    let product_subtotal =  parseFloat(new_qty) * price;

    //process to update cart localStorage START

    let cartupdate= JSON.parse(localStorage.getItem('cart'));
    
     $.each(cartupdate,function(h,k){

         if(k.uniqueId == uniqueId){
             k.qty = new_qty;
         }

     });     

    localStorage.setItem('cart', JSON.stringify(cartupdate));

    $('#product_total_'+uniqueId).html('₹'+product_subtotal.toFixed(2));

    cartupdate = JSON.parse(localStorage.getItem('cart'));  
    
    //process to update cart localStorage END   

    // process to update qty in database START

    let auth_check = "{{{ (Auth::user()) ? Auth::user()->id : 'empty' }}}";

    if(auth_check != 'empty'){
        $.ajax({
        type: "POST",
        async: true,
        dataType: "json",
        url: "{{URL::to('cart-qty-update')}}",
        data: {
            _token: '{{ csrf_token() }}',
            uniqueId: uniqueId,
            new_qty:new_qty
        },      
        success: function(response) {           
            
        },
        error: function() {
            console.log('something went wrong..!');
        }
    });
    }

    // process to update qty in database END

    // calculate grand total
    let grand_total = 0;
    $.each(cartupdate,function(h,k){
        grand_total = grand_total + (k.qty * k.price);
    });
    $('#grand_total').html('₹ '+grand_total.toFixed(2)); 
    $('#cart-total').html('₹ '+grand_total.toFixed(2));  


});

$('body').on('click','.pop_sub',function(){   

let uniqueId = $(this).data('unique');
let price = $(this).data('price');
let qty = $('#pop_qty_'+uniqueId).val();


//check minimum qty is one STRAT
 
  if(parseFloat(qty) - 1 < 1){
    swal("At leaset one quantity need in Cart");
    return false;
  }

//check minimum qty is one END   

let new_qty = parseFloat(qty) - 1;
          $('#pop_qty_'+uniqueId).val(new_qty);    

let product_subtotal =  parseFloat(new_qty) * price;

//process to update cart localStorage START
 
let cartupdate= JSON.parse(localStorage.getItem('cart'));

 $.each(cartupdate,function(h,k){

     if(k.uniqueId == uniqueId){
         k.qty = new_qty;
     }

 });

localStorage.setItem('cart', JSON.stringify(cartupdate));

$('#product_total_'+uniqueId).html('₹ '+product_subtotal.toFixed(2));

//process to update cart localStorage END 

// process to update qty in database START

let auth_check = "{{{ (Auth::user()) ? Auth::user()->id : 'empty' }}}";

if(auth_check != 'empty'){
    $.ajax({
    type: "POST",
    async: true,
    dataType: "json",
    url: "{{URL::to('cart-qty-update')}}",
    data: {
        _token: '{{ csrf_token() }}',
        uniqueId: uniqueId,
        new_qty:new_qty
    },      
    success: function(response) {           
        
    },
    error: function() {
        console.log('something went wrong..!');
    }
});
}

// process to update qty in database END


// calculate grand total
cartupdate= JSON.parse(localStorage.getItem('cart'));
let grand_total = 0;
    $.each(cartupdate,function(h,k){
        grand_total = grand_total + (k.qty * k.price);
    });
    $('#grand_total').html('₹ '+grand_total.toFixed(2));
    $('#cart-total').html('₹ '+grand_total.toFixed(2));  

});

// qty management in SHOPPING CART popup END

// change data of wight base product qty value START

$('body').on('keyup','.weightinput',function(){    
    
    let uniqueId = $(this).data('unique');
    let price = $(this).data('price');
    let qty = $(this).val(); 

    if(qty < 1){
        qty = 1;
    }
    
    let product_subtotal =  qty * price;

    //process to update cart localStorage START

    let cartupdate= JSON.parse(localStorage.getItem('cart'));
    
     $.each(cartupdate,function(h,k){

         if(k.uniqueId == uniqueId){
             k.qty = qty;
         }

     });     

    localStorage.setItem('cart', JSON.stringify(cartupdate));

    $('#product_total_'+uniqueId).html('₹'+product_subtotal.toFixed(2));

    cartupdate = JSON.parse(localStorage.getItem('cart'));  
    
    //process to update cart localStorage END   

    // process to update qty in database START

    let auth_check = "{{{ (Auth::user()) ? Auth::user()->id : 'empty' }}}";

    if(auth_check != 'empty'){
        $.ajax({
        type: "POST",
        async: true,
        dataType: "json",
        url: "{{URL::to('cart-qty-update')}}",
        data: {
            _token: '{{ csrf_token() }}',
            uniqueId: uniqueId,
            new_qty:qty
        },      
        success: function(response) {           
            
        },
        error: function() {
            console.log('something went wrong..!');
        }
    });
    }

    // process to update qty in database END

    // calculate grand total
    let grand_total = 0;
    $.each(cartupdate,function(h,k){
        grand_total = grand_total + (k.qty * k.price);
    });
    $('#grand_total').html('₹ '+grand_total.toFixed(2)); 
    $('#cart-total').html('₹ '+grand_total.toFixed(2));     

});

// change data of wight base product qty value END

// check qty is greter then 0 in weight base product START
$('body').on('change','.weightinput',function(){    
    
    let uniqueId = $(this).data('unique');
    let price = $(this).data('price');
    let qty = $(this).val();   

    if(qty == 0){
        qty = 1;
    }
    
    let product_subtotal =  qty * price;

    //process to update cart localStorage START

    let cartupdate= JSON.parse(localStorage.getItem('cart'));
    
     $.each(cartupdate,function(h,k){

         if(k.uniqueId == uniqueId){
             k.qty = qty;
         }

     });     

    localStorage.setItem('cart', JSON.stringify(cartupdate));

    $('#product_total_'+uniqueId).html('₹'+product_subtotal.toFixed(2));

    cartupdate = JSON.parse(localStorage.getItem('cart'));  
    
    //process to update cart localStorage END   

    // process to update qty in database START

    let auth_check = "{{{ (Auth::user()) ? Auth::user()->id : 'empty' }}}";

    if(auth_check != 'empty'){
        $.ajax({
        type: "POST",
        async: true,
        dataType: "json",
        url: "{{URL::to('cart-qty-update')}}",
        data: {
            _token: '{{ csrf_token() }}',
            uniqueId: uniqueId,
            new_qty:qty
        },      
        success: function(response) {           
            
        },
        error: function() {
            console.log('something went wrong..!');
        }
    });
    }

    // process to update qty in database END

    // calculate grand total
    let grand_total = 0;
    $.each(cartupdate,function(h,k){
        grand_total = grand_total + (k.qty * k.price);
    });
    $('#grand_total').html('₹ '+grand_total.toFixed(2)); 
    $('#cart-total').html('₹ '+grand_total.toFixed(2));
    $(this).val(qty);  

});
// check qty is greter then 0 in weight base product END

// delete product from cart START

$('body').on('click','.delete_cart',function(){

    var  uniqueId = $(this).data('unique');   

    let cartupdate= JSON.parse(localStorage.getItem('cart'));

    if(cartupdate != null && cartupdate.length > 0) {

        $.each(cartupdate,function(h,k){        

        if(k.uniqueId == uniqueId){                    
            keyValue = h;
        }
        });

        cartupdate.splice(keyValue,1);  
    } 

    // delete if Auth Exists and product exists in cart table START

    var auth_check = "{{{ (Auth::user()) ? Auth::user() : 'empty' }}}";

    if(auth_check != 'empty'){

        $.ajax({
        type: "POST",
        async: true,
        dataType: "json",
        url: "{{URL::to('delete-cart-product')}}",
        data: {
            _token: '{{ csrf_token() }}',
            uniqueId: uniqueId
        },      
        success: function(response) { 

            // calculate grand total           
            $('#grand_total').html('₹ '+response.cart_total.toFixed(2)); 
            $('#cart-total').html('₹ '+response.cart_total.toFixed(2));
            
        },
        error: function() {
            console.log('something went wrong..!');
        }
    });

    }

    // delete if Auth Exists and product exists in cart table END

localStorage.setItem('cart', JSON.stringify(cartupdate));

$('#cart_box_'+uniqueId).hide();

// calculate grand total
cartupdate= JSON.parse(localStorage.getItem('cart'));
let grand_total = 0;

$.each(cartupdate,function(h,k){
    grand_total = grand_total + (k.qty * k.price);
});

$('#grand_total').html('₹ '+grand_total.toFixed(2)); 
$('#cart-total').html('₹ '+grand_total.toFixed(2));

// set cart item count on page load START 

var cartcount = JSON.parse(localStorage.getItem('cart'));

    if(cartcount != null && cartcount.length > 0) {
        $('#cart-item-number').css('display', 'block');
        $('#cart-item-number').html(cartcount.length);
        $('#cart-footer').show();
    } else {
        $('#cart-item-number').css('display','none');       
        $('#cart-content-popup').html('No Product Found in cart');
        $('#cart-footer').hide();
    }

// set cart item count on page load END 

});

// delete product from cart END

// set selected size price in subtotal START

$('body').on('change','#product-size',function(){    
    let option = $(this).find(':selected').val();
    if(option !== ''){
        $('#add,#sub,#qty').prop('disabled',false);
    } else {
        $('#add,#sub,#qty').prop('disabled',false);
    }
    $('#cart_price').val($(this).find(':selected').attr('data-sizeprice'));

});
// set selected size price in subtotal END

// ===================  CART END ====================================  //

// SEARCH functionality START

$('body').on('keyup','#searchBar',function(){

    var string = $(this).val();

    if(string.length > 3){

        // AJAX FOR GET LIST OF PRODUCT STRAT

        $.ajax({
            type: "POST",
            async: true,
            dataType: "json",
            url: "{{URL::to('product-search')}}",
            data: {
                _token: '{{ csrf_token() }}',
                string: string
            },      
            success: function(response) { 

                var options = '';               

               if(response.data.length > 0){                    
                   $.each(response.data,function(s,r){
                    options += '<li data-option="'+r.name+'" class="click-option">'+r.name+'</li>';
                   });
                    
               } else {
                   options += '<li>No Product Found</li>';
               }
               
                $('#search_ul').html(options);
            },
            error: function() {  
                console.log('something went wrong..!');
            }
        });

        // AJAX FOR GET LIST OF PRODUCT END
    }
    
});

$('body').on('click','.click-option',function(){ 
    $('#searchBar').val($(this).data('option'));
    localStorage.setItem('search','');
    localStorage.setItem('search',$(this).data('option'));

    $('#search_ul').hide();
});


$(document).on('click','#search-submit',function(e){
    e.preventDefault();

    let string = $('#searchBar').val();

    if(string != '' && string.length > 3){
        $("#searchForm").submit();
    } else {
        return false;
    }
});

// SEARCH functionality END

// Size wise chart image get STRAT

$('body').on('change','.selectedsizeoption',function(){
    
    let productunit = $(this).find(':selected').data('productunit');
    if(productunit == 'weight'){
        let chart = $(this).find(':selected').data('chart');
        $('#chartimg').attr("src"," "); 
        $('#chartimg').attr("src",chart); 
        $('#product-price').html($(this).find(':selected').data('sizeprice').toFixed(2));
        $('#sizechartmodal').modal('show');
    } 
});

// Size wise chart image get END

// allow only number START

$("body").on("input", "#qty,.weightinput", function (evt) {
    var self = $(this);    
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
        evt.preventDefault();
    }
});

// allow only number END

</script>
     
</body>

</html>
