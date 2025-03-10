<header>
    <nav class="navbar navbar-expand-lg header-nav  fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ URL::to('/') }}"> <img
                    src="{{ asset('public/front/images/header-logo.png') }}" class="navbar-brand"
                    alt=""></a>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
          <div id="google_translate_element"></div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= (Request::is('/')) ? 'active' : ''?>" aria-current="page"
                            href="{{ URL::to('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (Request::is('aboutus')) ? 'active' : ''?>" href="{{ URL::to('aboutus') }}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (Request::is('select-product')) ? 'active' : ''?>" href="{{ URL::to('select-product') }}">Our
                            Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (Request::is('contactus')) ? 'active' : ''?>" href="{{ URL::to('contactus') }}" tabindex="-1"
                            aria-disabled="true">Contact us</a>
                    </li>                    
                </ul>                
            </div>
            <div class="right-menu">
                <ul class="right-nav">

                <li>
                    <form class="navbar-search" id="searchForm" method="GET" action="{{ URL::to('search-result') }}">
                        @csrf
                     <input type="text" name="search" class="form-control" placeholder="Search for..." id="searchBar">                    
                     <button type="submit" id="search-submit"><i id='toggle-search' class="fa fa-search fa-search"></i></button>
                    </form> 
                    <ul id="search_ul"></ul>
                </li>
                    <!-- <li class="nav-item dropdown dropdown-contry">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('public/front/images/icons-india.svg') }}" alt="">
                </a>
                <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#"><img src="{{ asset('public/front/images/icons-india.svg') }}" alt=""> </a></li>
                  <li><a class="dropdown-item" href="#"><img src="{{ asset('public/front/images/icons-india.svg') }}" alt=""></a></li>
                  
                </ul>
              </li> -->
                    <li id="cart-popup"><a class="cart-page" alt=""><img
                                src="{{ asset('public/front/images/shoppingbag.png') }}"
                                alt=""></a><span id="cart-item-number"></span></li>
                    <li class="nav-item">
                        @if(Auth::check())
                            <a href="{{ URL::to('profile') }}">
                                <img src="{{ asset('public/front/images/user.svg') }}" alt="">
                            </a>
                        @else
                            <a href="{{ URL::to('signin') }}">
                                <img src="{{ asset('public/front/images/user.svg') }}" alt="">
                            </a>
                        @endif
                    </li>

                </ul>
            </div>
            <button class="navbar-toggler menu toggler ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <svg viewBox="0 0 64 48">
                    <path d="M19,15 L45,15 C70,15 58,-2 49.0177126,7 L19,37"></path>
                    <path d="M19,24 L45,24 C61.2371586,24 57,49 41,33 L32,24"></path>
                    <path d="M45,33 L19,33 C-8,33 6,-2 22,14 L45,37"></path>
                </svg>
            </button>
        </div>
    </nav>    
    {{-- cart popup start --}}
    <span class="close-cartbody"></span>
    <aside id="shopping-cart">
        <button type="button" class="btn-close close-cart" aria-label="Close"></button>
        <div class="cart-header">
            <h4>SHOPPING CART</h4>

        </div>

        <div class="cart-content" id="cart-content-popup">
            
        </div>
        <div class="cart-footer" id="cart-footer">
            <div class="row">
                    <div class="col">
                        <h4>Subtotal</h4>
                        </div>
                        <div class="col text-end">
                        <span id="grand_total"><span>
                    </div>
            </div>            
            <hr>
            <div class="row">
                    <div class="col">
                        <h3>Total</h3>
                        </div>
                        <div class="col text-end">
                            <h4 id="cart-total"></h4>
                    </div>
            </div>
            <div class="row">
                    <div class="col">
                @if(Auth::check())        
                  <a href="{{ URL::to('checkout') }}" class="secondary-button w-100">Checkout</a>
                @else
                  <a href="{{ URL::to('signin') }}" class="secondary-button w-100">Checkout</a>
                @endif    
                     </div>
            </div>
        </div>        
    </aside>
    {{-- cart popup end --}}
</header>
<div class="call-whatapp">
    <a class="whatapp" href="https://api.whatsapp.com/send/?phone=+91 7046425050&text=I+have+a+query+regarding+Fishingnet+and+Products+&app_absent=0" target="_black"> <i class="fab fa-whatsapp"></i></a>
    <a href="tel:+91 7046425050" class="call-btn"><i class="fas fa-phone-alt"></i></a>
</div>

