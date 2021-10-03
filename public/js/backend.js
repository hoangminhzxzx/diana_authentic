const url_source = 'http://localhost/diana_authentic_shop/admin';

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
