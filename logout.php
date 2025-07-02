<?php
session_start();

if($_SESSION['auth']) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
}   

header("Location: index.php");