<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TRAVEL QUARTET</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- Navbar -->
  <div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-lg px-4 px-lg-5 py-3 py-lg-0">
      <a href="#" class="navbar-brand p-0">
        <img class="logo" src="gambar/LOGO.jpg" alt="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto py-0 pe-4">
          <li class="nav-item">
            <a class="nav-link" href="#home"><b>Telusuri</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about"><b>Trip</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><b>Ulasan</b></a>
          </li>
        </ul>
        <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
      </div>
    </nav>
  </div>
  <!-- End Navbar -->

  <!-- Secondary Navigation -->
  <div class="secondary-nav">
    <ul>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-search"></i> <b>Cari Semua</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-geo-alt"></i> <b>Jawa Tengah</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-cup-straw"></i> <b>Kuliner</b></a>
      </li>
    </ul>
  </div>

  <!-- Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="gambar/magelang/CandiBorobudur/8.jpg" class="d-block w-100" alt="gambar1" />
      </div>
      <div class="carousel-item">
        <img src="gambar/magelang/CandiMendut/7.jpg" class="d-block w-100" alt="gambar2" />
      </div>
      <div class="carousel-item">
        <img src="gambar/magelang/CandiGedong9/1.jpg" class="d-block w-100" alt="gambar3" />
      </div>
      <div class="carousel-item">
        <img src="gambar/magelang/EnamLangit/1.jpg" class="d-block w-100" alt="gambar4" />
      </div>
      <div class="carousel-item">
        <img src="gambar/magelang/SILANCURHIGHLAND/8.jpg" class="d-block w-100" alt="gambar5" />
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- End Carousel -->

  <!-- Footer -->
  <footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
      <span class="text-muted">© 2023 Travel Quartet. All rights reserved.</span>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
