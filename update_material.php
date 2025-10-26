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
        $sql = "SELECT material_name, quantity, category_id, price
                FROM materials
                WHERE material_id = ".$_GET['id'].";";
        $result = mysqli_query($connection, $sql);
        $row = $result -> fetch_assoc();
        $mat_name = $row['material_name'];
        $mat_quantity = $row['quantity'];
        $cat_id = $row['category_id'];
        $price =$row['price'];
        $sql = "SELECT unit
                FROM material_category
                WHERE category_id = ".$cat_id.";";
        $result = mysqli_query($connection, $sql);
        $row = $result -> fetch_assoc();
        $unit = $row['unit'];
    ?>
    <div id="profile_content">
        <div><span class="key">Material ID: </span><span class="value"><?php echo $_GET['id']; ?></span></div>
        <hr style="height: 1px;" />
        <div><span class="key">Name: </span><span class="value"><?php echo $mat_name; ?></span> </div>
        <hr style="height: 1px;" />
        <div><span class="key">Available: </span><span class="value"><?php echo $mat_quantity . " " . $unit;  ?></span> </div>
        <hr style="height: 1px;" />
        <div><span class="key">Price: </span><span class="value">Rs. <?php echo $price; ?></span> </div>
    </div>
    <form action="./process/updating_material.php" id="" class="forms" method="post">
        <h2 class="header_2">Update Details</h2>
        <div class="input_div">
            <label for="price">Price</label>
            <input type="number" name="price" placeholder="1000" required />
        </div>
        <div class="input_div">
            <label for="quntity">Available Units</label>
            <input type="number" name="quantity" placeholder="80" required />
        </div>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" name="update" value="Update" class="send_button" />
    </form>
    
    
    <footer>
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>