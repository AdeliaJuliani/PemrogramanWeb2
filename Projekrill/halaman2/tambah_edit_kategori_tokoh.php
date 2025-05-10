<?php include 'header.php'; include 'db.php';
$id = $_GET['id'] ?? '';
$data = ($id) ? mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kategori_tokoh WHERE id_kategori_tokoh='$id'")) : ['nama'=>''];
?>
<h1 class="text-xl font-bold mb-4"><?= $id ? 'Edit' : 'Tambah'; ?> Kategori Tokoh</h1>
<form method="post" action="proses_simpan.php?tabel=kategori_tokoh&id=<?= $id ?>">
    <label>Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required class="border p-2"></label>
    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Simpan</button>
</form>
<?php include 'footer.php'; ?>