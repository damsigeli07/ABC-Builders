<?php
session_start();
$hide_log = "block";
$show_profile = "none";
$is_admin = false;
$id = 0;
$role = "none";
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
    $row = mysqli_fetch_assoc($result);
    $name = $row['username'];
    $role = $row['role'];
    if ($role == 'admin') {
        $is_admin = true;
        $hide_help = "none";
    }
}
?>

<html>
<head>
    <title>
        ABC Builders Material Management System
    </title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <hr />
    <h1 id="header">Welcome to ABC Builders Material Management System</h1>
    <hr />
    <nav>
        <a class="active" style="margin-left: 4px;" href="#">Home</a>
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
        <a class="log_link" href="profile.php" style="display: <?php echo $show_profile ?>;">My Profile</a>
    </nav>
    <hr />
    <div class="description">
        This is the portal of ABC Builders & Suppliers Material Management System.
        You can browse available materials of ABC Builders & Suppliers and relavent information
        about those materials. If you are new to our site, please go to the Help page in Navigation.
    </div>
    <div id="image_div">
    <img src="./images/cement.png" alt="A Cement pack">
    <img src="./images/bricks.png" alt="An Brick">
    <img src="./images/tools.png" alt="A Tile Paster">
    <img src="./images/rocks.png" alt="A pile of cruched granites">
    </div>
    <div class="description" style="display: <?php echo $hide_log ?>;">
        If you are already signed up in the site, use your username and password.
        Else, you can send a sign up by clicking Sign up.
    </div>
    <form id="login_form" class="forms" action="login.php" method="post" style="display: <?php echo $hide_log ?>;">
        <h2 class="header_2">Log in to the System</h2>
        <div class="input_div">
            <label for="username">Username</label>
            <input type="text" name="username" required />
        </div>
        <div  class="input_div">
            <label for="password">Password</label>
            <input type="password" name="password" required />
        </div>
        <input type="submit" name="submit" value="Log in" class="send_button" />
        <div id="no_account">
            No account? <a href="./sign-up.php">Sign up</a>
        </div>
    </form>
    <footer>
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>