<?php include 'config.php'; ?>
<h2>Tambah Pasien</h2>
<form method="post">
    Nama: <input name="nama"><br>
    Tempat Lahir: <input name="tempat_lahir"><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir"><br>
    Gender: 
    <select name="gender">
        <option>Laki-laki</option>
        <option>Perempuan</option>
    </select><br>
    Email: <input name="email"><br>
    Alamat: <input name="alamat"><br>
    Kelurahan: <input name="kelurahan"><br>
    <button type="submit" name="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $sql = "INSERT INTO pasien (nama, tempat_lahir, tanggal_lahir, gender, email, alamat, kelurahan)
            VALUES ('{$_POST['nama']}', '{$_POST['tempat_lahir']}', '{$_POST['tanggal_lahir']}',
                    '{$_POST['gender']}', '{$_POST['email']}', '{$_POST['alamat']}', '{$_POST['kelurahan']}')";
    $conn->query($sql);
    header("Location: index.php");
}
?>
