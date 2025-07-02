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
                <h2> EDIT PRODUCT </h2>
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
                    <li class="sidebar-list-item-active">
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
           <div class="addproduct_wrapper">
            <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $product = getByID('products',$id);

                    if(mysqli_num_rows($product) > 0) 
                    {
                        $data = mysqli_fetch_array($product);
            ?>
                        <form class="addproduct_form" action="code.php" enctype="multipart/form-data" method="POST">
                            <div class="input_product">
                                <label for="selec"> Select Category </label>
                                <select name="category_id" id="category_id">
                                    <option selected> Select Category </option>
                                    <?php 
                                        $categories = getAll('categories');
                                        
                                        if (mysqli_num_rows($categories) > 0) {
                                            foreach ($categories as $item) {
                                                ?>
                                                    <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id'] ? "selected":"" ?> > <?= $item['name']; ?> </option>
                                                <?php
                                            }
                                        } else {
                                            echo "No category available";
                                        } 
                                    ?>
                                </select>
                                <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                            </div>
                            <div class="input_product">
                                <label for="name"> Name </label>
                                <input type="text" name="name" id="name" value="<?= $data['name'] ?>" autocomplete="off" required>
                            </div>
                            <div class="input_product">
                                <label for="slug"> Slug  </label>
                                <input type="text" name="slug" id="slug" value="<?= $data['slug'] ?>" autocomplete="off" required>
                            </div>
                            <div class="input_product">
                                <label for="small_description"> Small Description  </label>
                                <textarea type="text" name="small_description" id="small_description"  autocomplete="off" required><?= $data['small_description'] ?></textarea>
                            </div>
                            <div class="input_product">
                                <label for="description"> Description  </label>
                                <textarea type="text" name="description" id="description"  autocomplete="off" required><?= $data['description'] ?></textarea>
                            </div>
                            <div class="input_product">
                                <label for="original_price"> Original Price </label>
                                <input type="number" name="original_price" id="original_price" value="<?= $data['original_price'] ?>" autocomplete="off" required>
                            </div>
                            <div class="input_product">
                                <label for="selling_price"> Selling Price  </label>
                                <input type="number" name="selling_price" id="selling_price" value="<?= $data['selling_price'] ?>" autocomplete="off" required>
                            </div>
                            <div class="input_product">
                                <label for="image"> Upload Image  </label>
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                <input type="file" name="image" id="image" autocomplete="off">
                                <label for="image"> Current Image </label>
                                <img src="../uploads/<?= $data['image'] ?>" alt="Product Image" height="100px">
                            </div>
                            <div class="input_product">
                                <label for="qty"> Quantity  </label>
                                <input type="number" name="qty" id="qty" value="<?= $data['qty'] ?>" autocomplete="off" required>
                            </div>
                            <div class="radio_wrapper">
                                <div class="input_radio">
                                    <label for="status"> Status </label>
                                    <input type="checkbox" name="status" id="status" <?= $data['status'] == '0' ? '':'checked'?> value="<?= $data['status'] ?>" autocomplete="off">
                                </div>
                                <div class="input_radio">
                                    <label for="trending"> Trending </label>
                                    <input type="checkbox" name="trending" id="trending" <?= $data['trending'] == '0' ? '':'checked'?> value="<?= $data['trending'] ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="input_product">
                                <label for="meta_title"> Meta Title  </label>
                                <input type="text" name="meta_title" id="meta_title" value="<?= $data['meta_title'] ?>" autocomplete="off" required>
                            </div>
                            <div class="input_product">
                                <label for="meta_description"> Meta Description  </label>
                                <textarea type="text" name="meta_description" id="meta_description"  autocomplete="off" required> <?= $data['meta_description'] ?> </textarea>
                            </div>
                            <div class="input_product">
                                <label for="meta_keywords"> Meta Keywords  </label>
                                <textarea type="text" name="meta_keywords" id="meta_keywords"  autocomplete="off" required> <?= $data['meta_keywords'] ?>  </textarea>
                            </div>

                            <div class="button_submit">
                                <button name="update_product_btn" type="submit"> Update Product </button>
                            </div>
                        </form>
                        <?php
                    } else {
                        echo "Product not found for given id";
                    }
                } else {
                    echo "Id missing from URL";
                }
            ?>
           </div>
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