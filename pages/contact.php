<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include('../include/dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $firstname = $_POST['first_name'];
  $lastname = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone_number'];
  $word = $_POST['word'];

  // Prepare an insert statement
  $stmt = $dbh->prepare("INSERT INTO contact (first_name, last_name, email, phone_number, word) VALUES (:first_name, :last_name, :email, :phone_number, :word)");
  $stmt->bindParam(':first_name', $firstname);
  $stmt->bindParam(':last_name', $lastname);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':phone_number', $phone);
  $stmt->bindParam(':word', $word);

  if ($stmt->execute()) {
    echo "Word submitted successfully!";
  } else {
    echo "Error: " . $stmt->errorInfo()[2];
  }
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
?>


<!DOCTYPE html>
<html lang="en">
<html lang="en">

<head>
  <?php
  $title = 'Contact us';
  include('../include/header.php') ?>
</head>

<body>
  <?php include('../include/navbar.php') ?>
  <div class="container-fluid" style="background-color: white">
    <div class="row p-5 align-items-center">
      <div class="col-lg-6 d-flex justify-content-center">
        <img src="../images/cropped-Official-iau-logo2.png" alt="" style="width: 45%" />
      </div>
      <div class="col-lg-6">
        <h3 class="my-3">Feedback</h3>
        <form method="POST">
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <label class="form-label" for="form3Example1">First name</label>
                <input placeholder="Please enter your firstname" type="text" name="first_name" id="form3Example1" class="form-control" />
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <label class="form-label" for="form3Example2">Last name</label>
                <input placeholder="Please enter your lastname" type="text" name="last_name" id="form3Example2" class="form-control" />
              </div>
            </div>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input placeholder="Please enter your email" type="email" name="email" id="form3Example3" class="form-control" />
          </div>
          <!-- Phone input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Phone Number</label>
            <input placeholder="Please enter your phone number" type="number" name="phone_number" id="form3Example3" class="form-control" />
          </div>
          <!-- textarea input -->
          <div class="form-group">
            <label for="exampleFormControlTextarea1">YOUR WORDS</label>
            <textarea placeholder="List Down Your Feedback" class="form-control" name="word" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary btn-block mb-4 mt-3">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include('../include/footer.php') ?>
  <!-- Footer -->
</body>

</html>

</html>