<?php
// Konfigurasi database
$host = "localhost";      // Nama host server database
$user = "root";           // Username untuk database
$password = "";           // Password untuk database
$database = "web_trpl2c"; // Nama database yang akan diakses

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Memeriksa apakah koneksi berhasil atau tidak
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
} else {
}
?>
