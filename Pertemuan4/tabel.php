<?php
require_once 'fungsi.php';
$data_mhs = bacaData();
?>

<table border="1" cellpadding="2" cellspacing="2" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Mata Kuliah</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Nilai Tugas</th>
            <th>Nilai Akhir</th>
            <th>Kelulusan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach ($data_mhs as $mhs) {
            $obj = new NilaiMahasiswa(
                $mhs["nama"], 
                $mhs["matakuliah"], 
                $mhs["nilai_uts"], 
                $mhs["nilai_uas"], 
                $mhs["nilai_tugas"]
            );

            echo "<tr>";
            echo "<td>".$nomor."</td>";
            echo "<td>".$obj->nama."</td>";
            echo "<td>".$obj->matakuliah."</td>";
            echo "<td>".$obj->nilai_uts."</td>";
            echo "<td>".$obj->nilai_uas."</td>";
            echo "<td>".$obj->nilai_tugas."</td>";
            echo "<td>".number_format($obj->getNA(), 2)."</td>";
            echo "<td>".$obj->getKelulusan()."</td>";
            echo "</tr>";
            $nomor++;
        }
        ?>
    </tbody>
</table>
