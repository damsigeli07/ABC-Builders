<?php
//Check Authorization for Admin Only pages
session_start();
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
    $msg_id = $_GET['id'];
    require_once('../connect.php');
    $sql = "UPDATE messages
            SET answered = TRUE
            WHERE msg_id = ".$msg_id.";";
    if (mysqli_query($connection, $sql)) {
        header('Location: ../view_messages.php?s=Message Answered Successfully!');
    }
    else{
        header('Location: ../view_messages.php?e=Failed to Answer the Message!');
    }
?>