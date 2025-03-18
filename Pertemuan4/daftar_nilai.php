<?php
require_once 'fungsi.php';

// Proses data saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $matkul = $_POST["matkul"];
    $nilai_uts = $_POST["nilai_uts"];
    $nilai_uas = $_POST["nilai_uas"];
    $nilai_tugas = $_POST["nilai_tugas"];

    // Simpan data ke JSON
    tambahMahasiswa($nama, $matkul, $nilai_uts, $nilai_uas, $nilai_tugas);

    // Redirect untuk menghindari resubmission
    header("Location: daftar_nilai.php");
    exit();
}
?>

<h3>Input Data Mahasiswa</h3>

<form action="" method="POST">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" required><br><br>

    <label for="matkul">Matkul</label>
    <input type="text" name="matkul" id="matkul" required><br><br>

    <label for="nilai_uts">UTS</label>
    <input type="number" name="nilai_uts" id="nilai_uts" required><br><br>

    <label for="nilai_uas">UAS</label>
    <input type="number" name="nilai_uas" id="nilai_uas" required><br><br>

    <label for="nilai_tugas">Tugas</label>
    <input type="number" name="nilai_tugas" id="nilai_tugas" required><br><br>

    <input type="submit" value="Simpan">
</form>

<h3>Daftar Nilai Mahasiswa</h3>
<?php include 'tabel.php'; ?> <!-- Load tabel data mahasiswa -->
