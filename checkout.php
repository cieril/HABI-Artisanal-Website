<?php
    session_start();
    include('functions/userfunction.php');
    include('functions/authenticate.php');

    $cartItems = getCartItems();

    if(mysqli_num_rows($cartItems) == 0){
        header('Location: index.php');
    }
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
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
    <!-- Javascript -->
    <script defer src="js/active.js"></script>  
    <!-- Title -->
    <title> Checkout </title>

</head>
<body>
    
    <?php
        include ('nav.php');
    ?>

    <main>
        <form action="functions/placeorder.php" enctype="multipart/form-data" method="POST">
            <div class="checkout_main_container">
                <div class="form_container">
                    <div class="form_title">
                        <p> Basic Details </p>
                    </div>
                    <div class="form_inputs">
                        <label for="name"> Name </label>
                        <input type="text" name="name" id="name">
                        <small class="name errors"></small>
                    </div>
                    <div class="form_inputs">
                        <label for="email"> Email </label>
                        <input type="email" name="email" id="email">
                        <small class="email errors"></small>
                    </div> 
                    <div class="form_inputs">
                        <label for="phone"> Phone </label>
                        <input type="text" name="phone" id="phone">
                        <small class="phone errors"></small>
                    </div>
                    <div class="form_image">
                        <label for=""> Image </label>
                        <input type="file" name="image" id="image">
                        <small class="image errors"></small>
                        <p> Note: The image will be the reference for the drawing in card </p>
                    </div>
                    <div class="form_inputs">
                        <label for="address"> Address </label>
                        <textarea name="address" id="address"></textarea>
                        <small class="address errors"></small>
                    </div>
                    <div class="form_inputs">
                        <label for="zip_code"> Zip Code </label>
                        <input type="number" name="zip_code" id="zip_code">
                        <small class="zip_code errors"></small>
                    </div>
                    <div class="form_inputs">
                        <label for="card_message"> Card Message </label>
                        <textarea name="card_message" id="card_message"></textarea>
                        <small class="card_message errors"></small>
                    </div>
                </div>
                <div class="order_details_container">
                    <div class="order_details_title">
                        <p> Order Details </p>
                    </div>
                    <div class="orders_main_container">
                    <?php 
                        $cartitems = getCartItems();
                        $totalPrice = 0;
                        foreach ($cartitems as $citem) {
                    ?>
                        <div class="orders_container">
                            <div class="order_image">
                                <img src="uploads/<?= $citem['image'] ?>" alt="">
                            </div>
                            <div class="order_title">
                                <p> <?= $citem['name'] ?> </p>
                            </div>
                            <div class="order_price">
                                <p> &#8369; <?= $citem['selling_price'] ?> </p>
                            </div>
                            <div class="order_qty">
                                <p> x <?= $citem['prod_qty'] ?> </p>
                            </div>
                        </div>
                    <?php
                        $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                        }
                    ?> 
                    </div>
                    <hr class="main_hr">
                    <div class="total_price">
                        <p> Total Price: <span> &#8369; <?= $totalPrice ?> </span> </p>
                    </div>
                    <div class="total_note">
                        <p> Note: shipping fee will be shoulder by the buyer upon receaving the item </p>
                    </div>
                    <div class="checkout_button">
                        <input type="hidden" name="payment_mode" value="COD">
                        <button class="cod" type="submit" name="placeOrderBtn"> Confirm and Place order | COD </button>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </form> 
    </main>

    <?php
        include ('footer.php');
    ?>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier','position', 'top-right'); 
        <?php if(isset($_SESSION['message'])) { ?>
        alertify.success('<?= $_SESSION['message']; ?>');
        <?php 
        unset($_SESSION['message']);
        } ?>
    </script>
    <!-- Replace the "test" client-id value with your client-id -->
    <script src="https://www.paypal.com/sdk/js?client-id=AVMY0fng26i1qEZAKaLLW3gwmLUrxCY2FoXKoYQF5XXFa1wJH3QI9fSFX9nVv-pW4-WsBo-KUTDV45F2&currency=PHP"></script>
    <script>

        paypal.Buttons({
            onClick(){
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var image = $('#image').val();
                var address = $('#address').val();
                var zip_code = $('#zip_code').val();
                var card_message = $('#card_message').val();

                if(name.length == 0) {
                    $('.name').text("*This field is required");
                } else {
                    $('.name').text("");
                }
                if(email.length == 0) {
                    $('.email').text("*This field is required");
                } else {
                    $('.email').text("");
                }
                if(phone.length == 0) {
                    $('.phone').text("*This field is required");
                } else {
                    $('.phone').text("");
                }
                if(image.length == 0) {
                    $('.image').text("*This field is required");
                } else {
                    $('.image').text("");
                }
                if(address.length == 0) {
                    $('.address').text("*This field is required");
                } else {
                    $('.address').text("");
                }
                if(zip_code.length == 0) {
                    $('.zip_code').text("*This field is required");
                } else {
                    $('.zip_code').text("");
                }
                if(card_message.length == 0) {
                    $('.card_message').text("*This field is required");
                } else {
                    $('.card_message').text("");
                }

                if(name.length == 0 || email.length == 0|| phone.length == 0 || image.length == 0 || address.length == 0 || zip_code.length == 0 || card_message.length == 0) {
                    return false
                }
            },
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?= $totalPrice ?>'
                        }
                    }]
                });
            },
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    console.log(orderData);
                    const transaction = orderData.purchase_units[0].payments.captures[0];

                    // var name = $('#name').val();
                    // var email = $('#email').val();
                    // var phone = $('#phone').val();
                    // var image = $('#image').val();
                    // var address = $('#address').val();
                    // var zip_code = $('#zip_code').val();
                    // var card_message = $('#card_message').val();

                    // var data = {
                    //     'name': name,
                    //     'email': email,
                    //     'phone': phone,
                    //     'address': address,
                    //     'zip_code': zip_code,
                    //     'card_message': card_message,
                    //     'payment_mode': 'Paid by Paypal',
                    //     'payment_id': transaction.id,
                    //     'image': $image,
                    //     'placeOrderBtn': true
                    // };

                    // $.ajax({
                    //     method: "post",
                    //     url: "functions/placeorder.php",
                    //     data: data,
                    //     success: function (response) {
                    //         if(response == 201) {
                    //             alertify.success("Order Placed Successfully");
                    //             // actions.redirect('order.php')
                    //             window.location.href = 'order.php';
                    //         } 
                    //     }
                    // });
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var image = $('#image')[0].files[0]; // Get the File object from the input field
                    var address = $('#address').val();
                    var zip_code = $('#zip_code').val();
                    var card_message = $('#card_message').val();

                    var data = new FormData(); // Create FormData object for sending files
                    data.append('name', name);
                    data.append('email', email);
                    data.append('phone', phone);
                    data.append('address', address);
                    data.append('zip_code', zip_code);
                    data.append('card_message', card_message);
                    data.append('payment_mode', 'Paid by Paypal');
                    data.append('payment_id', transaction.id);
                    data.append('image', image); // Append the File object directly

                    // Additional field if needed
                    data.append('placeOrderBtn', true);

                    // Ajax call to submit data
                    $.ajax({
                        method: "POST",
                        url: "functions/placeorder.php",
                        data: data,
                        contentType: false, // Set content type to false for FormData
                        processData: false, // Prevent jQuery from converting to string
                        success: function(response) {
                            if (response.trim() == '201') {
                                alertify.success("Order Placed Successfully");
                                window.location.href = 'order.php';
                            } else {
                                alert("Failed to place order");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert("Error: " + xhr.responseText);
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    </script> 
</body> 
</html>
