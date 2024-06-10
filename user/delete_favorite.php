<?php
session_start();

// Check if the user is authenticated
if (empty($_SESSION['userid'])) {
    header('location: ../index.php'); // Redirect to login page
    exit();
}

// Include database connection
include('../include/dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $favorite_id = $_POST['favorite_id'];

    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM favorites WHERE id = :favorite_id");
    $stmt->bindParam(':favorite_id', $favorite_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to favorites page
        sleep(1);
        $msg = "The Favorite was Deleted successfully.";
        header('location: ../pages/favorite.php');
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
