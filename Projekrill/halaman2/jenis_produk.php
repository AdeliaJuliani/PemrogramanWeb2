<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<?php include 'header.php'; include 'db.php'; ?>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Jenis Produk</h1>
    <a href="tambah_edit_jenis_produk.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Tambah Jenis Produk</a>
    <div class="overflow-x-auto mt-6">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM jenis_produk");
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='border-t border-gray-300'>
                        <td class='px-4 py-2'>{$row['id_jenis_produk']}</td>
                        <td class='px-4 py-2'>{$row['nama']}</td>
                        <td class='px-4 py-2'>
                            <div class='space-y-2'>
                                <a href='tambah_edit_jenis_produk.php?id={$row['id_jenis_produk']}' class='bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow mr-2 transition'>
                                    <i class='fas fa-edit'></i>
                                </a>
                                <a href='proses_hapus.php?tabel=jenis_produk&id={$row['id_jenis_produk']}' class='bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow transition'>
                                    <i class='fas fa-trash'></i>
                                </a>
                            </div>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>
