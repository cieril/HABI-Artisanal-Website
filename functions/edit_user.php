<?php
session_start();
include('../config/dbcon.php');

if(isset($_SESSION['auth'])) {
    if (isset($_POST['updateUserBtn'])) {
        $user_id = $_SESSION['auth_user']['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $user_update_query = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$user_id'";
        $user_update_query_run = mysqli_query($con, $user_update_query);

        $_SESSION['message'] = "User info updated successfully";
        header('Location: ../user.php');
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('Location: ../user.php');
    }
} else {
    $_SESSION['message'] = "Something went wrong";
    header('Location: ../index.php');
}
