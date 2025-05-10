<?php include 'header.php'; ?>
<?php
include 'db_connection.php'; // Pastikan file koneksi sudah ada

// Hapus pesanan jika ada request hapus
if (isset($_GET['hapus'])) {
    $id_pesanan = intval($_GET['hapus']);
    
    // Hapus detail pesanan dulu (jika ada tabel pesanan_detail)
    $conn->query("DELETE FROM pesanan_detail WHERE id_pesanan = $id_pesanan");

    // Hapus pesanan
    $conn->query("DELETE FROM pesanan WHERE id_pesanan = $id_pesanan");

    header("Location: pesanan.php");
    exit;
}
?>

<h1 class="text-xl font-bold mb-4">Daftar Pesanan</h1>

<?php
$result = $conn->query("SELECT * FROM pesanan ORDER BY tanggal_pesanan DESC");

if ($result->num_rows == 0) {
    echo "<p>Tidak ada pesanan.</p>";
} else {
    echo "<table class='table-auto w-full border-collapse border border-gray-300'>
            <thead>
                <tr class='bg-gray-100'>
                    <th class='border px-4 py-2'>No</th>
                    <th class='border px-4 py-2'>Nama Pembeli</th>
                    <th class='border px-4 py-2'>Metode Pembayaran</th>
                    <th class='border px-4 py-2'>Total Harga</th>
                    <th class='border px-4 py-2'>Aksi</th>
                </tr>
            </thead>
            <tbody>";

    $no = 1;
    while ($pesanan = $result->fetch_assoc()) {
        echo "<tr>
                <td class='border px-4 py-2'>$no</td>
                <td class='border px-4 py-2'>{$pesanan['nama']}</td>
                <td class='border px-4 py-2'>{$pesanan['metode_pembayaran']}</td>
                <td class='border px-4 py-2'>Rp " . number_format($pesanan['total_harga'], 0, ',', '.') . "</td>
                <td class='border px-4 py-2'>
                    <a href='pesanan.php?hapus={$pesanan['id_pesanan']}' onclick='return confirm(\"Yakin hapus pesanan ini?\")' class='bg-red-500 text-white px-3 py-1 rounded'>Hapus</a>
                </td>
              </tr>";
        $no++;
    }

    echo "</tbody></table>";
}
?>

<?php include 'footer.php'; ?>
