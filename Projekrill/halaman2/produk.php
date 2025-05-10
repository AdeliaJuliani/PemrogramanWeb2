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
    <h1 class="text-2xl font-bold mb-6">Produk</h1>
    <a href="tambah_produk.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Tambah Produk</a>
    <div class="overflow-x-auto mt-6">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Kode</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Harga</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Stok</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Rating</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Min Stok</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Jenis Produk</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Deskripsi</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM produk");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='border-t border-gray-300'>
                            <td class='px-4 py-2'>{$row['id_produk']}</td>
                            <td class='px-4 py-2'>{$row['kode_varchar']}</td>
                            <td class='px-4 py-2'>{$row['nama_varchar']}</td>
                            <td class='px-4 py-2'>{$row['harga']}</td>
                            <td class='px-4 py-2'>{$row['stok']}</td>
                            <td class='px-4 py-2'>{$row['rating_int']}</td>
                            <td class='px-4 py-2'>{$row['min_stok']}</td>
                            <td class='px-4 py-2'>{$row['jenis_produk_id']}</td>
                            <td class='px-4 py-2'>{$row['deskripsi']}</td>
                            <td class='px-4 py-2'>
                                <div class='inline-flex space-x-2'>
                                    <a href='tambah_edit_produk.php?id={$row['id_produk']}' class='bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600 transition'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                    <a href='proses_hapus.php?tabel=produk&id={$row['id_produk']}' class='bg-red-500 text-white p-2 rounded hover:bg-red-600 transition'>
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