<?php
session_start();
include("db_connection.php");

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesan_sekarang'])) {
    if (!empty($_SESSION['keranjang'])) {
        // Mulai transaksi untuk mengurangi stok
        $conn->begin_transaction();
        
        try {
            // Iterasi produk dalam keranjang
            foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                // Kurangi stok produk di database
                $stmt = $conn->prepare("UPDATE produk SET stok = stok - ? WHERE id_produk = ? AND stok >= ?");
                $stmt->bind_param("iii", $jumlah, $id_produk, $jumlah);
                if (!$stmt->execute()) {
                    throw new Exception("Gagal mengurangi stok untuk produk ID: " . $id_produk);
                }
            }

            // Kosongkan keranjang setelah transaksi berhasil
            $_SESSION['keranjang'] = [];

            // Commit transaksi jika semuanya berhasil
            $conn->commit();

            // Redirect ke halaman terima kasih
            header("Location: card.html");
            exit;
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            $conn->rollback();
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-6 space-y-6">
        <h2 class="text-3xl font-bold text-center text-blue-600">Checkout</h2>

        <!-- FORM DATA PEMBELI -->
        <form method="post" class="space-y-4">
            <div>
                <label class="block font-semibold">Nama Lengkap</label>
                <input type="text" name="nama" required class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block font-semibold">Nomor Telepon</label>
                <input type="text" name="telepon" required class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block font-semibold">Alamat Lengkap</label>
                <textarea name="alamat" required class="w-full p-2 border rounded-lg"></textarea>
            </div>
            <div>
                <label class="block font-semibold">Metode Pembayaran</label>
                <select name="pembayaran" required class="w-full p-2 border rounded-lg">
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="Bayar di Tempat">Bayar di Tempat</option>
                </select>
            </div>

            <!-- RINGKASAN PESANAN -->
            <div class="mt-6">
                <h3 class="text-xl font-bold mb-2">Ringkasan Pesanan</h3>
                <?php
                $total_produk = 0;
                $total_harga = 0;
                if (!empty($_SESSION['keranjang'])) {
                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                        $stmt = $conn->prepare("SELECT * FROM produk WHERE id_produk = ?");
                        $stmt->bind_param("i", $id_produk);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $produk = $result->fetch_assoc();

                        if ($produk) {
                            $subtotal = $produk['harga'] * $jumlah;
                            $total_harga += $subtotal;
                            echo "<div class='flex justify-between items-center border-b py-2'>
                                    <div>
                                        <p class='font-semibold'>{$produk['nama_varchar']}</p>
                                        <p class='text-sm text-gray-500'>Jumlah: {$jumlah}</p>
                                    </div>
                                    <p>Rp " . number_format($subtotal, 0, ',', '.') . "</p>
                                </div>";
                        }
                    }
                    echo "<div class='flex justify-between font-semibold border-t pt-2'>
                            <p>Total Produk</p>
                            <p>Rp " . number_format($total_harga, 0, ',', '.') . "</p>
                        </div>";
                    
                    // Biaya tambahan
                    $biaya_admin = 3000;
                    $biaya_antar = 25000;
                    $biaya_pajak = 15000;
                    $total_bayar = $total_harga + $biaya_admin + $biaya_antar + $biaya_pajak;

                    echo "<div class='flex justify-between'>
                            <p>Biaya Admin</p>
                            <p>Rp " . number_format($biaya_admin, 0, ',', '.') . "</p>
                        </div>";
                    echo "<div class='flex justify-between'>
                            <p>Biaya Antar</p>
                            <p>Rp " . number_format($biaya_antar, 0, ',', '.') . "</p>
                        </div>";
                    echo "<div class='flex justify-between'>
                            <p>Biaya Pajak</p>
                            <p>Rp " . number_format($biaya_pajak, 0, ',', '.') . "</p>
                        </div>";
                    echo "<div class='flex justify-between text-lg font-bold border-t pt-2'>
                            <p>Total Bayar</p>
                            <p>Rp " . number_format($total_bayar, 0, ',', '.') . "</p>
                        </div>";
                } else {
                    echo "<p class='text-center text-gray-500'>Keranjang kosong.</p>";
                }
                ?>
            </div>

            <?php if (!empty($_SESSION['keranjang'])): ?>
                <button type="submit" name="pesan_sekarang" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition">Pesan Sekarang</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
