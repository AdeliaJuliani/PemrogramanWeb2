<?php
// Sertakan file koneksi database
require_once 'db_connection.php';

// Periksa apakah kata kunci pencarian diterima
if (isset($_POST['searchTerm'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // Query untuk mencari produk berdasarkan nama atau deskripsi
    $sql = "SELECT id_produk, nama_varchar, harga, deskripsi FROM produk WHERE nama_varchar LIKE '%$searchTerm%' OR deskripsi LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition">';
                echo '<div class="p-3">';
                echo '<h3 class="font-bold text-blue-600">' . htmlspecialchars($row['nama_varchar']) . '</h3>';
                echo '<p class="text-gray-700 text-sm">' . substr(htmlspecialchars($row['deskripsi']), 0, 50) . '...</p>';
                echo '<p class="text-green-500 font-semibold">Rp ' . number_format($row['harga']) . '</p>';
                echo '<button class="mt-2 bg-yellow-400 hover:bg-yellow-300 text-black px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">Lihat Detail</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Tidak ada produk yang ditemukan dengan kata kunci "' . htmlspecialchars($searchTerm) . '".</p>';
        }
    } else {
        echo '<p class="text-red-500">Terjadi kesalahan saat mencari produk di database: ' . mysqli_error($conn) . '</p>';
    }
    mysqli_free_result($result);
} else {
    echo '<p>Kata kunci pencarian tidak diterima.</p>';
}

mysqli_close($conn);
?>