<?php
include 'config/dbcon.php';

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getUserById($user_id)
{
    global $con;
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getCartItems() 
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$user_id' 
    ORDER BY c.id DESC";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getWishListItems() 
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT w.id as wid, w.prod_id, w.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM wishlist w, products p WHERE w.prod_id=p.id AND w.user_id='$user_id' 
    ORDER BY w.id DESC";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getOrders() 
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id='$user_id' AND status='0' OR status='1' OR status='2' OR status='3'ORDER BY id DESC ";
    $query_run = mysqli_query($con, $query);
    return $query_run;
} 

function getOrderHistory() 
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id='$user_id' AND status='4' OR status='5' ORDER BY id DESC ";
    $query_run = mysqli_query($con, $query);
    return $query_run;
} 

function getUserDetails() 
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];


    $query = "SELECT * FROM users WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
} 

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$user_id'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}



function redirect($url, $message)
{
    $_SESSION['message'] = $message; 
    header("Location: ".$url);
}