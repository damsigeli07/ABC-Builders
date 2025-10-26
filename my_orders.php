<?php
session_start();
$hide_log = "block";
$show_profile = "none";
$is_admin = false;
$id = 0;
$hide_help = "inline-block";
if (isset($_SESSION['id'])) {
    $hide_log = "none";
    $show_profile = "block";
    $id = $_SESSION['id'];
    require_once('connect.php');
    $sql = "SELECT username, role
            FROM users
            WHERE id = " . $id . ";";
    $result = mysqli_query($connection, $sql);
    $row = $result -> fetch_assoc();
    $name = $row['username'];
    $role = $row['role'];
    if ($role == 'admin') {
        $is_admin = true;
        $hide_help = "none";
        header('Location: ./');
    }
    elseif($role == 'delivery'){
        header('Location: ./');
    }
}
?>

<html>
    <head>
        <title>
            My Orders | ABC Builders & Suppliers
        </title>
        <link rel="stylesheet" href="./styles/main.css">
    </head>
    <body>
        <hr />
        <h1 id="header" style="text-align: left; margin: auto 0px; padding: 10px;">My Orders<br />ABC Builders & Suppliers</h1>
        <hr />

        <div id="system_msg">
            <strong>System Messages</strong>
            <?php
                if(isset($_GET['e'])) {
                    $error_msg = $_GET['e'];
                    echo '<div id="error_msg">'. $error_msg .'</div>';
                }
                elseif(isset($_GET['s'])){
                    $success_msg = $_GET['s'];
                    echo '<div id="success_msg">'. $success_msg .'</div>';
                }
            ?>
        </div>

        <nav>
        <a style="margin-left: 4px;" href="./index.php">Home</a>
            <a href="materials.php">Our Materials</a>
            <a href="manual.php" style="display: <?php echo $hide_help; ?>">Help</a>
            <?php
                if ($is_admin === true) {
                    echo "<a href=\"admin_panel.php\">Admin</a> <a href=\"handle_orders.php\">Orders</a>";
                }
                elseif(isset($role)){
                    echo "<a href=\"my_orders.php\">My Orders</a>";
                }
            ?>
            <a class="log_link" href="#login_form" style="display: <?php echo $hide_log ?>;">Log in</a>
            <a class="log_link" href="profile.php?id=<?php echo $id; ?>" style="display: <?php echo $show_profile ?>;">My Profile</a>
        </nav>
        <hr />

        <h2 class="header_2" id="not_completed">Orders To Be Completed</h2>

        <section>
            <?php
                $sql = "SELECT orders.order_id, orders.customer_name, orders.address, orders.phone, orders.email, orders.quantity, materials.material_name
                        FROM orders
                        INNER JOIN materials ON orders.material_id = materials.material_id
                        WHERE sent = 'NO' AND customer_id = ".$id.";";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) === 0){
                    $display_table = "none";
                    $display_msg = "block";
                    $load_more = 0;
                }
                else {
                    $display_table = "block";
                    $display_msg = "none";
                    $load_more = 1;
                }
            ?>

            <a href="#completed" class="add_mat_link" style="display: <?php echo $display_msg; ?>">All the orders are completed!</a>

            <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>;">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Material Name</th>
                    <th>Quantity</th>
                    <th style="text-align: center;">Order</th>
                </tr>
                <?php
                    if ($load_more ===1){
                            while ($row = $result -> fetch_assoc()){
                                $order_id = $row['order_id'];
                                $cust_name = $row['customer_name'];
                                $address = $row['address'];
                                $phone = $row['phone'];
                                $email = $row['email'];
                                $material_name = $row['material_name'];
                                $quantity = $row['quantity'];
                                echo '
                                    <tr>
                                        <td>'.$order_id.'</td>
                                        <td>'.$cust_name.'</td>
                                        <td>'.$address.'</td>
                                        <td>'.$phone.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$material_name.'</td>
                                        <td>'.$quantity.'</td>
                                        <td style="text-align: center;">Not Done</td>                                        
                                    </tr>
                                ';
                            }
                    }
                ?>
            </table>    
        </section>

        <h2 class="header_2" id="not_completed">Orders On The Way</h2>

        <section>
            <?php
                $sql = "SELECT orders.order_id, orders.customer_name, orders.address, orders.phone, orders.email, orders.quantity, materials.material_name
                        FROM orders
                        INNER JOIN materials ON orders.material_id = materials.material_id
                        WHERE sent = 'ON_WAY' AND customer_id = ".$id.";";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) === 0){
                    $display_table = "none";
                    $display_msg = "block";
                    $load_more = 0;
                }
                else {
                    $display_table = "block";
                    $display_msg = "none";
                    $load_more = 1;
                }
            ?>

            <a href="#completed" class="add_mat_link" style="display: <?php echo $display_msg; ?>">All the orders are completed!</a>

            <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>;">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Material Name</th>
                    <th>Quantity</th>
                    <th style="text-align: center;">Order</th>
                </tr>
                <?php
                    if ($load_more ===1){
                            while ($row = $result -> fetch_assoc()){
                                $order_id = $row['order_id'];
                                $cust_name = $row['customer_name'];
                                $address = $row['address'];
                                $phone = $row['phone'];
                                $email = $row['email'];
                                $material_name = $row['material_name'];
                                $quantity = $row['quantity'];
                                echo '
                                    <tr>
                                        <td>'.$order_id.'</td>
                                        <td>'.$cust_name.'</td>
                                        <td>'.$address.'</td>
                                        <td>'.$phone.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$material_name.'</td>
                                        <td>'.$quantity.'</td>
                                        <td style="text-align: center;">On the Way</td>                                        
                                    </tr>
                                ';
                            }
                    }
                ?>
            </table>    
        </section>


        <h2 class="header_2" id="completed">Completed Orders</h2>

        <section>
            <?php
                $sql = "SELECT orders.order_id, orders.customer_name, orders.address, orders.phone, orders.email, orders.quantity, materials.material_name
                        FROM orders
                        INNER JOIN materials ON orders.material_id = materials.material_id
                        WHERE sent = 'YES' AND customer_id = ".$id.";";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) === 0){
                    $display_table = "none";
                    $display_msg = "block";
                    $load_more = 0;
                }
                else {
                    $display_table = "block";
                    $display_msg = "none";
                    $load_more = 1;
                }
            ?>

            <a href="#not_completed" class="add_mat_link" style="display: <?php echo $display_msg; ?>">Your orders are not completed yet!</a>

            <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Material Name</th>
                    <th>Quantity</th>
                    <th style="text-align: center;">Order</th>
                </tr>
                <?php
                    if ($load_more ===1){
                            while ($row = $result -> fetch_assoc()){
                                $order_id = $row['order_id'];
                                $cust_name = $row['customer_name'];
                                $address = $row['address'];
                                $phone = $row['phone'];
                                $email = $row['email'];
                                $material_name = $row['material_name'];
                                $quantity = $row['quantity'];
                                echo '
                                    <tr>
                                        <td>'.$order_id.'</td>
                                        <td>'.$cust_name.'</td>
                                        <td>'.$address.'</td>
                                        <td>'.$phone.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$material_name.'</td>
                                        <td>'.$quantity.'</td>
                                        <td style="text-align: center;">Done</td>                                        
                                    </tr>
                                ';
                            }
                    }
                ?>
            </table>    
        </section>

        <footer>
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>