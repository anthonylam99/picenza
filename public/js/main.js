$('.color-options:nth-child(1)').addClass('active')
function changeColor(id, color) {
    console.log(id)
    $('#color-selected').val(id)
    $('.color-option .color').html('<text class="color">' + color + '</text>')

    $('.color-options').removeClass('active')
    $('.color-options:nth-child(' + id + ')').addClass("active")

}

function addParamCategory(){
    const url = window.location.href

    console.log(url)
}

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    let listDots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    for (i = 0; i < listDots.length; i++) {
        listDots[i].className = listDots[i].className.replace(" slideractive", "");
    }
    // slides[slideIndex-1].style.display = "block";
    // dots[slideIndex-1].className += " active";
    // captionText.innerHTML = dots[slideIndex-1].alt;
    // listDots[slideIndex-1].className += ' slideractive';

    if(slides.length > 0){
        slides[slideIndex-1].style.display = "block";
    }
    if(dots.length > 0){
        dots[slideIndex-1].className += " active";
    }
    // captionText.innerHTML = dots[slideIndex-1].alt;
    if(listDots.length > 0){
        listDots[slideIndex-1].className += ' slideractive';
    }
}
$('.dropdown-menu a.dropdown-item').on('click', function(e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    var $subMenu = $(this).next(".dropdown-menu");

    $subMenu.toggleClass('show');
    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass("show");
    });
    return false;
});
$(document).ready(function(){
    $('.owl-carousel.brands').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:false,
                dots: true
            },
            600:{
                items:3,
                nav:false,
                dots: true
            },
            1000:{
                items:5,
                nav:false,
                loop:false,
                dots: true
            }
        }
    })

    $('.owl-carousel.options3').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false,
                dots: true
            },
            600:{
                items:2,
                nav:false,
                dots: true
            },
            1000:{
                items:3,
                nav:false,
                loop:false,
                dots: true
            }
        }
    })

    $('.owl-carousel.category').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:false,
                dots: true
            },
            600:{
                items:4,
                nav:false,
                dots: true
            },
            1000:{
                items:6,
                nav:false,
                loop:false,
                dots: true
            }
        }
    })
    $('.owl-carousel.product-relate').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:false,
                dots: true
            },
            600:{
                items:4,
                nav:false,
                dots: true
            },
            1000:{
                items:6,
                nav:false,
                loop:false,
                dots: true
            }
        }
    })
    $('.owl-carousel.product-recent').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:false,
                dots: true
            },
            600:{
                items:4,
                nav:false,
                dots: true
            },
            1000:{
                items:6,
                nav:false,
                loop:false,
                dots: true
            }
        }
    })
});
