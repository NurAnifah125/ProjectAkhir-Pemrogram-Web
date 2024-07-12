<?php
session_start();

// Sertakan file koneksi.php
require_once "../koneksi.php";

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminID = $_POST['adminID'];
    $adminName = $_POST['adminName'];
    $adminEmail = $_POST['adminEmail'];
    $adminPassword = $_POST['adminPassword'];
    $adminRole = $_POST['adminRole'];

    // Mendapatkan koneksi ke database
    $koneksi = getKoneksi();

    // Mencegah SQL Injection
    $adminID = mysqli_real_escape_string($koneksi, $adminID);
    $adminName = mysqli_real_escape_string($koneksi, $adminName);
    $adminEmail = mysqli_real_escape_string($koneksi, $adminEmail);
    $adminPassword = mysqli_real_escape_string($koneksi, $adminPassword);
    $adminRole = mysqli_real_escape_string($koneksi, $adminRole);

    // Hash the password
    $hashedPassword = password_hash($adminPassword, PASSWORD_BCRYPT);

    // Update query
    if ($_FILES['adminPhoto']['name'] != "") {
        // If a new photo is uploaded
        $adminPhoto = $_FILES['adminPhoto']['name'];
        $targetDir = "../assets/foto/";
        $targetFile = $targetDir . basename($adminPhoto);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['adminPhoto']['tmp_name'], $targetFile)) {
            // Get the old photo filename
            $queryGetPhoto = "SELECT Photo FROM admin WHERE UserID='$adminID'";
            $result = mysqli_query($koneksi, $queryGetPhoto);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $oldPhotoPath = $targetDir . $row['Photo'];

                // Delete the old photo
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Update the admin with the new photo
            $query = "UPDATE admin SET Nama='$adminName', Email='$adminEmail', Password='$hashedPassword', Role='$adminRole', Photo='$adminPhoto' WHERE UserID='$adminID'";
        } else {
            header("Location: atur_pengguna.php?error=1");
            exit();
        }
    } else {
        // If no new photo is uploaded
        $query = "UPDATE admin SET Nama='$adminName', Email='$adminEmail', Password='$hashedPassword', Role='$adminRole' WHERE UserID='$adminID'";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location: atur_pengguna.php?success=1");
    } else {
        header("Location: atur_pengguna.php?error=1");
    }
}
?>
