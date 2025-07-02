<?php       
    session_start();
    include ('functions/userfunction.php');
    include ('functions/authenticate.php');
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
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/review.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
    <!-- Javascript -->
    <script defer src="js/active.js"></script>  
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Title -->
    <title> Account </title>

</head>
<body>
    <?php
        include_once 'nav.php';
    ?>

    <main class="user_containter">

        <div class="sidebar">
            <header class="sidebar_header"> My Account </header>
            <ul class="sidebar_list">
                <li class="sidebar_links profile"><a href="user.php"> Profile </a></li>
                <li class="sidebar_links my_orders"><a href="order.php"> My orders </a></li>
                <li class="sidebar_links my_orders"><a href="order_history.php"> Order History </a></li>
                <li class="sidebar_links my_orders"><a href="wishlist.php"> Wishlist </a></li>
            </ul>
        </div> 
        <div class="content">
            <header class="content_header"> Review Product </header>
            <?php
                $prod_id = $_GET['id'];
                $user_id = $_SESSION['auth_user']['user_id']; 

                $slug_query = "SELECT slug FROM products WHERE id='$prod_id'";
                $slug_query_run = mysqli_query($con, $slug_query);
                if ($slug_query_run && mysqli_num_rows($slug_query_run) > 0) {
                    $slug_data = mysqli_fetch_assoc($name_query_run);
                    $slug_name = $slug_data['slug'];
                } else {
                    $slug_name = '';
                }

                $name_query = "SELECT name FROM users WHERE id='$user_id'";
                $name_query_run = mysqli_query($con, $name_query);
                if ($name_query_run && mysqli_num_rows($name_query_run) > 0) {
                    $name_data = mysqli_fetch_assoc($name_query_run);
                    $user_name = $name_data['name'];
                } else {
                    $user_name = '';
                }
            ?>
            <form action="functions/addreview.php" method="post">
                <div class="content_wrapper">
                    <label for=""> Review Product </label>
                    <input type="hidden" name="slug" value="<?= $slug_name ?>">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="name" value="<?= $user_name ?>">
                    <select name="ratings" id="">
                        <option selected> Ratings  </option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                        <option value="3"> 3 </option>
                        <option value="4"> 4 </option>
                        <option value="5"> 5 </option>
                    </select>
                    <textarea name="comment" id="comment"></textarea>
                    <span class="span_container"><input type="checkbox" name="anonymous" id="anonymous" value="1"> <span class="anonymous"> Anonymous </span> </span>
                   
                    <button type="submit" name="addReviewBtn"> Submit </button>
                </div>
            </form>
        </div>
    </main>

    <?php
        include ('footer.php');
    ?>
    <!-- JQuery -->
    <script src="assets/jquery-3.7.1.min.js"></script>                  
    <!-- JS -->
    <script src="js/scripts.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/custom.js"></script> 
    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>

        <?php if(isset($_SESSION['message'])) { ?>
        alertify.set('notifier','position', 'top-right');
        alertify.success('<?= $_SESSION['message']; ?>');
        <?php 
        unset($_SESSION['message']);
        } ?>
    </script>
</body>
</html> 