function confirmDelete(form_id) {
    if (confirm('Are you sure?')) {
        $(form_id).submit();
    }
}

function imagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#uploadProduct + img").remove();
            $("#uploadProduct #thumbnail").after('<img class="img-thumbnail" id="image" src="'+e.target.result+'" style="margin-top: 1rem; max-width: 300px;"/>' );
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
