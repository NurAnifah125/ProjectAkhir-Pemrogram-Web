<?php
// Mengambil data dari request POST
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Proses validasi atau autentikasi login
if ($username === 'admin' && $password === 'password') {
    // Login berhasil
    echo "Login berhasil!";
} else {
    // Login gagal
    echo "Username atau password salah.";
}
?>
