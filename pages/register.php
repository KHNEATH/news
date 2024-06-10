<?php include('scripts/register1.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $title = 'Register';
    include('../include/header.php');
    ?>
</head>
<?php if (isset($msg)) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Sucess:</strong> <?php echo $msg;  ?>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php } elseif (isset($error)) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Unsucess:</strong> <?php echo $msg;  ?>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div>
        <?php echo $error;  ?>
    </div>
    </div>
<?php } ?>

<body>
    <?php
    $page = 'register';
    include('../include/navbar.php') ?>
    <div class="main">

        <h1 style="text-align: center;">Register</h1>
        <form method="POST" enctype="multipart/form-data">

            <label for="file">profile</label>
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
            <input type="password" id="password" name="password" placeholder="Enter your password" required title="Password must contain at least one number, 
					one alphabet, one symbol, and be at 
					least 8 characters long">

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
                <button type="submit" name="register" onclick="solve()">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>