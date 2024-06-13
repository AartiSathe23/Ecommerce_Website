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
    <?php include 'links.php' ?>
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
                                <form action="functions.php" method="POST">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="colname">Collection Name</label>
                                            <select name="parent_id" id="parent_id" class="form-control" onchange="updateSubCollectionOptions()">
                                                <option value="">--Select--</option>
                                                <?php foreach ($check as $value) { ?>
                                                    <option value="<?php echo $value['col_id']; ?>"><?php echo ucwords($value['col_name']);?></option>
                                                <?php  } ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-6">
                                            <label class="form-label" for="subcolname">Sub Collection Name</label>
                                            <select class="form-control" id="sub_col_name" name="col_name" required>
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>                                           
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="metatitle">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" placeholder="Meta Title" name="meta_title" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="metadesciption">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_desc" placeholder="Meta Description" name="meta_desc" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="metakeywords">Meta Keywords</label>
                                            <input type="text" class="form-control" id="meta_key" placeholder="Meta Keywords" name="meta_key" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="h1tag">H1 Tag</label>
                                            <input type="text" class="form-control" id="h1_tag" placeholder="H1 Tag" name="h1_tag" required>
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
                                    <button type="submit" id="add-sub-collections" name="add-sub-collections" class="btn btn-primary">Add Collection</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
    
    <script>
        function updateSubCollectionOptions() {
            const collectionDropdown = document.getElementById('parent_id');
            const subCollectionDropdown = document.getElementById('sub_col_name');
            const selectedCollection = collectionDropdown.options[collectionDropdown.selectedIndex].text.toLowerCase();

            const subCollectionOptions = {
                men: ['Men Shirts', 'Men T-Shirts', 'Men Hoodies', 'Men Bottomwear', 'Men Kurtas', 'Men Ethnics', 'Men Suits', 'Men Accessories', 'Men Footwear'],
                women: ['Women Tops', 'Women Kurtis', 'Women T-Shirts', 'Women Hoodies', 'Women Bottomwear', 'Women Kurta Set', 'Women Ethnics', 'Women Sarees', 'Women Jwellery', 'Women Accessories', 'Women Footwear', 'Women Beauty Collection', ],
                electronics: ['Bluetooth Devices', 'Camera Corner', 'Health & Personal Care', 'Mobile Accessories', 'Laptop Accessories', 'Gaming Accessories'],
                lifestyle: ['Space Saving Furniture', 'Home Beautification', 'Pet & Gardening'],
                books: ['Fictional Books', 'Non Fictional Books', 'Academics Books', 'Young Readers', 'Religion & Spirituality', 'Cookbooks & Health']
            };

            // Clear previous options
            subCollectionDropdown.innerHTML = '<option value="">--Select--</option>';

            if (subCollectionOptions[selectedCollection]) {
                subCollectionOptions[selectedCollection].forEach(function(option) {
                    const opt = document.createElement('option');
                    opt.value = option;
                    opt.text = option;
                    subCollectionDropdown.add(opt);
                });
            }
        }
    </script>
</body>
</html>
