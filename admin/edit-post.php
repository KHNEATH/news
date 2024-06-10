<?php
include('../include/dbconn.php');
// Set the default timezone
date_default_timezone_set('Asia/Bangkok');

// Get the current date and time in YYYY-MM-DD HH:MM:SS format
$currentDate = date('Y-m-d H:i:s');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    $getid = $_GET['eid'];

    // Handling the edit post functionality
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Initialize variables with form data
            $edit_id = intval($_POST['edit_id']);
            $edit_title = $_POST['title'];
            $edit_text = $_POST['text'];
            $edit_profile = '';

            // Check if a new profile image has been uploaded
            if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
                // File upload logic
                $uploadDir = "../uploads/"; // Directory to store uploaded files
                $uploadFile = $uploadDir . basename($_FILES["profile"]["name"]);

                // Move uploaded file to designated directory
                if (move_uploaded_file($_FILES["profile"]["tmp_name"], $uploadFile)) {
                    $edit_profile = basename($_FILES["profile"]["name"]); // Update profile image variable with new file name
                } else {
                    echo "Error uploading file."; // Display error message if file upload fails
                }
            }

            // Prepare SQL statement for updating post data
            $sql = "UPDATE post SET title = :title, text = :text";
            // Update SQL statement to include profile image if it's been updated
            if (!empty($edit_profile)) {
                $sql .= ", profile = :profile";
            }
            $sql .= " WHERE id = :id";

            $stmt = $dbh->prepare($sql);

            // Bind parameters for SQL statement
            $stmt->bindParam(':title', $edit_title);
            $stmt->bindParam(':text', $edit_text);
            if (!empty($edit_profile)) {
                $stmt->bindParam(':profile', $edit_profile);
            }
            $stmt->bindParam(':id', $edit_id, PDO::PARAM_INT);

            // Execute SQL statement
            if ($stmt->execute()) {
                $msg = "Record updated successfully";
            } else {
                $error = "Error updating record.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Fetch post data for editing
    $postData = [];
    if ($getid > 0) {
        try {
            $sql = "SELECT * FROM post WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $getid, PDO::PARAM_INT);
            $stmt->execute();

            $postData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$postData) {
                echo "No post found with ID " . $getid;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    $title = 'Admin Post';
    include('../include/header.php');
    ?>
    <?php if (isset($msg)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucess:</strong> <?php echo $msg;  ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>

    <?php } elseif (isset($error)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Unsucess:</strong> <?php echo $msg;  ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div>
            <?php echo $error;  ?>
        </div>
        </div>
    <?php } ?>

    <body>
        <?php include('../include/navbar.php'); ?>
        <div class="container">
            <div class="card rounded shadow-none mt-3">
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="edit_id" value="<?php echo htmlentities($postData['id']); ?>">
                            <input type="hidden" name="login_type" value="updatedimg">
                            <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto">
                                <!-- Clickable profile picture to change profile image -->
                                <label for="profileInput" class="profile-image">
                                    <?php if (!empty($postData['profile'])) : ?>
                                        <img src="<?php echo htmlentities('../uploads/' . $postData['profile']); ?>" alt="user image" class="d-block h-auto ms-0 ms-sm-5 rounded border p-1 bg-light user-profile-img shadow-sm" height="150px" width="150px" style="object-fit: cover;">
                                    <?php else : ?>
                                        <!-- Placeholder image if no profile picture exists -->
                                        <img src="placeholder.jpg" alt="user image" class="d-block h-auto ms-0 ms-sm-5 rounded border p-1 bg-light user-profile-img shadow-sm" height="150px" width="150px" style="object-fit: cover;">
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="profile" id="profileInput" class="d-none" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($postData['title']) ? htmlspecialchars($postData['title']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="text">Text:</label>
                                <textarea class="form-control" id="text" name="text" rows="5" required><?php echo isset($postData['text']) ? htmlspecialchars($postData['text']) : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <?php echo isset($postData['created_at']) ? htmlspecialchars($postData['created_at']) : ''; ?>
                    <?php
                    if (isset($postData['created_at'])) {
                        $updatedDate = new DateTime($postData['created_at']);
                        $now = new DateTime();
                        $interval = $now->diff($updatedDate);
                        date_default_timezone_set('Asia/Bangkok');
                        $date = date('Y-m-d H:i:s');
                        if ($interval->y > 0) {
                            $timeAgo = $interval->y . ' years ago';
                        } elseif ($interval->m > 0) {
                            $timeAgo = $interval->m . ' months ago';
                        } elseif ($interval->d > 0) {
                            $timeAgo = $interval->d . ' days ago';
                        } elseif ($interval->h > 0) {
                            $timeAgo = $interval->h . ' hours ago';
                        } elseif ($interval->i > 0) {
                            $timeAgo = $interval->i . ' minutes ago';
                        } else {
                            $timeAgo = 'Just now';
                        }

                        echo '<small class="text-muted">Last updated ' . htmlspecialchars($timeAgo) . '</small>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Include Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            // Display selected profile image
            document.getElementById('profileInput').addEventListener('change', function() {
                const profileImage = this.previousElementSibling.querySelector('img');
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        </script>
    </body>

    </html>
<?php
} else {
    // If user does not have admin privileges, display an error message
    echo "You do not have permission to access this page.";
}
?>