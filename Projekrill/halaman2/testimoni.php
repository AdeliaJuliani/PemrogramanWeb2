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
    <h1 class="text-2xl font-bold mb-6">Testimoni</h1>
    <a href="tambah_edit_testimoni.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Tambah Testimoni</a>
    
    <div class="overflow-x-auto mt-6">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tanggal</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Komentar</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Rating</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Produk ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tokoh ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM testimoni");
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='border-t border-gray-300'>
                            <td class='px-4 py-2'>{$row['id_testimoni']}</td>
                            <td class='px-4 py-2'>{$row['tanggal']}</td>
                            <td class='px-4 py-2'>{$row['nama_singkat']}</td>
                            <td class='px-4 py-2'>{$row['komentar']}</td>
                            <td class='px-4 py-2'>{$row['rating']}</td>
                            <td class='px-4 py-2'>{$row['produk_id']}</td>
                            <td class='px-4 py-2'>{$row['tokoh_id']}</td>
                            <td class='px-4 py-2'>
                                <div class='space-y-2'>
                                    <a href='tambah_edit_testimoni.php?id={$row['id_testimoni']}' class='bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow mr-2 transition'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                    <a href='proses_hapus.php?tabel=testimoni&id={$row['id_testimoni']}' class='bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow transition'>
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