<?php
session_start();
$hide_log = "block";
$show_profile = "none";
$is_admin = false;
$id = 0;
$hide_help = "inline-block";
$name = "";
$email = "";
if (isset($_SESSION['id'])) {
    $hide_log = "none";
    $show_profile = "block";
    $id = $_SESSION['id'];
    require_once('connect.php');
    $sql = "SELECT username, role, email
            FROM users
            WHERE id = " . $id . ";";
    $result = mysqli_query($connection, $sql);
    $row = $result -> fetch_assoc();
    $name = 'value="'.$row['username'].'" readonly';
    $role = $row['role'];
    $email = 'value="'.$row['email'].'" readonly';
    if ($role == 'admin') {
        $is_admin = true;
        $hide_help = "none";
    }
}
?>

<html>
<head>
    <title>
        User Manual |ABC Builders Material Management System
    </title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <hr />
    <h1 id="header">User Manual<br/>ABC Builders & Suppliers</h1>
    <hr />
    <nav>
        <a style="margin-left: 4px;" href="./">Home</a>
        <a href="materials.php">Our Materials</a>
        <a class="active" href="manual.php" style="display: <?php echo $hide_help; ?>">Help</a>
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
        <a class="log_link" href="./#login_form" style="display: <?php echo $hide_log ?>;">Log in</a>
        <a class="log_link" href="profile.php?id=<?php echo $id; ?>" style="display: <?php echo $show_profile ?>;">My Profile</a>
    </nav>
    <hr />
    <div class="description">
        <h2 class="description_header">
            How to create an account?
        </h2>
        You can create an account by going to Log In form and clicking Sign up. Or directly click <a href="./sign-up.php">Sign Up</a> right now!
    </div>
    <div class="description">
        <h2 class="description_header">
            How to Order a Product?
        </h2>
        Go to <a href="./materials.php">Our Materials</a> page and choose the material category you want to order and click <b>View More</b>.
        Then, chooce the material or product and order.
        <br>
        <strong>It is mandatory to Log In to the system to make an order. Otherwise, when you click order, you will be redirected to Log In form.</strong>
    </div>
    <div class="description">
        <h2 class="description_header">
                How to track my orders?
        </h2>
        Go to the <a href="./my_orders.php">My Orders</a> page and you can see your orders if you have any. Check the <b>Order</b> column in the orders table and you can see whether your order is Processing, Delivering or Done.
    </div>
    <div class="description">
        <h2 class="description_header">
                How to change the password?
        </h2>
        Go to your <a href="./profile.php">Profile</a> and change your password.
    </div>
    <div class="description">
        <h2 class="description_header">
                How can we contact you for another issue?
        </h2>
        Contact us throuh our <a href="#help_form">Contact Us form</a> regarding any problem you face while using our website.
    
    <form action="./process/contact_handle.php" method="post" class="forms" id="help_form">
        <h2 class="header_2">
            Contact Us
        </h2>
        <div class="input_div">
            <label for="name">Name</label>
            <input type="text" name="name" <?php echo $name;?> />
        </div>
        <div class="input_div">
            <label for="email">Email</label>
            <input type="text" name="email" <?php echo $email;?> />
        </div>
        <div class="input_div">
            <label for="message">Message</label>
            <textarea name="message"></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $id;?>" />
        <input type="submit" name="submit" value="Send" class="send_button" />
    </form>
    </div>
    <footer>
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>