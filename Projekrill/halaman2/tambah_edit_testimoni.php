<?php include 'header.php'; include 'db.php';
$id = $_GET['id'] ?? '';
$data = ($id) ? mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM testimoni WHERE id_testimoni='$id'")) : ['nama_singkat'=>'', 'isi'=>''];
?>
<h1 class="text-xl font-bold mb-4"><?= $id ? 'Edit' : 'Tambah'; ?> Testimoni</h1>
<form method="post" action="proses_simpan.php?tabel=testimoni&id=<?= $id ?>">
    <label>Nama: <input type="text" name="nama_singkat" value="<?= $data['nama_singkat'] ?>" required class="border p-2"></label><br>
    <label>Komentar: <textarea name="isi" class="border p-2" required><?= $data['isi'] ?></textarea></label><br>
    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Simpan</button>
</form>
<?php include 'footer.php'; ?>
