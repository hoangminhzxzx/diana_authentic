<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    


    <link rel="stylesheet" href="<?php echo e(url('/public/plugins/custom/dropzone/dist/min/dropzone.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-header">
                    <?php if(session('success_product')): ?>
                        <div class="alert alert-success mt-3" role="alert"><?php echo e(session('success_product')); ?></div>
                    <?php endif; ?>
                    <?php if(session('status_update_variant')): ?>
                        <div class="alert alert-success mt-3" role="alert"><?php echo e(session('status_update_variant')); ?></div>
                    <?php endif; ?>
                    <?php if(session('status_delete_variant')): ?>
                        <div class="alert alert-success mt-3" role="alert"><?php echo e(session('status_delete_variant')); ?></div>
                    <?php endif; ?>
                    <h3>Update Product</h3>
                </div>
                
                <div class="card-body">
                    <form action="<?php echo e(route('admin.product.update', $product->id)); ?>" method="POST" id="uploadProduct"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <lable>Title</lable>
                            <input type="text" name="title" value="<?php echo e($product->title); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable>Desc</lable>
                            <textarea name="desc" class="form-control" id="desc" cols="30"
                                      rows="3"><?php echo e($product->desc); ?></textarea>
                        </div>
                        <div class="form-group">
                            <lable>Content</lable>
                            <textarea name="content" class="form-control" id="content" cols="30"
                                      rows="5"><?php echo e($product->content); ?></textarea>
                        </div>
                        <div class="form-group">
                            <lable>Images</lable>
                        </div>
                        <div class="form-group">
                            <div id="thumbnail">
                                <img class="img-thumbnail" id="image" src="<?php echo e(asset($product->thumbnail)); ?>"
                                     style="margin-top: 1rem; max-width: 300px;"/>
                            </div>
                            <label for="inputUpload" id="btn_upload"
                                   class="btn btn-outline-success font-weight-bolder font-size-sm mb-0">
                                <i class="spinner spinner-success d-none mr-5"></i>
                                <span>Đổi ảnh</span>
                            </label>
                            
                            
                            <input type="file" class="d-none" id="inputUpload" name="thumbnail" value=""
                                   onchange="changeThumbnail(this)">
                            
                        </div>
                        <div class="form-group">
                            <lable>Is publish</lable>
                            <select name="is_publish" id="" class="form-control">
                                <option value="0">Choose</option>
                                <option value="1" <?php if($product->is_publish == 1): ?> selected <?php endif; ?>>Publish</option>
                                <option value="2" <?php if($product->is_publish == 2): ?> selected <?php endif; ?>>Unpublish</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <lable>Giá sản phẩm</lable>
                            <input type="text" name="price" value="<?php echo e($product->price); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable>Categories</lable>
                            <select name="category_id" id="" class="form-control">
                                <option value="0">Choose</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"
                                            <?php if($product->category_id == $item->id): ?> selected <?php endif; ?>><?php echo e($item->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category_accessory->id); ?>"
                                        <?php if(isset($product->category->id) && $product->category->id == $category_accessory->id): ?> selected <?php endif; ?>><?php echo e($category_accessory->title); ?></option>
                            </select>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-outline-success w-25" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php if($product->category->is_accessory != 1): ?>
                <div class="card mx-4">
                    <div class="card-header">
                        <?php if(session('success_variant')): ?>
                            <div class="alert alert-success mt-3" role="alert"><?php echo e(session('success_variant')); ?></div>
                        <?php endif; ?>
                        <h3>Variants</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="form_product_variant">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id">
                            <div class="form-group color_hex">
                                <lable>Color Hex</lable>
                                <input type="text" name="color_hex" id="colorpicker_variant"
                                       value="<?php echo e(old('color_hex')); ?>" class="form-control">
                                <?php $__errorArgs = ['color_hex'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group color_name">
                                <lable>Color Name</lable>
                                <input type="text" name="color_name" value="<?php echo e(old('color_name')); ?>"
                                       class="form-control">
                                <?php $__errorArgs = ['color_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group size">
                                <lable>Size</lable>
                                <input type="text" name="size" value="<?php echo e(old('size')); ?>" class="form-control">
                                <?php $__errorArgs = ['size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group size">
                                <lable>Số lượng</lable>
                                <input type="text" name="qty" value="<?php echo e(old('qty')); ?>" class="form-control">
                                <?php $__errorArgs = ['qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            <div class="form-group text-center">
                                
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
                                <th class=""><span>Số lượng</span></th>
                                <th><span>Actions</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php $__currentLoopData = $product->ProductVariants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                    <span>
                                        <label class="checkbox checkbox-single">
                                            <input type="checkbox" value="1">&nbsp;
                                        </label>
                                    </span>
                                    </td>
                                    <td><span><?php echo e(($item->color)?$item->color->value:""); ?></span></td>
                                    <td><span><?php echo e(($item->color)?$item->color->name:""); ?></span></td>
                                    <td><span><?php echo e(($item->size)?$item->size->value:""); ?></span></td>
                                    <td><span><?php echo e(($item->qty)?$item->qty:""); ?></span></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.product.variant.edit', ['id'=>$item->id])); ?>"
                                           class="btn btn-icon btn-light btn-hover-primary btn-sm mr-1">
                                            <i class="fas fa-pen-alt"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                                           onclick="confirmDelete('#delete-variant-<?php echo e($item->id); ?>');return false;">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <form method="POST" id="delete-variant-<?php echo e($item->id); ?>"
                                              action="<?php echo e(route('admin.product.variant.delete', ['id'=>$item->id])); ?>"
                                              style="display: none;">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card mx-4 mt-5">
                <div class="card-header">
                    <h4>Cài đặt ảnh nhỏ hiển thị</h4>
                </div>
                <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id">
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
                            <?php if($product->images): ?>
                                <?php $__currentLoopData = json_decode($product->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div id="" class="file-row d-flex justify-content-between item-image-single">
                                        <!-- This is used as the file preview template -->
                                        <div class="">
                                            <div>
                                                <span class="preview"><img data-dz-thumbnail="" width="80" height="80"
                                                                           alt="" src="<?php echo e(asset($image)); ?>"/></span>
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
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <button class="btn btn-danger" onclick="deleteImageSingle(this)"
                                                    data-path="<?php echo e($image); ?>">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js" type="text/javascript"></script>

    <script src="<?php echo e(url('/public/plugins/custom/dropzone/dist/min/dropzone.min.js')); ?>"></script>
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
            formData.append("_token", "<?php echo e(csrf_token()); ?>");
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>