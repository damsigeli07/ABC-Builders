<?php
session_start();
//Check Authorization for Admin Only pages
$user_id = $_SESSION['id'];
require_once('../connect.php');
$sql = "SELECT role
        FROM users
        WHERE id = ".$user_id.";";
$result = mysqli_query($connection, $sql);
$row = $result -> fetch_assoc();
$user_role = $row['role'];
if ($user_role != "admin"){
    header('Location: /material_management_system/');
}
?>

<?php
if (isset($_POST['submit'])) {
    $mat_name = $_POST['mat_name'];
    $cat_id = $_POST['cat_id'];
    $quantity = $_POST['quantity'];
    $added_date = $_POST['added_date'];
    $price = $_POST['mat_price'];
    $buy_price = $_POST['buy_price'];

    require_once('../connect.php');



 //Handling the File
            $mat_img = $_FILES['mat_img'];
            $extension = strtolower(pathinfo($mat_img['name'], PATHINFO_EXTENSION));
            $size = $mat_img['size'];
            $target_dir = "../material_images/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            //We want mat_name as file name because it allows us to show the image effectively.
            $target_file = $target_dir . $mat_name .'.'. $extension;
            $file_types = array('jpeg', 'png', 'jpg', 'gif');
            if (!in_array($extension,$file_types)) {
                header('Location: ../admin_panel?e=Incorrect image file type. Only JPEG, JPG, PNG, GIF allowd.');
                exit;
            }
            elseif ($size > 2 * 1024 * 1024) {
                header('Location: ../admin_panel?e=Image size is too large. Maximum file size is 2MB!');
                exit;
            }
            else{
                move_uploaded_file($mat_img['tmp_name'], $target_file);
            }







    $sql = "INSERT INTO materials(material_name, category_id, quantity, added_date, price, buy_price, img_ext)
            VALUES('". $mat_name ."', ". $cat_id .", ". $quantity .", '". $added_date ."',".$price.", ".$buy_price.", '".$extension."');";
    $sql_increment = "UPDATE material_category
                      SET quantity_all = quantity_all + ". $quantity .
                     " WHERE category_id = ". $cat_id .";";

    if (mysqli_query($connection, $sql) && mysqli_query($connection, $sql_increment)) {
        header('Location: ../admin_panel.php?s=Materials added successfully!');
        exit;
    }
    else{
        header('Location: ../admin_panel.php?e=Error occured while quering database!');
        exit;
    }
    
}
?>