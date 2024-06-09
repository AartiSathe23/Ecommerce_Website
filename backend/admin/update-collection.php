<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM admin_collections WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $collection = mysqli_fetch_assoc($result);
}

if (isset($_POST['update-collection'])) {
    $id = $_POST['id'];
    $col_name = $_POST['col_name'];
    $meta_title = $_POST['meta_title'];
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];
    $h1_tag = $_POST['h1_tag'];
    // $input_status = $_POST['input_status'];
    $slug_url = SlugUrl($col_name);

    $sql = "UPDATE admin_collections SET 
            col_name='$col_name', 
            meta_title='$meta_title', 
            meta_desc='$meta_desc', 
            meta_key='$meta_key', 
            h1_tag='$h1_tag', 
            -- input_status='$input_status', 
            slug_url='$slug_url' 
            WHERE id='$id'";

    $update_check = mysqli_query($conn, $sql);
    if ($update_check) {
        echo "<script type='text/javascript'>
                alert('Collection Updated Successfully');
                window.location.href='view-collections.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error updating collection');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Collection</title>
    <?php include 'links.php'?>
</head>
<body>
<?php include 'header.php' ?>
    <section class="main_content dashboard_part large_header_bg">

        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-lg-12 p-0 ">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="serach_field-area d-flex align-items-center">
                            <div class="search_inner">
                                <form action="#">
                                    <div class="search_field">
                                        <input type="text" placeholder="Search here...">
                                    </div>
                                    <button type="submit"> <img src="assets/icon/icon_search.svg" alt> </button>
                                </form>
                            </div>
                            <span class="f_s_14 f_w_400 ml_25 white_text text_white">Apps</span>
                        </div>
                        <div class="header_right d-flex justify-content-between align-items-center">
                            <div class="header_notification_warp d-flex align-items-center">
                                <li>
                                    <a class="bell_notification_clicker nav-link-notify" href="#"> <img
                                            src="assets/icon/bell.svg" alt>
                                    </a>

                                    <div class="Menu_NOtification_Wrap">
                                        <div class="notification_Header">
                                            <h4>Notifications</h4>
                                        </div>
                                        <div class="Notification_body">

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="assets/staf/2.png" alt></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Cool Marketing </h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="assets/staf/4.png" alt></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Awesome packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="assets/staf/3.png" alt></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>what a packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="assets/staf/2.png" alt></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Cool Marketing </h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="assets/staf/4.png" alt></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>Awesome packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="assets/staf/3.png" alt></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#">
                                                        <h5>what a packages</h5>
                                                    </a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nofity_footer">
                                            <div class="submit_button text-center pt_20">
                                                <a href="#" class="btn_1">See More</a>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li>
                                    <a class="CHATBOX_open nav-link-notify" href="#"> <img src="assets/icon/msg.svg" alt>
                                    </a>
                                </li>
                            </div>
                            <div class="profile_info">
                                <img src="assets/client_img.png" alt="#">
                                <div class="profile_info_iner">
                                    <div class="profile_author_name">
                                        <p>Neurologist </p>
                                        <h5>Dr. Robar Smith</h5>
                                    </div>
                                    <div class="profile_info_details">
                                        <a href="#">My Profile </a>
                                        <a href="#">Settings</a>
                                        <a href="#">Log Out </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main_content_iner ">
            <div class="container-fluid p-0 sm_padding_15px">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Update Details</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="card-body">
                                    <form action="update-collection.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $collection['id']; ?>">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="colname">Collection Name</label>
                                                <input type="text" class="form-control" id="col_name"
                                                    placeholder="Collection Name" value="<?php echo $collection['col_name']; ?>" name="col_name" required>
                                            </div>                                           
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="metatitle">Meta Title</label>
                                                <input type="text" class="form-control" id="meta_title"
                                                    placeholder="Meta Title" value="<?php echo $collection['meta_title']; ?>" name="meta_title" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="metadesciption">Meta Description</label>
                                                <input type="text" class="form-control" id="meta_desc"
                                                    placeholder="Meta Description" value="<?php echo $collection['meta_desc']; ?>" name="meta_desc" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="metakeywords">Meta Keywords</label>
                                                <input type="text" class="form-control" id="meta_key"
                                                    placeholder="Meta Keywords" value="<?php echo $collection['meta_key']; ?>" name="meta_key" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="h1tag">H1 Tag</label>
                                                <input type="text" class="form-control" id="h1_tag"
                                                    placeholder="H1 Tag" value="<?php echo $collection['h1_tag']; ?>" name="h1_tag" required>
                                            </div>
                                        </div>
                                        <!-- <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="inputStatus">Status</label>
                                                <select id="inputStatus" value="<?php echo $collection['input_status']; ?>" name="input_Status" class="form-control" required>
                                                    <option selected>--Select--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Deactive</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <button type="submit" name="update-collection">Update Collection</button>                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'?>

