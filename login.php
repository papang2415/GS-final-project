<?php
session_start();
$message = "";
if (count($_POST) > 0) {
    include 'connection.php';
    $result = mysqli_query($mysqli, "SELECT * FROM user WHERE userName='" . $_POST["user_name"] . "' and userPassword = '" . $_POST["password"] . "'");
    $row  = mysqli_fetch_array($result);
    if (is_array($row)) {
        $_SESSION["id"] = $row['userID'];
        $_SESSION["name"] = $row['userName'];
    } else {
        $message = "Invalid Username or Password!";
    }
}
if (isset($_SESSION["id"])) {
    header("Location:index.php");
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
<style>
    .fa {
        font-size: 20px;

    }

    .tablecart {
        margin-top: 50px;
        padding: 100px;
    }

    .card {
        height: 450px;

    }

    .container {
        padding: 2rem 0rem;
    }





    .form-title {
        margin: -2rem 0rem 2rem;
    }

    .btn-round {
        border-radius: 3rem;
    }

    .delimiter {
        padding: 1rem;
    }

    #login{
        border-radius: 1rem;
        border-color: #12AFCA;
        border-width: medium;
    }

    .signup-section {
        padding: 0.3rem 0rem;
    }
</style>
</head>

<body>

    <div class="d-flex flex-column text-center col-sm-4 mx-auto border p-5 " id= "login" style="margin-top:200px">

        <form class="signin" method="post" action="">
            <!-- <h2>Log In Now</h2> -->
            <div class="message"><?php if ($message != "") {
                                        echo $message;
                                    } ?></div>
            <h3 align="center">Enter Login Details</h3>
            <div class="form-group">
                <input type="text" name="user_name" class="form-control" id="email1" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" id="password1" placeholder="Your password...">
            </div>
            <button type="submit" name="submit" class="btn btn-info btn-block btn-round">Login</button>
            <a href="signup.php" class="small">Create Account Now</a>
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
            </di>
        </div>


        </form>
</body>

</html>