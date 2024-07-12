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

// Ambil trip yang akan dihapus
if (isset($_GET['id'])) {
    $trip_id = $_GET['id'];

    // Ambil path foto yang akan dihapus
    $query_select = "SELECT Photo FROM trip WHERE ID = '$trip_id'";
    $result_select = mysqli_query($koneksi, $query_select);
    $trip = mysqli_fetch_assoc($result_select);

    // Hapus trip dari database
    $query_delete = "DELETE FROM trip WHERE ID = '$trip_id'";
    if (mysqli_query($koneksi, $query_delete)) {
        // Hapus foto dari server jika ada
        if (!empty($trip['Photo'])) {
            $pathToDelete = "../../" . $trip['Photo'];
            if (file_exists($pathToDelete)) {
                unlink($pathToDelete); // Hapus file dari server
            }
        }
        
        // Redirect ke halaman manajemen trip
        header("Location: atur_trip.php");
        exit();
    } else {
        echo '<script>alert("Terjadi kesalahan saat menghapus trip!");</script>';
        exit();
    }
} else {
    echo '<script>alert("ID trip tidak ditemukan!");</script>';
    exit();
}
?>
