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
            "<img id='image-preview-src" + i + "' >" +
            "</div>" +
            "<label for='color-choose" + i + "'>Màu sắc:</label>" +
            "                        <input onchange='setColor(" + i + ")' type='color' id='color-picker" + i + "'>" +
            "                        <input type='hidden' id='color-choose" + i + "' name='hex" + i + "' value='#000000'>" +
            "<input class='form-control' type='text' name='price" + i + "' value='' placeholder='Nhập giá cả....' required/>" +
            "<input class='form-control' type='text' name='color" + i + "' value='' placeholder='Nhập tên màu....' required/>" +
            "<label for='image-input" + i + "' class='image-upload'>" +
            "<i class='fas fa-upload'></i>Chọn ảnh" +
            "</label>" +
            "<input style='display: none' onclick='selectImageGalery(" + i + ")'  id='image-input" + i + "' type='text' name='image" + i + "' data-photo='" + i + "' value=''> " +
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
    var imageInput = document.getElementById('label-image' + tag + index)
    imageInput.remove()

    $('#card-image' + tag).append("<input type='hidden' name='del-image" + tag + index + "' value='" + value + "' />");
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


                if (result.length === 0) {
                    html = "<option value=''> -- Vui lòng chọn --- "
                }
                productLineList.html(html)
                getProductType()
                getProductFeature()
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

function getProductFeature() {
    var productTypeId = $('#productTypeList').val()

    $.ajax({
        type: 'GET',
        url: '/quan-tri/product_feature_list/' + productTypeId,
        success: function (result) {
            var productFeature = $("#productFeature")

            var html = '';
            result.forEach(function (item) {
                html += '<div class="custom-control custom-checkbox col-4">\n' +
                    '                                    <input name="feature[]" class="custom-control-input" type="checkbox" id="customCheckbox' + item.id + '" value="' + item.id + '">\n' +
                    '                                    <label for="customCheckbox' + item.id + '" class="custom-control-label">' + item.name + '</label>\n' +
                    '                                </div>'
            })
            productFeature.html(html)
            if (result.length === 0) {
                productFeature.html("<input type='hidden' name='feature[]' value=''>")
                alert('Chưa có tính năng')
            }

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
                productLineList.html(html)
                if (result.length === 0) {
                    productTypeList.html("<option value=''> -- Vui lòng chọn --- ")
                }

                console.log(result)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
})

$(function () {
    $("#productTypeList").change(function () {
        var productTypeId = $(this).val()

        $.ajax({
            type: 'GET',
            url: '/quan-tri/product_feature_list/' + productTypeId,
            success: function (result) {
                var productFeature = $("#productFeature")

                var html = '';
                result.forEach(function (item) {
                    html += '<div class="custom-control custom-checkbox col-4">\n' +
                        '                                    <input name="feature[]" class="custom-control-input" type="checkbox" id="customCheckbox' + item.id + '" value="' + item.id + '">\n' +
                        '                                    <label for="customCheckbox' + item.id + '" class="custom-control-label">' + item.name + '</label>\n' +
                        '                                </div>'
                })
                productLineList.html(html)
                if (result.length === 0) {
                    productTypeList.html("<option value=''> -- Vui lòng chọn --- ")
                }

                console.log(result)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
})


//Choose Image Galery
var button1 = document.getElementById('ckfinder-popup-1');
button1.onclick = function () {
    selectFileWithCKFinder('img-avatar');
};

function selectFileWithCKFinder(elementId) {
    CKFinder.popup({
        chooseFiles: true,
        width: 1200,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                var output = document.getElementById(elementId);
                // output.value = file.getUrl();
                $('#img-avatar').attr('src', file.getUrl());
                $('#img_avatar_path').val(file.getUrl());
            });

            finder.on('file:choose:resizedImage', function (evt) {
                var output = document.getElementById(elementId);
                output.value = evt.data.resizedUrl;
            });
        }
    });
}

function selectImageGalery(id) {
    CKFinder.popup({
        chooseFiles: true,
        width: 1200,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // output.value = file.getUrl();
                $('#image-preview-src' + id).attr('src', file.getUrl());
                $('#image-input' + id).val(file.getUrl());
                console.log($('#image-input' + id).val())
            });

            finder.on('file:choose:resizedImage', function (evt) {
                var output = document.getElementById(elementId);
                output.value = evt.data.resizedUrl;
            });
        }
    });
}


//POST SEO
$('#news_title').on('input', function (){
    var seo_title = $(this).val()

    $('.preview_snippet_title').html(seo_title)
})
$('#news_description').on('input', function(){
    var seo_description = $(this).val()

    $('.preview_snippet_des').html(seo_description)
})

$(function(){
    $('#seo-url').on('input', function (){
        var repalce = $(this).val();
        var url = $('#url_seo').val();

        var seo_url = $('.preview_snippet_link').html(url+repalce)

    })

})
