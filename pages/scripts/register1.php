<?php
include('../include/dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $uploadDir = "../uploads/"; // Directory to store uploaded files
        $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);

        // Retrieve other form data
        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $password = md5($_POST['password']); // Consider using a more secure hashing method like bcrypt or SHA-256
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $role = $_POST['role'];
        // $createdAt = date('Y-m-d');

        try {
            // Move uploaded file to designated directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
                // File uploaded successfully, now insert file info into database
                $fileName = basename($_FILES["file"]["name"]);

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
                
                $stmt->execute();
                
                $msg = "File uploaded successfully ^-^.";
            } else {
                $error = "Error uploading file.";
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "No file uploaded or an error occurred during upload.";
    }
}

