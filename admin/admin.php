<?php
// Set the default timezone
date_default_timezone_set('Asia/Bangkok');

// Get the current date and time in YYYY-MM-DD HH:MM:SS format
$currentDate = date('Y-m-d H:i:s');

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include('../include/dbconn.php');

// Initialize variables
$newsId = 1; // Assuming this is the ID of the news item to display

// Check if session variable is not set (indicating first visit in this session)
// if (!isset($_SESSION['visited'])) {
//   try {
//     // Increment view count in database
//     $incrementViewCountStmt = $dbh->prepare("UPDATE viewer SET view_count = view_count + 1 WHERE id = :id");
//     $incrementViewCountStmt->bindParam(':id', $newsId, PDO::PARAM_INT);
//     $incrementViewCountStmt->execute();

//     // Set session variable to indicate visit
//     $_SESSION['visited'] = true;
//   } catch (PDOException $e) {
//     die('Database error: ' . $e->getMessage());
//   }
// }

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
if (empty($_SESSION['userid'])) { // Check if userid is empty or not set
  header('location: ../index.php');
  exit(); // Terminate script after redirect
} else {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    $title = 'Admin';
    include('../include/header.php') ?>
  </head>
  <style>
    .no-underline {
      text-decoration: none;
      color: inherit;
      /* Maintain the original color of the text */
    }

    .no-underline:hover {
      text-decoration: underline;
      /* Optional: underline on hover */
    }


    .card {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 600px;
      width: 100%;
      box-sizing: border-box;
    }

    .card-body {
      position: relative;
    }

    .card-text {
      font-size: 1em;
      line-height: 1.5;
      word-wrap: break-word;
      max-height: 4.5em;
      /* Adjust this value based on your needs */
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    @media (max-width: 768px) {
      .card-text {
        font-size: 0.9em;
      }
    }

    @media (max-width: 480px) {
      .card-text {
        font-size: 0.8em;
      }
    }
  </style>
  <!-- navbar -->

  <body>
    <!-- navbar -->
    <?php include('../include/navbar.php') ?>

    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide m-auto mt-3 carouselimg container" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
      </div>
      <div class="carousel-inner rounded-3 shadow-lg" style="object-fit: cover; height: auto;">
        <div class="carousel-item active">
          <img src="../images/2437919817_730789099252642_4101091192374117017_n.jpg   
            " class="d-block w-100" alt="..." style="object-fit: cover;" />
        </div>
        <div class="carousel-item">
          <img src="../images/238691778_136987331958452_1400618763356975659_n.jpg
            " class="d-block w-100" alt="..." style="object-fit: cover;" />
        </div>
        <div class="carousel-item" style="object-fit: cover;">
          <img src="../images/437919817_730789099252642_4101091192374117017_n.jpg
            " class="d-block w-100" alt="..." style="object-fit: cover;" />
        </div>
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
    <!-- paragraph detail -->
    <div class="d-flex flex-column align-items-center" style="margin-top: 45px; margin-bottom: 45px">
      <h3>WELCOME TO INTERNAL AUDIT UNIT</h3>
    </div>
    <!-- border -->
    <div style="border-bottom: 6px solid #ffd93d; width: 100%; margin-top: 10px"></div>
    <!-- paragraph detail -->
    <div class="d-flex flex-column align-items-center" style="margin-top: 45px">
      <h3>Hot News</h3>
    </div>
    <?php
    try {
      // Query to fetch data
      $sql = "SELECT * FROM post ORDER BY id DESC";
      $stmt = $dbh->query($sql);

      // Fetch data
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <div class="container">
      <div class="row">
        <?php foreach ($result as $row) : ?>
          <div class="col-lg-3 col-sm-12 mb-4">
            <!-- trov link vea kol knea mouy dom dermbey hover ban all -->
            <a href="../user/detailinfo.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="hover-link">
              <div class="card border-0 h-100 shadow-sm">
                <?php
                $profileImages = explode(",", $row['profile']);
                $firstImage = trim($profileImages[0]); // Get the first image and trim any extra whitespace
                echo '<img src="../uploads/' . htmlspecialchars($firstImage) . '" style="object-fit: cover; border-radius: 10px" height="auto" alt="...">';
                ?>
                <div class="card-body">
                  <h6><?php echo htmlspecialchars($row['title']); ?></h6>
                  <p class="card-text"><?php echo htmlspecialchars($row['text']); ?></p>
                </div>
                <div class="card-footer">
                  <?php
                  if (isset($row['created_at'])) {
                    $createdDate = new DateTime($row['created_at']);
                    $now = new DateTime();
                    $interval = $now->diff($createdDate);

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
                    // echo '<small class="text-muted">Last updated ' . htmlspecialchars($timeAgo) . '</small>';
                  }
                  ?>
                  <small class="text-muted"><i class='bx bxs-time bx-spin me-2'></i>Last updated <?php echo htmlspecialchars($timeAgo); ?></small>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>


    <!-- border -->
    <div style="border-bottom: 6px solid #ffd93d; width: 100%; margin-top: 10px"></div>
    <!-- paragraph detail -->
    <div class="d-flex flex-column align-items-center" style="margin-top: 45px">
      <h3>News</h3>
    </div>
    <?php
    try {
      // Query to fetch data
      $sql = "SELECT * FROM post ORDER BY id DESC ";
      $stmt = $dbh->query($sql);

      // Fetch data
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <div class="container">
      <div class="row">
        <?php foreach ($result as $row) : ?>
          <div class="col-lg-3 col-sm-12 mb-4">
            <!-- trov link vea kol knea mouy dom dermbey hover ban all -->
            <a href="../user/detailinfo.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="hover-link">
              <div class="card border-0 h-100 shadow-sm">
                <?php
                $profileImages = explode(",", $row['profile']);
                $firstImage = trim($profileImages[0]); // Get the first image and trim any extra whitespace
                echo '<img src="../uploads/' . htmlspecialchars($firstImage) . '" style="object-fit: cover; border-radius: 10px" height="auto" alt="...">';
                ?>
                <div class="card-body">
                  <h6><?php echo htmlspecialchars($row['title']); ?></h6>
                  <p class="card-text"><?php echo htmlspecialchars($row['text']); ?></p>
                </div>
                <div class="card-footer">
                  <?php
                  if (isset($row['created_at'])) {
                    $createdDate = new DateTime($row['created_at']);
                    $now = new DateTime();
                    $interval = $now->diff($createdDate);

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
                    // echo '<small class="text-muted">Last updated ' . htmlspecialchars($timeAgo) . '</small>';
                  }
                  ?>
                  <small class="text-muted"><i class='bx bxs-time bx-spin me-2'></i>Last updated <?php echo htmlspecialchars($timeAgo); ?></small>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <script>
      document.querySelectorAll('.see-more').forEach(button => {
        button.addEventListener('click', () => {
          const target = document.querySelector(button.getAttribute('data-target'));
          if (target.classList.contains('preview-text')) {
            target.classList.remove('preview-text');
            button.textContent = 'See Less';
          } else {
            target.classList.add('preview-text');
            button.textContent = 'See More';
          }
        });
      });
    </script>

    <style>
      .preview-text {
        max-height: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    </style>
    <div style="border-bottom: 6px solid #ffd93d; width: 100%; margin-top: 10px"></div>
    <!-- paragraph detail -->
    <div class="d-flex flex-column align-items-center" style="margin-top: 45px"></div>
    <?php
    include('../include/footer.php')
    ?>
  </body>

  </html>
<?php } ?>