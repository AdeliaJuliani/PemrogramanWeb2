<?php
require_once 'dbkoneksi.php'; 

// definisi query
$sql = "SELECT * FROM prodi";
// jalankan query
$rs = $dbh->query($sql);
?>

<h2>Daftar Program Studi</h2>
<table border="1" width="100%">
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama Prodi</th>
        <th>Kepala Prodi</th>
        <th>Aksi</th>
    </tr>
    <?php
    $nomor = 1;
    foreach($rs as $row){
    ?>
    <tr>
        <td><?= $nomor ?></td>
        <td><?= $row->kode ?></td>
        <td><?= $row->nama ?></td>
        <td><?= $row->kaprodi ?></td>
        <td>
            <a href="form_prodi.php?id_edit=<?= $row->id ?>">Edit</a> |
            <a href="proses_prodi.php?id_hapus=<?= $row->id ?>">Hapus</a>
        </td>
    </tr>
    <?php 
        $nomor++;
    } 
    ?>
</table>

