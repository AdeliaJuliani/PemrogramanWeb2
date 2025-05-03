<?php
include 'config.php';
include 'index.php';

$id = '';
$nama = '';
$tmp_lahir = '';
$tgl_lahir = '';
$gender = '';
$email = '';
$alamat = '';
$kelurahan_id = '';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

// Ambil data untuk edit
if ($aksi == 'edit' && isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id = $row['id'];
        $nama = $row['nama'];
        $tmp_lahir = $row['tmp_lahir'];
        $tgl_lahir = $row['tgl_lahir'];
        $gender = $row['gender'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $kelurahan_id = $row['kelurahan_id'];
    }
}

// Hapus data
if (isset($_GET['hapus'])) {
    $stmt = $dbh->prepare("DELETE FROM pasien WHERE id = ?");
    $stmt->execute([$_GET['hapus']]);
    header("Location: pasien_data.php");
    exit;
}

// Simpan data baru
if (isset($_POST['simpan'])) {
    $stmt = $dbh->prepare("INSERT INTO pasien (nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nama'],
        $_POST['tmp_lahir'],
        $_POST['tgl_lahir'],
        $_POST['gender'],
        $_POST['email'],
        $_POST['alamat'],
        $_POST['kelurahan_id']
    ]);
    header("Location: pasien_data.php");
    exit;
}

// Update data
if (isset($_POST['update'])) {
    $stmt = $dbh->prepare("UPDATE pasien SET nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, email=?, alamat=?, kelurahan_id=? WHERE id=?");
    $stmt->execute([
        $_POST['nama'],
        $_POST['tmp_lahir'],
        $_POST['tgl_lahir'],
        $_POST['gender'],
        $_POST['email'],
        $_POST['alamat'],
        $_POST['kelurahan_id'],
        $_POST['id']
    ]);
    header("Location: pasien_data.php");
    exit;
}
?>

<div class="col-md-10 p-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h2>Data Pasien</h2>
            <a href="pasien_data.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body">

            <!-- FORM TAMBAH / EDIT -->
            <?php if ($aksi == 'tambah' || $aksi == 'edit'): ?>
                <form method="POST" class="mb-4">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir:</label>
                        <input type="text" name="tmp_lahir" class="form-control" value="<?= htmlspecialchars($tmp_lahir) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="<?= htmlspecialchars($tgl_lahir) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gender:</label>
                        <select name="gender" class="form-control" required>
                            <option value="">--Pilih--</option>
                            <option value="L" <?= $gender == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $gender == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat:</label>
                        <textarea name="alamat" class="form-control" required><?= htmlspecialchars($alamat) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kelurahan:</label>
                        <select name="kelurahan_id" class="form-control" required>
                            <option value="">--Pilih Kelurahan--</option>
                            <?php
                            $kel = $dbh->query("SELECT * FROM kelurahan");
                            while ($k = $kel->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $kelurahan_id == $k['id'] ? 'selected' : '';
                                echo "<option value='{$k['id']}' $selected>{$k['nama_kelurahan']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="<?= $id ? 'update' : 'simpan' ?>" class="btn btn-success mt-3">
                        <?= $id ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="pasien_data.php" class="btn btn-secondary mt-3">Batal</a>
                </form>
            <?php endif; ?>

            <!-- TABEL DATA PASIEN -->
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Kelurahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $dbh->query("SELECT pasien.*, kelurahan.nama_kelurahan FROM pasien LEFT JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['tmp_lahir']}</td>
                                <td>{$row['tgl_lahir']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['nama_kelurahan']}</td>
                                <td>
                                    <a href='pasien_data.php?aksi=edit&id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='pasien_data.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
