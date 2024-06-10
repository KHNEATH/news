<?php // Set the default timezone
date_default_timezone_set('Asia/Bangkok');

// Get the current date and time in YYYY-MM-DD HH:MM:SS format
$currentDate = date('Y-m-d H:i:s');

include('../include/dbconn.php') ?>

<html lang="en">

<head>

    <?php
    $title = 'Detail';
    include('../include/header.php') ?>

</head>
<?php $getid = $_GET['id'];
$sql = $dbh->prepare("SELECT * FROM post WHERE id = :getid");
$sql->bindParam(':getid', $getid, PDO::PARAM_INT);
$sql->execute();
$lastselect = $sql->fetch(PDO::FETCH_ASSOC);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve post ID
    $postId = $_POST['postId'];

    // Prepare SQL statement to add the post to favorites
    $sql = "INSERT INTO favorites (post_id) VALUES (:postId)";
    $stmt = $dbh->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':postId', $postId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Post added to favorites successfully";
    } else {
        echo "Error adding post to favorites";
    }
} 

?>

<body>

    <!-- navbar -->
    <?php include('../include/navbar.php'); ?>
    </nav>

    <div class="container mt-5 mb-5">
        <h1 class="text-left text-uppercase" style="font-weight:bold;color: --bs-info
--bs-info-rgb;">
            Detail Information
        </h1>

        <!-- This page will display news detail such as image, name, date, location and 
description. -->

    </div>
    <hr>
    <div class="container">
        <div class="row m-2 ">
            <div class="card col-lg-4 col-md-4 col-12 my-5 shadow-sm rounded-3">
                <div class="list-group border-0">
                    <div class="list-group-item border-0 mt-3 rounded fs-4 bg-light">
                        <h3 class="text-center mb-0 text-info"><?php echo $lastselect['title']; ?></h3>
                    </div>
                </div>
                <div class="list-group-item border-0 text-dark fs-5 bg-light">
                    <!-- carousel -->
                    <div id="carouselExampleIndicators" class="carousel slide m-auto mt-2 carouselimg" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img style="object-fit: cover; width:100%; height: auto;" src="../uploads/<?php echo $lastselect['profile']; ?>" />
                            </div>
                            <!-- Add more carousel items here if needed -->
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
                        <h3 class='text-center mb-0 text-info'>
                            <?php echo date('D-m-Y, h:i A', strtotime($lastselect['created_at'])); ?>
                        </h3>
                    </div>
                    <div class="list-group-item fs-5 lead">
                        <div class="d-flex flex-column">
                            <h5 class="text-center mb-0" style="white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">
                                <?php echo htmlspecialchars($lastselect['text']); ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end bg-light">
                    <form  method="post">
                        <input type="hidden" name="postId" value="<?php echo htmlspecialchars($lastselect['id']); ?>">
                        <button type="submit" class="add-to-favorite">Add to favorite</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include('../include/footer.php') ?>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.0/dist/umd/popper.min.js"></script>
    <script src="script.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelector('.add-to-favorite').addEventListener('click', function() {
            const itemName = this.getAttribute('data-name');
            const itemId = this.getAttribute('data-id');

            fetch('add_to_favorite.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: itemName,
                        id: itemId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item added to favorite!');
                    } else {
                        alert('Failed to add item to favorite.');
                    }
                });
        });
    </script>

</body>

</html>