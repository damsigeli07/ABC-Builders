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
else{
    header("Location: ./index.php");
}
?>

<html>
<head>
    <title>
        My Profile | ABC Builders Material Management System
    </title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <hr />
    <h1 id="header">My Profile<br />ABC Builders & Suppliers</h1>
    <hr />
    <nav>
        <a style="margin-left: 4px;" href="./">Home</a>
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
        <a class="log_link active" href="profile.php?id=<?php echo $id; ?>" style="display: <?php echo $show_profile ?>;">My Profile</a>
    </nav>
    <hr />
    <div id="profile_content">
        <div><span class="key">ID: </span><span class="value"><?php echo $id; ?></span></div>
        <hr style="height: 1px;" />
        <div><span class="key">Username: </span><span class="value"><?php echo $name; ?></span> </div>
    </div>

    
    <form action="" id="change_pass" class="forms" method="post">
        <h2 class="header_2">Change Password</h2>
        <div class="input_div">
            <label for="c_pass">Enter Current Password</label>
            <input type="password" name="c_pass" required />
        </div>
        <div class="input_div">
            <label for="n_pass">Enter New Password</label>
            <input type="password" name="n_pass" required />
        </div>
        <div class="input_div">
            <label for="n_pass">Re-Enter New Password</label>
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
            $prev = $_POST['c_pass'];
            $new = $_POST['n_pass'];

            $sql = "SELECT password
                    FROM users
                    WHERE id = ".$id.";";
            $result = mysqli_query($connection, $sql);
            $row = $result -> fetch_assoc();
            if ($prev == $row['password']) {
                date_default_timezone_set("Asia/Colombo");
                $time = date("Y-m-d h:i:sa");
                $sql = "UPDATE users
                        SET password = '".$new."' , password_change = '".$time."'
                        WHERE id = ".$id.";";
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

    <a href="./process/logout.php" id="logout_button" class="send_button">Log out</a>
    
    
    <footer style="width: 100%">
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>