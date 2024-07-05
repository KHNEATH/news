<?php
include('../include/dbconn.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    try {
        // Create connection
        $dbh = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Delete post
        $delete_id = intval($_POST['delete_id']);
        $sql = "DELETE FROM post WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->errorInfo()[2];
        }

        // Redirect to the same page to refresh the list
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    if ($_SESSION['role'] === 'admin') {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            if (isset($_FILES["profile"]) && is_array($_FILES["profile"]["error"]) && count($_FILES["profile"]["error"]) > 0) {
                $uploadDir = "../uploads/";
                $uploadedFiles = [];
                $uploadErrors = [];

                foreach ($_FILES["profile"]["error"] as $key => $error) {
                    if ($error == 0) {
                        $uploadFile = $uploadDir . basename($_FILES["profile"]["name"][$key]);

                        if (move_uploaded_file($_FILES["profile"]["tmp_name"][$key], $uploadFile)) {
                            $uploadedFiles[] = basename($_FILES["profile"]["name"][$key]);
                        } else {
                            $uploadErrors[] = "Error uploading " . $_FILES["profile"]["name"][$key];
                        }
                    } else {
                        $uploadErrors[] = "Error uploading " . $_FILES["profile"]["name"][$key];
                    }
                }

                if (empty($uploadErrors)) {
                    $title = $_POST['title'];
                    $text = $_POST['text'];
                    $adminId = $_SESSION['userid'];
                    date_default_timezone_set('Asia/Bangkok');
                    $date = date('Y-m-d H:i:s');
                    $profiles = implode(",", $uploadedFiles);

                    $sql = "INSERT INTO post (profile, title, text, admin_id, created_at) 
                            VALUES (:profile, :title, :text, :admin_id, :date)";
                    $stmt = $dbh->prepare($sql);

                    $stmt->bindParam(':profile', $profiles);
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':text', $text);
                    $stmt->bindParam(':admin_id', $adminId);
                    $stmt->bindParam(':date', $date);

                    if ($stmt->execute()) {
                        $msg = "File uploaded successfully ^-^.";
                        header("Location: admin.php");
                        exit();
                    } else {
                        $error = "Error: " . implode(", ", $stmt->errorInfo());
                    }
                } else {
                    $error = implode("<br>", $uploadErrors);
                }
            } else {
                $error = "No file uploaded or an error occurred during upload.";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
            try {
                // Create connection
                $dbh = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $edit_id = intval($_POST['edit_id']);
                $edit_title = $_POST['title'];
                $edit_text = $_POST['text'];

                $sql = "UPDATE post SET title = :title, text = :text WHERE id = :id";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':title', $edit_title);
                $stmt->bindParam(':text', $edit_text);
                $stmt->bindParam(':id', $edit_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . implode(", ", $stmt->errorInfo());
                }

                // Redirect to the same page to refresh the list
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        echo "You do not have permission to access this page.";
    }
} else {
    header('location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = 'Admin Post';
include('../include/header.php')
?>

<body>
    <?php
    include('../include/navbar.php')
    ?>
    <div class="container">
        <div class="card rounded shadow-none mt-3">
            <div class="card-body">
                <div class="card-header text-center mb-3 bg-none">
                    <div class="row d-flex align-items-center ">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <h2 mb-0>Admin Post Form</h2>
                        </div>
                        <div class="col-4 text-end">
                            <button type="button mt-3" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Post News
                            </button>
                        </div>
                    </div>
                    <!-- Modal Post -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <!-- Add your form fields here -->
                                        <div class="form-group">
                                            <div class="form-group">
                                                <!-- HTML form for posting -->
                                                <label for="profile">Profile Photo:</label>
                                                <input type="file" class="form-control" id="profile" name="profile[]" multiple required>
                                            </div>
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Text:</label>
                                            <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <h2>Manage Posts</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="col-2">Title</th>
                                <th scope="col" class="col-8">Text</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Database connection
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "newssystem2";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch posts
                            $sql = "SELECT id, title, text FROM post";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <th scope='row'>" . htmlspecialchars($row['id']) . "</th>
                                            <td>" . htmlspecialchars($row['title']) . "</td>
                                            <td class='text-truncate' style='max-width: 300px;'>" . htmlspecialchars($row['text']) . "</td>
                                            <td class='action-buttons'>
                                                <a class='btn btn-sm btn-primary' href='edit-post.php?eid=" . htmlspecialchars($row['id']) . "'>Edit</a>
                                                <form method='post' action='' style='display:inline;'>
                                                    <input type='hidden' name='delete_id' value='" . htmlspecialchars($row['id']) . "'>
                                                    <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#modalCenter' onclick='setDeleteId(" . htmlspecialchars($row['id']) . ")'>Delete</button>
                                                </form>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No posts found</td></tr>";
                            }

                            // Close connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- model Detele -->
                <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title " id="modalCenterTitle">Confirm Delete</h3>

                            </div>
                            <div class="modal-body">
                                <h5>Are you want to delete?</h5>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="">
                                    <input type="hidden" name="delete_id" id="delete_id">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Yes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
</body>
<script>
    function populateEditModal(id, title, text) {
        document.getElementById('edit_id').value = id;
        document.getElementById('title').value = title;
        document.getElementById('text').value = text;
    }

    function setDeleteId(id) {
        document.getElementById('delete_id').value = id;
    }
</script>
<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>