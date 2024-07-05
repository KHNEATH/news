<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../include/dbconn.php');

if (empty($_SESSION['userid'])) {
    header('location: ../index.php');
    exit();
}


// Initialize variables
$newsId = 1; // Assuming this is the ID of the news item to display

// Check if session variable is not set (indicating first visit in this session)
if (!isset($_SESSION['visited'])) {
  try {
    // Increment view count in database
    $incrementViewCountStmt = $dbh->prepare("UPDATE viewer SET view_count = view_count + 1 WHERE id = :id");
    $incrementViewCountStmt->bindParam(':id', $newsId, PDO::PARAM_INT);
    $incrementViewCountStmt->execute();

    // Set session variable to indicate visit
    $_SESSION['visited'] = true;
  } catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
  }
}

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

$stmt = $dbh->prepare("SELECT * FROM contact");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete'])) {
    $contact_id = intval($_POST['contact_id']); // Get the contact ID from the form
    $sql = "DELETE FROM contact WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $contact_id, PDO::PARAM_INT);
    if ($query->execute()) {
    } else {
        echo "Error deleting contact.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = 'Feedback';
    include('../include/header.php');
    ?>
</head>

<body>
    <?php include('../include/navbar.php'); ?>
    <div class="mt-3"></div>
    <h1>Feedback from Users</h1>
    <div class="mt-3"></div>
    <?php if (isset($contacts) && !empty($contacts)) { ?>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Word</th>
                <th>Action</th>
            </tr>
            <?php
            $cnt = 1;
            foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($cnt); ?></td>
                    <td><?php echo htmlspecialchars($contact['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($contact['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                    <td><?php echo htmlspecialchars($contact['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($contact['word']); ?></td>
                    <td>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $contact['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are You Sure! you want to delete this Feedback?<?php echo $contact['id'] ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="contact_id" value="<?php echo htmlspecialchars($contact['id']); ?>">
                                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $contact['id'] ?>">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php
                $cnt++;
            endforeach; ?>
        </table>
    <?php } else { ?>
        <p>No contact data available.</p>
    <?php } ?>
</body>
<?php include('../include/footer.php'); ?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>