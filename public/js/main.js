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
