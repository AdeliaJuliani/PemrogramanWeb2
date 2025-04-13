<?php 
include 'config.php'; 
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM pasien WHERE id = $id")->fetch_assoc();
?>
<h2>Edit Pasien</h2>
<form method="post">
    Nama: <input name="nama" value="<?= $data['nama'] ?>"><br>
    Tempat Lahir: <input name="tempat_lahir" value="<?= $data['tempat_lahir'] ?>"><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>"><br>
    Gender: 
    <select name="gender">
        <option <?= $data['gender']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
        <option <?= $data['gender']=='Perempuan'?'selected':'' ?>>Perempuan</option>
    </select><br>
    Email: <input name="email" value="<?= $data['email'] ?>"><br>
    Alamat: <input name="alamat" value="<?= $data['alamat'] ?>"><br>
    Kelurahan: <input name="kelurahan" value="<?= $data['kelurahan'] ?>"><br>
    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    $sql = "UPDATE pasien SET 
            nama='{$_POST['nama']}', tempat_lahir='{$_POST['tempat_lahir']}',
            tanggal_lahir='{$_POST['tanggal_lahir']}', gender='{$_POST['gender']}',
            email='{$_POST['email']}', alamat='{$_POST['alamat']}',
            kelurahan='{$_POST['kelurahan']}'
            WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}
?>
