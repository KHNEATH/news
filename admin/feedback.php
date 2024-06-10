<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../include/dbconn.php');

if (empty($_SESSION['userid'])) {
    header('location: ../index.php');
    exit();
}
$stmt = $dbh->prepare("SELECT * FROM contact");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = 'Feedback';
    include('../include/header.php') ?>
</head>

<body>
    <?php include('../include/navbar.php') ?>
    <h1>Feedback from Users</h1>
    <?php if (isset($contacts) && !empty($contacts)) { ?>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Word</th>
            </tr>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($contact['id']); ?></td>
                    <td><?php echo htmlspecialchars($contact['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($contact['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                    <td><?php echo htmlspecialchars($contact['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($contact['word']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php } else { ?>
        <p>No contact data available.</p>
    <?php } ?>
</body>
<?php include('../include/footer.php') ?>

</html>