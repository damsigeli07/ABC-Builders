<?php
session_start();
require_once('connect.php');
$hide_log = "block";
$show_profile = "none";
$is_admin = false;
$id = 0;
$order_col = "block";
$hide_help = "inline-block";
if (isset($_SESSION['id'])) {
    $hide_log = "none";
    $show_profile = "block";
    $id = $_SESSION['id'];
    $sql = "SELECT username, role
            FROM users
            WHERE id = " . $id . ";";
    $result = mysqli_query($connection, $sql);
    $row = $result -> fetch_assoc();
    $name = $row['username'];
    $role = $row['role'];
    if ($role == 'admin') {
        $is_admin = true;
        $order_col = "none";
        $hide_help = "none";
    }
    elseif($role == 'delivery'){
        $order_col = "none";
    }
}
?>

<html>
    <head>
        <title>
            All Materials | ABC Builders & Suppliers
        </title>
        <link rel="stylesheet" href="./styles/main.css">
    </head>
    <body>
        <hr />
        <h1 id="header" style="text-align: left; margin: auto 0px; padding: 10px;">All Materials <br />ABC Builders & Suppliers</h1>
        <hr />

        <nav>
        <a style="margin-left: 4px;" href="./index.php">Home</a>
            <a href="materials.php">Our Materials</a>
            <a href="manual.php" style="display: <?php echo $hide_help; ?>">Help</a>
            <?php
                if ($is_admin === true) {
                    echo "<a href=\"admin_panel.php\">Admin</a> <a href=\"handle_orders.php\">Orders</a>";
                }
                elseif($role == "ordinary"){
                    echo "<a href=\"my_orders.php\">My Orders</a>";
                }
                elseif($role == "delivery") {
                    echo "<a href=\"deliveries.php\">Deliveries</a>"; 
                }
        ?>
            <a class="log_link" href="#login_form" style="display: <?php echo $hide_log ?>;">Log in</a>
            <a class="log_link" href="profile.php?id=<?php echo $id; ?>" style="display: <?php echo $show_profile ?>;">My Profile</a>
        </nav>
        <hr />

        <h2 class="header_2">
                <?php
                    $sql = "SELECT category_name
                            FROM material_category
                            WHERE category_id = ".$_GET['category'].";";

                    $result = mysqli_query($connection, $sql);
                    $row = $result -> fetch_assoc();
                    $category_name = $row['category_name'];
                    echo $category_name;
                ?>
        </h2>

        <section>
            <?php
                $sql = "SELECT *
                        FROM materials
                        WHERE category_id = ".$_GET['category'].";";
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


            <div id="material_list">
        <?php
            require_once('connect.php');
            $get_materials_sql = "SELECT *
                               FROM materials";
            $material_list = mysqli_query($connection, $get_materials_sql);
            /*if (mysqli_num_rows($material_list) > 0) {
                while ($row = $material_list -> fetch_assoc()) {
                    echo '*/
                    if ($load_more ===1){
                        while ($row = $result -> fetch_assoc()){
                            $id = $row['material_id'];
                            $name = $row['material_name'];
                            $quantity = $row['quantity'];
                            $price = $row['price'];
                            echo '
                            <div class="material_card">
                            <img src="./material_images/'. $row['material_name'] .'.'. $row['img_ext'].'" alt="" />
                            <div class="details">
                                <h4>Material name: '. $row['material_name'] .'</h4>
                                <p>Material ID: '. $row['material_id'] .'</p>
                                <p>Available: '. $row['quantity'] .'</p>
                                <p>Price: '. $row['price'] .'</p>
                            </div>
                            <a href="./order.php?id='. $row['material_id'] .'" class="view_material" style="display: '.$order_col.';">Order</a>
                        </div>';
                }
            }
            else {
                echo "<h3>Sorry, there is no material to show!</h3>";
            }
        ?>
        </div>




            <!-- <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>; width: fit-content">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price(Rs.)</th>
                    <th style="text-align: center; display: <?php echo $order_col; ?>">Order</th>
                </tr> 
                /* <?php
                    if ($load_more ===1){
                            while ($row = $result -> fetch_assoc()){
                                $id = $row['material_id'];
                                $name = $row['material_name'];
                                $quantity = $row['quantity'];
                                $price = $row['price'];
                                echo '
                                    <tr>
                                        <td>'.$id.'</td>
                                        <td>'.$name.'</td>
                                        <td>'.$quantity.'</td>
                                        <td>'.$price.'</td>
                                        <td style="text-align: center; display: '.$order_col.'"><a href="./order.php?id='.$id.'" class="delete_mat_link">Order</a></td>                                        
                                    </tr>
                                ';
                            }
                    }
                ?> */
            </table> -->
        </section>

        <footer style="width: 100%">
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>