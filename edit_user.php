<?php       
    session_start();
    include ('functions/userfunction.php');
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
    <link rel="stylesheet" href="css/footer.css">
    <!-- Title Icon -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/icon type">
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Javascript -->
    <script defer src="js/active.js"></script>  
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
            <header class="content_header"> My Profile </header>
            <div class="content_wrapper">
                <?php
                    $users = getUserDetails();

                    if (mysqli_num_rows($users) > 0)
                    {
                        foreach ($users as $item) {
                ?>
                <form action="functions/edit_user.php" method="POST">
                    <div class="content_content">
                        <div class="content_div">
                            <p> Name: </p>
                            <input type="text" name="name" value="<?= $item['name'] ?>">
                        </div>
                        <div class="content_div">
                            <p> Email: </p>
                            <input type="text" name="email" value="<?= $item['email'] ?>">
                        </div>
                        <div class="content_div">
                            <p> Phone Number: </p>
                            <input type="text" name="phone" value="<?= $item['phone'] ?>">
                        </div>
                    </div>
                    <div class="content_button">
                        <button type="submit" name="updateUserBtn"> UPDATE </button>
                    </div>
                </form>
            <?php
                    }
                }
            ?>
            </div>
        </div>
        
    </main>

    <?php
            include('footer.php');
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
</body>
</html> 