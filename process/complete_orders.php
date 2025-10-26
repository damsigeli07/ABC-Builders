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
    require_once('../connect.php');

    $sql = "UPDATE orders
            SET sent = 'ON_WAY'
            WHERE order_id = ".$_GET['id'].";";
    if (mysqli_query($connection, $sql)) {
        header('Location: ../handle_orders.php?s=Order ID: '.$_GET['id'].' completed successfully!');
    }
    else{
        header('Location: ../handle_orders.php?e=Failed Completing the Order ID: '.$_GET['id']);
    }
    
?>