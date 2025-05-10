<?php
include 'header.php';
include 'db.php';

$status = null;

if (isset($_POST['simpan'])) {
    try {
        $sql = "INSERT INTO produk (kode_varchar, nama_varchar, harga, stok, rating_int, min_stok, jenis_produk_id, deskripsi)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssdiisis', 
            $_POST['kode_varchar'],
            $_POST['nama_varchar'],
            $_POST['harga'],
            $_POST['stok'],
            $_POST['rating_int'],
            $_POST['min_stok'],
            $_POST['jenis_produk_id'],
            $_POST['deskripsi']
        );

        mysqli_stmt_execute($stmt);

        $status = 'success';
    } catch (Exception $e) {
        $status = 'error';
    }
}
?>

<div class="max-w-4xl mx-auto my-10 p-6 bg-white shadow-2xl rounded-2xl">
    <div class="border-b-2 pb-4 mb-6">
        <h2 class="text-3xl font-bold text-blue-700">Tambah Produk</h2>
    </div>

    <?php if ($status == 'success'): ?>
        <div class="p-4 mb-4 rounded-lg bg-green-100 text-green-700 border border-green-400">
            ✅ Data produk berhasil disimpan!
        </div>
        <a href="produk.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            Lihat Data Produk
        </a>
    <?php elseif ($status == 'error'): ?>
        <div class="p-4 mb-4 rounded-lg bg-red-100 text-red-700 border border-red-400">
            ❌ Data produk gagal disimpan! Silakan coba lagi.
        </div>
        <a href="produk.php" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow">
            Isi Ulang Form
        </a>
    <?php else: ?>
        <form method="post" class="space-y-5">
            <div>
                <label for="kode_varchar" class="block text-gray-700 font-semibold mb-1">Kode Produk</label>
                <input type="text" id="kode_varchar" name="kode_varchar" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div>
                <label for="nama_varchar" class="block text-gray-700 font-semibold mb-1">Nama Produk</label>
                <input type="text" id="nama_varchar" name="nama_varchar" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div>
                <label for="harga" class="block text-gray-700 font-semibold mb-1">Harga</label>
                <input type="number" id="harga" name="harga" step="0.01" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div>
                <label for="stok" class="block text-gray-700 font-semibold mb-1">Stok</label>
                <input type="number" id="stok" name="stok" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div>
                <label for="rating_int" class="block text-gray-700 font-semibold mb-1">Rating (1-5)</label>
                <input type="number" id="rating_int" name="rating_int" min="1" max="5" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div>
                <label for="min_stok" class="block text-gray-700 font-semibold mb-1">Minimum Stok</label>
                <input type="number" id="min_stok" name="min_stok" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div>
                <label for="jenis_produk_id" class="block text-gray-700 font-semibold mb-1">Jenis Produk</label>
                <select id="jenis_produk_id" name="jenis_produk_id" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="">-- Pilih Jenis Produk --</option>
                    <option value="101">101 - Makanan</option>
                    <option value="102">102 - Minuman</option>
                    <option value="103">103 - Buah</option>
                    <option value="104">104 - Sayur</option>
                </select>
            </div>
            <div>
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="w-full px-4 py-2 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400 resize-y" rows="4" required></textarea>
            </div>
            <div>
                <button type="submit" name="simpan" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-green-400">
                    Simpan Produk
                </button>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
