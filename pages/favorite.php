<?php
// Start the session
session_start();

// Check if the user is authenticated
if (empty($_SESSION['userid'])) {
    header('location: ../index.php'); // Redirect to login page
    exit();
}

// Include necessary files
include('../include/dbconn.php');
$title = 'Favorite';
include('../include/header.php');

$sql = "SELECT * FROM post JOIN favorites ON post.id = favorites.post_id";
$stmt = $dbh->prepare($sql);
$stmt->execute();

// Fetch all the results
$favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <!-- Include any necessary meta tags, stylesheets, or scripts -->
</head>

<body>
    <!-- Include navbar -->
    <?php include('../include/navbar.php'); ?>

    <div class="container">
        <?php if (isset($msg)) { ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $msg ?>
            </div>
        <?php } ?>
        <div class="mt-3"></div>
        <h1>Favorites</h1>
        <div class="mt-3"></div>
        <ul class="list-group ">
            <?php
            // Check if $favorites is not empty
            if (!empty($favorites)) {
                // Loop through favorites
                foreach ($favorites as $favorite) {
                    // Display favorite information
                    echo '<li class="list-group-item">';

                    // Check if 'profile', 'title', and 'text' are set in the $favorite array
                    if (isset($favorite['profile'])) {
                        echo '<img src="../uploads/' . htmlspecialchars($favorite['profile']) . '" width="100px" style="margin-bottom: 1rem;" alt="Favorite Picture">';
                    }

                    if (isset($favorite['title'])) {
                        echo '<p>Title: ' . htmlspecialchars($favorite['title']) . '</p>';
                    }

                    if (isset($favorite['text'])) {
                        echo '<p style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">Description: ' . htmlspecialchars($favorite['text']) . '</p>';
                    }

                    // Delete button form
                    echo '<form method="POST" action="../user/delete_favorite.php" style="display:inline;">
                        <input type="hidden" name="favorite_id" value="' . htmlspecialchars($favorite['id']) . '">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>';

                    // Add more fields as needed
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