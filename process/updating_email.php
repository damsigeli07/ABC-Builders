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
    header('Location: ../');
}
?>

<?php
    if (isset($_POST['update'])){
        $email = $_POST['email'];
        $id = $_POST['id'];
        require_once("../connect.php");

        $sql = "UPDATE users
                SET email = '".$email."'
                WHERE id = ".$id.";";
        
        if (mysqli_query($connection, $sql)){
            header('Location: ../edit_user.php?id='.$id.'&s=Email Updated Successfully!');
        }
        else{
            header('Location: ../edit_user.php?id='.$id.'&e=Failded To Upadate Email!');
        }
    }
    else{
        header('Location: ../edit_user.php?id='.$id.'&e=Failded To Upadate Email!');
    }
?>