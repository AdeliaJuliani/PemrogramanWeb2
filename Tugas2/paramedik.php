<?php
include 'config.php';
include 'index.php'; 

$id = '';
$nama_paramedik = '';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

// Jika ada parameter id → ambil data (untuk edit)
if ($aksi == 'edit' && isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM paramedik WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id = $row['id'];
        $nama_paramedik = $row['nama'];
    }
}

// Hapus data
if (isset($_GET['hapus'])) {
    $stmt = $dbh->prepare("DELETE FROM paramedik WHERE id = ?");
    $stmt->execute([$_GET['hapus']]);
    header("Location: paramedik.php");
    exit;
}

// Simpan data baru
if (isset($_POST['simpan'])) {
    $stmt = $dbh->prepare("INSERT INTO paramedik (nama) VALUES (?)");
    $stmt->execute([$_POST['nama_paramedik']]);
    header("Location: paramedik.php");
    exit;
}

// Update data
if (isset($_POST['update'])) {
    $stmt = $dbh->prepare("UPDATE paramedik SET nama = ? WHERE id = ?");
    $stmt->execute([$_POST['nama_paramedik'], $_POST['id']]);
    header("Location: paramedik.php");
    exit;
}
?>

<div class="col-md-10 p-4">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h2>Data Paramedik</h2>
            <a href="paramedik.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body">

            <!-- TAMPILKAN FORM JIKA AKSI TAMBAH ATAU EDIT -->
            <?php if ($aksi == 'tambah' || $aksi == 'edit'): ?>
                <form method="POST" class="mb-4">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                    <div class="form-group">
                        <label>Nama Paramedik:</label>
                        <input type="text" name="nama_paramedik" class="form-control" value="<?= htmlspecialchars($nama_paramedik) ?>" required>
                    </div>
                    <button type="submit" name="<?= $id ? 'update' : 'simpan' ?>" class="btn btn-success mt-3">
                        <?= $id ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="paramedik.php" class="btn btn-secondary mt-3">Batal</a>
                </form>
            <?php endif; ?>

            <!-- TABEL DATA -->
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>ID</th>
                        <th>Nama Paramedik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $dbh->query("SELECT * FROM paramedik");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama']}</td>
                            <td>
                                <a href='paramedik.php?aksi=edit&id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='paramedik.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                            </td>
                        </tr>";
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
