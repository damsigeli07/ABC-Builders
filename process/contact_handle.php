<html>
    <head>
        <title>
            Message Recorded! | ABC Builders and Suppliers
        </title>
    </head>
    <body>
        <?php 
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            require_once('../connect.php');
            $sql = "INSERT INTO messages(user_id, name, email, message)
                    VALUES(".$id.",'".$name."', '".$email."', '".$message."')";
            if (mysqli_query($connection, $sql)) {
                echo "<div>Your message is recorded. We will reach you as soon as possible through email.</div>
                        <a href='../' class='submit_button'>Go back to Homepage</button>";
            }
            else{
                echo "Sorry, failed record your message! Error Occured.";
            }
        ?>
    </body>
</html>