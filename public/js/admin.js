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
            "<img id='image-preview-src" + tag + i + "' >" +
            "</div>" +

            "<label for='image-input" + tag + i + "' class='image-upload'>" +
            "<i class='fas fa-upload'></i>Chọn ảnh" +
            "</label>" +
            "<input style='margin-bottom: 3px' class='form-control' type='text' name='title" + tag + i + "' value='' placeholder='Nhập tiêu đề..' />" +
            "<input style='margin-bottom: 3px' class='form-control' type='text' name='url" + tag + i + "' value='' placeholder='Nhập đường dẫn bài viết..' />" +
            "<input style='margin-bottom: 3px' class='form-control' type='text' name='content" + tag + i + "' value='' placeholder='Nhập nội dung mô tả..' />" +
            "<input style='display: none' onclick='selectImageGaleryCustom(" + i + ", " + ' "' + tag + '" ' + ")'  id='image-input" + tag + i + "' type='text' name='image" + tag + i + "' data-photo='" + i + "'> " +
            "<button type='button' class='btn-danger btn-deleteimg' onclick='removeImage(" + i + ", " + ' "' + tag + '" ' + ")'>Xóa ảnh</button>" +
            "</div>");
    } else {
        $(".body-card-image" + tag).append("" +
            "<div class='col-3 img-box" + tag + "' id='label-image" + tag + i + "' data-photo='" + i + "'>" +
            "<div style='height: 100px; border: 2px dashed #cccccc; margin-bottom: 10px;' id='image-preview" + tag + i + "' class='show-img'>" +
            "<img id='image-preview-src" + tag + i + "' >" +
            "</div>" +

            "<label for='image-input" + tag + i + "' class='image-upload'>" +
            "<i class='fas fa-upload'></i>Chọn ảnh" +
            "</label>" +
            "<input style='display: none' onclick='selectImageGaleryCustom(" + i + ", " + ' "' + tag + '" ' + ")'  id='image-input" + tag + i + "' type='text' name='image" + tag + i + "' data-photo='" + i + "'> " +
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

$('#minPrice').on('input', function () {
    const price = $(this).val().replace(/[,]+/g, "");
    const format = parseInt(price).toLocaleString('en-US')

    $(this).val(format)
})

$('#maxPrice').on('input', function () {
    const price = $(this).val().replace(/[,]+/g, "");
    const format = parseInt(price).toLocaleString('en-US')

    $(this).val(format)
})


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

//GET FEATURE PRODUCT
$(function () {
    $('#productLineList').change(function () {
        var categoryId = $(this).val()
        var html = ''

        $.ajax({
            type: 'GET',
            url: '/quan-tri/product_feature_list/' + categoryId,
            success: function (res) {

                res.feature.forEach(function (item) {
                    html += '<div class="col-4">\n' +
                        '   <div class="card">\n' +
                        '      <div class="card-header" id="headingOne' + item.id + '">\n' +
                        '         <h2 class="mb-0">\n' +
                        '            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne' + item.id + '">\n' +
                        '            <i class="fa fa-plus"></i>\n' +
                        '            ' + item.name + '\n' +
                        '            </button>\n' +
                        '         </h2>\n' +
                        '      </div>\n' +
                        '      <div id="collapseOne' + item.id + '" class="collapse" aria-labelledby="headingOne' + item.id + '" data-parent="#accordionExample">\n' +
                        '         <div class="card-body">\n';

                    item.sub.forEach(function (item) {
                        html +=

                            '            <div class="custom-control custom-checkbox">\n' +
                            '               <input name="feature[]" class="custom-control-input" type="checkbox" id="customCheckbox' + item.id + '" value="' + item.id + '">\n' +
                            '               <label for="customCheckbox' + item.id + '" class="custom-control-label">' + item.name + '</label>\n' +
                            '            </div>\n';

                    })

                    html += '         </div>\n' +
                        '      </div>\n' +
                        '   </div>\n' +
                        '</div>';
                })

                $('#accordionExample').html(html)
                console.log(res)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
})


//Choose Image Galery
$(function () {
    $('#ckfinder-popup-1').click(function () {
        selectFileWithCKFinder('img-avatar');
    })

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
})

function selectImageGalery(id) {
    CKFinder.popup({
        chooseFiles: true,
        width: 1200,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // output.value = file.getUrl();
                var img = "<img id='image-preview-src' + id  src='" + file.getUrl() + "'/>"
                $('#image-preview' + id).html(img);
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

function selectImageGaleryCustom(id, tag) {
    console.log(id, tag)
    CKFinder.popup({
        chooseFiles: true,
        width: 1200,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // output.value = file.getUrl();
                var img = "<img id='image-preview-src' + tag + id  src='" + file.getUrl() + "'/>"
                $('#image-preview' + tag + id).html(img);
                $('#image-input' + tag + id).val(file.getUrl());
                console.log($('#image-input' + tag + id).val())
            });

            finder.on('file:choose:resizedImage', function (evt) {
                var output = document.getElementById(elementId);
                output.value = evt.data.resizedUrl;
            });
        }
    });
}


//POST SEO
$('#news_title').on('input', function () {
    var seo_title = $(this).val()

    $('.preview_snippet_title').html(seo_title)
})
$('#news_description').on('input', function () {
    var seo_description = $(this).val()

    $('.preview_snippet_des').html(seo_description)
})

$(function () {
    $('#seo-url').on('input', function () {
        var repalce = $(this).val();
        var url = $('#url_seo').val();
        var seo_url = $('.preview_snippet_link').html(url + repalce)

    })

})

function changeStatusProd(id) {
    var status = $('#status' + id).is(':checked')
    status = status ? 1 : 0
    var statusText = status ? 'Bật' : 'Tắt'
    $('.status' + id).html(statusText)
    console.log(status)
    $.ajax({
        type: 'GET',
        url: '/quan-tri/san-pham/update-status-prod',
        data: {
            id: id,
            status: status
        },
        success: function (res) {
            console.log(res)
        },
        error: function (err) {
            console.log(err)
        }
    })
}

function changeStatus(id) {
    var status = $('#status' + id).is(':checked')
    status = status ? 1 : 0
    var statusText = status ? 'Bật' : 'Tắt'
    $('.status' + id).html(statusText)
    console.log(status)
    $.ajax({
        type: 'GET',
        url: '/quan-tri/dong-san-pham/update-status',
        data: {
            id: id,
            status: status
        },
        success: function (res) {
            console.log(res)
        },
        error: function (err) {
            console.log(err)
        }
    })
}

function changeShowHome(id) {
    var status = $('#show-home' + id).is(':checked')
    status = status ? 1 : 0
    var statusText = status ? 'Bật' : 'Tắt'
    $('.show-home' + id).html(statusText)
    $.ajax({
        type: 'GET',
        url: '/quan-tri/san-pham/showhome',
        data: {
            id: id,
            show_home: status
        },
        success: function (res) {
            console.log(res)
        },
        error: function (err) {
            console.log(err)
        }
    })
}

function changeStatusTag(id) {
    var status = $('#status' + id).is(':checked')
    status = status ? 1 : 0
    var statusText = status ? 'Bật' : 'Tắt'
    $('.status' + id).html(statusText)
    $.ajax({
        type: 'GET',
        url: '/quan-tri/bai-viet/tag/update-status',
        data: {
            id: id,
            status: status
        },
        success: function (res) {
            console.log(res)
        },
        error: function (err) {
            console.log(err)
        }
    })
}

function changeStatusCategory(id) {
    var status = $('#status' + id).is(':checked')
    status = status ? 1 : 0
    var statusText = status ? 'Bật' : 'Tắt'
    $('.status' + id).html(statusText)
    $.ajax({
        type: 'GET',
        url: '/quan-tri/bai-viet/chuyen-muc/update-status',
        data: {
            id: id,
            status: status
        },
        success: function (res) {
            console.log(res)
        },
        error: function (err) {
            console.log(err)
        }
    })
}

function changeStatusComment(id) {
    var status = $('#status' + id).is(':checked')
    status = status ? 1 : 0
    var statusText = status ? 'Bật' : 'Tắt'
    $('.status' + id).html(statusText)
    $.ajax({
        type: 'GET',
        url: '/quan-tri/binh-luan/update-status',
        data: {
            id: id,
            status: status
        },
        success: function (res) {
            console.log(res)
        },
        error: function (err) {
            console.log(err)
        }
    })
}

$(function () {
    $('#add-sub-category').click(function () {
        $('#add-sub-category-form').show()
        $(this).hide()
        $('#cancel-sub-category').show()
    })
    $('#cancel-sub-category').click(function () {
        $('#add-sub-category-form').hide()
        $(this).hide()
        $('#add-sub-category').show()
    })
})

$(function () {
    $('#sub-category-name').on('input', function () {
        $('#subNameCate').val($(this).val())
    })
})

$(function () {
    $("#add-sub-category-btn").click(function () {
        var cateName = $('#subNameCate').val()
        var idCate = $("#id_category").val()
        var token = $('#token').val()
        $.ajax({
            type: 'POST',
            url: '/quan-tri/san-pham/tinh-nang/add-sub-category',
            data: {
                name: cateName,
                parent: idCate,
                _token: token
            },
            success: function (res) {
                var table = $('#sub-cate-tbl tbody').html()

                var html = ''
                html += "<tr>" +
                    "<td>" +
                    "<a href='/quan-tri/san-pham/tinh-nang/danh-muc-con/sua/" + res.data.id + "'>" + res.data.name +
                    "</a>" +
                    "</td>" +
                    "<td>" + new Date(res.data.created_at).toISOString().split('T')[0] + "</td>" +
                    "<td>" + new Date(res.data.updated_at).toISOString().split('T')[0] + "</td>" +
                    "<td>" +
                    "<div class='custom-control custom-checkbox'>\n" +
                    "    <input name='favourite" + res.data.id + "' class='custom-control-input' type='checkbox'\n" +
                    "             id='favourite" + res.data.id + "' onclick='makeFavourite(" + res.data.id + ")'>\n" +
                    "    <label for='favourite" + res.data.id + "' class='custom-control-label'></label>\n" +
                    "</div>" +
                    "</td>" +
                    "<td>" +
                    "<button class='btn btn-danger' onclick='deleteSubCate(" + res.data.id + ")'>" + "<i class='fas fa-trash'></i>" + "</button>" +
                    "</td>" +
                    "</tr>";
                html += table
                $('#sub-cate-tbl tbody').html(html)
                console.log(res)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
})

function makeFavourite(id) {
    $('#favourite' + id).change(function () {
        var status = $(this).val()
        status = (status === 'on') ? 1 : 0

        $.ajax({
            type: 'GET',
            url: '/quan-tri/san-pham/tinh-nang/danh-muc-con/yeu-thich',
            data: {
                id: id,
                status: status
            },
            success: function (res) {
                console.log(res)
            },
            error: function (err) {
                console.log(err)
            }
        })
    })
}

function deleteSubCate(id) {
    var token = $("#token").val();

    $.ajax({
        type: 'POST',
        url: '/quan-tri/san-pham/tinh-nang/danh-muc-con/xoa',
        data: {
            _token: token,
            id: id
        },
        success: function (res) {
            window.location.reload()
        },
        error: function (err) {
            console.log(err)
        }
    })
}


// function showPost(id, tag){
//     var status = $('#customCheckbox'+id).is(':checked')
//     status = status ? 1 : 0;
//
//     $.ajax({
//         type: 'GET',
//         url: '/quan-tri/update-page-image',
//         data: {
//             status: status,
//             post_id: id,
//             tag: tag
//         },
//         success: function (res){
//             console.log(res)
//         },
//         error: function (err){
//             console.log(err)
//         }
//     })
// }
