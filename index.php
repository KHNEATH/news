<?php include('include/dbconn.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Internal Audit Unit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .no-underline {
      text-decoration: none;
      color: inherit;
    }

    .no-underline:hover {
      text-decoration: underline;
    }

    .card {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      height: 100%;
    }

    .card-body {
      position: relative;
    }

    .card-text {
      font-size: 1em;
      line-height: 1.5;
      word-wrap: break-word;
      max-height: 4.5em;
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

    .card-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card-footer small {
      margin-right: auto;
    }

    .hover-link:hover {
      text-decoration: none;
    }

    .carouselimg {
      margin-bottom: 30px;
    }

    .carousel-inner img {
      height: 100vh;
      object-fit: cover;
    }

    .carousel-indicators button {
      background-color: #000;
    }

    .content-section {
      padding: 40px 0;
    }

    .content-section h3 {
      margin-bottom: 20px;
    }

    .content-section .border-bottom {
      margin-bottom: 30px;
    }

    .card-container {
      margin-top: 30px;
    }
  </style>
</head>

<body>
  <!-- Navbar for index -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom-1">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../images/cropped-Official-iau-logo2.png" alt="News Website Logo" class="logo" height="60px" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item mx-3">
            <a class="nav-link" href="../user/user.php"><i class='bx bxs-home bx-tada me-2'></i>HOME</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="../pages/allnews.php"><i class='bx bx-news bx-tada me-2'></i>ALL NEWS</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="../pages/about.php">ABOUT</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link text-red" href="../pages/contact.php"><i class='bx bxs-contact bx-tada me-2'></i>CONTACT</a>
          </li>
        </ul>
        <form class="d-flex">
          <a href="login.php" class="btn btn-outline-secondary me-2"><i class='bx bx-log-in bx-tada me-2'></i>Login</a>
          <a href="pages/register.php" class="btn btn-success"><i class='bx bx-registered bx-tada me-2'></i>Register</a>
        </form>
      </div>
    </div>
  </nav>

  <!-- carousel -->
  <div id="carouselExampleIndicators" class="carousel slide m-auto mt-3 carouselimg container" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner rounded-3 shadow-lg">
      <div class="carousel-item active">
        <img src="../images/2437919817_730789099252642_4101091192374117017_n.jpg" class="d-block w-100" alt="..." />
      </div>
      <div class="carousel-item">
        <img src="../images/238691778_136987331958452_1400618763356975659_n.jpg" class="d-block w-100" alt="..." />
      </div>
      <div class="carousel-item">
        <img src="../images/437919817_730789099252642_4101091192374117017_n.jpg" class="d-block w-100" alt="..." />
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
  <div class="d-flex flex-column align-items-center my-5">
    <h3>WELCOME TO INTERNAL AUDIT UNIT</h3>
  </div>

  <!-- border -->
  <div class="border-bottom border-warning" style="width: 100%; margin-top: 10px"></div>

  <!-- paragraph detail -->
  <div class="d-flex flex-column align-items-center my-5">
    <h3>HOT NEWS</h3>
  </div>

  <!-- category -->
  <?php
  try {
    $sql = "SELECT * FROM post ORDER BY id DESC";
    $stmt = $dbh->query($sql);
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

  <!-- Share Modals -->
  <?php foreach ($result as $row) : ?>
    <div class="modal fade" id="shareModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="shareModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="shareModalLabel<?php echo $row['id']; ?>">Share this post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p id="shareTitle"></p>
            <div class="d-grid gap-2">
              <a id="facebookShare<?php echo $row['id']; ?>" href="#" target="_blank" class="btn btn-primary btn-sm"><i class="fab fa-facebook-f"></i> Facebook</a>
              <a id="twitterShare<?php echo $row['id']; ?>" href="#" target="_blank" class="btn btn-info btn-sm"><i class="fab fa-twitter"></i> Twitter</a>
              <a id="linkedinShare<?php echo $row['id']; ?>" href="#" target="_blank" class="btn btn-secondary btn-sm"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
              <button id="copyURLButton<?php echo $row['id']; ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-copy"></i> Copy URL</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- JavaScript for Share Modals -->
  <script>
    <?php foreach ($result as $row) : ?>

      function setShareData(title, url) {
        document.getElementById('shareTitle<?php echo $row['id']; ?>').textContent = title;
        document.getElementById('facebookShare<?php echo $row['id']; ?>').href = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
        document.getElementById('twitterShare<?php echo $row['id']; ?>').href = 'https://twitter.com/intent/tweet?url=' + url + '&text=' + encodeURIComponent(title);
        document.getElementById('linkedinShare<?php echo $row['id']; ?>').href = 'https://www.linkedin.com/shareArticle?url=' + url + '&title=' + encodeURIComponent(title);
      }

      function copyToClipboard<?php echo $row['id']; ?>() {
        var url = decodeURIComponent(document.getElementById('facebookShare<?php echo $row['id']; ?>').href.split('u=')[1]);
        navigator.clipboard.writeText(url).then(function() {
          alert('URL copied to clipboard!');
        }, function(err) {
          console.error('Could not copy text: ', err);
        });
      }

      document.getElementById('copyURLButton<?php echo $row['id']; ?>').addEventListener('click', copyToClipboard<?php echo $row['id']; ?>);
    <?php endforeach; ?>
  </script>

  <!-- Footer -->
  <?php include('include/footer.php') ?>

</body>

</html>