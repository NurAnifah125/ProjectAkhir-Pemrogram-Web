<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Sertakan file koneksi.php
require_once "../../koneksi.php";

// Mendapatkan koneksi ke database
$koneksi = getKoneksi();

// Proses penambahan trip baru
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah file cover telah diunggah
    if (!empty($_FILES['photo']['name'])) {
        // Memeriksa jenis file cover
        $coverType = $_FILES['photo']['type'];
        $allowedCoverTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($coverType, $allowedCoverTypes)) {
            echo '<script>alert("Hanya file gambar (JPEG, PNG, GIF) yang diperbolehkan untuk cover!");</script>';
            exit();
        }

        // Direktori penyimpanan file
        $targetDirCover = "../../assets/foto/";
        // Nama file setelah diunggah
        $targetFileCover = $targetDirCover . basename($_FILES["photo"]["name"]);

        // Pindahkan file yang diunggah ke direktori tujuan
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFileCover)) {
            // Potong bagian "../" dari path
            $dbPathCover = str_replace("../../", "", $targetFileCover);
            
            // Ambil data dari form
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
            $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
            $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
            $rating = mysqli_real_escape_string($koneksi, $_POST['rating']);

            // Query untuk menambahkan trip baru ke database
            $query = "INSERT INTO trip (Nama, Lokasi, Kategori, Deskripsi, Rating, Photo) 
                      VALUES ('$nama', '$lokasi', '$kategori', '$deskripsi', '$rating', '$dbPathCover')";
            mysqli_query($koneksi, $query);

            // Redirect ke halaman manajemen trip
            header("Location: atur_trip.php");
            exit();
        } else {
            // Jika gagal mengunggah file
            echo '<script>alert("Terjadi kesalahan saat mengunggah file!");</script>';
            exit();
        }
    } else {
        // Jika pengguna tidak memilih file cover
        echo '<script>alert("Silakan pilih file cover!");</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Trip</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light d-lg-none" style="background-color: #87CEEB;">
    <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="bi bi-person-circle"></i> Welcome, <?php echo $_SESSION['nama']; ?>!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../dashboard.php"><i class="fas fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../trip/atur_trip.php"><i class="fas fa-map-marked-alt"></i> Trip</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../kuliner/atur_kuliner.php"><i class="fas fa-utensils"></i> Kuliner</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pengguna/atur_pengguna.php"><i class="fas fa-users-cog"></i> Pengguna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="sidebar d-none d-lg-block">
    <div class="text-center mb-4">
   <h1> <i class="bi bi-person-circle"></i></h1>
      <h3>Welcome</h3>
      <p><?php echo $_SESSION['nama']; ?></p>
    </div>
    <a href="../dashboard.php"><i class="fas fa-home"></i> Home</a>
    <a href="../trip/atur_trip.php"><i class="fas fa-map-marked-alt"></i> Trip</a>
    <a href="../kuliner/atur_kuliner.php"><i class="fas fa-utensils"></i> Kuliner</a>
    <a href="../atur_pengguna.php"><i class="fas fa-users-cog"></i> Pengguna</a>
    <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
<div class="main-content">
  <div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-map"></i> Tambah Trip</h2>

    <!-- Form Tambah Trip -->
    <form action="tambah_trip.php" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="nama" class="form-label">Nama:</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="lokasi" class="form-label">Lokasi:</label>
          <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="kategori" class="form-label">Kategori:</label>
          <select class="form-control" id="kategori" name="kategori" required>
            <option value="Wisata Alam">Wisata Alam</option>
            <option value="Wisata Budaya">Wisata Budaya</option>
            <option value="Wisata Kuliner">Wisata Kuliner</option>
            <option value="Wisata Sejarah">Wisata Sejarah</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="rating" class="form-label">Rating:</label>
          <input type="number" step="0.1" class="form-control" id="rating" name="rating" required>
        </div>
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="photo" class="form-label">Upload Cover (JPEG, PNG, GIF):</label>
        <input type="file" class="form-control" id="photo" name="photo" accept=".jpg, .jpeg, .png, .gif" required>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Trip</button>
    </form>
  </div>
</div>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
