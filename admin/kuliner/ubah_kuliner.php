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

// Ambil data kuliner berdasarkan ID
if (isset($_GET['id'])) {
  $kuliner_id = $_GET['id'];
  $query = "SELECT * FROM kuliner WHERE ID = '$kuliner_id'";
  $result = mysqli_query($koneksi, $query);
  $kuliner = mysqli_fetch_assoc($result);
}

// Proses pengubahan kuliner
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil data dari form
  $id = $_POST['id'];
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
  $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
  $rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
    
// Cek apakah ada file foto yang diunggah
if (!empty($_FILES['photo']['name'])) {
  // Hapus foto lama jika ada
  if (!empty($kuliner['Photo'])) {
      $pathToDelete = "../../" . $kuliner['Photo'];
      if (file_exists($pathToDelete)) {
          unlink($pathToDelete); // Hapus file dari server
      }
  }
        // Memeriksa jenis file foto
        $photoType = $_FILES['photo']['type'];
        $allowedPhotoTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($photoType, $allowedPhotoTypes)) {
            echo '<script>alert("Hanya file gambar (JPEG, PNG, GIF) yang diperbolehkan untuk foto!");</script>';
            exit();
        }

        // Direktori penyimpanan file
        $targetDirPhoto = "../../assets/foto/";
        // Nama file setelah diunggah
        $targetFilePhoto = $targetDirPhoto . basename($_FILES["photo"]["name"]);

        // Pindahkan file yang diunggah ke direktori tujuan
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePhoto)) {
            // Potong bagian "../../" dari path
            $dbPathPhoto = str_replace("../../", "", $targetFilePhoto);

            // Query untuk mengubah kuliner dengan foto
            $query = "UPDATE kuliner SET Nama='$nama', Lokasi='$lokasi', Kategori='$kategori', Deskripsi='$deskripsi', Rating='$rating', Photo='$dbPathPhoto' WHERE ID='$id'";
        } else {
            // Jika gagal mengunggah file
            echo '<script>alert("Terjadi kesalahan saat mengunggah file!");</script>';
            exit();
        }
    } else {
        // Query untuk mengubah trip tanpa mengubah foto
        $query = "UPDATE kuliner SET Nama='$nama', Lokasi='$lokasi', Kategori='$kategori', Deskripsi='$deskripsi', Rating='$rating' WHERE ID='$id'";
    }

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman manajemen kuliner
        header("Location: atur_kuliner.php");
        exit();
    } else {
        echo '<script>alert("Terjadi kesalahan saat mengubah kuliner!");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Trip</title>
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
    <h2><i class="bi bi-journal-plus"></i> Ubah Kuliner</h2>

    <!-- Form Ubah Trip -->
    <form action="ubah_kuliner.php?id=<?php echo $kuliner['ID']; ?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $kuliner['ID']; ?>">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $kuliner['Nama']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi:</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $kuliner['Lokasi']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="kategori" class="form-label">Kategori:</label>
        <select class="form-control" id="kategori" name="kategori" required>
          <option value="Makanan" <?php echo ($kuliner['Kategori'] == 'Makanan') ? 'selected' : ''; ?>>Makanan</option>
          <option value="Minuman" <?php echo ($kuliner['Kategori'] == 'Minuman') ? 'selected' : ''; ?>>Minuman</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $kuliner['Deskripsi']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating:</label>
        <input type="number" class="form-control" id="rating" name="rating" value="<?php echo $kuliner['Rating']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="photo" class="form-label">Upload Foto (JPEG, PNG, GIF):</label>
        <input type="file" class="form-control" id="photo" name="photo" accept=".jpg, .jpeg, .png, .gif">
        <?php if (!empty($kuliner['Photo'])): ?>
          <img src="../../<?php echo $kuliner['Photo']; ?>" alt="Photo" width="100" class="mt-2">
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
    </form>
  </div>
</div>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
