<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../include/dbconn.php');
if (empty($_SESSION['userid'])) { // Check if userid is empty or not set
    header('location: ../index.php');
    exit(); // Terminate script after redirect
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        $title = 'Admin info';
        include('../include/header.php');

        try {
            // Include the dbconn.php file
            include('../include/dbconn.php');
            $getid = $_GET['userid'] ?? null; // Safely get the userid from $_GET

            if ($getid !== null) { // Check if userid is provided
                // Query to fetch admin data
                $sql = "SELECT firstname, lastname, email, contact, profile FROM registered WHERE id = :getid LIMIT 1"; // Assuming there's only one admin

                // Prepare the SQL query
                $query = $dbh->prepare($sql);

                $query->bindParam(':getid', $getid, PDO::PARAM_INT);
                // Execute the query
                $query->execute();

                // Fetch data using fetch
                $admin_data = $query->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "No user ID provided.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $dbh = null; // Close the database connection
        ?>

    </head>

    <body>
        <?php include('../include/navbar.php') ?>
        <a href="admin.php" class="btn btn-success m-2">Back to Admin</a>
        <?php
        // Check if admin data exists
        if (isset($admin_data)) {
        ?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="mt-3 d-flex flex-column align-items-center" id="profile-info">
                                    <!-- <img src="../uploads/User.jpg" alt=""> -->

                                    <?php
                                    $defaultImagePath = 'User.jpg';
                                    $img = $user_data["profile"];
                                    $profileImagePath = $img ?? $defaultImagePath;
                                    ?>

                                    <h1><?php echo $user_data["firstname"] . ' ' . $user_data["lastname"]; ?>'s Profile</h1>
                                    <img class="mb-3" height="100px" width="100px" src="../uploads/<?php echo $profileImagePath ?>" alt="Profile Picture">
                                    <p class="text-primary fw-bold fs-5">Email: <?php echo $user_data["email"]; ?></p>
                                    <p>Contact: <?php echo $user_data["contact"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </body>


    </html>
<?php } ?>