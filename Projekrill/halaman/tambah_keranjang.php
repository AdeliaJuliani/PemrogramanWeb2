<?php
session_start();
include("db_connection.php");

$id_produk = isset($_POST['id_produk']) ? (int)$_POST['id_produk'] : 0;
$jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 1;

// Pastikan jumlah minimal 1
if ($jumlah < 1) $jumlah = 1;

// Cek apakah produk ada di database
$stmt = $conn->prepare("SELECT id_produk FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan']);
    exit;
}

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Tambahkan produk ke keranjang
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += $jumlah;
} else {
    $_SESSION['keranjang'][$id_produk] = $jumlah;
}

// Hitung total item
$total_items = array_sum($_SESSION['keranjang']);

echo json_encode(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang!', 'total_items' => $total_items]);
?>