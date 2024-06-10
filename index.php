<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Snake News</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css" />
</head>
<!-- navbar -->

<body>
  <!-- Navbar for index -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom-1">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="https://media4.s-nbcnews.com/i/newscms/2019_01/2705191/nbc-social-default_b6fa4fef0d31ca7e8bc7ff6d117ca9f4.png" alt="" height="60px" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item mx-3">
            <a class="nav-link " href="../index.php">HOME</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="../pages/allnews.php">ALL NEWS</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="../pages/about.php">ABOUT</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link text-red" href="../pages/contact.php">CONTACT</a>
          </li>
        </ul>
        <form class="d-flex">
          <a href="login.php" class="btn btn-outline-secondary me-2">Login</a>
          <a href="pages/register.php" class="btn btn-success">Register</a>
        </form>
      </div>
    </div>
  </nav>
  <!-- carousel -->
  <div id="carouselExampleIndicators" class="carousel slide m-auto mt-3 carouselimg" data-bs-ride="carousel">
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
  <!-- category -->
  <div class="container">

    <div class="row">
      <div class="col-lg-3 col-sm-12 mb-2">
        <div class="card h-100">
          <img src="https://m.media-amazon.com/images/I/71fudCp4a1L._AC_UF894,1000_QL80_.jpg" style="object-fit: cover;" height="300" alt="...">
          <div class="card-body">
            <h5 class="card-title">Young Sheldon</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae deserunt aspernatur iure ratione repellendus doloremque nesciunt, amet illum mollitia dolor sed commodi incidunt iste assumenda repellat sint cumque porro voluptate.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 1 mins ago</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-12 mb-2">
        <div class="card h-100">
          <img src="https://akns-images.eonline.com/eol_images/Entire_Site/20211011/rs_1200x1200-211111143759-1200-Young-Sheldon.jpg?fit=around%7C1200:1200&output-quality=90&crop=1200:1200;center,top" style="object-fit: cover;" height="300" alt="">
          <div class="card-body">
            <h5 class="card-title">Sheldon</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore maiores reiciendis dolores totam quasi, quibusdam nisi voluptates ullam, provident libero eveniet aut nobis cupiditate distinctio molestias atque eaque ex animi.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 2 mins ago</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-12 mb-2">
        <div class="card h-100">
          <img src="https://m.media-amazon.com/images/M/MV5BZTM2OTE3OGItMWE5Yi00NmEzLTg1ZjMtOTY5MjRkNDQ2MDE4XkEyXkFqcGdeQXVyNjc5Mjg0NjU@._V1_.jpg" class="card-img-top" style="object-fit: cover;" height="300" alt="...">
          <div class="card-body">
            <h5 class="card-title">Mrs.Cooper</h5>
            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod veritatis nulla quam. Nobis quisquam sint nam nostrum est culpa cumque, harum delectus a sapiente, sit, nemo doloribus asperiores esse illum?</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-12 mb-2">
        <div class="card h-100">
          <img src="https://m.media-amazon.com/images/M/MV5BODA2MWI3N2MtNmU4My00NjYxLWE1NTUtOWNhMmYwMDM2OTllXkEyXkFqcGdeQXVyMTExNDQ2MTI@._V1_.jpg" class="card-img-top" style="object-fit: cover;" height="300" alt="...">
          <div class="card-body">
            <h5 class="card-title">Mr.Cooper</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus dolor neque rem mollitia tempore ullam ut sed. Nostrum labore, voluptatum laudantium ipsum unde nesciunt iure atque nulla, a tempora porro!</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 4 mins ago</small>
          </div>
        </div>
      </div>
    </div>

    <!-- border -->
    <div style="border-bottom: 6px solid #ffd93d; width: 100%; margin-top: 10px"></div>
    <!-- paragraph detail -->
    <div class="d-flex flex-column align-items-center" style="margin-top: 45px">
      <h3>Hot News</h3>
    </div>
    <!-- category -->
    <div class="container">

      <div class="row">
        <div class="col-lg-3 col-sm-12 mb-2">
          <div class="card h-100">
            <img src="https://www.shutterstock.com/image-vector/disney-stitch-cartoon-character-vector-260nw-2396410923.jpg" style="object-fit: cover;" height="300" alt="...">
            <div class="card-body">
              <h5 class="card-title">Stick</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae deserunt aspernatur iure ratione repellendus doloremque nesciunt, amet illum mollitia dolor sed commodi incidunt iste assumenda repellat sint cumque porro voluptate.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 1 months ago</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 mb-2">
          <div class="card h-100">
            <img src="https://www.wikihow.com/images/thumb/2/23/Draw-Mickey-Mouse-Step-8.jpg/v4-460px-Draw-Mickey-Mouse-Step-8.jpg.webp" style="object-fit: cover;" height="300" alt="">
            <div class="card-body">
              <h5 class="card-title">Mickey Mouse</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore maiores reiciendis dolores totam quasi, quibusdam nisi voluptates ullam, provident libero eveniet aut nobis cupiditate distinctio molestias atque eaque ex animi.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 2 months ago</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 mb-2">
          <div class="card h-100">
            <img src="https://i.pinimg.com/564x/23/0e/db/230edb41a50ff386616ae01b7d993706.jpg" class="card-img-top" style="object-fit: cover;" height="300" alt="...">
            <div class="card-body">
              <h5 class="card-title">Pluto</h5>
              <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod veritatis nulla quam. Nobis quisquam sint nam nostrum est culpa cumque, harum delectus a sapiente, sit, nemo doloribus asperiores esse illum?</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 months ago</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 mb-2">
          <div class="card h-100">
            <img src="https://i.pinimg.com/736x/e8/45/31/e8453111f9c8fd9867eccf0cc6bce3db.jpg" class="card-img-top" style="object-fit: cover;" height="300" alt="...">
            <div class="card-body">
              <h5 class="card-title">Winnie The Pooh</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus dolor neque rem mollitia tempore ullam ut sed. Nostrum labore, voluptatum laudantium ipsum unde nesciunt iure atque nulla, a tempora porro!</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 4 months ago</small>
            </div>
          </div>
        </div>
      </div>

      <!-- border -->
      <div style="
        border-bottom: 6px solid #ffd93d;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 15px;
      "></div>
      <!-- Footer -->
      <?php
      include('include/footer.php')
      ?>
      <!-- Footer -->
</body>

</html>