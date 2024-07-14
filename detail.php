<?php
require_once "koneksi.php";

// Ambil parameter dari URL
$trip_id = isset($_GET['trip']) ? intval($_GET['trip']) : null;
$kuliner_id = isset($_GET['kuliner']) ? intval($_GET['kuliner']) : null;

// Fungsi untuk menampilkan detail trip
function get_trip_detail($koneksi, $trip_id) {
    $query = "SELECT * FROM trip WHERE id = $trip_id";
    $result = $koneksi->query($query);
    return $result->fetch_assoc();
}

// Fungsi untuk menampilkan detail kuliner
function get_kuliner_detail($koneksi, $kuliner_id) {
    $query = "SELECT * FROM kuliner WHERE id = $kuliner_id";
    $result = $koneksi->query($query);
    return $result->fetch_assoc();
}

$detail = null;
if ($trip_id) {
    $detail = get_trip_detail($koneksi, $trip_id);
    $type = 'trip';
} elseif ($kuliner_id) {
    $detail = get_kuliner_detail($koneksi, $kuliner_id);
    $type = 'kuliner';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail <?php echo ucfirst($type); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
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
                        <a class="nav-link" href="index.php#home"><b>Telusuri</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about"><b>Trip</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><b>Ulasan</b></a>
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

    <div class="container mt-5">
        <?php if ($detail): ?>
            <div class="card">
                <img src="<?php echo $detail['Photo']; ?>" class="card-img-top img-fluid" style="max-height: 400px; object-fit: cover;" alt="<?php echo $detail['Nama']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $detail['Nama']; ?></h5>
                    <p class="card-text"><strong>Lokasi:</strong> <?php echo $detail['Lokasi']; ?></p>
                    <p class="card-text"><strong>Kategori:</strong> <?php echo $detail['Kategori']; ?></p>
                    <p class="card-text"><strong>Deskripsi:</strong> <?php echo $detail['Deskripsi']; ?></p>
                    <p class="card-text"><strong>Rating:</strong>
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <?php if ($i < $detail['Rating']): ?>
                                <i class="fa fa-star text-warning"></i>
                            <?php else: ?>
                                <i class="fa fa-star text-secondary"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </p>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">Detail tidak ditemukan.</p>
        <?php endif; ?>
    </div>

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

<?php
$koneksi->close();
?>
