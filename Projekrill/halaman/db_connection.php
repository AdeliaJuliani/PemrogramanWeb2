<?php
$servername = "localhost";  // Ganti dengan server MySQL Anda
$username = "root";         // Ganti dengan username MySQL Anda
$password = "";             // Ganti dengan password MySQL Anda
$dbname = "dbpos";          // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>