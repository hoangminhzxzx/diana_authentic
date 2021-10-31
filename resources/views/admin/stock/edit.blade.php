@extends('layouts.layout_admin')
@section('styles')
    <link rel="stylesheet" href="{{ url('/public/plugins/custom/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="card mx-4 col-6" id="form_edit_stock">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa bản ghi stock</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stock.update', ['id' => $stock->id]) }}" method="POST" enctype="multipart/form-data" id="stockFormEdit" class="">
                    @csrf
                    <div class="form-group">
                        <lable>Số lượng hàng</lable>
                        <input type="number" name="input" value="{{ $stock->input }}" class="form-control">
                        @error('input')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable>Tổng giá tiền</lable>
                        <input type="number" name="total_price" value="{{ $stock->total_price }}" class="form-control">
                        @error('total_price')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable>Ghi chú</lable>
                        <input type="text" name="note" value="{{ $stock->note }}" class="form-control">
                    </div>


                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-outline-success w-25" value="Lưu">
{{--                        <button type="button" class="btn btn-outline-success w-25" onclick="updateRecordStock(this)">Lưu</button>--}}
                    </div>
                </form>

                <div class="card mx-4 mt-5" id="form_upload_image">
                    <div class="card-header">
                        <h4>Ảnh hóa đơn</h4>
                    </div>
                    <input type="hidden" value="{{ $stock->id }}}" id="stock_id" name="stock_id">
                    <div class="card-body">
                        <div class="form-group">
                            <div id="actions" class="row mb-4">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-success fileinput-button dz-clickable">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add files...</span>
                    </span>
                                </div>

                                <div class="col-lg-5">
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process">
                                    <div id="total-progress" class="progress progress-striped active" role="progressbar"
                                         aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
                                        <div class="progress-bar progress-bar-success" style="width: 100%;"
                                             data-dz-uploadprogress=""></div>
                                    </div>
                                </span>
                                </div>
                            </div>

                            <!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
                            <div class="table table-striped" class="files" id="previews">
                                <div id="template" class="file-row d-flex justify-content-between">
                                    <!-- This is used as the file preview template -->
                                    <div class="">
                                        <div>
                                            <span class="preview"><img data-dz-thumbnail/></span>
                                        </div>
                                        <div>
                                            <p class="name" data-dz-name></p>
                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>
                                        <div>
                                            <p class="size" data-dz-size></p>
                                            <div class="progress progress-striped active" role="progressbar"
                                                 aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;"
                                                     data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary start">
                                            <i class="glyphicon glyphicon-upload"></i>
                                            <span>Start</span>
                                        </button>
                                        <button data-dz-remove class="btn btn-warning cancel">
                                            <i class="glyphicon glyphicon-ban-circle"></i>
                                            <span>Cancel</span>
                                        </button>
                                        <button data-dz-remove class="btn btn-danger delete d-none">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                                @if($stock->images)
                                    @foreach(json_decode($stock->images) as $image)
                                        <div id="" class="file-row d-flex justify-content-between item-image-single">
                                            <!-- This is used as the file preview template -->
                                            <div class="">
                                                <div>
                                                <span class="preview"><img data-dz-thumbnail="" width="80" height="80"
                                                                           alt="" src="{{ asset($image) }}"/></span>
                                                </div>
                                                <div>
                                                    <p class="name" data-dz-name></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                                <div>
                                                    <p class="size" data-dz-size></p>
                                                    <div class="progress progress-striped active" role="progressbar"
                                                         aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                                             data-dz-uploadprogress></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                {{--                                    <button class="btn btn-primary start">--}}
                                                {{--                                        <i class="glyphicon glyphicon-upload"></i>--}}
                                                {{--                                        <span>Start</span>--}}
                                                {{--                                    </button>--}}
                                                {{--                                    <button data-dz-remove class="btn btn-warning cancel">--}}
                                                {{--                                        <i class="glyphicon glyphicon-ban-circle"></i>--}}
                                                {{--                                        <span>Cancel</span>--}}
                                                {{--                                    </button>--}}
                                                <button class="btn btn-danger" onclick="deleteImageSingleStock(this)"
                                                        data-path="{{ $image }}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ url('/public/plugins/custom/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var stock_id = $("input[name='stock_id']").val();

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: 'http://localhost/diana_authentic/admin/stock/upload-images-dz', // Set the url
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function () {
                myDropzone.enqueueFile(file);
            };
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function (file, xhr, formData) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1";
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            file.previewElement.querySelector(".start").style.display = 'none';
            file.previewElement.querySelector(".cancel").style.display = 'none';

            // file.previewElement.querySelector(".delete").classList.remove('d-none');

            // formData.append('idea_id', dropzone_idea_id);
            formData.append('id', stock_id);
            formData.append("_token", "{{ csrf_token() }}");
        });
        myDropzone.on("complete", function (progress) {
            var obj = jQuery.parseJSON(progress.xhr.response);
            console.log(progress);
            console.log(obj);

            // file.previewElement.querySelector(".delete").setAttribute("data-path", obj.path_image);
            let buttonDelete = progress.previewElement.querySelector(".delete");
            buttonDelete.classList.remove('d-none');
            buttonDelete.setAttribute('data-path', obj.path_image);
            buttonDelete.setAttribute('onclick', 'deleteImageSingleStock(this)');
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector(".start").onclick = function () {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };
        document.querySelector(".cancel").onclick = function () {
            myDropzone.removeAllFiles(true);
        };
    </script>
@endsection

