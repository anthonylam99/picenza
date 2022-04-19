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
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
    listDots[slideIndex-1].className += ' slideractive';
}
