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
    header('Location: ./');
}
?>

<html>
<head>
    <title>
        Order | ABC Builders Material Management System
    </title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <hr />
    <h1 id="header">Order<br />ABC Builders & Suppliers</h1>
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
        <a style="margin-left: 4px;" href="./">Home</a>
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
    <?php
        $sql = "SELECT username, email
                FROM users
                WHERE id = ".$_GET['id'].";";
        $result = mysqli_query($connection, $sql);
        $row = $result -> fetch_assoc();
        $name = $row['username'];
        $email = $row['email'];
    ?>
    <div id="profile_content">
        <div><span class="key">ID: </span><span class="value"><?php echo $_GET['id']; ?></span></div>
        <hr style="height: 1px;" />
        <div><span class="key">Username: </span><span class="value"><?php echo $name; ?></span> </div>
        <hr style="height: 1px;" />
        <div><span class="key">Email: </span><span class="value"><?php echo $email  ?></span> </div>
    </div>
    <form action="./process/updating_email.php" class="forms" method="post">
        <h2 class="header_2">Update Email</h2>
        <div class="input_div">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="pqr@example.com" required />
        </div>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" name="update" value="Update" class="send_button" />
    </form>

    <form action="" class="forms" method="post">
        <h2 class="header_2">Change Password of the User</h2>
        <div class="input_div">
            <label for="c_pass">Enter Your Password</label>
            <input type="password" name="c_pass" required />
        </div>
        <div class="input_div">
            <label for="n_pass">Enter New Password for user</label>
            <input type="password" name="n_pass" required />
        </div>
        <div class="input_div">
            <label for="n_pass">Re-Enter New Password for user</label>
            <input type="password" required>
        </div>
        <input type="submit" name="change_pass" value="Change" class="send_button" />
        <?php
            $sql = "SELECT password_change
                    FROM users
                    WHERE id = ".$id."";
            $result = mysqli_query($connection, $sql);
            $row = $result -> fetch_assoc();
            $password_change = $row['password_change'];
            if ($password_change == "2000-01-01 00:00:00") {
                $password_change = "Never";
            }
        ?>
        <div class="dark_msg">
            Last Change: <?php echo $password_change; ?>
        </div>
    </form>

    <?php
        if (isset($_POST['change_pass'])) {
            $admin_pass = $_POST['c_pass'];
            $user_pass = $_POST['n_pass'];

            $sql = "SELECT password
                    FROM users
                    WHERE id = ".$user_id.";";
            $result = mysqli_query($connection, $sql);
            $row = $result -> fetch_assoc();
            if ($admin_pass == $row['password']) {
                date_default_timezone_set("Asia/Colombo");
                $time = date("Y-m-d h:i:sa");
                $sql = "UPDATE users
                        SET password = '".$user_pass."' , password_change = '".$time."'
                        WHERE id = ".$_GET['id'].";";
                if (mysqli_query($connection, $sql)) {
                    echo "<script>alert('Password changed');</script>";
                }
                else {
                    echo "<script>alert('Error Occured!);</script>";
                }

            }
            else{
                echo "<script>alert('Password is incorrect!');</script>";
            }
        }
    ?>
    
    
    <footer>
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>