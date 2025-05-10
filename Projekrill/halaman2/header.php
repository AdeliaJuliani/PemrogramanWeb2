<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-lg h-screen fixed">
        <h2 class="text-2xl font-bold p-4 border-b border-blue-500">Topbase</h2>
        <nav class="flex flex-col">
            <a href="tambah_produk.php" class="flex items-center gap-2 p-4 hover:bg-blue-700 transition rounded">
                <i data-lucide="box"></i> Tambah Produk
            </a>
            <a href="jenis_produk.php" class="flex items-center gap-2 p-4 hover:bg-blue-700 transition rounded">
                <i data-lucide="box"></i> Jenis Produk
            </a>
            <a href="kategori_tokoh.php" class="flex items-center gap-2 p-4 hover:bg-blue-700 transition rounded">
                <i data-lucide="users"></i> Kategori Tokoh
            </a>
            <a href="produk.php" class="flex items-center gap-2 p-4 hover:bg-blue-700 transition rounded">
                <i data-lucide="shopping-bag"></i> Produk
            </a>
            <a href="testimoni.php" class="flex items-center gap-2 p-4 hover:bg-blue-700 transition rounded">
                <i data-lucide="message-square"></i> Testimoni
            </a>
            <a href="tokoh.php" class="flex items-center gap-2 p-4 hover:bg-blue-700 transition rounded">
                <i data-lucide="message-square"></i> Tokoh
            </a>
        </nav>
    </div>

    <div class="ml-64 p-6 w-full">
        <div class="bg-white shadow rounded-lg p-6 min-h-screen">
