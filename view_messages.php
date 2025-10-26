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
            Admin Panel | ABC Builders & Suppliers
        </title>
        <link rel="stylesheet" href="./styles/main.css">
    </head>
    <body>
        <hr />
        <h1 id="header" style="text-align: left; margin: auto 0px; padding: 10px;">Admin Panel <br />ABC Builders & Suppliers</h1>
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

        <h2 class="header_2">Unanswered Customer Messages</h2>
        <section>
            <?php
                $sql = "SELECT name, email, message, msg_id
                        FROM messages
                        WHERE answered = 'NO';";
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

            <a href="#completed" class="add_mat_link" style="display: <?php echo $display_msg; ?>">You have no messages to answer!</a>

            <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>;">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th style="text-align: center;">Answered</th>
                </tr>
                <?php
                    if ($load_more ===1){
                            while ($row = $result -> fetch_assoc()){
                                $msg_id = $row['msg_id'];
                                $cust_name = $row['name'];
                                $email = $row['email'];
                                $msg = $row['message'];
                                echo '
                                    <tr>
                                        <td>'.$msg_id.'</td>
                                        <td>'.$cust_name.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$msg.'</td>
                                        <td style="text-align: center;"><a href="./process/answer_message.php?id='.$msg_id.'" class="update_mat_link">Answer</a></td>                                        
                                    </tr>
                                ';
                            }
                    }
                ?>
            </table>    
        </section>


        <h2 class="header_2">Answered Customer Messages</h2>
        <section>
            <?php
                $sql = "SELECT name, email, message, msg_id
                        FROM messages
                        WHERE answered = TRUE;";
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

            <a href="#completed" class="add_mat_link" style="display: <?php echo $display_msg; ?>">You have not answered any questions!</a>

            <table border="1" cellspacing="0" cellpadding="5" id="view_all_table" style="display: <?php echo  $display_table; ?>;">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th style="text-align: center;">Answered</th>
                </tr>
                <?php
                    if ($load_more ===1){
                            while ($row = $result -> fetch_assoc()){
                                $msg_id = $row['msg_id'];
                                $cust_name = $row['name'];
                                $email = $row['email'];
                                $msg = $row['message'];
                                echo '
                                    <tr>
                                        <td>'.$msg_id.'</td>
                                        <td>'.$cust_name.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$msg.'</td>
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