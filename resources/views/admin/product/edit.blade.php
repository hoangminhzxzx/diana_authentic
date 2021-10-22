@extends('layouts.layout_admin')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    {{--    <link rel="stylesheet" href="{{ url('public/plugins/custom/dropzone-5.7.0/dist/min/dropzone.min.css') }}">--}}

{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ url('/public/plugins/custom/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-header">
                    @if (session('success_product'))
                        <div class="alert alert-success mt-3" role="alert">{{session('success_product')}}</div>
                    @endif
                    @if (session('status_update_variant'))
                        <div class="alert alert-success mt-3" role="alert">{{session('status_update_variant')}}</div>
                    @endif
                    @if (session('status_delete_variant'))
                        <div class="alert alert-success mt-3" role="alert">{{session('status_delete_variant')}}</div>
                    @endif
                    <h3>Update Product</h3>
                </div>
                {{--                <img class="img-thumbnail" id="image" src="{{ asset($product->thumbnail) }}" style="margin-top: 1rem; max-width: 200px;" /> Ảnh sản phẩm đại diện ( Khi muốn thay đổi cần liên hệ với Bang Chủ hoặc xóa đi nhập liệu lại)--}}
                <div class="card-body">
                    <form action="{{route('admin.product.update', $product->id)}}" method="POST" id="uploadProduct"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <lable>Title</lable>
                            <input type="text" name="title" value="{{ $product->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable>Desc</lable>
                            <textarea name="desc" class="form-control" id="desc" cols="30"
                                      rows="3">{{ $product->desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <lable>Content</lable>
                            <textarea name="content" class="form-control" id="content" cols="30"
                                      rows="5">{{ $product->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <lable>Images</lable>
                        </div>
                        <div class="form-group">
                            <div id="thumbnail">
                                <img class="img-thumbnail" id="image" src="{{ asset($product->thumbnail) }}"
                                     style="margin-top: 1rem; max-width: 300px;"/>
                            </div>
                            <label for="inputUpload" id="btn_upload"
                                   class="btn btn-outline-success font-weight-bolder font-size-sm mb-0">
                                <i class="spinner spinner-success d-none mr-5"></i>
                                <span>Đổi ảnh</span>
                            </label>
                            {{--                            <form action="" method="POST" id="change-thumbnail" class="d-none" enctype="multipart/form-data">--}}
                            {{--                                @csrf--}}
                            <input type="file" class="d-none" id="inputUpload" name="thumbnail" value=""
                                   onchange="changeThumbnail(this)">
                            {{--                            </form>--}}
                        </div>
                        <div class="form-group">
                            <lable>Is publish</lable>
                            <select name="is_publish" id="" class="form-control">
                                <option value="0">Choose</option>
                                <option value="1" @if($product->is_publish == 1) selected @endif>Publish</option>
                                <option value="2" @if($product->is_publish == 2) selected @endif>Unpublish</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <lable>Giá sản phẩm</lable>
                            <input type="text" name="price" value="{{ $product->price }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable>Categories</lable>
                            <select name="category_id" id="" class="form-control">
                                <option value="0">Choose</option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}"
                                            @if($product->category_id == $item->id) selected @endif>{{$item->title}}</option>
                                @endforeach
                                <option value="{{ $category_accessory->id }}"
                                        @if(isset($product->category->id) && $product->category->id == $category_accessory->id) selected @endif>{{ $category_accessory->title }}</option>
                            </select>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <lable>Phân loại thường - hot - hot header</lable>--}}
                        {{--                            <select name="is_hot" id="" class="form-control">--}}
                        {{--                                <option value="0" @if($product->is_hot == 0) selected @endif>Thường</option>--}}
                        {{--                                <option value="1" @if($product->is_hot == 1) selected @endif>Hot</option>--}}
                        {{--                                <option value="2" @if($product->is_hot == 2) selected @endif>Hot header</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-outline-success w-25" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @if($product->category->is_accessory != 1)
                <div class="card mx-4">
                    <div class="card-header">
                        @if (session('success_variant'))
                            <div class="alert alert-success mt-3" role="alert">{{session('success_variant')}}</div>
                        @endif
                        <h3>Variants</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="form_product_variant">
                            @csrf
                            <div class="form-group color_hex">
                                <lable>Color Hex</lable>
                                <input type="text" name="color_hex" id="colorpicker_variant"
                                       value="{{ old('color_hex') }}" class="form-control">
                                @error('color_hex')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group color_name">
                                <lable>Color Name</lable>
                                <input type="text" name="color_name" value="{{ old('color_name') }}"
                                       class="form-control">
                                @error('color_name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group size">
                                <lable>Size</lable>
                                <input type="text" name="size" value="{{ old('size') }}" class="form-control">
                                @error('size')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            {{--                            <div class="form-group">--}}
                            {{--                                <lable>Price</lable>--}}
                            {{--                                <input type="text" name="price" value="{{ old('price') }}" class="form-control">--}}
                            {{--                                @error('price')--}}
                            {{--                                <small class="text-danger">{{$message}}</small>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            <div class="form-group text-center">
                                {{--                                <input type="submit" class="btn btn-outline-success w-25" value="Thêm">--}}
                                <button type="button" onclick="addProductVariant(this)"
                                        class="btn btn-outline-success w-25">
                                    <i class="spinner spinner-dark mr-2 d-none"></i>Thêm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mx-4 mt-5">
                    <div class="card-header">
                        <h4>List Variants</h4>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tbl_list_variant">
                            <thead>
                            <tr>
                                <th>
                                    <span><label class="checkbox checkbox-single checkbox-all"><input type="checkbox">&nbsp;<span></span></label></span>
                                </th>
                                <th class=""><span>Color hex</span></th>
                                <th class=""><span>Color name</span></th>
                                <th class=""><span>Size</span></th>
                                <th class=""><span>Price</span></th>
                                <th><span>Actions</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--                        {{$product->ProductVariants}}--}}
                            @foreach($product->ProductVariants as $item)
                                <tr>
                                    <td>
                                    <span>
                                        <label class="checkbox checkbox-single">
                                            <input type="checkbox" value="1">&nbsp;
                                        </label>
                                    </span>
                                    </td>
                                    <td><span>{{ ($item->color)?$item->color->value:"" }}</span></td>
                                    <td><span>{{ ($item->color)?$item->color->name:"" }}</span></td>
                                    <td><span>{{ ($item->size)?$item->size->value:"" }}</span></td>
                                    <td><span>{{$item->price?$item->price:""}}</span></td>
                                    <td>
                                        <a href="{{ route('admin.product.variant.edit', ['id'=>$item->id]) }}"
                                           class="btn btn-icon btn-light btn-hover-primary btn-sm mr-1">
                                            <i class="fas fa-pen-alt"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                                           onclick="confirmDelete('#delete-variant-{{ $item->id }}');return false;">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <form method="POST" id="delete-variant-{{ $item->id }}"
                                              action="{{ route('admin.product.variant.delete', ['id'=>$item->id]) }}"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            <div class="card mx-4 mt-5">
                <div class="card-header">
                    <h4>Cài đặt ảnh nhỏ hiển thị</h4>
                </div>
                <input type="hidden" value="{{ $product->id }}" name="product_id">
                <div class="card-body">
                    <div class="form-group">
                        <div id="actions" class="row mb-4">
                            <div class="col-lg-7">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn btn-success fileinput-button dz-clickable">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add files...</span>
                                </span>
                                {{--                                <button type="submit" class="btn btn-primary start">--}}
                                {{--                                    <i class="glyphicon glyphicon-upload"></i>--}}
                                {{--                                    <span>Start upload</span>--}}
                                {{--                                </button>--}}
                                {{--                                <button type="reset" class="btn btn-warning cancel">--}}
                                {{--                                    <i class="glyphicon glyphicon-ban-circle"></i>--}}
                                {{--                                    <span>Cancel upload</span>--}}
                                {{--                                </button>--}}
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
                            @if($product->images)
                                @foreach(json_decode($product->images) as $image)
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
                                            <button class="btn btn-danger" onclick="deleteImageSingle(this)"
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
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js" type="text/javascript"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>--}}
    <script src="{{ url('/public/plugins/custom/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        $("#colorpicker_variant").spectrum();
        // var url_source = 'http://localhost/diana_authentic_shop/';

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var product_id = $("input[name='product_id']").val();

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: 'http://localhost/diana_authentic/admin/upload-images-dz', // Set the url
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
            console.log(product_id);
            formData.append('id', product_id);
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
            buttonDelete.setAttribute('onclick', 'deleteImageSingle(this)');
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
