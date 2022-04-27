$(function () {
    var i = 0;
    var list = $(".img-box").map(function () {
        return $(this).attr("data-photo");
    }).get();
    if (list.length > 0) {
        i = list.splice(-1)[0]
    }

    $("#btn-add").click(function () {
        i++;
        $(".body-card-image").append("" +
            "<div class='col-3 img-box' id='label-image" + i + "' data-photo='" + i + "'>" +
            "<div style='height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;' id='image-preview" + i + "' class='show-img'>" +
            "</div>" +
            "<label for='color-choose" + i + "'>Màu sắc:</label>" +
            "                        <input onchange='setColor(" + i + ")' type='color' id='color-picker" + i + "'>" +
            "                        <input type='hidden' id='color-choose" + i + "' name='hex" + i + "' value='#000000'>" +
            "<input class='form-control' type='text' name='color" + i + "' value='' placeholder='Nhập tên màu....' required/>" +
            "<label for='image-input" + i + "' class='image-upload'>" +
            "<i class='fas fa-upload'></i>Chọn ảnh" +
            "</label>" +
            "<input style='display: none' onchange='previewImage(" + i + ")'  id='image-input" + i + "' type='file' name='image" + i + "' data-photo='" + i + "'> " +
            "<button type='button' class='btn-danger btn-deleteimg' onclick='removeImage(" + i + ")'>Xóa ảnh</button>" +
            "</div>");
    })
})

function addImageBox(tag) {
    var i = 0;
    var list = $(".img-box" + tag).map(function () {
        return $(this).attr("data-photo");
    }).get();
    if (list.length > 0) {
        i = list.splice(-1)[0]
    }

    i++;


    if (tag === 'discovery') {
        $(".body-card-image" + tag).append("" +
            "<div class='col-3 img-box" + tag + "' id='label-image" + tag + i + "' data-photo='" + i + "'>" +
            "<div style='height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;' id='image-preview" + tag + i + "' class='show-img'>" +
            "</div>" +

            "<label for='image-input" + tag + i + "' class='image-upload'>" +
            "<i class='fas fa-upload'></i>Chọn ảnh" +
            "</label>" +
            "<input style='margin-bottom: 3px' class='form-control' type='text' name='title" + tag + i + "' value='' placeholder='Nhập tiêu đề..' />" +
            "<input style='margin-bottom: 3px' class='form-control' type='text' name='url" + tag + i + "' value='' placeholder='Nhập đường dẫn bài viết..' />" +
            "<input style='margin-bottom: 3px' class='form-control' type='text' name='content" + tag + i + "' value='' placeholder='Nhập nội dung mô tả..' />" +
            "<input style='display: none' onchange='previewImageCustom(" + i + ", " + ' "' + tag + '" ' + ")'  id='image-input" + tag + i + "' type='file' name='image" + tag + i + "' data-photo='" + i + "'> " +
            "<button type='button' class='btn-danger btn-deleteimg' onclick='removeImage(" + i + ", " + ' "' + tag + '" ' + ")'>Xóa ảnh</button>" +
            "</div>");
    } else {
        $(".body-card-image" + tag).append("" +
            "<div class='col-3 img-box" + tag + "' id='label-image" + tag + i + "' data-photo='" + i + "'>" +
            "<div style='height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;' id='image-preview" + tag + i + "' class='show-img'>" +
            "</div>" +

            "<label for='image-input" + tag + i + "' class='image-upload'>" +
            "<i class='fas fa-upload'></i>Chọn ảnh" +
            "</label>" +
            "<input style='display: none' onchange='previewImageCustom(" + i + ", " + ' "' + tag + '" ' + ")'  id='image-input" + tag + i + "' type='file' name='image" + tag + i + "' data-photo='" + i + "'> " +
            "<button type='button' class='btn-danger btn-deleteimg' onclick='removeImage(" + i + ", " + ' "' + tag + '" ' + ")'>Xóa ảnh</button>" +
            "</div>");
    }
}

function previewImageCustom(index, tag) {
    var imageInput = document.getElementById('image-input' + tag + index)
    var quantos = imageInput.files.length;
    for (i = 0; i < quantos; i++) {
        var urls = URL.createObjectURL(event.target.files[i]);
        document.getElementById("image-preview" + tag + index).innerHTML = '<img src="' + urls + '">';
    }
}
function removeImageCustom(index, tag, value) {
    var imageInput = document.getElementById('label-image'+tag + index)
    imageInput.remove()

    $('#card-image'+tag).append("<input type='hidden' name='del-image"+tag + index + "' value='" + value + "' />");
}


function previewImage(index) {
    var imageInput = document.getElementById('image-input' + index)
    var quantos = imageInput.files.length;
    for (i = 0; i < quantos; i++) {
        var urls = URL.createObjectURL(event.target.files[i]);
        document.getElementById("image-preview" + index).innerHTML = '<img src="' + urls + '">';
    }
}

function removeImage(index, value) {
    var imageInput = document.getElementById('label-image' + index)
    imageInput.remove()

    $('#card-image').append("<input type='hidden' name='del-image" + index + "' value='" + value + "' />");

}

function setColor(index) {
    var colorPicker = document.getElementById('color-picker' + index)
    var color = colorPicker.value
    var colorInput = document.getElementById("color-choose" + index)
    colorInput.setAttribute('value', color)
}

$('#productPrice').on('input', function () {
    const price = $(this).val().replace(/[,]+/g, "");
    const format = parseInt(price).toLocaleString('en-US')

    $("#salePrice").val(0)
    $("#pricePercent").val(0)
    $(this).val(format)
})
$('#salePrice').on('input', function () {
    const price = $("#productPrice").val().replace(/[,]+/g, "")
    const salePrice = $(this).val().replace(/[,]+/g, "");

    if (salePrice > 0) {
        console.log(salePrice)
        console.log(parseInt(price))
        if (salePrice > parseInt(price)) {
            alert('Giá giảm giá lớn hơn giá gốc. Vui lòng kiểm tra lại')
        }
        const format = parseInt(salePrice).toLocaleString('en-US')
        $(this).val(format)
        const pricePercent = 100 - Math.round(salePrice / price * 100)
        console.log(pricePercent)
        $("#pricePercent").val(pricePercent)
    }
})
$('#pricePercent').on('input', function () {
    let pricePercent = $(this).val()
    if (pricePercent >= 100) {
        $(this).val(100)
        pricePercent = 100
    }
    if (pricePercent <= 0) {
        $(this).val(0)
        pricePercent = 0
    }
    if (pricePercent > 0) {
        const price = $("#productPrice").val().replace(/[,]+/g, "");

        const salePrice = price - Math.round(price * pricePercent / 100)
        const format = parseInt(salePrice).toLocaleString('en-US')
        $("#salePrice").val(format)
    }

})


$(function () {
    $("#companyList").change(function () {
        var id = $(this).val()
        $.ajax({
            type: 'GET',
            url: '/quan-tri/product_line_list/' + id,
            success: function (result) {
                var productLineList = $("#productLineList")

                var html = '';
                result.forEach(function (item) {
                    html += "<option value='" + item.id + "'> " + item.name + " "
                })
                productLineList.html(html)
                getProductType()
                console.log(result)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
})

function getProductType() {
    var productLineList = $("#productLineList").val()
    var companyId = $('#companyList').val()

    $.ajax({
        type: 'GET',
        url: '/quan-tri/product_type_list/' + companyId + '/' + productLineList,
        success: function (result) {
            var productTypeList = $("#productTypeList")

            var html = '';
            result.forEach(function (item) {
                html += "<option value='" + item.id + "'> " + item.name + " "
            })
            productTypeList.html(html)

            console.log(result)
        },
        error: function (err) {
            console.log(err)
        }
    })
}


$(function () {
    $("#productLineList").change(function () {
        var companyId = $('#companyList').val()
        var productTypeId = $(this).val()

        $.ajax({
            type: 'GET',
            url: '/quan-tri/product_type_list/' + companyId + '/' + productTypeId,
            success: function (result) {
                var productTypeList = $("#productTypeList")

                var html = '';
                result.forEach(function (item) {
                    html += "<option value='" + item.id + "'> " + item.name + " "
                })
                productTypeList.html(html)

                console.log(result)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
})
