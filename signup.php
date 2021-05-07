<?php
include 'include/header.php';
session_start();
$message = "";
if (isset($_POST['submit'])) {
    $username = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    include 'connection.php';
    $sql = "INSERT INTO user (userName, userEmail, userPassword)
        VALUES ('$username','$email','$password')";

    if ($mysqli->query($sql) === TRUE) {
        header("location:login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>User Login</title>
</head>

<body>

    <div class="d-flex flex-column text-center col-sm-4 mx-auto" style="margin-top:200px">

        <form class="signin" method="post" action="">
            <!-- <h2>Log In Now</h2> -->
            <div class="message"><?php if ($message != "") {
                                        echo $message;
                                    } ?></div>
            <h3 align="center">Create Account Now</h3>
            <div class="form-group">
                <input type="text" name="user_name" required class="form-control" id="email1" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" name="email" required class="form-control" id="email1" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" required class="form-control" id="password1" placeholder="Your password...">
            </div>
            <button type="submit" name="submit" class="btn btn-info btn-block btn-round">Create</button>
            <a href="login.php" class="small">Already have an account</a>
        </form>
        <div class="text-center text-muted delimiter">or use a social network</div>
        <div class="d-flex justify-content-center social-buttons">
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
                <i class="fa fa-twitter"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                <i class="fa fa-facebook"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
                <i class="fa fa-linkedin"></i>
            </button>

        </div>
    </div>


    </form>
</body>

</html>