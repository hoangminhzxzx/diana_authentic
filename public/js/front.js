const url_source = 'http://localhost/diana_authentic_shop';

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
        MenuItems.style.maxHeight = "290px";
        MenuItems.style.background = "#fec8b5 none repeat scroll 0% 0%";
    } else {
        MenuItems.style.maxHeight = "0px";
    }
};

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
    console.log(valueColor);

    //active icon color
}
// function chooseSize(e) {
//     console.log(e);
//     // var size_id_output = $("#valueSize").val();
//     // var size_id_input = $("#chooseSize").val();
//     // return this.value = size_id_input;
// }
$('#chooseSize').change(function (){
    // console.log(e);
    var size_id = $("#chooseSize").find(':selected').val();
    console.log(size_id);
    $("#valueSize").val(size_id);
})

$('#submitStep1').click(function () {
    // alert('ok');
    var size_id = $('#valueSize').val();
    var id = $("#product_id").val();
    console.log(size_id);
    var data = {size_id: size_id, id: id};
    var product_id = $('#product_id').val();
    if (size_id === "") {
        alert("Vui lòng chọn size");
    } else {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_source+'/product/step-choose-color/'+product_id,
            type: 'GET',
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    window.location.href = res.redirect;
                }
            },
            // error: function (xhr, ajaxOptions, thrownError) {
            //     alert(xhr.status);
            //     alert(thrownError);
            // }
        });
    }
})

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
            }
        },
        // error: function (xhr, ajaxOptions, thrownError) {
        //     alert(xhr.status);
        //     alert(thrownError);
        // }
    });
}
