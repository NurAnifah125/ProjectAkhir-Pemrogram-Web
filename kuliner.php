<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TRAVEL QUARTET - Semua Kuliner</title>
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
      <a href="index.php" class="navbar-brand p-0">
        <img class="logo" src="gambar/LOGO.jpg" alt="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto py-0 pe-4">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><b>Telusuri</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="trip.php"><b>Trip</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ulasan.php"><b>Ulasan</b></a>
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

  <!-- Kuliner Section -->
  <div class="container mt-5">
    <h2 class="mb-4">Semua Kuliner</h2>
    <div class="row">
      <?php
      // Connect to database
      require_once "koneksi.php";
      
      // Query to retrieve all culinary spots
      $kulinerQuery = "SELECT * FROM kuliner";
      $kulinerResult = $koneksi->query($kulinerQuery);
      
      // Display culinary spots if there are any
      if ($kulinerResult->num_rows > 0) {
          while ($kuliner = $kulinerResult->fetch_assoc()) {
              echo '<div class="col-md-4 mb-4">';
              echo '  <div class="card">';
              echo '    <img src="' . $kuliner['Photo'] . '" class="card-img-top" alt="' . $kuliner['Nama'] . '">';
              echo '    <div class="card-body">';
              echo '      <h5 class="card-title"><a href="detail.php?kuliner=' . $kuliner['ID'] . '">' . $kuliner['Nama'] . '</a></h5>';
              echo '      <p class="card-text">' . $kuliner['Lokasi'] . '</p>';
              echo '      <p class="card-text">' . $kuliner['Kategori'] . '</p>';
              echo '      <p class="card-text">' . $kuliner['Deskripsi'] . '</p>';
              echo '      <div class="card-text">';
              for ($i = 0; $i < 5; $i++) {
                  if ($i < $kuliner['Rating']) {
                      echo '<i class="fa fa-star text-warning"></i>';
                  } else {
                      echo '<i class="fa fa-star text-secondary"></i>';
                  }
              }
              echo '      </div>';
              echo '    </div>';
              echo '  </div>';
              echo '</div>';
          }
      } else {
          echo '<p class="text-center">No culinary spots available.</p>';
      }
      
      // Close database connection
      $koneksi->close();
      ?>
    </div>
  </div>
  <!-- End Kuliner Section -->

  <!-- Footer -->
  <div class="footer mt-auto py-3">
    <div class="container text-center">
      <span class="text-muted">© 2023 Travel Quartet. All rights reserved.</span>
    </div>
    </div>
  <!-- End Footer -->

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
