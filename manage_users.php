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
            Manage Users | ABC Builders & Suppliers
        </title>
        <link rel="stylesheet" href="./styles/main.css">
    </head>
    <body>
        <hr />
        <h1 id="header" style="text-align: left; margin: auto 0px; padding: 10px;">Manage Users<br />ABC Builders & Suppliers</h1>
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

        <a href="./add_user.php" class="view_all_link">Add a User</a>

        <h2 class="header_2">Users</h2>

        <section>
            <?php
                $sql = "SELECT id, username, email
                        FROM users
                        WHERE username != 'admin';";
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

            <a href="#completed" class="add_mat_link" style="display: <?php echo $display_msg; ?>">There is no user to show!</a>

            <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>;">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th style="text-align: center;">Edit Details</th>
                    <th style="text-align: center;">Delete</th>
                </tr>
                <?php
                    if ($load_more ===1){
                            while ($row = $result -> fetch_assoc()){
                                $user_id = $row['id'];
                                $cust_name = $row['username'];
                                $email = $row['email'];
                                echo '
                                    <tr>
                                        <td>'.$user_id.'</td>
                                        <td>'.$cust_name.'</td>
                                        <td>'.$email.'</td>
                                        <td><a href="edit_user.php?id='.$user_id.'">Edit</a></td>
                                        <td><a href="delete_user.php?id='.$user_id.'">Delete</a></td>
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