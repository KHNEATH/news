<?php
session_start();
include('include/dbconn.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Define a parameterized SQL query
        $sql = "SELECT * FROM registered WHERE email = :email";

        // Prepare the SQL query
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR); // Use PARAM_STR for string parameters

        // Execute the query
        $query->execute();

        // Fetch data using fetch
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $hashed_password = $row['password'];

            // Verify hashed password
            if (password_verify($password, $hashed_password)) {
                $role = $row['role'];
                $username = $row['firstname'] . " " . $row['lastname'];
                $id = $row['id'];

                if ($role == 'admin') {
                    $_SESSION['role'] = $role;
                    $_SESSION['alogin'] = $email; // Store email in session instead of password
                    $_SESSION['userid'] = $id;
                    header('location: admin/admin.php');
                    exit(); // Terminate script after redirect
                } elseif ($role == 'user') {
                    $_SESSION['role'] = $role;
                    $_SESSION['ulogin'] = $email; // Store email in session instead of password
                    $_SESSION['userid'] = $id;
                    header('location: user/user.php');
                    exit(); // Terminate script after redirect
                } else {
                    header('location: index.php');
                    exit(); // Terminate script after redirect
                }
            } else {
                // Password does not match
                echo "<div class='alert alert-danger' role='alert'>login.</div>";
            }
        } else {
            // No user found with given email
            echo "<div class='alert alert-danger' role='alert'>Invalid email or password.</div>";
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = 'login'; ?>
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include('include/navbar.php'); ?>
    <div class="main">
        <h1>Login</h1>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <div class="wrap mt-3">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>