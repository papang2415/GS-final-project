<?php
include 'connection.php';
include 'include/header.php';


//check user if the user is already login
if (!isset($_SESSION['name'])) {
    header("location:login.php");
}//end of session if not set
?>

<body>
    <br>
    <!-- container for displaying  products in card -->
    <div class="container" style="margin-top: 100px;">
    <p class="lead ml-4" style="font-size: 40px;">Products</p>
        <div class="row p-4 text-center">
        
            <?php
            // select all from products  table in ascending order
            $query = "SELECT * FROM products ORDER BY id ASC";
            $result = mysqli_query($mysqli, $query); //connect to database
            
            //if result is greater than zero 
            if (mysqli_num_rows($result) > 0) { //condtion for the result if greater than 0
                while ($row = mysqli_fetch_array($result)) { //while fetching result that stored in variable row
            ?>
            <!-- card for displaying product -->
                    <div class="col-sm-4 p-4">
                        <div class="card  indexcard" style="width: 20rem;">
                        <!-- form for displaying product -->
                            <form action="index.php?action=add$id=<?php echo $row['id']; ?>" method="post">
                            <!-- Display image from database with data type -->
                                <?php echo '<img  src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"  class="img-thumbnail"/>'; ?>
                                <div class="card-body">
                                    <h6 class="card-title mt-2"><?php echo $row['product_name']; ?></h6>
                                    <h5 class="text-danger"><em>₱&nbsp;<?php echo number_format($row['price'], 2); ?></em></h5>
                                    <center> <input type="number" name="quantity" class="form-control w-50" value="1"></center>
                                    <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="hidden_name" value="<?php echo $row['product_name']; ?>">
                                    <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
                                    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-outline-primary btn-sm" value="Add to Cart">

                                </div>
                        </div>

                        </form> 
                        <!-- end of form for product -->
                    </div>

            <?php
                }//end of while loop
            }//end of condition
            ?>
        </div>

    </div>
    <!-- end of the container for displaying products -->



</body>


<?php
include 'include/footer.php';
?>