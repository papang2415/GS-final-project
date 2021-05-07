<?php
session_start();
include_once 'connection.php';
include_once 'include/header.php';
?>

<body>
<!-- container for the checkout table product -->
    <div class="tablecart container">
        <p class="pb-2" style="font-size:40px">Order Details</p>
        <!-- this section is for the table where data display -->
        <table class="table table-hover">
            <thead class="thead">
                <tr>
                    <th scope="col">Order number</th>
                    <th scope="col">Delivery Address</th>
                    <th scope="col" class="text-center">Ordered Products</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Cancel Order</th>

                </tr>
            </thead>
            <tbody>
                <!-- identifying current user -->
                <?php
                if(isset($_SESSION['id'])){//condition for setting the session variable for ID
                    $name = $_SESSION['name'];//Store the Session variable name;
                }
                $email = "SELECT * FROM user WHERE userName = '$name'";//query for current user
                $result1 = mysqli_query($mysqli, $email);//connect the result query to the database
                if (mysqli_num_rows($result1) > 0) {//condition for the result if greater than 0
                    while ($row1 = mysqli_fetch_array($result1)) {//while loop condition for the result
                        $useremail = $row1['userEmail'];//store the the user email in the useremail variable
                        $query = "SELECT * FROM checkout WHERE checkout_email = '$useremail'";//query for selecting data from checkout where checkout_email is equal to current user 
                        $result = mysqli_query($mysqli, $query);//store the result in the result variable
                        if (mysqli_num_rows($result) > 0) { //condition that count the result by row and if result is greater than zero 
                            while ($row = mysqli_fetch_array($result)) { //loop that fetch the result
                ?>
                <tr>
                    <td class="text-info"><?php echo $row['checkout_id'];?></td>
                    <td><?php echo $row['checkout_delAddress'];?></td>
                    <td class="text-center"><?php echo $row['checkout_products'];?></td>
                    <td><?php echo $row['checkout_quantity'];?> pc(s)</td>
                    <td class="text-danger">₱&nbsp;<?php echo number_format($row['checkout_total'],2);?></td>
                    <td class="text-success"><?php echo $row['order_date'];?></td>
                    <td><?php echo $row['status']?></td>
                    <td><a href="connection.php?cancel-order=<?php echo $row['checkout_id'] ?>"><i class="fa fa-trash-o text-danger"></i></a></td>
                </tr>
                <?php } //end of while loop ?>              
                <?php } //end of if condition?>
                <?php } //end of while loop?>
                <?php } //end of if condition?>
            </tbody>
        </table>
                               
    </div>
    
</body>

</html>



<?php
include_once 'include/footer.php'
?>