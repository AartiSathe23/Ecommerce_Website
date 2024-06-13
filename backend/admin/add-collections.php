<?php
include 'db.php';

function collectionExists($collectionName) {
    global $conn;
    $collectionName = mysqli_real_escape_string($conn, $collectionName);
    $sql = "SELECT * FROM admin_collections WHERE col_name = '$collectionName'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

if (isset($_POST['add-collections'])) {
    $col_name = $_POST['col_name'];
    $meta_title = $_POST['meta_title'];
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];
    $h1_tag = $_POST['h1_tag'];
    $input_Status = $_POST['input_Status'];

    // Check if collection already exists
    if (collectionExists($col_name)) {
        echo "<script>alert('Collection already exists!');</script>";
    } else {
        // Proceed with adding the collection to the database
        // Your insertion code here...
    }
}
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
                                        <h3 class="m-0">Collection Details</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="card-body">
                                    <form  action="functions.php" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="colname">Collection Name</label>
                                                <select id="col_name" name="col_name" class="form-control" required>
                                                    <option selected>--Select--</option>
                                                    <option>Men</option>
                                                    <option>Women</option>
                                                    <option>Electronics</option>
                                                    <option>Lifestyle</option>
                                                    <option>Books</option>
                                                </select>
                                            </div>                                           
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="metatitle">Meta Title</label>
                                                <input type="text" class="form-control" id="meta_title"
                                                    placeholder="Meta Title" name="meta_title" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="metadesciption">Meta Description</label>
                                                <input type="text" class="form-control" id="meta_desc"
                                                    placeholder="Meta Description" name="meta_desc" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
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
                                                <label class="form-label" for="inputStatus">Status</label>
                                                <select id="inputStatus" name="input_Status" class="form-control" required>
                                                    <option selected>--Select--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" id="add-collections" name="add-collections" class="btn btn-primary">Add Collection</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'?>
        