<?php
include 'config.php';
include 'index.php'; // kalau perlu layout

$id = '';
$tanggal = '';
$berat = '';
$tinggi = '';
$tensi = '';
$keterangan = '';
$pasien_id = '';
$dokter_id = '';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($aksi == 'edit' && isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM periksa WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id = $row['id'];
        $tanggal = $row['tanggal'];
        $berat = $row['berat'];
        $tinggi = $row['tinggi'];
        $tensi = $row['tensi'];
        $keterangan = $row['keterangan'];
        $pasien_id = $row['pasien_id'];
        $dokter_id = $row['dokter_id'];
    }
}

if (isset($_GET['hapus'])) {
    $stmt = $dbh->prepare("DELETE FROM periksa WHERE id = ?");
    $stmt->execute([$_GET['hapus']]);
    header("Location: periksa.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $stmt = $dbh->prepare("INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['tanggal'],
        $_POST['berat'],
        $_POST['tinggi'],
        $_POST['tensi'],
        $_POST['keterangan'],
        $_POST['pasien_id'],
        $_POST['dokter_id']
    ]);
    header("Location: periksa.php");
    exit;
}

if (isset($_POST['update'])) {
    $stmt = $dbh->prepare("UPDATE periksa SET tanggal=?, berat=?, tinggi=?, tensi=?, keterangan=?, pasien_id=?, dokter_id=? WHERE id=?");
    $stmt->execute([
        $_POST['tanggal'],
        $_POST['berat'],
        $_POST['tinggi'],
        $_POST['tensi'],
        $_POST['keterangan'],
        $_POST['pasien_id'],
        $_POST['dokter_id'],
        $_POST['id']
    ]);
    header("Location: periksa.php");
    exit;
}
?>

<div class="col-md-10 p-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h2>Data Periksa</h2>
            <a href="periksa.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body">

            <?php if ($aksi == 'tambah' || $aksi == 'edit'): ?>
                <form method="POST" class="mb-4">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                    <div class="form-group">
                        <label>Tanggal:</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($tanggal) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Berat (kg):</label>
                        <input type="number" step="0.01" name="berat" class="form-control" value="<?= htmlspecialchars($berat) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tinggi (cm):</label>
                        <input type="number" step="0.01" name="tinggi" class="form-control" value="<?= htmlspecialchars($tinggi) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tensi:</label>
                        <input type="text" name="tensi" class="form-control" value="<?= htmlspecialchars($tensi) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan:</label>
                        <textarea name="keterangan" class="form-control" required><?= htmlspecialchars($keterangan) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Pasien:</label>
                        <select name="pasien_id" class="form-control" required>
                            <option value="">--Pilih Pasien--</option>
                            <?php
                            $pasien = $dbh->query("SELECT * FROM pasien");
                            while ($p = $pasien->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $pasien_id == $p['id'] ? 'selected' : '';
                                echo "<option value='{$p['id']}' $selected>{$p['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dokter (Paramedik):</label>
                        <select name="dokter_id" class="form-control" required>
                            <option value="">--Pilih Dokter--</option>
                            <?php
                            $dokter = $dbh->query("SELECT * FROM paramedik");
                            while ($d = $dokter->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $dokter_id == $d['id'] ? 'selected' : '';
                                echo "<option value='{$d['id']}' $selected>{$d['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="<?= $id ? 'update' : 'simpan' ?>" class="btn btn-success mt-3">
                        <?= $id ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="periksa.php" class="btn btn-secondary mt-3">Batal</a>
                </form>
            <?php endif; ?>

            <table class="table table-striped table-hover table-bordered">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Berat</th>
                        <th>Tinggi</th>
                        <th>Tensi</th>
                        <th>Keterangan</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $dbh->query("SELECT periksa.*, pasien.nama AS nama_pasien, paramedik.nama AS nama_dokter FROM periksa
                                         LEFT JOIN pasien ON periksa.pasien_id = pasien.id
                                         LEFT JOIN paramedik ON periksa.dokter_id = paramedik.id");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['tanggal']}</td>
                                <td>{$row['berat']}</td>
                                <td>{$row['tinggi']}</td>
                                <td>{$row['tensi']}</td>
                                <td>{$row['keterangan']}</td>
                                <td>{$row['nama_pasien']}</td>
                                <td>{$row['nama_dokter']}</td>
                                <td>
                                    <a href='periksa.php?aksi=edit&id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='periksa.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
