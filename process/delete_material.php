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
    $id = $_GET['id'];
    require_once('../connect.php');
    $sql = "SELECT category_id, quantity
            FROM materials
            WHERE material_id = ".$id.";";
    $result = mysqli_query($connection, $sql);
    $row = $result -> fetch_assoc();
    $cat_id = $row['category_id'];
    $quantity = $row['quantity'];

    echo $cat_id;
    
    $sql = "UPDATE material_category
            SET quantity_all = quantity_all - ".$quantity."
            WHERE category_id = ".$cat_id.";";
    if (mysqli_query($connection, $sql)) {
        $sql = "DELETE FROM  materials
                WHERE material_id = ".$id.";";
        if (mysqli_query($connection, $sql)) {
            header('Location: ../view_all.php?s=Material Deleted Successfully!');
        }
        else{
            header('Location: ../view_all.php?e=Failed To Delete The Material!');  
        }
    }
?>