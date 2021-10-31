@extends('layouts.layout_admin')
@section('styles')
    <link rel="stylesheet" href="{{ url('/public/plugins/custom/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success mt-3" role="alert">{{session('status')}}</div>
    @endif
    <div class="row mb-5 mx-4">
        <div class="card col-4" id="form_add_stock">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Thêm bản ghi</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data" id="stockForm" class="">
                    @csrf
                    <div class="form-group">
                        <lable>Số lượng hàng</lable>
                        <input type="number" name="input" value="{{ old('input') }}" class="form-control">
                        @error('input')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable>Tổng giá tiền</lable>
                        <input type="number" name="total_price" value="{{ old('total_price') }}" class="form-control">
                        @error('total_price')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable>Ghi chú</lable>
                        <input type="text" name="note" value="{{ old('note') }}" class="form-control">
                    </div>


                    <div class="form-group text-center">
                        {{--                    <input type="submit" class="btn btn-outline-success w-25" value="Lưu">--}}
                        <button type="button" class="btn btn-outline-success w-25" onclick="saveRecordStock(this)">Lưu</button>
                    </div>
                </form>

                <div class="card mx-4 mt-5 d-none" id="form_upload_image">
                    <div class="card-header">
                        <h4>Ảnh hóa đơn</h4>
                    </div>
                    <input type="hidden" value="" id="stock_id" name="stock_id">
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
                                {{--                            @if($stock->images)--}}
                                {{--                                @foreach(json_decode($stock->images) as $image)--}}
                                {{--                                    <div id="" class="file-row d-flex justify-content-between item-image-single">--}}
                                {{--                                        <!-- This is used as the file preview template -->--}}
                                {{--                                        <div class="">--}}
                                {{--                                            <div>--}}
                                {{--                                                <span class="preview"><img data-dz-thumbnail="" width="80" height="80"--}}
                                {{--                                                                           alt="" src="{{ asset($image) }}"/></span>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div>--}}
                                {{--                                                <p class="name" data-dz-name></p>--}}
                                {{--                                                <strong class="error text-danger" data-dz-errormessage></strong>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div>--}}
                                {{--                                                <p class="size" data-dz-size></p>--}}
                                {{--                                                <div class="progress progress-striped active" role="progressbar"--}}
                                {{--                                                     aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">--}}
                                {{--                                                    <div class="progress-bar progress-bar-success" style="width:0%;"--}}
                                {{--                                                         data-dz-uploadprogress></div>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div>--}}
                                {{--                                            --}}{{--                                    <button class="btn btn-primary start">--}}
                                {{--                                            --}}{{--                                        <i class="glyphicon glyphicon-upload"></i>--}}
                                {{--                                            --}}{{--                                        <span>Start</span>--}}
                                {{--                                            --}}{{--                                    </button>--}}
                                {{--                                            --}}{{--                                    <button data-dz-remove class="btn btn-warning cancel">--}}
                                {{--                                            --}}{{--                                        <i class="glyphicon glyphicon-ban-circle"></i>--}}
                                {{--                                            --}}{{--                                        <span>Cancel</span>--}}
                                {{--                                            --}}{{--                                    </button>--}}
                                {{--                                            <button class="btn btn-danger" onclick="deleteImageSingle(this)"--}}
                                {{--                                                    data-path="{{ $image }}">--}}
                                {{--                                                <i class="glyphicon glyphicon-trash"></i>--}}
                                {{--                                                <span>Delete</span>--}}
                                {{--                                            </button>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                @endforeach--}}
                                {{--                            @endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mx-4 col-7" id="list_log_stock">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách log</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTableStock" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Số lượng nhập</th>
                            <th>Tổng giá nhập hàng</th>
                            <th>Ghi chú</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_stock as $stock)
                            <tr class="row-stock-{{ $stock->id }}">
                                <td id="div_images_{{ $stock->id }}">
                                    @if($stock->images)
                                        @foreach(json_decode($stock->images, true) as $image)
                                            <img src="{{ url($image) }}" alt="" class="img-thumbnail" width="70">
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ number_format($stock->input, 0, '.', '.') }}</td>
                                <td>{{ number_format($stock->total_price, 0, '.', '.') }} VNĐ</td>
                                <td>{{ $stock->note }}</td>
                                <td>{{ substr($stock->created_at, 0, 10) }}</td>
                                <td>
                                    <a href="{{route('admin.stock.edit', $stock->id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
{{--                                    <a class="btn btn-icon btn-light btn-hover-danger btn-sm" onclick="deleteStock(this,{{ $stock->id }})">--}}
{{--                                        <i class="fas fa-trash-alt"></i>--}}
{{--                                    </a>--}}

                                    <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                                       onclick="confirmDelete('#delete-stock-{{$stock->id}}');return false;">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form method="POST" id="delete-stock-{{$stock->id}}"
                                          action="{{route('admin.stock.delete', $stock->id)}}"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{--                    {{ $list_product->render('vendor.pagination.bootstrap-4') }}--}}
                        </tbody>
                    </table>
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

        // var stock_id = $("input[name='stock_id']").val();

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
                var stock_id = $("input[name='stock_id']").val();
                myDropzone.enqueueFile(file);
                console.log(stock_id);
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
            var stock_id = $("input[name='stock_id']").val();
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

            //render images stock in list table
            $('#div_images_'+obj.stock_id).empty();
            $('#div_images_'+obj.stock_id).append(obj.html);
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

