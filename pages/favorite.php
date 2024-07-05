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

// Initialize variables
$newsId = 1; // Assuming this is the ID of the news item to display

// Fetch the news item to display
try {
    $stmt = $dbh->prepare("SELECT * FROM viewer WHERE id = :id");
    $stmt->bindParam(':id', $newsId, PDO::PARAM_INT);
    $stmt->execute();
    $newsItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$newsItem) {
        echo 'News item not found.';
        exit();
    }
} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}

// Fetch favorite posts
$sql = "SELECT * FROM post JOIN favorites ON post.id = favorites.post_id";
$stmt = $dbh->prepare($sql);
$stmt->execute();

// Fetch all the results
$favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo htmlspecialchars($title); ?></title>
    <!-- Include any necessary meta tags, stylesheets, or scripts -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../path/to/your/styles.css"> <!-- Adjust the path as needed -->
    <style>
        .profile-img {
            max-width: 100%;
            /* Ensure the image does not exceed its container width */
            height: auto;
            /* Maintain aspect ratio */
            object-fit: cover;
            /* Cover the container without distortion */
            border-radius: 10px;
            /* Optional: Rounded corners for the profile image */
        }
    </style>
</head>

<body>
    <!-- Include navbar -->
    <?php include('../include/navbar.php'); ?>

    <div class="container col-xl-6  order-5 order-xxl-0 d-flex justify-content-center">
        <div class="card h-100">
            <div class="card-header">
                <div class="card-title mb-0">
                    <h5 class="m-0 text-center">Favorites</h5>
                </div>
            </div>
            <div class="card-body ">
                <!-- Your content for the card body here -->
                <ul class="list-group ">
                    <?php
                    // Check if $favorites is not empty
                    if (!empty($favorites)) {
                        // Loop through favorites
                        foreach ($favorites as $favorite) {
                            echo '<li class="list-group-item">';

                            // Display profile image if available
                            if (isset($favorite['profile'])) {
                                $profileImages = explode(",", $favorite['profile']);
                                $firstImage = trim($profileImages[0]);
                                echo '<div class="profile-img-container">';
                                echo '<img src="../uploads/' . htmlspecialchars($firstImage) . '" class="profile-img" alt="Profile Image">';
                                echo '</div>';
                            }

                            // Display title if available
                            if (isset($favorite['title'])) {
                                echo '<div class="item-content fw-bold">';
                                echo '<p>' . htmlspecialchars($favorite['title']) . '</p>';
                                echo '</div>';
                            }

                            // Display description if available
                            if (isset($favorite['text'])) {
                                echo '<div class="item-content">';
                                echo '<p style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">' . htmlspecialchars($favorite['text']) . '</p>';
                                echo '</div>';
                            }

                            echo '<div style="border-bottom: 1px solid LightGray; width: 100%; margin-top: 10px"></div>';

                            // Delete button form
                            echo '<div class="delete-form text-end mt-2">';
                            echo '<form method="POST" action="../user/delete_favorite.php">';
                            echo '<input type="hidden" name="favorite_id" value="' . htmlspecialchars($favorite['id']) . '">';
                            echo '<button type="submit" class="btn btn-danger btn-sm">Delete</button>';
                            echo '</form>';
                            echo '</div>';

                            echo '</li>';
                        }
                    } else {
                        // Display message if no favorites are present
                        echo '<li class="list-group-item">No favorites added yet.</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>


    <!-- <div class="container">
        <?php if (isset($msg)) { ?>
            <div class="alert alert-primary" role="alert">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php } ?>
        <div class="mt-3">
            <h1>Favorites</h1>
        </div>
        <div class="container-fluid home">
            <div>
                <ul class="list-group">
                    <?php
                    // Check if $favorites is not empty
                    if (!empty($favorites)) {
                        // Loop through favorites
                        foreach ($favorites as $favorite) {
                            echo '<li class="list-group-item">';

                            // Display profile image if available
                            if (isset($favorite['profile'])) {
                                $profileImages = explode(",", $favorite['profile']);
                                $firstImage = trim($profileImages[0]);
                                echo '<div class="profile-img-container">';
                                echo '<img src="../uploads/' . htmlspecialchars($firstImage) . '" class="profile-img" alt="Profile Image">';
                                echo '</div>';
                            }

                            // Display title if available
                            if (isset($favorite['title'])) {
                                echo '<div class="item-content">';
                                echo '<p>' . htmlspecialchars($favorite['title']) . '</p>';
                                echo '</div>';
                            }

                            // Display description if available
                            if (isset($favorite['text'])) {
                                echo '<div class="item-content">';
                                echo '<p style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">' . htmlspecialchars($favorite['text']) . '</p>';
                                echo '</div>';
                            }

                            // Delete button form
                            echo '<div class="delete-form">';
                            echo '<form method="POST" action="../user/delete_favorite.php">';
                            echo '<input type="hidden" name="favorite_id" value="' . htmlspecialchars($favorite['id']) . '">';
                            echo '<button type="submit" class="btn btn-danger btn-sm">Delete</button>';
                            echo '</form>';
                            echo '</div>';

                            echo '</li>';
                        }
                    } else {
                        // Display message if no favorites are present
                        echo '<li class="list-group-item">No favorites added yet.</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div> -->



    <!-- Include footer -->
    <?php include('../include/footer.php'); ?>
</body>

</html>