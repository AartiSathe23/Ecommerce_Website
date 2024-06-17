<?php
include 'db.php';
session_start();
if(isset($_POST['add-collections'])){
    $col_id = mt_rand(11111,99999);
    $admin_id = $_SESSION['admin_id'];
    $col_name = $_POST['col_name'];
    $meta_title = $_POST['meta_title'];
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];
    $h1_tag = $_POST['h1_tag'];
    // $input_Status = $_POST['input_Status'];
    $added_on = date('M d, Y');
    $slug_url = SlugUrl($col_name);

    $sql = "INSERT INTO admin_collections (col_id, admin_id, col_name, meta_title,
    meta_desc, meta_key, h1_tag, input_status, slug_url, added_on)VALUES('$col_id', '$admin_id', '$col_name', '$meta_title', '$meta_desc', '$meta_key', '$h1_tag', 1, '$slug_url',  '$added_on')";

    $check = mysqli_query($conn,$sql);
      if($check){
        ?>
        <script type="text/javascript">
            alert("Collection Added Successfully");
            window.location.href="view-collections.php";
        </script>
        <?php
      }
}

if(isset($_POST['add-sub-collections'])){
    $col_id = mt_rand(11111,99999);
    $admin_id = $_SESSION['admin_id'];
    $parent_id = $_POST['parent_id'];
    $col_name = $_POST['col_name'];
    $meta_title = $_POST['meta_title'];
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];
    $h1_tag = $_POST['h1_tag'];
    $added_on = date('M d, Y');
    $slug_url = SlugUrl($col_name);

    $sql = "INSERT INTO admin_sub_collections (col_id, admin_id, parent_id, col_name, meta_title, meta_desc, meta_key, h1_tag, input_status, slug_url, added_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $col_id, $admin_id, $parent_id, $col_name, $meta_title, $meta_desc, $meta_key, $h1_tag, $slug_url, $added_on);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                alert('Sub Collection Added Successfully');
                window.location.href='view-sub-collections.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error adding sub-collection');
              </script>";
    }

    $stmt->close();
}


if(isset($_POST['add-products'])){
    $pro_id = mt_rand(11111,99999);
    $admin_id = $_SESSION['admin_id'];
    $pro_name = $_POST['pro_name'];
    $brand = $_POST['brand'];
    $pro_desc = $_POST['pro_desc'];
    $pro_col = $_POST['pro_col'];
    $pro_sub_col = $_POST['pro_sub_col'];
    $sku = $_POST['sku'];
    $mrp = $_POST['mrp'];
    $sell_price = $_POST['sell_price'];
    $quantity = $_POST['quantity'];
    $meta_title = $_POST['meta_title'];
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];
    $h1_tag = $_POST['h1_tag'];
    $input_status = $_POST['input_status'];
    $added_on = date('M d, Y');
    $slug_url = SlugUrl($pro_name);
    $file_name = $_FILES['pro_img']['name'];
    $file_tmp = $_FILES['pro_img']['tmp_name'];
    $target_dir = "assets/uploads/";
    $target_file = $target_dir .$file_name;
    // $uploadOk = 1;
    move_uploaded_file($file_tmp,$target_file);

    $sql = "INSERT INTO admin_products (pro_id, admin_id, pro_name, brand, pro_desc, pro_col, pro_sub_col, sku, pro_img, mrp, sell_price, quantity, meta_title, meta_desc, meta_key, h1_tag, input_status, slug_url, added_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $pro_id, $admin_id, $pro_name, $brand, $pro_desc, $pro_col, $pro_sub_col, $sku, $target_file, $mrp, $sell_price, $quantity, $meta_title, $meta_desc, $meta_key, $h1_tag, $input_status, $slug_url, $added_on);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Query executed successfully
            ?>
            <script type="text/javascript">
                alert("Product Added Successfully");
                window.location.href="view-products.php";
            </script>
            <?php
        } else {
            // Error handling if the query fails
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error handling if the prepared statement fails
        echo "Error: " . mysqli_error($conn);
    }

    }

function get_Collections() {
    include 'db.php';
    $admin_id = $_SESSION['admin_id']; 
    $sql = "SELECT * FROM admin_collections WHERE admin_id = '$admin_id' ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);
    $sno = 1;
    $output = ""; // Initialize the output variable as an empty string
    while ($result = mysqli_fetch_assoc($check)) {
        // Append each row to the output variable with update and delete buttons
        $output .= "<tr>
                    <td>".$sno++."</td>
                    <td>".$result['col_id']."</td>
                    <td>".ucwords($result['col_name'])."</td>
                    <td>".$result['slug_url']."</td>
                    <td>".$result['input_status']."</td>
                    <td>".$result['added_on']."</td>
                    <td>
                        <a href='view-collections.php?delete_id=".$result['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this collection?\");'>Delete</a>
                    </td>
                   </tr>";
    }
    return $output;
}

function get_sub_Collections(){
    include 'db.php';
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT * FROM admin_sub_collections WHERE admin_id = '$admin_id' ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);
    $sno = 1;
    $output = "";

    while ($result = mysqli_fetch_assoc($check)) {
        $parent_id = $result['parent_id'];

        // Check if parent collection still exists
        $sql2 = "SELECT col_name FROM admin_collections WHERE col_id='$parent_id'";
        $parent_check = mysqli_query($conn, $sql2);
        $parent_result = mysqli_fetch_assoc($parent_check);

        $parent_name = $parent_result ? $parent_result['col_name'] : 'Deleted Parent';

        // Append each row to the output variable
        $output .= "<tr>
                    <td>".$sno++."</td>
                    <td>".$result['col_id']."</td>
                    <td>".ucwords($result['col_name'])."</td>
                    <td>".ucwords($parent_name)."</td>
                    <td>".$result['slug_url']."</td>
                    <td>".$result['input_status']."</td>
                    <td>".$result['added_on']."</td>
                    <td>
                        <a href='view-sub-collections.php?delete_id=".$result['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this sub-collection?\");'>Delete</a>
                    </td>
                </tr>";
    }
    return $output;
}


function get_Products(){
    include 'db.php';
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT * FROM admin_products WHERE admin_id = '$admin_id' ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);
    $sno = 1;
    $output = ""; // Initialize the output variable as an empty string

    while ($result = mysqli_fetch_assoc($check)) {
        // Append each row to the output variable with update and delete buttons
        $output .= "<tr>
                    <td>".$sno++."</td>
                    <td>".$result['pro_id']."</td>
                    <td>".ucwords($result['pro_name'])."</td>
                    <td>".ucwords($result['pro_col'])."</td>
                    <td>".ucwords($result['pro_sub_col'])."</td>
                    <td>".$result['sku']."</td>
                    <td><img src='".$result['pro_img']."' alt='".ucwords($result['pro_name'])."' style='width: 50px; height: auto;'></td>
                    <td>".$result['mrp']."</td>
                    <td>".$result['sell_price']."</td>
                    <td>".$result['quantity']."</td>
                    <td>".$result['input_status']."</td>
                    <td>".$result['added_on']."</td>
                    <td>
                        <a href='view-products.php?delete_id=".$result['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>
                    </td>
                   </tr>";
    }
    return $output;
}


function get_Customers(){
    include 'db.php';
    $sql = "SELECT * FROM customer_management ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);
    $sno = 1;
    $output = ""; // Initialize the output variable as an empty string

    while ($result = mysqli_fetch_assoc($check)) {
        // Append each row to the output variable with update and delete buttons
        $output .= "<tr>
                    <td>".$sno++."</td>
                    <td>".$result['cust_id']."</td>
                    <td>".ucwords($result['name'])."</td>
                    <td>".$result['phone']."</td>
                    <td>".$result['email']."</td>
                    <td>".$result['city']."</td>
                    <td>".$result['state']."</td>
                    <td>".$result['country']."</td>
                    <td>".$result['postal_code']."</td>
                   </tr>";
    }
    return $output;
}

function get_Orders(){
    include 'db.php';
    $sql = "SELECT * FROM customer_orders ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);
    $sno = 1;
    $output = ""; // Initialize the output variable as an empty string

    while ($result = mysqli_fetch_assoc($check)) {
        // Append each row to the output variable with update and delete buttons
        $output .= "<tr>
                    <td>".$sno++."</td>
                    <td>".$result['cust_id']."</td>
                    <td>".$result['pro_id']."</td>
                    <td>".ucwords($result['cust_name'])."</td>
                    <td>".$result['phone']."</td>
                    <td>".$result['address']."</td>
                    <td>".$result['payment']."</td>
                    <td>".$result['status']."</td>
                    <td>".$result['total_price']."</td>
                    <td>".$result['quantity']."</td>
                    <td>".$result['order_date']."</td>
                   </tr>";
    }
    return $output;
}

if (isset($_POST['col_id'])) {
    $p_id = $_POST['col_id'];
    $sql = "SELECT * FROM admin_sub_collections WHERE parent_id = $p_id ORDER BY id DESC";
    $check = mysqli_query($conn, $sql);
    echo '<option value="">--Select--</option>';
    while ($result = mysqli_fetch_assoc($check)) {
        echo '<option value="'.$result['col_id'].'">'.ucwords($result['col_name']).'</option>';
    }
    exit;
}




function SlugUrl($string){
    // $slug = trim($string);
    $slug = preg_replace('/[^A-Za-z0-9 -]+/', '', $string);
    $slug = str_replace(' ', '-', $slug);
    $slug = strtolower($slug);
    return $slug;

}
?>	


