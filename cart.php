<?php
include_once 'connection.php'; //include connection.php
include_once 'include/header.php'; //include header.php

//intantiation of variables
$total_price = 0;
$total_products = 0;
$result = $mysqli->query("SELECT * FROM order_product"); //select all data from order_product

$items = array(); //declare variable as an array
$all_items = ''; //all items as a string
$sql_concat = "SELECT CONCAT(product_name, '(',quantity,')') AS ItemQty, price FROM order_product"; //select all from order_product concatinate product_name and quantity as item_quantity

//prepare and execute the query
$stmt_concat =  $mysqli->prepare($sql_concat); //prepare statement query
$stmt_concat->execute(); //Excuting the prepared statement
$result_concat = $stmt_concat->get_result(); //get the result from concatenate query
while ($row_concat = $result_concat->fetch_assoc()) { //condition that loops to the result of concatenated data that result from preparing query
    $items[] = $row_concat['ItemQty']; //fetch the selected data and store it to items array
}
$all_items = implode(", ", $items); //removing all the special characters

?>
<style>
    .form-rounded {
        border-radius: 1rem;
}
</style>
<!-- This section is container for the table  -->
<div class="tablecart container">
    <p class="lead " style="font-size: 35px;">Products</p>
    <div class="row">
        <div class="col-sm-9">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- fetch all data from order_product  -->

                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['product_name']; ?></td>
                            <td class="text-center"><?php echo $row['id']; ?></td>
                            <td class="text-center"><?php echo $row['quantity']; ?> pc(s)</td>
                            <td class="text-center">₱&nbsp;<span class="text-info"><?php echo number_format($row['price'], 2); ?></span></td>
                            <td class="text-center">₱&nbsp;<span class="text-info"><?php echo number_format($row['quantity'] * $row['price'], 2); ?></span>
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href="connection.php?cancel=<?php echo $row['id'] ?>"><i class="fa fa-trash-o text-danger w-100"></i></a>
                            </td>
                        </tr>
                        <!-- total price is equal to quantity multiply by price -->
                        <?php
                        $total_price += ($row['quantity'] * $row['price']);
                        $total_products += $row['quantity']; //total products order

                        ?>

                    <?php

                    endwhile; ?>

                    <!-- modal for check out form -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-dark" id="exampleModalLabel">Complete your order!</h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- check out form modal -->
                                <form method="post">
                                    <div id="order_now" class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5>Your Order</h5>
                                                <h6><em>Product(s) :</em> </h6>
                                                <textarea readonly="readonly" name="products" class="form-control overflow-hidden text-justify text-info" rows="6" required><?php echo $all_items; ?></textarea>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Delivery Charges :</label>
                                                    <select class="form-control form-rounded" id="exampleFormControlSelect1" type="hidden"  readonly="readonly" >
                                                        <option>Free</option>
                                                    </select>
                                                </div>
                                                <h6><em>Total Quantity Product(s) :</em></h6>
                                                <input name="total_quantity" class="form-control form-rounded" type="hidden" readonly="readonly" value="<?php echo $total_products; ?>" required>
                                                <input class="form-control form-rounded" type="text" readonly="readonly" value="<?php echo $total_products; ?> pc(s)" required>
                                                <h6>Total Amount Payable : </h6>
                                                <input class="form-control text-danger form-rounded" type="text" readonly="readonly" value="₱&nbsp;<?php echo number_format($total_price, 2); ?>" required>
                                                <input class="form-control form-rounded" type="hidden" name="checkout_total" value="<?php echo $total_price; ?>">
                                                <input class="form-control" type="hidden" name="status" value="<?php echo "Pending"; ?>">
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Payment Type :</label>
                                                    <select class="form-control form-rounded" id="exampleFormControlSelect1" type="hidden" name="payment">
                                                        <option>Cash On Delivery(COD)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h5>Billing Details</h5>

                                                <div class="form-group">
                                                    <label for="name" class="col-form-label"><em>Full Name :</em> </label>
                                                    <input type="text" class="form-control form-rounded" id="name" name="fullName" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emailAddress" class="col-form-label"><em>Email Address
                                                            :</em></label>
                                                    <input type="email" class="form-control form-rounded" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact" class="col-form-label"><em>Contact Number :</em>
                                                    </label>
                                                    <input type="text" class="form-control form-rounded" name="contact" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deliveryAddress" class="col-form-label"><em>Delivery Address
                                                            :</em> </label>
                                                    <textarea class="form-control" id="message-text" name="deliveryAddress" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="code" class="col-form-label"><em>Post/Zip Code :</em> </label>
                                                    <input type="text" class="form-control form-rounded" name="code" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="order_now" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Order now</button>
                                    </div>
                                </form>
                                <!-- end of check out form -->
                            </div>
                        </div>
                    </div>
                    <!-- end of modal check out from -->
                </tbody>
            </table>

        </div>

        <div class="col-sm-3">
        <!-- Card for summary of product -->
            <div class="card " style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title pb-4">Summary</h5>
                    <p class="card-text">Products : <span class="text-info"><?php echo $all_items; ?></span></p>
                    <p class="card-text ">Total :
                        <span class="text-info">₱&nbsp;<?php echo number_format($total_price, 2); ?></span>
                    </p>
                    <p class="card-text">Quantity : <span class="text-info"><?php echo $total_products; ?> pc(s)</span> </p>
                    <button type="button" class="btn btn-outline-dark  btn-block" data-toggle="modal" data-target=".bd-example-modal-lg">Proceed to Checkout</button>
                    <a href="index.php" class="btn btn-outline-info btn-block">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>


</div>
<?php
include_once 'include/footer.php'
?>