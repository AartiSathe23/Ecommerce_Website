<?php
include 'db.php';

    $sql = "SELECT * FROM admin_collections ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="zxx">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sales</title>
    <link rel="icon" href="assets/logo.png" type="image/png">

    <?php include 'links.php'?>
</head>

<body class="crm_body_bg">
    <?php include 'header.php' ?>
    

        <div class="main_content_iner ">
            <div class="container-fluid p-0 sm_padding_15px">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Product Details</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="card-body">
                                    <form action="functions.php" method="POST" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="proname">Product Name</label>
                                                <input type="text" class="form-control" id="pro_name"
                                                    placeholder="Product Name" name="pro_name" required>
                                            </div> 
                                            <div class="col-md-6">
                                                <label class="form-label" for="brand">Brand</label>
                                                <input type="text" class="form-control" id="brand"
                                                    placeholder="Brand" name="brand" required>
                                            </div>                                           
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="pro_desc">Product Description</label>
                                                <textarea class="form-control" id="pro_desc" name="pro_desc" ></textarea>
                                            </div>                                           
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="colname">Collection Name</label>
                                                <select name="pro_col" id="parent_id" class="form-control" onchange="get_sub_collections(this.value)">
                                                    <option value="">--Select--</option>
                                                    <?php foreach ($check as $value) { ?>
                                                        <option value="<?php echo $value['col_id']; ?>"><?php echo ucwords($value['col_name']);?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="colname">Sub Collection Name</label>
                                                <select name="pro_sub_col" id="subcol_id" class="form-control">
                                                    <option value="">--Select--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="sku">Stock Keeping Unit(SKU)</label>
                                                <input type="text" class="form-control" id="sku"
                                                    placeholder="SKU" name="sku" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="pro_img">Image</label>
                                                <input type="file" class="form-control" id="pro_img"
                                                    placeholder="" name="pro_img" required >
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="mrp">MRP</label>
                                                <input type="text" class="form-control" id="mrp"
                                                    placeholder="Cost Price" name="mrp" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="sell_price">Selling Price</label>
                                                <input type="text" class="form-control" id="sell_price"
                                                    placeholder="Selling Price" name="sell_price" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="quantity">Stock Quantity</label>
                                                <input type="text" class="form-control" id="quantity"
                                                    placeholder="Stock Available" name="quantity" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="metatitle">Meta Title</label>
                                                <input type="text" class="form-control mb-3" id="meta_title"
                                                    placeholder="Meta Title" name="meta_title" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="metadesciption">Meta Description</label>
                                                <input type="text" class="form-control" id="meta_desc"
                                                    placeholder="Meta Description" name="meta_desc" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 ">
                                                <label class="form-label" for="metakeywords">Meta Keywords</label>
                                                <input type="text" class="form-control" id="meta_key"
                                                    placeholder="Meta Keywords" name="meta_key" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="h1tag">H1 Tag</label>
                                                <input type="text" class="form-control" id="h1_tag"
                                                    placeholder="H1 Tag" name="h1_tag" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="input_status">Status</label>
                                                <select id="input_status" name="input_status" class="form-control" required>
                                                    <option selected>--Select--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" id="add-products" name="add-products" class="btn btn-primary">Add Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'?>
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('pro_desc', {
            height: 300,
            toolbar: [
                { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
                { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },
                '/',
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
                { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
                '/',
                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
                { name: 'about', items: ['About'] }
            ],
        });

        function get_sub_collections(col_id) {
            if (col_id) {
                $.ajax({
                    url: 'functions.php',
                    method: 'POST',
                    data: {col_id: col_id},
                    success: function(data) {
                        $('#subcol_id').html(data);
                    },
                    error: function() {
                        alert("Something went wrong");
                    }
                });
            } else {
                $('#subcol_id').html('<option value="">--Select--</option>');
            }
        }
    </script>
</body>
</html>