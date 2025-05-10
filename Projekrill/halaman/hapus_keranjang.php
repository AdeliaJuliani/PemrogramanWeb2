<?php
session_start();

// Cek apakah id_produk ada
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Hapus produk dari keranjang
    if (isset($_SESSION['keranjang'][$id_produk])) {
        unset($_SESSION['keranjang'][$id_produk]);
    }
}

// Redirect kembali ke halaman keranjang
header("Location: keranjang.php");
exit();