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

<html>
    <head>
        <title>
            Our Materials | ABC Builders & Suppliers
        </title>
        <link rel="stylesheet" href="./styles/main.css">
    </head>
    <body>
        <hr />
        <h1 id="header">Our Materials <br />ABC Builders & Suppliers</h1>
        <hr />
        <nav>
            <a style="margin-left: 4px;" href="/material_management_system/index.php">Home</a>
            <a class="active" href="materials.php">Our Materials</a>
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
            <a class="log_link" href="./#login_form" style="display: <?php echo $hide_log ?>;">Log in</a>
            <a class="log_link" href="profile.php?id=<?php echo $id; ?>" style="display: <?php echo $show_profile ?>;">My Profile</a>
        </nav>
        <hr />
        <div id="material_list">
        <?php
            require_once('connect.php');
            $get_materials_sql = "SELECT *
                               FROM material_category";
            $material_list = mysqli_query($connection, $get_materials_sql);
            if (mysqli_num_rows($material_list) > 0) {
                while ($row = $material_list -> fetch_assoc()) {
                    echo '<div class="material_card">
                            <img src="./category_images/'. $row['category_name'] .'.'. $row['extension'].'" alt="" />
                            <div class="details">
                                <h4>Catagory Name: '. $row['category_name'] .'</h4>
                                <p>Category ID: '. $row['category_id'] .'</p>
                                <p>Available: '. $row['quantity_all'] .'</p>
                            </div>
                            <a href="./view_material.php?category='. $row['category_id'] .'" class="view_material">More Details</a>
                        </div>';
                }
            }
            else {
                echo "<h3>Sorry, there is no material to show!</h3>";
            }
        ?>
        </div>
        <footer>
            <hr />
            <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
            <hr />
    </footer>
    </body>
</html>
