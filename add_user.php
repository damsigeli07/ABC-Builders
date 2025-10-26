<?php
session_start();
require_once('connect.php');
$hide_log = "block";
$show_profile = "none";
$is_admin = false;
$id = 0;
$order_col = "block";
$hide_help = "inline-block";
if (isset($_SESSION['id'])) {
    $hide_log = "none";
    $show_profile = "block";
    $id = $_SESSION['id'];
    $sql = "SELECT username, role
            FROM users
            WHERE id = " . $id . ";";
    $result = mysqli_query($connection, $sql);
    $row = $result -> fetch_assoc();
    $name = $row['username'];
    $role = $row['role'];
    if ($role == 'admin') {
        $is_admin = true;
        $order_col = "none";
        $hide_help = "none";
    }
    elseif($role == 'delivery'){
        $order_col = "none";
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
            Sign Up | ABC Builders & Suppliers
        </title>

        <script>
            function validate() {
                var form = document.signup_form;
                var name_error = document.getElementById('name_error');
                var email_error = document.getElementById('email_error');
                var pass_error = document.getElementById('pass_error');
                var con_error = document.getElementById('con_error');
                
                if (form.username.value == "") {
                    name_error.style.opacity = 1;
                    form.username.focus();
                    return false;
                }
                else{
                    name_error.style.opacity = 0;
                }

                if (!validateEmail()) {
                    email_error.style.opacity = 1;
                    return false;
                }
                else{
                    email_error.style.opacity = 0;
                }

                if (form.password.value.length < 4) {
                    pass_error.style.opacity = 1;
                    form.password.focus();
                    return false;
                }
                else{
                    pass_error.style.opacity = 0;
                }
                
                if (form.con_password.value != form.password.value) {
                    con_error.style.opacity = 1;
                    form.con_password.focus();
                    return false;
                }
                else{
                    pass_error.style.opacity = 0;
                }

                return true;
                
            }
            function validateEmail(){
                var form = document.signup_form;
                var email = form.email.value;
                var at_position = email.indexOf('@');
                var dot_position = email.indexOf('.');

                if (at_position < 1 || (dot_position - at_position < 2)) {
                    return false;
                }
                else{
                    return true;
                }
            }
        </script>

        <link rel="stylesheet" href="./styles/main.css" />
    </head>
    <body>
        <hr />
        <h1 id="header" style="margin: auto 0px; padding: 10px;">Add a New User<br />ABC Builders & Suppliers</h1>
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
        <form id="signup_form" name="signup_form" class="forms" action="#" method="post" onsubmit="return validate();">
            <h2 class="header_2">Add a New User</h2>
            <div class="input_div">
                <label for="username">Enter a Username</label>
                <input type="text" name="username" />
                <div class="error_msg" id="name_error">Enter a Valid Username!</div>
            </div>
            <div class="input_div">
                <label for="email">Email Address</label>
                <input type="text" name="email" />
                <div class="error_msg" id="email_error">Enter a Valid Email!</div>
            </div>
            <div  class="input_div">
                <label for="password">Enter a Password</label>
                <input type="password" name="password" />
                <div class="error_msg" id="pass_error">Password is too short!</div>
            </div>
            <div  class="input_div">
                <label for="con_password">Confirm Password</label>
                <input type="password" name="con_password" />
                <div class="error_msg" id="con_error">Passwords are Not Matching!
                </div>
            </div>
            <div  class="input_div">
                <label for="role">Confirm Password</label>
                <select name="role" id="">
                    <option value="ordinary">Ordinary</option>
                    <option value="delivery">Delivery</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="error_msg" id="con_error">Passwords are Not Matching!
                </div>
            </div>
            <input type="submit" name="submit" value="Add" class="send_button" />
            <div class="account_exist">
            <?php
            if (isset($_POST['submit'])){
                $name = $_POST['username'];
                $email = $_POST['email'];
                $pass= $_POST['password'];
                $role = $_POST['role'];

                require_once('./connect.php');

                $sql = "SELECT username
                        FROM users
                        WHERE username = '".$name."';";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "Username Already Exists!";
                }
                else{                  
                    $sql = "INSERT INTO users(username, email, `password`, role)
                            VALUES('".$name."', '".$email."', '".$pass."', '".$role."')";

                    if (mysqli_query($connection, $sql)) {
                        $sql = "SELECT id
                                FROM users
                                WHERE username = '".$name."';";
                        if (mysqli_query($connection, $sql)){
                            echo "<b color='green'>User added successfully!</b>";                        }
                    }
                }

            }
        ?>
            </div>
        </form>

        <footer style="position: absolute; bottom: 0; width: 100%">
            <hr />
            <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
            <hr />
        </footer>
</body>
</html>