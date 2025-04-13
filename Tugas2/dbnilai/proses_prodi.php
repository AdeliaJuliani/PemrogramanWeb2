<?php
require_once 'dbkoneksi.php';

// Tangkap data dari form dengan validasi
$_kode = isset($_POST['kode']) ? $_POST['kode'] : null;
$_nama = isset($_POST['nama']) ? $_POST['nama'] : null;
$_kaprodi = isset($_POST['kaprodi']) ? $_POST['kaprodi'] : null;
$_proses = isset($_POST['proses']) ? $_POST['proses'] : null;

if (!$_proses) {
    die("Aksi tidak valid.");
}

// Buat array data
$ar_data = [$_kode, $_nama, $_kaprodi];

if ($_proses == "Simpan") {
    $sql = "INSERT INTO prodi(kode, nama, kaprodi) VALUES (?, ?, ?)";
} elseif ($_proses == "Update") {
    if (!isset($_POST['id_edit'])) {
        die("ID untuk update tidak ditemukan.");
    }
    $id_edit = $_POST['id_edit'];
    $ar_data = [$_nama, $_kaprodi, $_kode, $id_edit]; // sesuai urutan
    $sql = "UPDATE prodi SET nama=?, kaprodi=?, kode=? WHERE id=?";
} elseif ($_proses == "Hapus") {
    if (!isset($_POST['id_hapus'])) {
        die("ID untuk hapus tidak ditemukan.");
    }
    $id_hapus = $_POST['id_hapus'];
    $ar_data = [$id_hapus];
    $sql = "DELETE FROM prodi WHERE id=?";
} else {
    die("Proses tidak dikenali.");
}

try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute($ar_data);
    header('Location: list_prodi.php');
    exit;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
