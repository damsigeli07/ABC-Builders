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
        $cat_name = $_POST['cat_name'];
        require_once('../connect.php');
        $sql = "SELECT category_id
                FROM material_category
                WHERE category_name = '". $cat_name ."'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            header('Location: ../admin_panel.php?e=Material Category already exists!');
        }
        else{
            //Handling the File
            $cat_img = $_FILES['cat_img'];
            $extension = strtolower(pathinfo($cat_img['name'], PATHINFO_EXTENSION));
            $size = $cat_img['size'];
            //echo $size . ", " . $extension;
            $target_dir = "../category_images/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            //We want cat_name as file name because it allows us to show the image effectively.
            $target_file = $target_dir . $cat_name .'.'. $extension;
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
                move_uploaded_file($cat_img['tmp_name'], $target_file);
            }

            $unit = $_POST['unit'];
            require_once('../connect.php');
            $sql = "INSERT INTO material_category(category_name, unit, extension)
                    VALUES ('".$cat_name."', '".$unit."', '".$extension."')";
            if (mysqli_query($connection, $sql)){
                header('Location: ../admin_panel.php?s='. $cat_name .' added to the categories succesfully!');
                exit;
            }
            else{
                header('Location: ../admin_panel.php?e=Error occured while quering the database!'); 
                exit;
            }
        }

    }
?>