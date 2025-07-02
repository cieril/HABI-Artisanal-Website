<?php
session_start();
include('../config/dbcon.php');


// if(isset($_SESSION['auth'])) {
//     if (isset($_POST['addReviewBtn'])) {
//         $user_id = $_POST['user_id'];
//         $comment = $_POST['comment'];
//         $prod_id = $_POST['prod_id'];
//         $name = $_POST['name'];
//         $ratings = $_POST['ratings'];
//         $anonymous = isset($_POST['anonymous']) ? $_POST['anonymous'] : 0;

//         $chck_existing_review = "SELECT * FROM reviews WHERE prod_id='$prod_id' AND user_id='$user_id' ";
//         $chck_existing_review_run = mysqli_query($con, $chck_existing_review);

//         if (mysqli_num_rows($chck_existing_review_run) > 0) {
//             $_SESSION['message'] = "You can only review once per product";
//             header('location: ../order_history.php');
//         } else {
//             $insert_review_query = "INSERT INTO reviews (user_id, prod_id, name, ratings, comment, anonymous) VALUES ('$user_id', '$prod_id', '$name', '$ratings', '$comment', '$anonymous')";            
//             $insert_review_query_run = mysqli_query($con, $insert_review_query);

//             if ($insert_review_query_run) {
//                 $_SESSION['message'] = "Review added successfully";
//                 header('location: ../order_history.php');
//             } else {
//                 $_SESSION['message'] = "Something went wrong";
//                 header('location: ../order_history.php');
//             }
//         }
        
//     }
// } else {
//     header("Location: ../index.php");
// }

if (isset($_SESSION['auth'])) {
    if (isset($_POST['addReviewBtn'])) {
        // Fetch form data
        $user_id = $_POST['user_id'];
        $comment = $_POST['comment'];
        $slug = $_POST['slug'];
        $name = $_POST['name'];
        $ratings = $_POST['ratings'];
        $anonymous = isset($_POST['anonymous']) ? $_POST['anonymous'] : 0; // Default to 0 if not set

        // Check if the user has already reviewed this product
        $chck_existing_review = "SELECT * FROM reviews WHERE prod_slug=? AND user_id=?";
        $stmt_check = $con->prepare($chck_existing_review);
        $stmt_check->bind_param("ii", $slug, $user_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $_SESSION['message'] = "You can only review once per product";
            header('location: ../order_history.php');
            exit; // Exit to prevent further execution
        }

        // Insert the review into the database
        $insert_review_query = "INSERT INTO reviews (user_id, prod_slug, name, ratings, comment, anonymous) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $con->prepare($insert_review_query);
        $stmt_insert->bind_param("iisiss", $user_id, $slug, $name, $ratings, $comment, $anonymous);

        if ($stmt_insert->execute()) {
            $_SESSION['message'] = "Review added successfully";
        } else {
            $_SESSION['message'] = "Error adding review: " . $stmt_insert->error;
        }

        // Redirect after processing
        header('location: ../order_history.php');
        exit; // Exit to prevent further execution
    }
}