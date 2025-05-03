<?php
include 'config.php';  // Meng-include koneksi database
include 'index.php';   // Meng-include layout atau header (jika diperlukan)

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';  // Mendapatkan aksi (tambah/edit/hapus)
$id = isset($_GET['id']) ? $_GET['id'] : '';        // Mendapatkan id untuk edit/hapus
$nama_unit = '';  // Variabel untuk input nama unit kerja

// Fungsi untuk tambah data
if (isset($_POST['simpan'])) {
    $nama_unit = $_POST['nama_unit'];
    $stmt = $dbh->prepare("INSERT INTO unit_kerja (nama_unit) VALUES (?)");
    $stmt->execute([$nama_unit]);
    header("Location: unitkerja.php"); // Redirect ke halaman unitkerja.php setelah tambah data
    exit;
}

// Fungsi untuk edit data
if ($aksi == 'edit' && $id) {
    $stmt = $dbh->prepare("SELECT * FROM unit_kerja WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $nama_unit = $row['nama_unit'];
    }

    // Update data jika form di-submit
    if (isset($_POST['update'])) {
        $nama_unit = $_POST['nama_unit'];
        $stmt = $dbh->prepare("UPDATE unit_kerja SET nama_unit = ? WHERE id = ?");
        $stmt->execute([$nama_unit, $id]);
        header("Location: unitkerja.php");  // Redirect ke halaman unitkerja.php setelah update data
        exit;
    }
}

// Fungsi untuk hapus data
if (isset($_GET['hapus'])) {
    $stmt = $dbh->prepare("DELETE FROM unit_kerja WHERE id = ?");
    $stmt->execute([$_GET['hapus']]);
    header("Location: unitkerja.php"); // Redirect ke halaman unitkerja.php setelah hapus data
    exit;
}
?>

<div class="col-md-10 p-4">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h2>Data Unit Kerja</h2>
            <a href="unitkerja.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body">

            <!-- Form untuk Tambah / Edit Data -->
            <?php if ($aksi == 'tambah' || $aksi == 'edit'): ?>
                <form method="POST" class="mb-4">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                    <div class="form-group">
                        <label>Nama Unit:</label>
                        <input type="text" name="nama_unit" class="form-control" value="<?= htmlspecialchars($nama_unit) ?>" required>
                    </div>
                    <button type="submit" name="<?= $id ? 'update' : 'simpan' ?>" class="btn btn-success mt-3">
                        <?= $id ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="unitkerja.php" class="btn btn-secondary mt-3">Batal</a>
                </form>
            <?php endif; ?>

            <!-- Tabel Data Unit Kerja -->
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Nama Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data unit kerja
                    $stmt = $dbh->query("SELECT * FROM unit_kerja");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nama_unit']}</td>
                                <td>
                                    <a href='unitkerja.php?aksi=edit&id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='unitkerja.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

</body>
</html>
