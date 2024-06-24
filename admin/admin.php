<?php
// Set the default timezone
date_default_timezone_set('Asia/Bangkok');

// Get the current date and time in YYYY-MM-DD HH:MM:SS format
$currentDate = date('Y-m-d H:i:s');

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include('../include/dbconn.php');
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
  <!-- navbar -->

  <body>
    <?php include('../include/navbar.php') ?>

    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide m-auto mt-2 carouselimg" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://marketplace.canva.com/EAFMBRX08aA/2/0/1600w/canva-modern-red-yellow-breaking-news-intro-animation-video-UIT1LgQx_rA.jpg
            " class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="https://t4.ftcdn.net/jpg/04/26/47/69/360_F_426476994_6XuB8NIGYGLbQUkFITCKwjKiVUe2eOYa.jpg
            " class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="https://marketplace.canva.com/EAFfT3S71Oc/1/0/1600w/canva-red-blue-modern-breaking-news-youtube-thumbnail-qJRhA0AmHOw.jpg
            " class="d-block w-100" alt="..." />
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
      <h3>WELCOME TO SNAKE NEWS</h3>
    </div>
    <!-- border -->
    <div style="border-bottom: 6px solid #ffd93d; width: 100%; margin-top: 10px"></div>
    <!-- paragraph detail -->
    <div class="d-flex flex-column align-items-center" style="margin-top: 45px">
      <h3>NEWS</h3>
    </div>

    <?php
    try {
      // Query to fetch data
      $sql = "SELECT * FROM post ORDER BY id DESC limit 4 ";
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
          <div class="col-lg-3 col-sm-12 mb-2">
            <!-- trov link vea kol knea mouy dom dermbey hover ban all -->
            <a href="../user/detailinfo.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="hover-link">
              <div class="card h-100">
                <img src="../uploads/<?php echo htmlspecialchars($row['profile']); ?>" style="object-fit: cover;" height="300" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
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
                    echo '<small class="text-muted">Last updated ' . htmlspecialchars($timeAgo) . '</small>';
                  }
                  ?>
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
      $sql = "SELECT * FROM post ORDER BY id DESC limit 4 ";
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
          <div class="col-lg-3 col-sm-12 mb-2">
            <!-- trov link vea kol knea mouy dom dermbey hover ban all -->
            <a href="../user/detailinfo.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="hover-link">
              <div class="card h-100">
                <img src="../uploads/<?php echo htmlspecialchars($row['profile']); ?>" style="object-fit: cover;" height="300" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                  <p class="card-text lh-base text-break"><?php echo htmlspecialchars($row['text']); ?></p>
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
                    echo '<small class="text-muted">Last updated ' . htmlspecialchars($timeAgo) . '</small>';
                  }
                  ?>
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