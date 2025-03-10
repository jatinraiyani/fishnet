$('.add').click(function() {
    
    if ($(this).prev().val() < 10) {
        $(this).prev().val(+$(this).prev().val() + 1);
    }
});
$('.sub').click(function() {
    if ($(this).next().val() > 1) {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
    }
});
$(document).ready(function() {
    $(".cart-page").click(function() {
        $('body').toggleClass('show-cart');
    });
   
    $(".close-cartbody").click(function() {
        $('body').removeClass('show-cart');
    });
    $(".close-cart").click(function() {
        $('body').toggleClass('show-cart');
    });
    $('#toggle-search').on('click', function() {
        $('#searchBar').toggle('display: inline-block');
    });
});
$(function() {
    var activeEl = $(this),
        showEl = $(this).attr("data-show-id");

    $('.box-white').on('click', '.go-continue', function(e) {
        e.preventDefault();

        var activeEl = $(this).closest('.box-white'),
            showNext = $(this).attr("data-show-id");

        console.log('#' + showNext);
        activeEl.fadeTo(400, 0, function() {
            activeEl.hide();
            $('#' + showNext).fadeTo(400, 1);
        });
    });
});


$('.about-carousel').owlCarousel({
        loop: true,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: true,
                margin: 10,
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    })
    $('.banner-owl').owlCarousel({
        loop:true,
        nav:true,
        loop: true,
        dots:false,
        items:1,
    })
    $('.offer-carousel').owlCarousel({
        loop:true,
        nav:false,
        autoplay:true,
autoplayTimeout:5000,
        loop: true,
        margin:0,
        dots:false,
        items:1,
       
    })
    
    // $('.product-owl').owlCarousel({
    //     loop:true,
    //     nav:false,
    //     dots:true,
    //     loop: true,
    //     items:1,
  
  
    // })
    /* menu-icon js */
$(".navbar-toggler").click(function() {
    $('html').toggleClass('show-menu');
});

document.querySelectorAll('.menu').forEach(btn => {
    btn.addEventListener('click', e => {
        btn.classList.toggle('active');
    });
});

