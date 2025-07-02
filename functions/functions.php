<?php
session_start();
include('dbcon.php');

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header("Location: ".$url);
}

function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status='0' OR status='1' OR status='2' OR status='3'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getOrderHistory()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status='4' OR status='5'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' ";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}


