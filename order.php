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
    header('Location: ./#login_form');
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

    <?php
        $sql = "SELECT email
                FROM users
                WHERE id = ".$id.";";
        $result = mysqli_query($connection, $sql);
        $row = $result -> fetch_assoc();
        $email = $row['email'];
    ?>
    <form action="./process/ordering.php" id="" class="forms" method="post">
        <h2 class="header_2">Enter Details</h2>
        <div class="input_div">
            <label for="o_name">Name with initials</label>
            <input type="text" name="o_name" placeholder="Eg. P.Q.R. Silva" required />
        </div>
        <div class="input_div">
            <label for="o_phone">Phone Number</label>
            <input type="text" name="o_phone" placeholder="Eg. 071 123 1234" required />
        </div>
        <div class="input_div">
            <label for="o_email">Email</label>
            <input type="email" name="o_email" placeholder="Eg. pqrs@gmial.com" value="<?php echo $email; ?>" readonly>
        </div>
        <div class="input_div">
            <label for="o_address">Delivery Address</label>
            <input type="text" name="o_address" placeholder="Eg. No.4, Temple Road, Maharagama." required>
        </div>
        <div class="input_div">
            <label for="o_mat_name">Material_name</label>
            <input type="text" name="o_mat_name" value="<?php echo $mat_name; ?>" readonly />
            <input type="hidden" name="o_mat_id" value="<?php echo $_GET['id']; ?>" />
            <input type="hidden" name="o_cat_id" value="<?php echo $cat_id; ?>" />
        </div>
        <div class="input_div">
            <label for="o_quantity">Quantity</label>
            <input type="number" max="<?php echo $mat_quantity; ?>" placeholder="Maximum <?php echo $mat_quantity; ?>" name="o_quantity" id="o_quantity" oninput="total();" />
        </div>

        <div class="dark_msg" style="margin-bottom: 10px;">
            Total Cost: <strong id="display_price"></strong>
            <script type="text/javascript">
                document.getElementById('display_price').innerText = "Rs. 0"; 
                function total() {
                    var unit_price = <?php echo $price; ?>;
                    var quantity = document.getElementById('o_quantity').value;
                    document.getElementById('display_price').innerText = "Rs. 0"; 
                    var total = unit_price * quantity;
                    document.getElementById('display_price').innerText = "Rs. " + total;                   
                }
            </script>
        </div>
        <input type="submit" name="change_pass" value="Order" class="send_button" />
    </form>
    
    
    <footer>
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html>