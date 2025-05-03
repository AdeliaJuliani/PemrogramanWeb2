<?php
include 'config.php';
include 'index.php';

$status = null; // untuk status penyimpanan

if (isset($_POST['simpan'])) {
    try {
        // Perbaikan: pakai kolom sesuai database (tmp_lahir, tgl_lahir)
        $sql = "INSERT INTO pasien (nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id)
                VALUES (:nama, :tmp_lahir, :tgl_lahir, :gender, :email, :alamat, :kelurahan)";

        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':nama' => $_POST['nama'],
            ':tmp_lahir' => $_POST['tempat_lahir'],
            ':tgl_lahir' => $_POST['tanggal_lahir'],
            ':gender' => $_POST['gender'],
            ':email' => $_POST['email'],
            ':alamat' => $_POST['alamat'],
            ':kelurahan' => $_POST['kelurahan'],
        ]);

        $status = 'success'; // jika berhasil
    } catch (Exception $e) {
        $status = 'error'; // jika gagal
    }
}
?>

<div class="col-md-10 p-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2>Tambah Pasien</h2>
        </div>
        <div class="card-body">

            <?php if ($status == 'success'): ?>
                <div class="alert alert-success">
                    ✅ Data pasien berhasil disimpan!
                </div>
                <a href="pasien_data.php" class="btn btn-info">Lihat Data Pasien</a>
            <?php elseif ($status == 'error'): ?>
                <div class="alert alert-danger">
                    ❌ Data pasien gagal disimpan! Silakan coba lagi.
                </div>
                <a href="pasien.php" class="btn btn-warning">Isi Ulang Form</a>
            <?php else: ?>
                <form method="post">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tempat Lahir</label>
                        <input name="tempat_lahir" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">-- Pilih Gender --</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input name="alamat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kelurahan (ID)</label>
                        <input name="kelurahan" class="form-control" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success rounded-pill">Simpan</button>
                </form>
            <?php endif; ?>

        </div>
    </div>
</div>
</div></div></body></html>
