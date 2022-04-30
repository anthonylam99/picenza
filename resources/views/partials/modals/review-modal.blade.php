<!-- Modal -->
<div class="modal fade" id="reviewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhận xét</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_testimonial">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-lg-12 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                            <input type="text" class="form-control" name="title" placeholder="Tiêu đề">
                            <small id="title_div_alert" class="text-danger"></small>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-2 mb-lg-0 mb-md-0">
                            <div>
                                <textarea name="body" onkeydown="$('.count-text-body-review').html($(this).val().length)" id="" cols="30" rows="8"
                                    class="textarea-body rounded-top d-block w-100 h-auto px-1 py-1"
                                    placeholder="Nhập đánh giá về sản phẩm (tối thiểu 80 ký tự)" style=""></textarea>
                                <div class="file_img rounded-bottom d-flex justify-content-between px-2 py-2" style="">
                                    <div>
                                        <input type="file" name="fileImg" class="d-none" id="imgInp">
                                        <label class="" for="imgInp">
                                            <i class="fa fa-camera"></i>
                                            Đính kèm ảnh
                                        </label>
                                    </div>
                                    <div>
                                        <span class="count-text-body-review">0</span>
                                        /
                                        <span>80</span>
                                    </div>
                                </div>
                                <small id="body_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="row">
                                <div class="col-lg-12 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                                    <input type="text" class="form-control" name="full_name" placeholder="Họ tên">
                                    <small id="full_name_div_alert" class="text-danger"></small>
                                </div>
                                <div class="col-lg-12 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                                    <small id="address_div_alert" class="text-danger"></small>
                                </div>
                                <div class="col-lg-12 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" checked value="0">
                                        <label class="form-check-label">Nam</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="1">
                                        <label class="form-check-label">Nữ</label>
                                    </div>
                                    <small id="gender_div_alert" class="text-danger"></small>
                                </div>
                                <div class="col-lg-6 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                                    <input type="text" class="form-control" name="phone_number"
                                        placeholder="Số điện thoại">
                                    <small id="phone_number_div_alert" class="text-danger"></small>
                                </div>
                                <div class="col-lg-6 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                    <small id="email_div_alert" class="text-danger"></small>
                                </div>
                                <div class="col-lg-6 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                                    <button type="submit" id="btn-review" class="btn btn-primary btn-block text-uppercase">Gửi nhận xét </button>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product_id }}" class="product_id">
                            <input type="hidden" name="rating" value="1" class="rating">

                        </div>
                    </div>
                </div>
                <div>
                    <div class="row mt-4" id="image_review_render">

                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#form_testimonial').on('submit', function (e) {
            e.preventDefault()
            var formdata = new FormData($(this)[0]);
            insertdata(formdata)
        })

        function resetFormTestimonial() {
            $('#form_testimonial textarea[name="body"]').val('')
            $('#form_testimonial input[name="full_name"]').val('')
            $('#form_testimonial input[name="phone_number"]').val('')
            $('#form_testimonial input[name="email"]').val('')
            $('#form_testimonial input[name="address"]').val('')
            $('.count-text-body-review').text('0')
            $('#image_review_render').html('')
        }

        function insertdata(formdata) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('submitRatingComment')}}',
                data: formdata,
                dataType: 'json',
                type: 'post',
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success == 1) {
                        alert('Đánh giá của bạn sẽ được hệ thống kiểm duyệt. Xin cám ơn.')
                        $('#reviewmodal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                        resetFormTestimonial()
                    }
                },
                error: function (err) {
                    //$('#btn-review').prop('disabled', true)
                    if (err.status == 422) {
                        if ('phone_number' in err.responseJSON.errors) {
                            $('#phone_number_div_alert').text(err.responseJSON.errors.phone_number[0])
                        } else {
                            $('#phone_number_div_alert').text('')
                        }
                        if ('address' in err.responseJSON.errors) {
                            $('#address_div_alert').text(err.responseJSON.errors.address[0])
                        } else {
                            $('#address_div_alert').text('')
                        }
                        if ('title' in err.responseJSON.errors) {
                            $('#title_div_alert').text(err.responseJSON.errors.title[0])
                        } else {
                            $('#title_div_alert').text('')
                        }
                        if ('email' in err.responseJSON.errors) {
                            $('#email_div_alert').text(err.responseJSON.errors.email[0])
                        } else {
                            $('#email_div_alert').text('')
                        }
                        if ('body' in err.responseJSON.errors) {
                            $('#body_div_alert').text(err.responseJSON.errors.body[0])
                        } else {
                            $('#body_div_alert').text('')
                        }
                        if ('full_name' in err.responseJSON.errors) {
                            $('#full_name_div_alert').text(err.responseJSON.errors.full_name[0])
                        } else {
                            $('#full_name_div_alert').text('')
                        }
                    }
                }
            })
        }
    </script>
    <script>
        $('#imgInp').change(function () {
            readURL(this)
        })

        function readURL(input) {
            html = ''
            if (input.files && input.files[0]) {
                var file = input.files[0]
                var formData = new FormData()
                formData.append('formData', file)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('postRatingImage')}}',  //Server script to process data
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    //Ajax events
                    success: function (data) {
                        html += '<div class="col-lg-3">'
                        html += '<div class="position-relative">'
                        html += '<span onclick="$(this).parent().parent().remove();" class="btn_remove_img position-absolute rounded rounded-circle bg-dark d-flex justify-content-center align-items-center" style="">'
                        html += '<i class="fa fa-times-circle text-light"></i>'
                        html += '</span>'
                        html += '<img class="w-100" src="' + data.url + '" alt="">'
                        html += '</div>'
                        html += '<input type="hidden" value="' + data.url + '" name="file[]">'
                        html += '</div>'
                        $('#image_review_render').append(html)
                    }
                })
            }
        }
    </script>
@endpush


