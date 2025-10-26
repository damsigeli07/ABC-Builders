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
                    echo "<a href=\"admin_panel.php\" class='active'>Admin</a> <a href=\"handle_orders.php\">Orders</a>";
                }
                elseif(isset($role)){
                    echo "<a href=\"my_orders.php\">My Orders</a>";
                }
            ?>
            <a class="log_link" href="#login_form" style="display: <?php echo $hide_log ?>;">Log in</a>
            <a class="log_link" href="profile.php" style="display: <?php echo $show_profile ?>;">My Profile</a>
        </nav>
        <hr />

        <a href="./view_all.php" class="view_all_link">View All Materials</a>
        <a href="./view_messages.php" class="view_all_link">View Messages</a>
        <a href="./manage_users.php" class="view_all_link">Manage Users</a>
        <a href="./view_reports.php" class="view_all_link">Reports</a>

        <!--Search for materials-->
        <form action="" method="post" id="search_mat" class="forms">
            <h2 class="header_2">
                Search Materials
            </h2>
            <div class="input_div">
                <label for="cat_name">Material Name</label>
                <input type="text" name="mat_name" placeholder="Insee Standard Cement" />
            </div>
            <div class="input_div">
                <label for="cat_id">Category ID</label>
                <input type="number" name="cat_id" placeholder="1" />
            </div>
            <input type="submit" name="submit" value="Search" class="send_button" />

            <div id="display_mat">
                <?php
                    if (isset($_POST['submit'])) {
                        if ($_POST['mat_name'] != ""){
                            $mat_name = $_POST['mat_name'];
                            require_once('connect.php');
                            $sql = "SELECT material_name, quantity, category_id
                                    FROM materials
                                    WHERE material_name LIKE '%".$mat_name."%'";
                            $result = mysqli_query($connection, query: $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = $result -> fetch_assoc()){
                                    echo '
                                        <div class="search_result">
                                            <div>Name: '.$row['material_name'].'</div>
                                            <div>Quantity: '.$row['quantity'].'</div>
                                            <a href="./view_material.php?category='.$row['category_id'].'">View More</a>
                                        </div>
                                    ';
                                }
                            }
                            else{
                                echo '<div class="search_result">Sorry, there is no matching result.</div>';
                            }
                        }
                        elseif ($_POST['cat_id'] != ""){
                            $cat_id = $_POST['cat_id'];
                            require_once('connect.php');
                            $sql = "SELECT material_name, quantity, category_id
                                    FROM materials
                                    WHERE category_id = ".$cat_id.";";
                            $result = mysqli_query($connection, query: $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = $result -> fetch_assoc()){
                                    echo '
                                        <div class="search_result">
                                            <div>Name: '.$row['material_name'].'</div>
                                            <div>Quantity: '.$row['quantity'].'</div>
                                            <a href="./view_material.php?category_id='.$row['category_id'].'">View More</a>
                                        </div>
                                    ';
                                }
                            }
                            else{
                                echo '<div class="search_result">Sorry, there is no matching result.</div>';
                            }
                        }
                    }
                    else{
                        echo "<div class=\"msg\">Materials will appear here!</div>";
                    }
                ?>
            </div>
        </form>

        <!--Add materials-->
        <form action="./process/add_materials.php" method="post" enctype="multipart/form-data" id="add_mat" class="forms">
            <h2 class="header_2">
                Add Materials
            </h2>
            <div class="input_div">
                <label for="mat_name">Material Name</label>
                <input type="text" name="mat_name" placeholder="Insee Standard Cement" required />
            </div>
            <div class="input_div">
                <label for="buy_price">Buying Price(Rs.)</label>
                <input type="number" name="buy_price" placeholder="1000" required />
            </div>
            <div class="input_div">
                <label for="mat_price">Selling Price(Rs.)</label>
                <input type="number" name="mat_price" placeholder="1000" required />
            </div>
            <div class="input_div">
                <label for="cat_id">Category<br /><font size="2">(You can add a new category using <a href="#add_category">below form</a>)</font></label>
                <select name="cat_id" >
                    <?php
                        require_once('connect.php');
                        $sql = "SELECT category_name, category_id
                                FROM material_category";
                        $result = mysqli_query($connection, $sql);
                        while($row = $result -> fetch_assoc()){
                            echo "<option value=\"". $row['category_id'] ."\">". $row['category_name'] ."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="input_div">
                <label for="quantity">No. of Units</label>
                <input type="number" name="quantity" placeholder="20" required />
            </div>
            <div class="input_div">
                <label for="added_date">Added Date</label>
                <input type="date" name="added_date" placeholder="20" required />
            </div>
            <div class="input_div">
                <label for="cat_img">Material Image</label>
                <input type="file" name="mat_img" style="font-size: 14px; border: none;" required />
            </div>
            <input type="submit" name="submit" value="Add" class="send_button" />
        </form>

        <!--Add Material Categories-->
        <form action="./process/add_category.php" method="post" enctype="multipart/form-data" id="add_category" class="forms">
            <h2 class="header_2">
                Add a Material Category
            </h2>
            <div class="input_div">
                <label for="cat_name">Category Name</label>
                <input type="text" name="cat_name" placeholder="Standard Cement" required />
            </div>
            <div class="input_div">
                <label for="unit">Unit</label>
                <input type="text" name="unit" placeholder="(50KG)" required />
            </div>
            <div class="input_div">
                <label for="cat_img">Category Image</label>
                <input type="file" name="cat_img" style="font-size: 14px; border: none;" required />
            </div>
            <input type="submit" name="submit" value="Add" class="send_button" />
        </form>

        <footer>
            <hr />
            <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
            <hr />
        </footer>
    </body>
</html>