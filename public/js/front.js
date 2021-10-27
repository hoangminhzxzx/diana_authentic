const url_source = 'http://localhost/diana_authentic';

// function showLoading(selector) {
//     let loading = document.createElement('span');
//     loading.className = 'spinner-border spinner-border-sm spinner-diana';
//     loading.setAttribute('role', 'status');
//     loading.setAttribute('aria-hidden', 'true');
//     loading.style.marginLeft = '5px';
//     selector.append(loading);
// }
// function hideLoading(selector) {
//     let loading = $(selector).find('.spinner-diana');
//     if (loading) {
//         loading.remove();
//     }
// }

function confirmDelete(form_id) {
    if (confirm('Bạn muốn thực hiện thao tác này ?')) {
        $(form_id).submit();
    }
}

<!-- ---------js for toggle menu------------ -->
var MenuItems = document.getElementById("MenuItems");
MenuItems.style.maxHeight = "0px";

function menutoggle() {
    if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "500px";
        MenuItems.style.background = "#fec8b5 none repeat scroll 0% 0%";
    } else {
        MenuItems.style.maxHeight = "0px";
    }

    let widthScreen = window.screen.width;
    if (widthScreen <= 800) {

    }
};
// function chooseSize(e) {
//     console.log(e);
//     // var size_id_output = $("#valueSize").val();
//     // var size_id_input = $("#chooseSize").val();
//     // return this.value = size_id_input;
// }
// $('#chooseSize').change(function (){
//     // console.log(e);
//     var size_id = $("#chooseSize").find(':selected').val();
//     console.log(size_id);
//     $("#valueSize").val(size_id);
// })

// $('#submitStep1').click(function () {
//     // alert('ok');
//     var size_id = $('#valueSize').val();
//     var id = $("#product_id").val();
//     console.log(size_id);
//     var data = {size_id: size_id, id: id};
//     var product_id = $('#product_id').val();
//     if (size_id === "") {
//         alert("Vui lòng chọn size");
//     } else {
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             url: url_source+'/product/step-choose-color/'+product_id,
//             type: 'GET',
//             data: data,
//             dataType: 'json',
//             success: function (res) {
//                 if (res.success) {
//                     window.location.href = res.redirect;
//                 }
//             },
//             // error: function (xhr, ajaxOptions, thrownError) {
//             //     alert(xhr.status);
//             //     alert(thrownError);
//             // }
//         });
//     }
// })

// $('#remove_item_cart').click(function () {
//     $('form#form_remove_item_cart').submit();
// })

function changeQty(id,e) {
    var rowId = $('#rowIdItem-'+id).val(),
        qty = $('#qtyItem-'+id).val(),
        idItem = $('#idItem-'+id).val();
    var data = {rowId: rowId, qty: qty};
    console.log(rowId);
    console.log(qty);
    console.log(idItem);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/product/updateQtyAjax/'+rowId,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                var qtyNewItem = res.qtyNewItem,
                    totalCart = res.totalCart,
                    priceItem = res.priceItem;
                // console.log(qtyNewItem);
                // console.log(totalCart);
                $('#subTotal-' + idItem).text(qtyNewItem * priceItem + ' VND');
                $('#totalCart').text(totalCart + ' VND');

                $(".count_item_cart").text(res.total_item_cart);
            } else {
                Swal.fire({
                    text: 'Mặt hàng này chỉ còn ' + res.qty_stock,
                    icon: "warning",
                })
            }
        },
        // error: function (xhr, ajaxOptions, thrownError) {
        //     alert(xhr.status);
        //     alert(thrownError);
        // }
    });
}

function changeImagePreview(e) {
    let ProductImg = $('#ProductImg');
    let SmallImg = $(e);
    ProductImg.attr('src', SmallImg.attr('src'));

    let activeThumbPreview = $('.active_thumb_preview');
    if (activeThumbPreview) {
        activeThumbPreview.removeClass('active_thumb_preview');
    }

    $(e).addClass('active_thumb_preview');
}

function chooseSize(e) {
    let product_id = $('input#product_id').val();
    let size_id = $(e).val();

    let data = {
        product_id: product_id,
        size_id : size_id
    };

    let group_color = $('#group_color');
    if (group_color) {
        group_color.remove();
    }

    if (size_id != 'nothing') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_source+'/choose-size',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    $(e).after(res.html);
                }
            },
        });
    }
}

function chooseColor(e) {
    // var valueColor = $("input#valueColor").value();
    var valueColor = document.getElementById('valueColor');
    var data_color = e.getAttribute('data-color');

    var elems = document.querySelectorAll(".active_color");
    [].forEach.call(elems, function(el) {
        el.classList.remove("active_color");
    });

    valueColor.value = data_color;
    if (valueColor.value == data_color) {
        e.classList.toggle("active_color");
    }
    if (e.classList.contains('active_color')) {
        valueColor.value = data_color;
    }else {
        valueColor.value = null;
    }
    // $("input#valueColor").value(data_color);
    // console.log(valueColor);

    //active icon color
}

function addToCart(e) {
    let size_id = $("#chooseSize").val(),
        color_id = $('#valueColor').val(),
        qty = $("input[name = 'qty']").val();
    let product_type = $("#is_accessory").val();

    let checkRequired = true;
    if (product_type == 0) { //kiểu phụ kiện
        if (!size_id || !color_id || !qty) {
            // alert('Vui lòng kiểm tra lại size, màu, số lượng');
            Swal.fire({
                text: 'Vui lòng kiểm tra lại size, màu, số lượng',
                icon: "warning",
            })
            checkRequired = false;
        }
        console.log('size_id: ' + size_id);
        console.log('color_id: ' + color_id);
        console.log('qty: ' + qty);
        var data = {
            size_id: size_id,
            color_id: color_id,
            qty: qty,
            is_accessory: product_type
        };
    } else { //kiểu sản phẩm có màu,size
        // if (!size_id) {
        //     alert('Vui lòng kiểm tra lại size');
        //     checkRequired = false;
        // }
        let product_id = $("input#product_id").val();
        var data = {
            qty: qty,
            product_id : product_id,
            is_accessory: product_type
        };
    }

    if (checkRequired) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_source+'/product/add-to-cart',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    window.location.href = res.redirect;
                }
            },
        });
    }
}

function removeItemCart(e) {
    let ele = $(e),
        rowId = ele.attr('data-rowId');
    let data = {
        rowId: rowId
    };
    Swal.fire({
        title: "Bạn muốn xóa sản phẩm này khỏi giỏ hàng ?",
        icon: "warning",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url_source+'/product/remove-to-cart',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        let eleParent = $(e).closest('.item-cart-single');
                        eleParent.remove();
                        if (res.redirect) {
                            window.location.href = res.redirect;
                        }
                    }
                },
            });
        }
    });
}

function selectProvince(e) {
    let valueProvince = $(e).val();
    let province_name = $("select[name='province'] option:selected").text();
    let inputAddress = $("input#address_client");
    let data = {
        province: valueProvince
    };

    // let arr_address = [];
    // arr_address.push(province_name);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/select-province',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                //gán địa chỉ tỉnh/thành phố vào input hidden
                // inputAddress.val(JSON.stringify(arr_address));

                //check xem có tồn tại select của chọn quận/huyện chưa, nếu có r thì xóa đi, render cái mới
                let checkIssetSelectDistrict = $("select[name='district']");
                if (checkIssetSelectDistrict) {
                    checkIssetSelectDistrict.remove();
                }

                let checkIssetSelectWard = $("select[name='ward']");
                if (checkIssetSelectWard) {
                    checkIssetSelectWard.remove();
                }
                $(e).after(res.html);
            }
        },
    });
}

function selectDistrict(e) {
    let valueDistrict = $(e).val();
    let district_name = $("select[name='district'] option:selected").text();
    let inputAddress = $("input#address_client");
    let data = {
        district: valueDistrict
    };

    //lấy giá trị tỉnh/thành phố ra để khi success thì nối quận/huyện vào, rồi gán vào lại input address
    // let address_current = JSON.parse(inputAddress.val());
    // console.log(address_current);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/select-district',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                //gán địa chỉ mới vào input hidden
                // let address_new = address_current + ', ' + district_name;
                // inputAddress.val(address_new);

                let checkIssetSelectWard = $("select[name='ward']");
                if (checkIssetSelectWard) {
                    checkIssetSelectWard.remove();
                }

                $(e).after(res.html);
            }
        },
    });
}

function orderSubmit(e) {
    let form_data_pending_order = $('form#form-pending-order').serialize();
    let ele_error_required_orders = $(".error_required_order");
    $.each(ele_error_required_orders, function (index, item) {
        if (item.value) {
            item.classList.remove('error_required_order');
        }
    })
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/thanh-toan',
        type: 'POST',
        data: form_data_pending_order,
        dataType: 'json',
        success: function (res) {
            if (res.mess_error) {
                let obj = res.mess_error;
                $.each(obj, function(key, value) {
                    let eleInput = $("#"+key);
                    if (eleInput) {
                        eleInput.addClass('error_required_order');
                    }
                });
            }

            if (res.success) {
                window.location.href = res.redirect;
                setTimeout(function () {
                    window.location.href = res.redirect_home;
                }, 5000)
            }
        },
    });
}

//--------- Account Client ---------------
$("#btnRegister").click(function () {
    let form_data = $("#RegForm").serialize();

    let ele_error_required_orders = $(".error_required_order");
    $.each(ele_error_required_orders, function (index, item) {
        if (item.value) {
            item.classList.remove('error_required_order');
        }
    })

    let ele_error_placeholder_text = $(".error-placeholder-text");
    $.each(ele_error_placeholder_text, function (index, item) {
        if (item.value) {
            item.classList.remove('error-placeholder-text');
        }
    })
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/dang-ky-tai-khoan',
        type: 'POST',
        data: form_data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    text: 'Bạn đã đăng ký thành công',
                    icon: "success",
                })
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if (xhr.status == 422) {
                let obj_errors = JSON.parse(xhr.responseText).errors;
                $.each(obj_errors, function(key, value) {
                    let eleInput = $("#RegForm input[name = "+ "'"+key+"'" +"]");
                    eleInput.attr('placeholder', value);
                    eleInput.addClass('error-placeholder-text');

                    if (eleInput) {
                        eleInput.addClass('error_required_order');
                    }
                });
            }
        }
    });
})

$("#btnLogin").click(function () {
    let form_data = $("#LoginForm").serialize();
    console.log(form_data);

    let ele_error_required_orders = $(".error_required_order");
    $.each(ele_error_required_orders, function (index, item) {
        if (item.value) {
            item.classList.remove('error_required_order');
        }
    })

    let ele_error_placeholder_text = $(".error-placeholder-text");
    $.each(ele_error_placeholder_text, function (index, item) {
        if (item.value) {
            item.classList.remove('error-placeholder-text');
        }
    })

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/dang-nhap-tai-khoan',
        type: 'POST',
        data: form_data,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire({
                    text: 'Bạn đã đăng nhập thành công',
                    icon: "success",
                })
                window.location.href = url_source + '/';
            } else {
                if (res.message_error_account) {
                    Swal.fire({
                        text: res.message_error_account,
                        icon: "warning",
                    })
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if (xhr.status == 422) {
                let obj_errors = JSON.parse(xhr.responseText).errors;
                $.each(obj_errors, function(key, value) {
                    let eleInput = $("#LoginForm input[name = "+ "'"+key+"'" +"]");
                    eleInput.attr('placeholder', value);
                    eleInput.addClass('error-placeholder-text');

                    if (eleInput) {
                        eleInput.addClass('error_required_order');
                    }
                });
            }
        }
    });
})

function showSubMenu(e) {
    $("ul#sub_menu").toggleClass('d-none');
    // let widthScreen = window.screen.width;
    // if (widthScreen <= 800) {
    //     $("ul#sub_menu").css({
    //         'left' : '20%',
    //         'top' : '-100px',
    //         'width' : '60%',
    //         'background-color' : '#fec8b5'
    //     });
    // }
    // if (widthScreen <= 600) {
    //     $("ul#sub_menu").css({
    //         'left' : '20%',
    //         'top' : '-100px',
    //         'width' : '60%',
    //         'background-color' : '#fec8b5'
    //     });
    // }
    // if (widthScreen <= 460) {
    //     $("ul#sub_menu").css({
    //         'left' : '15%',
    //         'top' : '-100px',
    //         'width' : '60%',
    //         'background-color' : '#fec8b5'
    //     });
    // }
    // if (widthScreen <= 400) {
    //     $("ul#sub_menu").css({
    //         'left' : '0%',
    //         'top' : '-100px',
    //         'width' : '60%',
    //         'background-color' : '#fec8b5'
    //     });
    // }
}
$("#btn_logout").click(function () {
    Swal.fire({
        title: "Bạn có muốn đăng xuất ?",
        icon: "warning",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url_source+'/dang-xuat',
                type: 'POST',
                data: {},
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        window.location.href = url_source + '/';
                    } else {

                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {

                }
            });
        }
    });
})

$("#btnRestore").click(function () {
    // console.log('send request');
    $('#btnRestore').attr('disabled', 'disabled');
    $('#btnRestore').css('opacity', '0.3');
    let spanError = $('#span_error_email'),
        spannSuccess = $("#span_success_email");
    let form_data = $("#restoreForm").serialize();
    // console.log(form_data);
    spannSuccess.text(null);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/restart-password-client',
        type: 'POST',
        data: form_data,
        dataType: 'json',
        success: function (res) {
            // console.log(res);
            if (res.success) {
                spanError.text(null);
                if (res.mess_send) {
                    spannSuccess.text(res.mess_send);
                }
            } else {
                if (res.error_isset_email) {
                    spanError.text(res.error_isset_email);
                }
            }

            $('#btnRestore').removeAttr('disabled');
            $('#btnRestore').css('opacity', '1');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if (xhr.status == 422) {
                let obj_errors = JSON.parse(xhr.responseText).errors;
                $.each(obj_errors, function(key, value) {
                    console.log(spanError);
                    spanError.text(value);
                });
                $('#btnRestore').removeAttr('disabled');
                $('#btnRestore').css('opacity', '1');
            }
        }
    });
})

$("#btnUpdateRestorePassForm").click(function () {
    $("#btnUpdateRestorePassForm").attr('disabled', 'disabled');
    $("#btnUpdateRestorePassForm").css('opacity', '0.3');

    let spanError = $("#span_error");
    let form_data = $("#updateRestorePassForm").serialize();
    let account_client_id = $("#hidden_info").attr('data-account-client-id'),
        account_client_email = $('#hidden_info').attr('data-account-client-email');
    form_data = form_data + '&id='+account_client_id + '&email=' + account_client_email;

    spanError.text(null);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_source+'/restore-update-password',
        type: 'POST',
        data: form_data,
        dataType: 'json',
        success: function (res) {
            // console.log(res);
            if (res.success) {
                Swal.fire({
                    text: 'Bạn đã đổi mật khẩu thành công, đợi giây lát Diana Au sẽ đưa bạn về Home',
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000
                })

                setTimeout(function () {
                    window.location.href = url_source + '/';
                }, 3000);
            } else {
                if (res.error_confirm) {
                    spanError.text(res.error_confirm);
                }
            }

            $("#btnUpdateRestorePassForm").removeAttr('disabled');
            $("#btnUpdateRestorePassForm").css('opacity', '1');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if (xhr.status == 422) {
                let obj_errors = JSON.parse(xhr.responseText).errors;
                $.each(obj_errors, function(key, value) {
                    spanError.text(value);
                });
                $("#btnUpdateRestorePassForm").removeAttr('disabled');
                $("#btnUpdateRestorePassForm").css('opacity', '1');
            }
        }
    });
})

// $("#select_order_product").onchange(function () {
//     console.log('here');
//     console.log(this.value);
// })
function orderProduct(e) {
    console.log('here');
    console.log($(e).val());
    $("#formFilterProduct").submit();
    // let slug = $(e).attr('data-category-slug');
    // let data = {
    //     order_type: $(e).val()
    // };
    // $.ajax({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     url: url_source+'/category/'+slug,
    //     type: 'GET',
    //     data: data,
    //     dataType: 'json',
    //     success: function (res) {
    //         if (res.success) {
    //
    //         }
    //     },
    //     error: function (xhr, ajaxOptions, thrownError) {
    //
    //     }
    // });
}
