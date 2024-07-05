<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
  // If session variable 'userid' is set and not empty
?>
  <!-- Admin or User Navbar -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom-1">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../images/cropped-Official-iau-logo2.png" alt="News Website Logo" class="logo" alt="" height="60px" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item mx-3">
            <a class="nav-link" href="<?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? '../admin/admin.php' : '../user/user.php'; ?>"><i class='bx bxs-home bx-tada me-2'></i>HOME</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="../pages/allnews.php"><i class='bx bx-news bx-tada me-2'></i>ALL NEWS</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="../pages/about.php">ABOUT</a>
          </li>
          <?php if ($_SESSION['role'] === 'user') { ?>
            <li class="nav-item mx-3">
              <a class="nav-link text-red" href="../pages/contact.php"><i class='bx bxs-contact bx-tada me-2'></i>CONTACT</a>
            </li>
          <?php } ?>
          <?php if ($_SESSION['role'] === 'admin') { ?>
            <li class="nav-item mx-3">
              <a class="btn btn-info nav-link text-red" href="../admin/post.php"><i class="bx bx-edit-alt me-2"></i>POST</a>
            </li>
          <?php } ?>
          <?php if ($_SESSION['role'] === 'admin') { ?>
            <li class="nav-item mx-3">
              <a class="nav-link text-red" href="../admin/feedback.php"><i class='bx bx-comment-detail bx-tada me-2'></i>FEEDBACK</a>
            </li>
          <?php } ?>
          <?php if ($_SESSION['role'] === 'user') { ?>
            <li class="nav-item mx-3">
              <a class="nav-link text-red" href="../pages/favorite.php">FAVORITE</a>
            </li>
          <?php } ?>
        </ul>
        <?php
        // session_start();
        require '../include/dbconn.php'; // Include the database connection file

        $userid = $_SESSION['userid'] ?? null;
        $user_data = null;

        if ($userid) {
          try {
            $stmt = $dbh->prepare("SELECT * FROM registered WHERE id = ?");
            $stmt->execute([$userid]);
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
          } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
          }
        }

        $defaultImagePath = 'User.jpg';

        $profileImagePath = $user_data['profile'] ?? $defaultImagePath;

        ?>

        <div class="avatar avatar-online mx-2">
          <img src="../uploads/<?php echo $profileImagePath; ?>" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;" alt="Profile Picture">
        </div>



        <form class="d-flex">
          <a href="<?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? 'admininfo.php' : 'userinfo.php'; ?>?userid=<?php echo $_SESSION['userid']; ?>" class="btn btn-success me-2 d-flex align-items-center"> <?php echo $_SESSION['role'] ?></a>
          <a href="../include/logout.php?role=<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>" class="btn btn-danger"><i class='bx bx-log-out bx-tada me-2'></i>Logout</a>
        </form>
      </div>
    </div>
  </nav>
<?php
} else {
  // If session variable 'userid' is not set or empty
?>
  <!-- Navbar for index, login, or register pages -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom-1">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../images/cropped-Official-iau-logo2.png" alt="News Website Logo" class="logo" alt="" height="60px" />
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
          <a href="../login.php" class="btn btn-outline-secondary me-2"><i class='bx bx-log-in bx-tada me-2'></i>Login</a>
          <a href="../pages/register.php" class="btn btn-success"><i class='bx bx-registered bx-tada me-2'></i>Register</a>
        </form>
      </div>
    </div>
  </nav>
<?php } ?>