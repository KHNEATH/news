<!-- <?php include('dbconn.php');

if (isset($_POST['submit'])) {

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];


    $sqli = "insert into register (FirstName, LastName, Email, Dob, Password, Contact, Gender) values ('$first','$last','$email','$dob','$password','$mobile','$gender')";
    $result = mysqli_query($conn, $sqli);

    if ($result) {
        echo "succesfull";
    } else {
        echo "incorrect";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
  <?php include('../include/header.php') ?>
</head>

<body>
  <?php include('../include/navbar.php') ?>
    <div class="main">
        <h1>Login</h1>
        <form method="POST">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">


            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$" title="Password must contain at least one number, 
					one alphabet, one symbol, and be at 
					least 8 characters long">

            <div class="wrap mt-3">
                <button type="submit" onclick="solve()">
                    Submit
                </button>
            </div>
        </form>
        <hr>
        <div class="d-flex">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Register
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <label for="first">First Name:</label>
                                <input type="text" id="first" name="first" placeholder="Enter your first name">

                                <label for="last">Last Name:</label>
                                <input type="text" id="last" name="last" placeholder="Enter your last name">

                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email">

                                <label for="dob">Date of Birth:</label>
                                <input type="date" id="dob" name="dob" placeholder="Enter your DOB">

                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" placeholder="Enter your password" pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$" title="Password must contain at least one number, 
					one alphabet, one symbol, and be at 
					least 8 characters long">

                                <label for="repassword">Re-type Password:</label>
                                <input type="password" id="repassword" name="repassword" placeholder="Re-Enter your password">
                                <span id="pass"></span>

                                <label for="mobile">Contact:</label>
                                <input type="text" id="mobile" name="mobile" placeholder="Enter your Mobile Number" maxlength="10">

                                <label for="gender">Gender:</label>
                                <select id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column h-100">

        <!-- FOR DEMO PURPOSE -->
        <section class="hero text-white py-5 flex-grow-1">
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="display-4">Bootstrap footer bottom</h1>
                        <p class="fst-italic text-muted">Using Bootstrap 5 flexbox utilities, create a footer that always sticks to the bottom of your viewport. Snippet by <a class="text-primary" href="https://bootstrapious.com/" target="_blank">Bootstrapious</a></p>
                    </div>
                </div>
            </div>
        </section>


        <!-- FOOTER -->
        <footer class="w-100 py-4 fixed-bottom bg-light flex-shrink-0">
            <div class="container-fluid py-4">
                <div class="row gy-4 gx-5">
                    <div class="col-lg-4 col-md-6">
                        <h5 class="h1 text-white">FB.</h5>
                        <p class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                        <p class="small text-muted mb-0">&copy; Copyrights. All rights reserved. <a class="text-primary" href="#">Bootstrapious.com</a></p>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h5 class="text-white mb-3">Quick links</h5>
                        <ul class="list-unstyled text-muted">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Get started</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h5 class="text-white mb-3">Quick links</h5>
                        <ul class="list-unstyled text-muted">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Get started</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-3">Newsletter</h5>
                        <p class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                        <form action="#">
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-primary" id="button-addon2" type="button"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="script.js"></script>
</body>

</html> -->