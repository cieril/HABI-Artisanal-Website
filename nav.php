    <nav>
        <ul class="nav-list">
            <li><a href="index.php"><img src="img/habi_logo.png" alt="Logo"></a></li>
            <li class="nav-links"><a href="about.php"> ABOUT </a></li>
            <li class="nav-links"><a href="contact.php"> CONTACT </a></li>
            <li class="nav-links"><a href="cart.php"> CART </a></li>
            <?php
            if (isset($_SESSION['auth'])) {
            ?>
                <li class="nav-links"><a href="user.php"> PROFILE </a></li>
                <li class="login"><a href="logout.php"> LOGOUT <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
            <?php
                }
                else {
                    ?>
                <li class="login"><a href="login.php"> LOGIN <i class="fa-solid fa-arrow-right-to-bracket"></i></a></li>
                    <?php
                }
            ?>
        </ul>
    </nav>