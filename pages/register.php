<!DOCTYPE html>
<html>

<head>
    <?php
    $title = 'Register';
    include('../include/header.php');
    session_start();
    ?>
</head>

<body>
    <?php
    if (isset($_SESSION['msg'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success:</strong> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } elseif (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php
    $page = 'register';
    include('../include/navbar.php') ?>
    <div class="main">
        <h1 style="text-align: center;">Register</h1>
        <form method="POST" action="register1.php" enctype="multipart/form-data">
            <label for="file">Profile (optional):</label>
            <input type="file" name="file" accept="image/*">

            <label for="first">First Name:</label>
            <input type="text" id="first" name="first" placeholder="Enter your first name" required>

            <label for="last">Last Name:</label>
            <input type="text" id="last" name="last" placeholder="Enter your last name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" placeholder="Enter your DOB" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required title="Password must contain at least one number, one alphabet, one symbol, and be at least 8 characters long">

            <label for="repassword">Re-type Password:</label>
            <input type="password" id="repassword" name="repassword" placeholder="Re-Enter your password" required>
            <span id="pass"></span>

            <label for="mobile">Contact:</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter your Mobile Number" required maxlength="10">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="other">Other</option>
            </select>

            <div class="wrap">
                <button type="submit" name="register">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>
