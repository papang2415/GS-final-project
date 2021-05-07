<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JMD Computer Accessories</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>

.navbar {
    height: 80px;
    -webkit-box-shadow: 0 8px 6px -8px #777;
    -moz-box-shadow: 0 8px 6px -8px #777;
    box-shadow: 0 8px 6px -8px #777;
    color: black;
}

#navbarNav {
    font-size: 18px;
}

.jumbotron {
    margin-top: 50px;
    height: 600px;
    -webkit-box-shadow: 0 8px 6px -8px #777;
    -moz-box-shadow: 0 8px 6px -8px #777;
    box-shadow: 0 8px 6px -8px #777;
}

.img {
    height: 80px;
    width: 80px;
    border-radius: 50%;
    padding: 5px;

}

.jolly {
    font-size: 40px;
}

.indexcard {
    padding: 2px;
    box-shadow: 0 2px 6px 0 #888888;
    transition: 0.3s;
}

.indexcard:hover {
    box-shadow:
        0 2.8px 2.2px rgba(0, 0, 0, 0.034),
        0 6.7px 5.3px rgba(0, 0, 0, 0.048),
        0 12.5px 10px rgba(0, 0, 0, 0.06),
        0 22.3px 17.9px rgba(0, 0, 0, 0.072),
        0 41.8px 33.4px rgba(0, 0, 0, 0.086),
        0 100px 80px rgba(0, 0, 0, 0.12);
    transform: scale(1.1);

}

.tablecart {
   margin-top: 150px;
}
</style>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <img src="./images/logo.png" alt="..." class="img">
        <a class="navbar-brand" href="#">Computer Accessories</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav text-dark">
                <li class="nav-item mr-4">
                    <a class="nav-link" href="./index.php">Store</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="./checkout.php">Order Info</a>
                </li>
                <li class="nav-item mr-4">
                    
                    <a class="nav-link" href="./cart.php"><i class="fa fa-shopping-cart text-danger"><span class="badge badge-light"></span></i> Shopping
                        Cart</a>
                </li>
                <li class="nav-item mt-1">
                    <div class="dropdown">
                        <button class="btn bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> <?php if(isset($_SESSION['id'])){
                                                                    echo $_SESSION["name"];
                                                                } ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="logout.php">Logout</a>

                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </nav>