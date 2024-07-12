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

// Ambil semua data trip
$query = "SELECT * FROM trip";
$result = mysqli_query($koneksi, $query);

function potongDeskripsi($deskripsi, $panjang) {
    if (strlen($deskripsi) > $panjang) {
        return substr($deskripsi, 0, $panjang) . '...';
    } else {
        return $deskripsi;
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
            <a class="nav-link" href="../atur_pengguna.php"><i class="fas fa-users-cog"></i> Pengguna</a>
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
    <h1><i class="bi bi-person-circle"></i></h1>
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
    <h2><i class="bi bi-journal-bookmark"></i> Manajemen Trip</h2>

    <!-- Tombol Tambah Trip -->
    <a href="tambah_trip.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Trip</a>
    <h4 class="pt-4"><i class="bi bi-journal-text"></i> Daftar Trip</h4>
    <!-- Tabel Daftar Trip -->
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Lokasi</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Rating</th>
            <th>Photo</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['ID']; ?></td>
              <td><?php echo $row['Nama']; ?></td>
              <td><?php echo $row['Lokasi']; ?></td>
              <td><?php echo $row['Kategori']; ?></td>
              <td><?php echo potongDeskripsi($row['Deskripsi'], 50); ?></td>
              <td><?php echo $row['Rating']; ?></td>
              <td><img src="../../<?php echo $row['Photo']; ?>" alt="photo" width="50"></td>
              <td>
                <a href="ubah_trip.php?id=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                <a href="hapus_trip.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus trip ini?');"><i class="fas fa-trash-alt"></i> Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
