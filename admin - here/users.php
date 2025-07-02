<?php
    include('../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="images/favicon.png">

    <!-- Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
</head>
<body>
    <div class="grid-container">
        <!-- Header -->
        <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div>

        <div class="header-left"> 
            <div class="main-title">
                <h2> Users </h2>
            </div>
        </div>

        <div class="header-right">
            <div>
                <span class="material-icons-outlined">account_circle</span>
            </div>
            
        </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <img src="images/logo.png" alt=""> ADMIN
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()";>close</span>
            </div>

            <ul class="sidebar-list">
                <hr>
                <a href="index.php">
                    <li class="sidebar-list-item">
                            <span class="material-icons-outlined">dashboard</span> Dashboard
                    </li>
                </a>   

                <a href="products.php">
                    <li class="sidebar-list-item">
                    <span class="material-icons-outlined">shopping_bag</span> PRODUCTS
                    </li>
                </a>

                <a href="category.php">
                    <li class="sidebar-list-item">
                    <span class="material-icons-outlined">admin_panel_settings</span> CATEGORIES
                    </li>
                </a>

                <a href="orders.php">
                    <li class="sidebar-list-item">
                    <span class="material-icons-outlined">border_color</span> ORDERS
                    </li>
                </a>

                <a href="users.php">
                    <li class="sidebar-list-item-active">
                    <span class="material-icons-outlined">admin_panel_settings</span> USERS
                    </li>
                </a>

                <a href="../logout.php">
                    <li class="sidebar-list-item">
                    <span class="material-icons-outlined">logout</span> LOGOUT
                    </li>
                </a>
            </ul>
        </aside>
        <!-- End Sidebar -->

        <!-- Main -->
        <main class="main-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Role </th>
                        <th colspan="2"> ACTION </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $users = getAll('users');

                if(mysqli_num_rows($users) > 0) {
                    foreach($users as $item) {
                    ?>
                    <tr>
                        <td> <?= $item['id']?> </td>
                        <td> <?= $item['name']?> </td>
                        <td> <?= $item['email']?> </td>
                        <td> 
                            <?php 
                            if ($item['role_as'] == 1) {
                                ?>
                                <p> Admin </p>
                                <?php
                            } else {
                                ?>
                                <p> User </p>
                                <?php
                            }
                            ?> 
                        </td>
                        <form action="code.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $item['id'] ?>">
                            <td><button type="submit" name="update_btn_admin" class="admin"> Set as Admin </button></td>
                            <td><button type="submit" name="update_btn_user" class="user"> Set as User </button></td>
                        </form>
                    </tr>
                <?php
                        }
                    } else {
                        echo "No records";
                    }
                ?>
                </tbody>
    </table>
    </main>
        <!-- End Main -->
    </div>

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