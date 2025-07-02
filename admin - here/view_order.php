<?php       
    include('../middleware/admin_middleware.php');

    if (isset($_GET['t'])) {
        $tracking_no = $_GET['t'];

        $orderData = checkTrackingNoValid($tracking_no);
        if(mysqli_num_rows($orderData) < 0) {
            ?>
                <h4> Something went wrong </h4>
            <?php
            die();
        }

    } else {
        ?>
            <h4> Something went wrong </h4>
        <?php
        die(); 
    }

    $data = mysqli_fetch_array($orderData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Imports -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/index.css">  
    <link rel="stylesheet" href="../css/vieworder.css">  
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="../css/footer.css">
    <!-- Title Icon -->
    <link rel="icon" href="../img/favicon-32x32.png" type="image/icon type">
    <!-- Javascript -->
    <script defer src="js/active.js"></script>  
    <!-- Title -->
    <title> Account </title>

</head>
<body>

    <main class="user_containter">

    <div class="small_nav">
        <a href="orders.php"> Go back </a>
    </div>

        <div class="main_container">

            <div class="delivery_details_container">
                <div class="details_title">
                    <p> Delivery Details </p>
                </div>
                <hr>
                <div class="details_div">
                    <label for=""> Name </label>
                    <div class="div_content">
                        <p> <?= $data['name'] ?> </p>
                    </div>
                </div>
                <div class="details_div">
                    <label for=""> Email </label>
                    <div class="div_content">
                        <p> <?= $data['email'] ?> </p>
                    </div>
                </div>
                <div class="details_div">
                    <label for=""> Phone </label>
                    <div class="div_content">
                        <p> <?= $data['phone'] ?> </p>
                    </div>
                </div>
        <form action="code.php" method="POST">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <div class="details_div">
                    <label for=""> Tracking No. </label>
                    <div class="div_input">
                        <input type="text" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                    </div>
                </div>
                <div class="details_div">
                    <label for=""> Address </label>
                    <div class="div_content">
                        <p> <?= $data['address'] ?> </p>
                    </div>
                </div>
                <div class="details_div">
                    <label for=""> Zip Code </label>
                    <div class="div_content">
                        <p> <?= $data['zip_code'] ?> </p>
                    </div>
                </div>
            </div>

            <div class="order_details_container">
                <div class="order_title">
                    <p> Order Details</p>
                </div>
                <hr>
                <div class="order_table">
                    <table>
                        <tr>
                            <th colspan="2"> Product </th>
                            <th> Price </th>
                            <th> Quantity </th>
                        </tr>
                        <?php
                        $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM orders o, order_items oi, products p WHERE oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";
                        $order_query_run = mysqli_query($con, $order_query);

                        if(mysqli_num_rows($order_query_run) > 0) {
                        foreach ($order_query_run as $item) {
                            ?>
                            <tr>
                                <td> <img src="../uploads/<?= $item['image']?>" alt="<?= $item['name']?>"> </td>
                                <td> <?= $item['name']?> </td>
                                <td> <?= $item['price']?> </td>
                                <td> <?= $item['orderqty']?> </td>
                            </tr>
                            <?php 
                            }
                        }
                        ?>
                    </table>
                </div>
                <hr>
                <div class="total_price">
                    <p> Total Price: <span> <?= $data['total_price'] ?> </span> </p>
                </div>
                <div class="details_div">
                    <label for=""> Payment Method </label>
                    <div class="div_content">
                        <p> <?= $data['payment_mode'] ?> </p>
                    </div>
                </div>
                <div class="details_div">
                    <label for=""> Status </label>
                    <div class="div_status">
                        <select name="order_status" id="">
                            <option value="0" <?= $data['status'] == 0 ? "selected":"" ?>> Pending </option>
                            <option value="1" <?= $data['status'] == 1 ? "selected":"" ?>> Under Processed </option>
                            <option value="2" <?= $data['status'] == 2 ? "selected":"" ?>> Packed </option>
                            <option value="3" <?= $data['status'] == 3 ? "selected":"" ?>> Shipped </option>
                            <option value="4" <?= $data['status'] == 4 ? "selected":"" ?>> Completed </option>
                            <option value="5" <?= $data['status'] == 5 ? "selected":"" ?>> Cancelled </option>
                        </select>
                    </div>
                </div>
                <div class="update_btn">
                        <button type="submit" name="updateOrderBtn"> UPDATE </button>
                </div>
        </form>
            </div>

        </div>
    </main>
</body>
</html> 