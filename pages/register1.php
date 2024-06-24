<?php
include('../include/dbconn.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve other form data
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Use bcrypt for hashing
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $fileName = null;

    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $uploadDir = "../uploads/"; // Directory to store uploaded files
        $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);
        $fileType = pathinfo($uploadFile, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
                $fileName = basename($_FILES["file"]["name"]);
            } else {
                $_SESSION['error'] = "Error uploading file.";
                header('Location: register.php');
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid file format. Only JPG, PNG, JPEG, and GIF files are allowed.";
            header('Location: register.php');
            exit;
        }
    }

    try {
        // Prepare the SQL statement to prevent SQL injection
        $sql = "INSERT INTO registered (profile, firstname, lastname, email, dob, password, contact, gender, role) 
                VALUES (:profile, :first, :last, :email, :dob, :password, :mobile, :gender, :role)";
        $stmt = $dbh->prepare($sql);
        

        // Bind parameters and execute the statement
        $stmt->bindParam(':profile', $fileName);
        $stmt->bindParam(':first', $first);
        $stmt->bindParam(':last', $last);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Registration successful.";
        } else {
            $_SESSION['error'] = "Error executing the query.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    header('Location: register.php');
    exit;
}
?>
