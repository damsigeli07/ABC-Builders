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
            Reports | ABC Builders & Suppliers
        </title>
        <link rel="stylesheet" href="./styles/main.css">
    </head>
    <body>
        <hr />
        <h1 id="header" style="text-align: left; margin: auto 0px; padding: 10px;">Reports<br />ABC Builders & Suppliers</h1>
        <hr />

        <nav>
        <a style="margin-left: 4px;" href="./index.php">Home</a>
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

        <h2 class="header_2">Sales Revenue By Materials</h2>

        <section>
            <?php
                $sql = "SELECT o.quantity, o.time, o.time, m.material_name, m.buy_price, m.price
                        FROM orders o
                        INNER JOIN materials m ON o.material_id = m.material_id
                        ORDER BY time ASC;";
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

            <a href="#completed" class="add_mat_link" style="display: <?php echo $display_msg; ?>">There is no data to show!</a>

<script>
    var sales_data = [
        <?php
            while ($row = $result->fetch_assoc()) {
                echo "[" . $row['quantity'] . ", '" . $row['time'] . "', '" . $row['material_name'] . "', " . $row['buy_price'] . ", " . $row['price'] . "],";
            }
        ?>
    ];

    var revenues_report = {};
    var monthly_report = {};

sales_data.forEach(item => {

    /* item[0] = quantity, item[1] = time, item[2] = material_name, item[3] = buy_price, item[4] = price */

    var revenues = item[0] * (item[4] - item[3]);
    var materialName = item[2];
    var sales_month = item[1].substring(0, 7);

    if (revenues_report[materialName]) {
        revenues_report[materialName].total_quantity += item[0];
        revenues_report[materialName].total_revenues += revenues;
    } 
    else {
        revenues_report[materialName] = {
            total_quantity: item[0],
            total_revenues: revenues
        };
    }

    if (monthly_report[sales_month]) {
        monthly_report[sales_month].total_revenues += revenues;
    }
    else {
        monthly_report[sales_month] = {
            total_revenues : revenues
        };
    }
});

    var report_data = {};
    for (var material in revenues_report) {
        report_data[material] = [
            material,
            revenues_report[material].total_quantity,
            revenues_report[material].total_revenues
        ];
    }
</script>

<table id="view_all_table" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Material Name</th>
        <th>Total Quantity Sold</th>
        <th>Revenues</th>
    </tr>
    <script type="text/javascript">
        total_rev = 0;
        for (var material in report_data) {
            var item = report_data[material];
            document.write('<tr>');
            document.write('<td>' + item[0] + '</td>');
            document.write('<td>' + item[1] + '</td>');
            document.write('<td>' + item[2] + '.00</td>');
            document.write('</tr>');
            total_rev += item[2];
        }
        document.write('<tr><td colspan="2"><strong>Total Revenues:</strong></td><td><strong>' + total_rev + '.00</strong></td></tr>');
    </script>
</table>

<h2 class="header_2">Sales Revenue By Months</h2>


<table id="view_all_table" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Month</th>
        <th>Revenues</th>
    </tr>
    <script type="text/javascript">
        total_rev = 0;
        for (var month in monthly_report) {
            document.write('<tr>');
            document.write('<td>' + month + '</td>');
            document.write('<td>' + monthly_report[month].total_revenues + '.00</td>');
            document.write('</tr>');
            total_rev += monthly_report[month].total_revenues
        }
        document.write('<tr><td colspan="2"><strong>Total Revenues: ' + total_rev +'.00</strong></td></tr>');    
    </script>
</table>
        </section>

        <section class="graph">
            <h2 class="header_2">
                Sales from 2023 - 01 to 2024 - 12
            </h2>
        <script type="text/javascript">
        for (var month in monthly_report) {
            document.write('<div class="rectangle" style="height: '+ monthly_report[month].total_revenues / 500 +';"></div>');
        }
        for (var month in monthly_report) {
            document.write('<div class="rectangle_month">' + month + " - Rs. " + monthly_report[month].total_revenues + '.00</div>');
        }
    </script>
        </section>

        <footer>
        <hr />
        <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
        <hr />
    </footer>
</body>
</html> 