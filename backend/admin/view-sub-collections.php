<?php
include 'functions.php';
include 'db.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM admin_sub_collections WHERE id='$delete_id'";
    $delete_check = mysqli_query($conn, $sql);
    if ($delete_check) {
        echo "<script type='text/javascript'>
                alert('Collection Deleted Successfully');
                window.location.href='view-sub-collections.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error deleting collection');
                window.location.href='view-sub-collections.php';
              </script>";
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
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Collection table</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">
                                                <div class="search_inner">
                                                    <form active="#">
                                                        <div class="search_field">
                                                            <input type="text" placeholder="Search content here...">
                                                        </div>
                                                        <button type="submit"> <i class="ti-search"></i> </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="add_button ms-2">
                                                <a href="add-sub-collections.php" data-bs-toggle="modal" data-bs-target="#addcategory"
                                                    class="btn_1">Add New</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="QA_table mb_30">

                                        <table class="table lms_table_active ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Sub Collection ID</th>
                                                    <th scope="col">Sub Collection Name</th>
                                                    <th scope="col">Parent Collection Name</th>
                                                    <th scope="col">Slug URL</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Added On</th>
                                                    <th scope="col">Actions</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo get_sub_Collections(); ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'?>