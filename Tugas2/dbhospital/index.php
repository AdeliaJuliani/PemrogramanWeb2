<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pasien</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff; 
        }
        .table thead {
            background-color: #b3e5fc; 
        }
        .btn-success {
            background-color: #81c784; 
            border-color: #66bb6a;
        }
        .btn-warning {
            background-color: #ffd54f;
            border-color: #ffca28;
        }
        .btn-danger {
            background-color: #ef9a9a;
            border-color: #e57373;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        h2 {
            color: #00796b;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Pasien</h2>
    <div class="text-right mb-3">
        <a href="tambah.php" class="btn btn-success">+ Tambah Pasien</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th><th>Nama</th><th>Tempat Lahir</th><th>Tanggal Lahir</th>
                    <th>Gender</th><th>Email</th><th>Alamat</th><th>Kelurahan</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT pasien.*, kelurahan.nama_kelurahan 
                        FROM pasien 
                        LEFT JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
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
                            <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='hapus.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
