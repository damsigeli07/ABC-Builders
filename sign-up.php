<?php
session_start();

if (isset($_SESSION['id'])) {
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
        <h1 id="header" style="margin: auto 0px; padding: 10px;">Sign Up<br />ABC Builders & Suppliers</h1>
        <hr />
        <form id="signup_form" name="signup_form" class="forms" action="#" method="post" onsubmit="return validate();">
            <h2 class="header_2">Sign Up to the System</h2>
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
                <div class="error_msg" id="con_error">Passwords are Not Matching!</div>

            </div>
            <input type="submit" name="submit" value="Sign Up" class="send_button" />
            <div class="account_exist">
            <?php
            if (isset($_POST['submit'])){
                $name = $_POST['username'];
                $email = $_POST['email'];
                $pass= $_POST['password'];

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
                            VALUES('".$name."', '".$email."', '".$pass."', 'ordinary')";

                    if (mysqli_query($connection, $sql)) {
                        $sql = "SELECT id
                                FROM users
                                WHERE username = '".$name."';";
                        $result = mysqli_query($connection, $sql);
                        $row = $result -> fetch_assoc();
                        $id = $row['id'];
                        $_SESSION['id'] = $id;
                        header('Location: ./');
                    }
                }

            }
        ?>
            </div>
            <div id="no_account">
                Already have an account? <a href="./index.php#login_form">Log in</a>
            </div>
        </form>



        <footer style="position: absolute; bottom: 0; width: 100%">
            <hr />
            <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
            <hr />
        </footer>
</body>
</html>