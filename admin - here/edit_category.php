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
                <h2> EDIT CATEGORY </h2>
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
                    <li class="sidebar-list-item-active">
                    <span class="material-icons-outlined">admin_panel_settings</span> CATEGORIES
                    </li>
                </a>

                <a href="orders.php">
                    <li class="sidebar-list-item">
                    <span class="material-icons-outlined">border_color</span> ORDERS
                    </li>
                </a>

                <a href="users.php">
                    <li class="sidebar-list-item">
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

        <main class="main-container">
        <?php
            if(isset($_GET['id'])) {   
                $id = $_GET['id'];  
                $category = getByID("categories", $id);  
                
                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
        ?>
           <div class="addproduct_wrapper">
            <form class="addproduct_form" action="code.php" enctype="multipart/form-data" method="POST">
                <div class="input_product">
                    <input type="hidden" name="cateogry_id" value="<?= $data['id'] ?>">
                    <label for="name"> Name </label>
                    <input type="text" name="name" value="<?= $data['name'] ?>" id="name" autocomplete="off">
                </div>
                <div class="input_product">
                    <label for="slug"> Slug  </label>
                    <input type="text" name="slug" value="<?= $data['slug'] ?>" id="slug" autocomplete="off">
                </div>
                <div class="input_product">
                    <label for="description"> Description  </label>
                    <textarea type="text" name="description" id="description"  autocomplete="off"><?= $data['description'] ?></textarea>
                </div>
                <div class="input_product">
                    <label for="image"> Upload Image  </label>
                    <input type="file" name="image" id="image" autocomplete="off">
                    <label for="image"> Current Image  </label>
                    <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                    <img src="../uploads/<?= $data['image'] ?>" alt="" height="100px">
                </div>
                <div class="input_product">
                    <label for="meta_title"> Meta Title  </label>
                    <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>" id="meta_title" autocomplete="off">
                </div>
                <div class="input_product">
                    <label for="meta_description"> Meta Description  </label>
                    <textarea type="text" name="meta_description" id="meta_description"  autocomplete="off"><?= $data['meta_description'] ?></textarea>
                </div>
                <div class="input_product">
                    <label for="meta_keywords"> Meta Keywords  </label>
                    <textarea type="text" name="meta_keywords" id="meta_keywords"  autocomplete="off"><?= $data['meta_keywords'] ?></textarea>
                </div>
                <div class="radio_wrapper">
                    <div class="input_radio">
                        <label for="status"> Status </label>
                        <input type="checkbox" <?= $data['status'] ? "checked":"" ?> name="status" id="status" autocomplete="off">
                    </div>
                    <div class="input_radio">
                        <label for="popular" > Popular  </label>
                        <input type="checkbox" <?= $data['popular'] ? "checked":"" ?> name="popular" id="popular" autocomplete="off">
                    </div>
                </div>
                <div class="button_submit">
                    <button name="update_category_btn" type="submit"> Update </button>
                </div>
            </form>
           </div>
        <?php   
                } else {
                    echo "Category not found";
                }
            } else {
                echo 'Id missing from url';
            }
        ?>
        </main>

    </div>

    <!-- JS -->
    <script src="js/scripts.js"></script>
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