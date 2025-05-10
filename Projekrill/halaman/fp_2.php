<?php
include('db_connection.php');

$kode = isset($_GET['kode']) ? $_GET['kode'] : '';

$sql = "
  SELECT p.*, t.komentar
  FROM produk p
  LEFT JOIN testimoni t
    ON p.id_produk = t.produk_id
  WHERE p.kode_varchar LIKE '$kode%'
  LIMIT 12
";

$result = $conn->query($sql);

$user_icons = [
  "https://cdn-icons-png.flaticon.com/512/149/149071.png",
  "https://cdn-icons-png.flaticon.com/512/847/847969.png",
  "https://cdn-icons-png.flaticon.com/512/236/236831.png",
  "https://cdn-icons-png.flaticon.com/512/4140/4140048.png",
  "https://cdn-icons-png.flaticon.com/512/921/921347.png"
];

$no_user = 0;
?>

<?php if ($result->num_rows > 0): ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <?php while($row = $result->fetch_assoc()): 
        $nama_bersih = strtolower(str_replace(' ', '_', $row['kode_varchar']));
        $image_url = "../produk/" . $nama_bersih . ".jpg";
        $user_icon = $user_icons[$no_user];
        $no_user = ($no_user + 1) % count($user_icons);
    ?>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition flex flex-col">
      <img src="<?= $image_url ?>" class="w-full aspect-square object-cover">
      <div class="p-4 flex-1 flex flex-col justify-between">
        <div>
          <h3 class="font-bold text-lg text-red-500"><?= htmlspecialchars($row['nama_varchar']) ?></h3>
          <p class="text-yellow-500 font-bold text-xl">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
          <p>⭐ <?= $row['rating_int'] ?> | <span class="text-green-600 font-semibold">Stok: <?= $row['stok'] ?></span></p>
          <p class="text-sm text-gray-700 mt-1"><?= htmlspecialchars($row['deskripsi']) ?></p>
        </div>
        <div class="flex items-center mt-2">
          <img src="<?= $user_icon ?>" class="w-8 h-8 rounded-full ring-2 ring-yellow-400">
          <p class="ml-2 text-sm italic text-gray-600">“<?= htmlspecialchars($row['komentar']) ?>”</p>
        </div>
        <!-- Tombol dan input jumlah -->
        <div class="flex items-center space-x-2 mt-3 tombol-container" data-id="<?= $row['id_produk'] ?>">
            <button class="kurang-jumlah bg-red-400 text-white px-2 rounded shadow">-</button>
            <input type="number" value="1" min="1" class="input-jumlah w-12 text-center border rounded">
            <button class="tambah-jumlah bg-green-400 text-white px-2 rounded shadow">+</button>
            <button class="btn-tambah bg-blue-500 hover:bg-blue-400 text-white px-3 py-1 rounded shadow ml-4">Tambah ke Keranjang</button>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
</div>
<?php else: ?>
<p class="text-center text-gray-600">Tidak ada produk tersedia</p>
<?php endif; ?>

<?php $conn->close(); ?>
