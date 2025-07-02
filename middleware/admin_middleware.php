<?php
include('../functions/functions.php');

if (isset($_SESSION['auth'])) {
    if ($_SESSION['role_as'] == 0) {
        redirect('../index.php', "You are not authorize to this page");
    }
} else {
    redirect('../login.php', "login to continue");
}