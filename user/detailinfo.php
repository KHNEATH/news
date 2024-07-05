<?php
// Set the default timezone
date_default_timezone_set('Asia/Bangkok');

// Get the current date and time in YYYY-MM-DD HH:MM:SS format
$currentDate = date('Y-m-d H:i:s');

include('../include/dbconn.php');

// Get the post ID from the URL
$getid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Prepare and execute SQL statement to fetch the post details
$sql = $dbh->prepare("SELECT * FROM post WHERE id = :getid");
$sql->bindParam(':getid', $getid, PDO::PARAM_INT);
$sql->execute();
$lastselect = $sql->fetch(PDO::FETCH_ASSOC);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve post ID
    $postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);

    // Prepare SQL statement to add the post to favorites
    $sql = "INSERT INTO favorites (post_id) VALUES (:postId)";
    $stmt = $dbh->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':postId', $postId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Post added to favorites successfully');</script>";
    } else {
        echo "<script>alert('Error adding post to favorites');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = 'Detail';
    include('../include/header.php');
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php include('../include/navbar.php'); ?>
    </nav>

    <div class="container mt-5 mb-5">
        <h1 class="text-left text-uppercase font-weight-bold text-info">
            Detail Information
        </h1>
        <!-- This page will display news detail such as image, name, date, location, and description. -->
    </div>
    <hr>
    <div class="container">
        <div class="row m-2">
            <div class="card col-lg-4 col-md-4 col-12 my-5 shadow-sm rounded-3">
                <div class="list-group border-0">
                    <div class="list-group-item border-0 mt-3 rounded fs-4 bg-light">
                        <h6 class="text-center mb-0 text-info"><?php echo htmlspecialchars($lastselect['title']); ?></h6>
                    </div>
                </div>
                <div class="list-group-item border-0 text-dark fs-5 bg-light">
                    <!-- Carousel -->
                    <div id="carouselExampleIndicators" class="carousel slide m-auto mt-2 carouselimg" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php
                            $profileImages = explode(",", $lastselect['profile']);
                            foreach ($profileImages as $index => $image) {
                                $active = ($index === 0) ? 'active' : '';
                                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $index . '" class="' . $active . '" aria-label="Slide ' . ($index + 1) . '"></button>';
                            }
                            ?>
                        </div>
                        <div class="carousel-inner">
                            <?php
                            foreach ($profileImages as $index => $image) {
                                $active = ($index === 0) ? 'active' : '';
                                echo '<div class="carousel-item ' . $active . '">';
                                echo '<img style="object-fit: cover; width:100%; height: auto;" src="../uploads/' . trim($image) . '" />';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12 my-5 shadow-sm rounded-3">
                <div class="list-group border-0">
                    <div class="list-group-item border-0 mt-3 rounded fs-4 bg-light" style="background-color:#394867">
                        <h5 class="text-center mb-0 text-info">
                            <?php echo date('D-m-Y, h:i A', strtotime($lastselect['created_at'])); ?>
                        </h5>
                    </div>
                    <div class="list-group-item fs-5 lead">
                        <div class="d-flex flex-column">
                            <p class="text-center mb-0 dark-text" style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                <?php echo nl2br(htmlspecialchars($lastselect['text'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end bg-light">
                    <?php
                    if (isset($_SESSION['userid']) || !empty($_SESSION['userid'])) { ?>
                        <form method="post">
                            <input type="hidden" name="postId" value="<?php echo htmlspecialchars($lastselect['id']); ?>">
                            <button type="submit" class="btn btn-primary add-to-favorite">Add to favorite</button>
                        </form>
                    <?php } else { ?>
                        <div class="alert bg-light text-center border fw-bold mt-2">Please Login Before You Can Add to Favorite <a href="../login.php" class="btn btn-outline-secondary me-2"><i class='bx bx-log-in bx-tada me-2'></i>Login</a></div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../include/footer.php'); ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.0/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>