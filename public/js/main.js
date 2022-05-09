$('.color-options:nth-child(1)').addClass('active')

function changeColor(id, color_id, color, productId, pricent) {
    console.log(id);
    $('#color-selected').val(color_id)
    $('.color-option .color').html('<text class="color">' + color + '</text>')

    $('.color-options').removeClass('active')
    $('.color-options:nth-child(' + id + ')').addClass("active")

    var price = new Intl.NumberFormat('vi-VN', {style: 'currency', currency: 'VND'}).format(pricent)
    $('#bind-price').html(price);
    $('#hidden-price').val(pricent);

    var list = $(".image-product").map(function () {
        return $(this).hide();
    }).get();
    $('.image-product:nth-child(' + id + ')').show()
    // $.ajax({
    //     url: '/get-image-from-color-and-product-id',
    //     type: 'GET',
    //     data: {
    //         color_id: id,
    //         product_id: productId,
    //     },
    //     //Ajax events
    //     success: function (response) {
    //         var img = `<img src="${response.url}" >`;
    //
    //         var price = new Intl.NumberFormat('vi-VN', {style: 'currency', currency: 'VND'}).format(response.price)
    //         $('#img-product-color').html(img);
    //         $('#bind-price').html(price);
    //         $('#hidden-price').val(response.price);
    //     }
    // })
}

function addParamCategory() {
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
    let listContent = document.getElementsByClassName("content-sl-main")

    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < listContent.length; i++) {
        listContent[i].style.display = "none";
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

    if (slides.length > 0) {
        slides[slideIndex - 1].style.display = "block";
    }
    if (listContent.length > 0) {
        listContent[slideIndex - 1].style.display = "block";
    }
    if (dots.length > 0) {
        dots[slideIndex - 1].className += " active";
    }
    // captionText.innerHTML = dots[slideIndex-1].alt;
    if (listDots.length > 0) {
        listDots[slideIndex - 1].className += ' slideractive';
    }
}

$('.dropdown-menu a.dropdown-item').on('click', function (e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    var $subMenu = $(this).next(".dropdown-menu");

    $subMenu.toggleClass('show');
    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
        $('.dropdown-submenu .show').removeClass("show");
    });
    return false;
});
$(document).ready(function () {
    $('.owl-carousel.brands').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false,
                dots: true
            },
            600: {
                items: 3,
                nav: false,
                dots: true
            },
            1000: {
                items: 5,
                nav: false,
                loop: false,
                dots: true
            }
        }
    });

    $('.owl-carousel.subcate').owlCarousel({
        loop: true,
        items: 3
    })

    $('.owl-carousel.bestseller').owlCarousel({
        loop: true,
        items: 3
    })

    $('.owl-carousel.options3').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                dots: true
            },
            600: {
                items: 2,
                nav: false,
                dots: true
            },
            1000: {
                items: 3,
                nav: false,
                loop: false,
                dots: true
            }
        }
    })

    $('.owl-carousel.category').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false,
                dots: true
            },
            600: {
                items: 4,
                nav: false,
                dots: true
            },
            1000: {
                items: 6,
                nav: false,
                loop: false,
                dots: true
            }
        }
    })
    $('.owl-carousel.product-relate').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false,
                dots: true
            },
            600: {
                items: 4,
                nav: false,
                dots: true
            },
            1000: {
                items: 6,
                nav: false,
                loop: false,
                dots: true
            }
        }
    })
    $('.owl-carousel.product-recent').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false,
                dots: true
            },
            600: {
                items: 4,
                nav: false,
                dots: true
            },
            1000: {
                items: 6,
                nav: false,
                loop: false,
                dots: true
            }
        }
    })
    $('.owl-carousel.banner').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                dots: true
            },
            600: {
                items: 1,
                nav: false,
                dots: true
            },
            1000: {
                items: 1,
                nav: false,
                loop: false,
                dots: true
            }
        }
    })
});


$(function () {
    $("body").click(function(){
        $("#search-auto").hide()
    })
    $('#kwdCompare').click(function(){
        $(this).show()
    })
    $('#kwdCompare').on('input', function () {
        var query = $(this).val()

        $.ajax({
            type: 'GET',
            url: '/search-product',
            data: {
                query: query
            },
            success: function (res) {
                var html = ''

                res.forEach(function (item) {
                    $("#search-auto").show()
                    var currentUrl = window.location.href + '&product[]=' + item.id
                    html += "<div class='search-item' onclick='location.href="+'"'+currentUrl+'"'+"'>" +
                                "<div class='img'>" +
                                    "<img src='"+item.avatar_path+"'>" +
                                "</div>"+
                                    "<div class='info'>"+
                                        "<h2>" +
                                            "<a href='"+currentUrl+"'>" +
                                                item.name +
                                            "</a>" +
                                        "</h2>"+
                                                "<h3>"+
                                                    "<strike>"+"</strike>"+
                                                        parseInt(item.price).toLocaleString('en-US') + "VNĐ" +
                                                "</h3>" +
                                    "</div>"+
                            "<div>"
                })
                $('#autocomplete-suggestion').html(html)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
})
$('#kwdCompare').autocomplete({
    serviceUrl: '/search-product',
    transformResult : function(response) {
        return {
            // must convert json to javascript object before process
            suggestions : $.map($.parseJSON(response), function(item) {
                return item
            })
        };
    },
    formatResult: function (suggestion){
        return autoComplateFormat(suggestion)
    },
    onSelect: function (suggestion) {
        $('#kwdCompare').html(suggestion.name);
    }

})
function autoComplateFormat(n) {
    var url = window.location.href + '&product[]=' + n.id
    if(n.avatar_path === null){
        n.avatar_path ='/images/no-image.jpg'
    }

    var t = '<div class="search-item" onclick="location.href=\'' + url + "'\">";
    return t += '<div class="img"><img src="' + n.avatar_path + '" /><\/a><\/div>', t += '   <div class="info">', t += '       <h2><a href="' + url + '">' + n.name + "<\/a><\/h2>", t += "       <h3><strike>" + "<\/strike> " + n.price + "<\/h3>", t += "   <\/div>", t += "<\/div>", t + "<\/div>"
}
