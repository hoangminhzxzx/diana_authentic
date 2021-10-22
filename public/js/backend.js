const url_source = 'http://localhost/diana_authentic/admin';

function confirmDelete(form_id) {
    if (confirm('Are you sure?')) {
        $(form_id).submit();
    }
}

function imagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#image_preview").remove();
            $("#thumbnail").after('<img class="img-thumbnail" id="image_preview" src="'+e.target.result+'" style="margin-top: 1rem; max-width: 300px;"/>' );
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#thumbnail").change(function (){
    imagePreview(this);
    $("#uploadProduct #image").remove();
})


function changeThumbnail(e) {
    imagePreview(e);
    $("#uploadProduct #image").remove();

    console.log($(e)[0].files[0]);

    let form_data = new FormData();
    let files = $(e)[0].files[0];
    form_data.append('file', files);

    // $.ajax({
    //     url: 'upload.php',
    //     type: 'post',
    //     data: fd,
    //     contentType: false,
    //     processData: false,
    //     success: function(response){
    //         if(response != 0){
    //             alert('file uploaded');
    //         }
    //         else{
    //             alert('file not uploaded');
    //         }
    //     },
    // });
}

function deleteImageSingle(e) {
    let ele = $(e);
    let path = ele.attr('data-path'),
        product_id = $("input[name='product_id']").val();

    let data = {
        path: path,
        product_id: product_id,
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source + '/remove-image-single',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                let item_parent = ele.closest('.item-image-single');
                item_parent.remove();

                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: 'Đã xóa',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        },
    });
}

function selectProductBanner(e) {
    let product_id = $(e).val();
    let data = {
        product_id: product_id
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source + '/config-banner-store',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                console.log('abcd');
            }
        },
    });
}

function addProductVariant(e) {
    let ele = $(e);
    console.log(ele);

    let form_data = $('form#form_product_variant').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source + '/product/variant',
        type: 'POST',
        data: form_data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thêm variant thành công',
                    showConfirmButton: false,
                    timer: 1500
                })

                // console.log(res.html);

                let row_variant = $('#tbl_list_variant tbody');
                row_variant.append(res.html);
            }
        },
    });
}

function checkOrder(e) {
    Swal.fire({
        title: "Check Order ?",
        icon: "warning",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let ele = $(e);
            let order_id = $("#order_id").val();

            let data = {
                order_id : order_id
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url_source + '/check-order',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        //effect
                        ele.removeClass('item-circle');
                        ele.addClass('item-circle-success');
                        ele.removeAttr('onclick');
                        ele.children().first().remove();
                        ele.append('<i class="far fa-check-circle text-success" style="font-size: 20px;"></i>');

                        //-----add event onclick step next -------------------
                        let step_confirm_shipping = $("#step_confirm_shipping");
                        step_confirm_shipping.attr('onclick', 'confirmShipOrder(this)');
                    } else {
                        if (res.message) {
                            Swal.fire({
                                title: res.message,
                                icon: "danger",
                                showCancelButton: true,
                            })
                        }
                    }
                },
            });
        }
    });
}

function confirmShipOrder(e) {
    Swal.fire({
        title: "Xác nhận đang ship Order ?",
        icon: "warning",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let ele = $(e);
            let order_id = $("#order_id").val();

            let data = {
                order_id : order_id
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url_source + '/confirm-ship-order',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        //effect
                        ele.removeClass('item-circle');
                        ele.addClass('item-circle-success');
                        ele.removeAttr('onclick');
                        ele.children().first().remove();
                        ele.append('<i class="far fa-check-circle text-success" style="font-size: 20px;"></i>');

                        //-----add event onclick step next -------------------
                        let step_confirm_complete = $("#step_confirm_complete");
                        step_confirm_complete.attr('onclick', 'confirmCompleteOrder(this)');
                    } else {
                        if (res.message) {
                            Swal.fire({
                                title: res.message,
                                icon: "danger",
                                showCancelButton: true,
                            })
                        }
                    }
                },
            });
        }
    });
}

function confirmCompleteOrder(e) {
    Swal.fire({
        title: "Xác nhận hoàn thành Order ?",
        icon: "warning",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let ele = $(e);
            let order_id = $("#order_id").val();

            let data = {
                order_id : order_id
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url_source + '/confirm-complete-order',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        //effect
                        ele.removeClass('item-circle');
                        ele.addClass('item-circle-success');
                        ele.removeAttr('onclick');
                        ele.children().first().remove();
                        ele.append('<i class="far fa-check-circle text-success" style="font-size: 20px;"></i>');

                        // //-----add event onclick step next -------------------
                        // let step_confirm_complete = $("#step_confirm_complete");
                        // step_confirm_complete.attr('onclick', 'confirmCompleteOrder(this)');

                        //---- remove box cancle Order -----------
                        let box_cancle_order = $("#box_cancle_order");
                        if (box_cancle_order) {
                            box_cancle_order.remove();
                        }
                    } else {
                        if (res.message) {
                            Swal.fire({
                                title: res.message,
                                icon: "danger",
                                showCancelButton: true,
                            })
                        }
                    }
                },
            });
        }
    });
}

function cancleOrder(e) {
    Swal.fire({
        title: "Xác nhận hủy Order ?",
        icon: "warning",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let ele = $(e);
            let order_id = $("#order_id").val();

            let data = {
                order_id : order_id
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url_source + '/confirm-cancle-order',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        let box_check_order = $("#box_check_order"),
                            box_shipping_order = $("#box_shipping_order"),
                            box_complete_order = $("#box_complete_order"),
                            box_cancle_order = $("#box_cancle_order");
                        box_check_order.remove();
                        box_shipping_order.remove();
                        box_complete_order.remove();
                        box_cancle_order.remove();

                        //---show alert order cancled-----
                        let box_cancled_order = $("#box_cancled_order");
                        box_cancled_order.removeClass('d-none');
                    } else {
                        if (res.message) {
                            Swal.fire({
                                text: res.message,
                                icon: "warning",
                            })
                        }
                    }
                },
            });
        }
    });
}

// <i className="spinner spinner-dark d-none" style="padding-right: 20px;"></i>
// <span className="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
function showLoading(selector) {
    let loading = document.createElement('span');
    loading.className = 'spinner-border spinner-border-sm spinner-diana';
    loading.setAttribute('role', 'status');
    loading.setAttribute('aria-hidden', 'true');
    loading.style.marginLeft = '5px';
    selector.append(loading);
}
function hideLoading(selector) {
    let loading = $(selector).find('.spinner-diana');
    if (loading) {
        loading.remove();
    }
}

function configProductSelect(e) {
    showLoading(e);
    let ele = $(e);
    let product_id = ele.attr('data-productId');
    console.log(product_id);

    let data = {
        product_id: product_id
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source + '/config-product-update',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật thành công',
                    showConfirmButton: false,
                    timer: 1500
                })

                $(e).text(res.text);
                if (res.text == 'Selected') {
                    $(e).removeClass('btn-warning');
                    $(e).addClass('btn-success');
                } else {
                    $(e).addClass('btn-warning');
                    $(e).removeClass('btn-success');
                }

                //chuyển product hot về như bình thg
                if (res.product_down) {
                    console.log(res.product_down);
                    let btn_product_down = $(".btn-select-diana[data-productId = '"+ res.product_down.id +"']");
                    console.log(btn_product_down);
                    btn_product_down.removeClass('btn-success');
                    btn_product_down.addClass('btn-warning');
                    btn_product_down.text('Select');

                    //remove position
                    btn_product_down.parent().children().first().remove();
                }

                //đoạn xử lý show position sản phẩm hot
                if (res.position) {
                    let card_product_hot_banner = $(e).parent();
                    let divPosition = '<div class="hot-position" data-productId="'+ product_id +'" onclick="changePosition(this)"><span>'+ res.position +'</span></div>';

                    card_product_hot_banner.prepend(divPosition);
                }
            } else {

            }
            hideLoading(e);
        },
    });
}
function changePosition(e) {
    let product_id = $(e).attr('data-productId');
    let data = {
        product_id: product_id
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source + '/config-change-position',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: 'Cập nhật vị trí banner thành công',
                    showConfirmButton: false,
                    timer: 1500
                })

                //trả về position mới cho sản phẩm vừa click
                $(e).children().first().text(res.position_product_this);

                //trả về position mới cho sản phẩm rest nếu có tồn tại
                if (res.position_product_rest) {
                    let btn_position_rest = $(".hot-position[data-productId = '"+ res.product_rest_id +"']");
                    if (btn_position_rest) {
                        btn_position_rest.children().first().text(res.position_product_rest);
                    }
                }
            } else {
                Swal.fire({
                    text: res.mess,
                    position: 'top-end',
                    icon: 'danger',
                })
            }
        },
    });
}

function deleteProduct(e, id) {
    let ele = $(e);
    let data = {
        id: id
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source + '/product/delete',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: 'Xoá thành công',
                    showConfirmButton: false,
                    timer: 1500
                })

                let rowParent = $(".row-product-" + id);
                if (rowParent) {
                    rowParent.remove();
                }
            } else {
                Swal.fire({
                    text: 'Lỗi',
                    position: 'top-end',
                    icon: 'danger',
                })
            }
        },
    });
}

function setPublishProduct(e, product_id) {
    let is_publish = 0;
    if ($(e).prop("checked") == true) {
        is_publish = 1;
    }
    let data = {
        product_id: product_id,
        is_publish: is_publish
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source + '/product/set-publish',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    text: res.text_response,
                    position: 'top-end',
                    icon: 'success',
                })
            } else {
                Swal.fire({
                    text: 'Lỗi',
                    position: 'top-end',
                    icon: 'danger',
                })
            }
        },
    });
}
