<?php include 'header.php'; include 'db.php';
$id = $_GET['id'] ?? '';
$data = ($id) ? mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tokoh WHERE id_tokoh='$id'")) : ['nama'=>'', 'kategori_tokoh_id'=>''];
?>
<h1 class="text-xl font-bold mb-4"><?= $id ? 'Edit' : 'Tambah'; ?> Tokoh</h1>
<form method="post" action="proses_simpan.php?tabel=tokoh&id=<?= $id ?>">
    <label>Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required class="border p-2"></label><br>
    
    <label>Kategori Tokoh:
        <select name="kategori_tokoh_id" class="border p-2" required>
            <option value="1" <?= $data['kategori_tokoh_id'] == '1' ? 'selected' : '' ?>>Remaja</option>
            <option value="2" <?= $data['kategori_tokoh_id'] == '2' ? 'selected' : '' ?>>Dewasa</option>
            <option value="3" <?= $data['kategori_tokoh_id'] == '3' ? 'selected' : '' ?>>Lansia</option>
        </select>
    </label><br><br>

    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Simpan</button>
</form>
<?php include 'footer.php'; ?>
