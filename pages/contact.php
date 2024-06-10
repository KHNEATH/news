<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include('../include/dbconn.php');

if (empty($_SESSION['userid'])) { // Check if userid is empty or not set
  header('location: ../index.php');
  exit(); // Terminate script after redirect
}

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
        <img src="https://marketplace.canva.com/EAFMBRX08aA/2/0/1600w/canva-modern-red-yellow-breaking-news-intro-animation-video-UIT1LgQx_rA.jpg" alt="" style="width: 45%" />
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