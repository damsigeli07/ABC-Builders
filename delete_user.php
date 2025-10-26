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
        Delete User | ABC Builders Material Management System
    </title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <hr />
    <h1 id="header">Delete User<br />ABC Builders & Suppliers</h1>
    <hr />
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
    <div id="profile_content">
        <div><span class="key">ID: </span><span class="value"><?php echo $_GET['id']; ?></span></div>
        <hr style="height: 1px;" />
        <?php 
            $sql = "SELECT username
                    FROM users
                    WHERE id = ".$_GET['id'].";";
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) == 0) {
                header('Location: ./manage_users.php?e=Cannot find the user specified!');
            }
            else{
                $row = $result -> fetch_assoc();
                $name = $row['username'];
            }
        ?>
        <div><span class="key">Username: </span><span class="value"><?php echo $name; ?></span> </div>
    </div>


    <form action="#" method="post" class="forms" id="help_form">
        <h2 class="header_2">
            Delete User
        </h2>
        <div class="input_div">
            <label for="pass">Enter your Password</label>
            <input type="password" name="pass"  />
        </div>
        <div class="input_div">
            <label for="message">Reason to Deletion</label>
            <textarea name="message"></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <input type="submit" name="delete" value="Delete" class="send_button" />
    </form>

    <?php
        if (isset($_POST['delete'])) {
            $admin_pass = $_POST['pass'];
            $message = $_POST['message'];
            $del_user_id = $_POST['id'];

            $sql = "SELECT password
                    FROM users
                    WHERE id = ".$user_id.";";
            $result = mysqli_query($connection, $sql);
            $row = $result -> fetch_assoc();
            
            if ($admin_pass == $row['password']) {
                $sql = "SELECT order_id
                        FROM orders
                        WHERE customer_id = ".$del_user_id." AND sent != 'YES';";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) == 0) {
                    $sql = "DELETE FROM users
                            WHERE id = ".$del_user_id.";";
                    if (mysqli_query($connection, $sql)) {
                        $sql = "INSERT INTO delete_log(user_id, reason)
                                VALUES(".$del_user_id.", '".$message."');";
                        header('Location: ./manage_users.php?s=User Deleted Successfully!');
                    }
                    else {
                        echo "<script>alert('Error Occured!');</script>";
                    }
                }
                else {
                    echo "<script>alert('There is an incomplete order to complete to this user!');</script>";
                }
            }
            else{
                echo "<script>alert('Password is incorrect!');</script>";
            }
        }
    ?>
    
    
    <footer style="width: 100%">
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>