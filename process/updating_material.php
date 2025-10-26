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
    if (isset($_POST['update'])){
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $id = $_POST['id'];
        require_once("../connect.php");
        $sql = "SELECT quantity, category_id
                FROM materials
                WHERE material_id = ".$id.";";
        $result = mysqli_query($connection, $sql);
        $row = $result -> fetch_assoc();
        $prev_q = $row['quantity'];
        $cat_id = $row['category_id'];

        $sql = "UPDATE material_category
                SET quantity_all = quantity_all - ".$prev_q." + ".$quantity."
                WHERE category_id = ".$cat_id.";";
        mysqli_query($connection, $sql);

        $sql = "UPDATE materials
                SET price = ".$price.", quantity = ".$quantity."
                WHERE material_id = ".$id.";";
        mysqli_query($connection, $sql);

        header('Location: ../update_material.php?id='.$id.'&s=Material Details Updated Successfully!');
    }
    else{
        header('Location: ../update_material.php?id='.$id.'&e=Failded To Upadate Material Details!');
    }
?>