<?php
session_start();
include('../config/dbcon.php');
// require 'userfunction.php';

if(isset($_SESSION['auth'])) {

    if (isset($_POST['placeOrderBtn'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);
        $card_message = mysqli_real_escape_string($con, $_POST['card_message']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

        $image = $_FILES['image']['name'];

        $path = '../uploads';

        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;

        if(empty($name) || empty($email) || empty($phone) || empty($address) || empty($zip_code) || empty( $card_message)) {
            $_SESSION['message'] = "All feilds are mandatory";
            header("location: ../checkout.php");
            exit(0);
        }

        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$user_id' 
        ORDER BY c.id DESC";
        $query_run = mysqli_query($con, $query);

        $totalPrice = 0;
        foreach ($query_run as $citem) {
            $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
        } 

        $tracking_no = "*****" . rand(1, 9999);

        $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, zip_code, card_message, total_price, payment_mode, payment_id, image) VALUES ('$tracking_no', '$user_id', '$name', '$email', '$phone', '$address', '$zip_code', '$card_message', '$totalPrice', '$payment_mode', '$payment_id', '$filename') ";
        $insert_query_run = mysqli_query($con, $insert_query);

        if ($insert_query_run) {
            $order_id = mysqli_insert_id($con);
            foreach ($query_run as $citem) {
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['selling_price'];
                $insert_item_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price')";
                $insert_item_query_run = mysqli_query($con, $insert_item_query);
                
                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1";
                $product_query_run = mysqli_query($con, $product_query);

                $productData = mysqli_fetch_array($product_query_run);    
                $current_qty = $productData['qty'];

                $new_qty = $current_qty - $prod_qty;

                $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id' ";
                $updateQty_query_run = mysqli_query($con, $updateQty_query);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

            $deleteCartQuery = "DELETE FROM carts WHERE user_id='$user_id'"; 
            $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);

            if ($payment_mode === "COD") {
                $_SESSION['message'] = "Order place successfully";
                header("location: ../order.php");
                die();
            } else {
                echo 201;
            }  
        } 
    }

} else {
    header("Location: ../index.php");
}

