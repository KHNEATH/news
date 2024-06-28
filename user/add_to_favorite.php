<?php
session_start();

// Check if the user is authenticated
if (!empty($_SESSION['userid'])) {
    header('location: ../index.php'); // Redirect to login page
    exit();
}

include('../include/dbconn.php');

// Function to send a message to the user
function send_message($message)
{
    echo '<script>alert("' . $message . '");</script>';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $title = !empty($_POST['title']) ? htmlspecialchars($_POST['title']) : null;
    $id = !empty($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
    $profile = !empty($_POST['profile']) ? htmlspecialchars($_POST['profile']) : null;

    if ($title && $id && $profile) {
        try {
            // Prepare an SQL statement for execution
            $sql = "INSERT INTO favorites (post_id, title, profile) VALUES (:id, :title, :profile)";
            $stmt = $dbh->prepare($sql);

            // Bind the input parameters to the prepared statement
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':profile', $profile, PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                send_message('Item added to favorites successfully.');
            } else {
                send_message('Failed to add item to favorites.');
            }
        } catch (PDOException $e) {
            send_message('Database error: ' . $e->getMessage());
        }
    } else {
        send_message('Invalid data.');
    }
}

// Prepare SQL statement to fetch favorites
try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare("SELECT id, title, post_id, profile FROM favorites");
    $stmt->execute();
    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Favorites</title>
    <!-- Include any necessary meta tags, stylesheets, or scripts -->
</head>

<body>
    <!-- Include navbar -->
    <?php include('../include/navbar.php'); ?>

    <div class="container">
        <h1>Favorites</h1>

        <!-- Form to add a favorite -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="id">Post ID:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="profile">Profile:</label>
                <input type="text" class="form-control" id="profile" name="profile" required>
            </div>
            <button type="submit" class="btn btn-primary">Add to Favorites</button>
        </form>

        <ul class="list-group mt-4">
            <?php
            // Check if there are any favorites
            if (!empty($favorites)) {
                // Loop through favorites
                foreach ($favorites as $favorite) {
                    echo '<li class="list-group-item">';
                    echo '<p>ID: ' . htmlspecialchars($favorite['id']) . '</p>';
                    echo '<p>Title: ' . htmlspecialchars($favorite['title']) . '</p>';
                    echo '<p>Post ID: ' . htmlspecialchars($favorite['post_id']) . '</p>';
                    echo '<p>Profile: ' . htmlspecialchars($favorite['profile']) . '</p>';
                    echo '</li>';
                }
            } else {
                // Display message if no favorites are present
                echo '<li class="list-group-item">No favorites added yet.</li>';
            }
            ?>
        </ul>
    </div>

    <!-- Include footer -->
    <?php include('../include/footer.php'); ?>
</body>

</html>