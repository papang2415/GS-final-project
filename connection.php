<?php

$mysqli = new mysqli('localhost', 'root', '', 'gs_project') or die(mysqli_error($mysqli));  //connection to database


//this section is to add product to cart
if (isset($_POST['add_to_cart'])) {
    //initialize variables that will hold  every data
    $prodID = $_POST['hidden_id'];
    $product_name = $_POST['hidden_name'];
    $product_price = $_POST['hidden_price'];
    $product_quantity = $_POST['quantity'];
    $mysqli->query("INSERT INTO order_product(id,product_name,price,quantity) VALUES ('$prodID','$product_name','$product_price','$product_quantity')"); //adding data to the order_product from database


} //end of add_to_cart section

//this is section is to delete product from cart
if (isset($_GET['cancel'])) {
    $id = $_GET['cancel'];
    $mysqli->query("DELETE FROM order_product WHERE id ='$id'") or die($mysqli->error); //delete data from order_product with spcific id
    header("location: cart.php");
} //end of delete product section

//this section is to delete order product
if (isset($_GET['cancel-order'])) {
    $id = $_GET['cancel-order'];
    $mysqli->query("DELETE FROM checkout WHERE checkout_id ='$id'") or die($mysqli->error); //delete data from order_product according to the selected id
    header("location: checkout.php");
} //end of deleting order product section

//this section is for completion of order product
if (isset($_POST['order_now'])) {
    //initialize variables that will hold  every data
    $date = new Datetime("now", new DateTimeZone('Asia/Manila')); //intantiate date
    $today = $date->format('Y-m-d g:i A');
    $checkout_fullName = $_POST['fullName'];
    $checkout_email = $_POST['email'];
    $checkout_contact = $_POST['contact'];
    $checkout_delAdd = $_POST['deliveryAddress'];
    $checkout_code = $_POST['code'];
    $product_list = $_POST['products'];
    $total_quantity = $_POST['total_quantity'];
    $checkout_total = $_POST['checkout_total'];
    $checkout_payment_type =$_POST['payment'];
    $checkout_status = $_POST['status'];

    //if product_list is empty then 
    if (empty($product_list)) {
        echo "<script>alert('Please add product(s) to cart first before you order')</script>"; //echo alert
    } else { //else 
        $mysqli->query("INSERT INTO checkout(checkout_full_name,checkout_email,checkout_contact,checkout_delAddress,post_zip_code,checkout_products,checkout_quantity,checkout_total,payment_type,status,order_date) VALUES (' $checkout_fullName','$checkout_email','$checkout_contact','$checkout_delAdd','$checkout_code','$product_list','$total_quantity','$checkout_total','$checkout_payment_type','$checkout_status','$today')") or die($mysqli->error); //add data to the database    
        $mysqli->query("DELETE FROM order_product") or die($mysqli->error); //delete data from order products 
        echo "<script>alert('Successfully Ordered. Thank you')</script>";
        header("location: checkout.php"); //insert into checkout table and delete from the order_product(cart) then redirect to header.php
    } //end of if-else statement
} //end of the section for completion order product
