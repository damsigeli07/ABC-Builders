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
    }
}
?>

<?php
//Check Authorization for Admin Only pages
$user_id = $_SESSION['id'];
require_once('./connect.php');
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
        <a style="margin-left: 4px;" href="/material_management_system/index.php">Home</a>
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
            <a class="log_link" href="profile.php" style="display: <?php echo $show_profile ?>;">My Profile</a>
        </nav>
        <hr />

        <a href="./admin_panel.php" class="view_all_link">Go back to Admin Panel</a>

        <section>
            <?php
                require_once('connect.php');
                $sql = "SELECT *
                        FROM materials";
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

            <a href="./admin_panel.php#add_mat" class="add_mat_link" style="display: <?php echo $display_msg; ?>">Sorry, there is no material to show. Add them now!</a>

            <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php
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
                                        <td><a href="./update_material.php?id='.$id.'" class="update_mat_link">Update</a></td>
                                        <td><a href="./process/delete_material.php?id='.$id.'" class="delete_mat_link">Delete</a></td>                                        
                                    </tr>
                                ';
                            }
                    }
                ?>
            </table>
        </section>

        <footer style="position: absolute; bottom: 0; width: 100%">
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>