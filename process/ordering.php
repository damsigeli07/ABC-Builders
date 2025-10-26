<?php
    session_start();
    require_once('../connect.php');
    $o_name = $_POST['o_name'];
    $o_phone = $_POST['o_phone'];
    $o_email = $_POST['o_email'];
    $o_address = $_POST['o_address'];
    $o_mat_id = $_POST['o_mat_id'];
    $o_quantity = $_POST['o_quantity'];
    $o_cat_id = $_POST['o_cat_id'];
    $user_id = $_SESSION['id'];

    $sql = "INSERT INTO orders(customer_id, material_id, customer_name, phone, email, address, quantity)
            VALUES(".$user_id.", ".$o_mat_id.", '".$o_name."', '".$o_phone."', '".$o_email."', '".$o_address."', ".$o_quantity.");";
    if (mysqli_query($connection, $sql)) {
        $sql = "UPDATE materials
                SET quantity = quantity - ".$o_quantity."
                WHERE material_id = ".$o_mat_id.";";
        mysqli_query($connection, $sql);

        $sql = "UPDATE material_category
                SET quantity_all = quantity_all - ".$o_quantity."
                WHERE category_id = ".$o_cat_id.";";
        mysqli_query($connection, $sql);

        $msg = "Order Placed Successfully!";
        header('Location: ../order.php?id='.$o_mat_id.'&s='.$msg);
    }
    else{
        $msg = "Failded Placing the order!";
        header('Location: ../order.php?id='.$o_mat_id.'$e='.$msg);
    }
?>