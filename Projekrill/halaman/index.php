<?php
include('db_connection.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Landing Page Minimarket</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }
  </style>
</head>
<body class="bg-gray-50">
  <!-- NAVBAR -->
  <nav class="sticky top-0 z-50 flex items-center justify-between bg-gradient-to-r from-red-500 via-yellow-400 to-blue-500 text-white px-6 py-4 shadow-lg">
    <div class="flex items-center space-x-2">
        <img src="../img/logo.png" alt="Logo" class="h-8 w-8 rounded-full bg-white">
        <span class="text-xl font-bold">TOPMART</span>
    </div>
    <div class="flex items-center w-1/3 space-x-2">
        <input type="text" placeholder="Search..." class="w-full px-4 py-1 rounded-full text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" id="searchInput">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer text-white hover:text-yellow-300 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="searchIcon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <div class="flex items-center space-x-4">
        <button onclick="window.location.href='../login.php'" class="bg-yellow-400 hover:bg-yellow-300 text-black px-3 py-1 rounded shadow-md">Login</button>
        <div class="relative cursor-pointer hover:scale-105 transition" onclick="window.location.href='keranjang.php'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007.6 17h9.8a1 1 0 00.95-.68L21 9H7M7 13L5 6M16 21a1 1 0 11-2 0 1 1 0 012 0zm-8 0a1 1 0 11-2 0 1 1 0 012 0z"/>
            </svg>
        </div>
    </div>
</nav>

  <!-- BANNER UTAMA -->
  <div class="w-full h-[900px] my-8 px-8"> <img src="../img/selamat.png" alt="Banner Promosi" class="w-full h-full object-cover rounded-lg shadow-lg border-4 border-yellow-400"></div>

  <!-- KATEGORI -->
  <div class="text-center my-10">
    <h2 class="text-5xl font-bold text-red-600 mb-6 uppercase">Kategori</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-8">
        <a href="makanan.php">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition">
                <img src="../img/k1.jpg" alt="" class="w-full h-45 object-cover">
                <p class="p-3 font-bold text-blue-600 text-xl">Makanan</p>
            </div>
        </a>
        <a href="minuman.php">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition">
                <img src="../img/k2.jpg" alt="" class="w-full h-45 object-cover">
                <p class="p-3 font-bold text-yellow-500 text-xl">Minuman</p>
            </div>
        </a>
        <a href="buah.php">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition">
                <img src="../img/k3.jpg" alt="" class="w-full h-45 object-cover">
                <p class="p-3 font-bold text-green-600 text-xl">Buah - Buahan</p>
            </div>
        </a>
        <a href="sayur.php">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition">
                <img src="../img/k4.jpg" alt="" class="w-full h-45 object-cover">
                <p class="p-3 font-bold text-pink-600 text-xl">Sayuran</p>
            </div>
        </a>
    </div>
  </div>

  <!-- BANNER PROMOSI -->
  <div class="w-full h-[900px] my-8 px-8"> <img src="../img/diskon.png" alt="Banner Promosi" class="w-full h-full object-cover rounded-lg shadow-lg border-4 border-yellow-400"></div>

  <!-- REKOMENDASI PRODUK -->
<div class="px-8 mb-12" id="rekomendasiProduk">
  <span id="cartCountProduk"></span>
  <h2 class="text-center text-5xl font-bold text-blue-600 mb-6">Rekomendasi Produk</h2>
  <div id="product-list" class="space-y-6"></div>
</div>


<script>
    $(document).ready(function(){
    fetchProducts();
});

const searchInput = $('#searchInput');
const searchIcon = $('#searchIcon');
const productContainer = $('#product-list');
const rekomendasiProdukSection = $('#rekomendasiProduk');

function fetchProducts() {
    $.ajax({
        url: 'fetch_products.php',
        method: 'GET',
        success: function(response) {
            productContainer.html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching products:", status, error);
            productContainer.html('<p>Gagal memuat produk.</p>');
        }
    });
}

function performSearch(searchTerm) {
    if (searchTerm.length >= 1) {
        $.ajax({
            url: 'search_products.php',
            method: 'POST',
            data: { searchTerm: searchTerm },
            success: function(data) {
                productContainer.html(data);
            },
            error: function(xhr, status, error) {
                console.error("Error performing search:", status, error);
                productContainer.html('<p>Terjadi kesalahan saat mencari produk.</p>');
            }
        });
    } else {
        fetchProducts();
    }

    $('html, body').animate({
        scrollTop: rekomendasiProdukSection.offset().top
    }, 'slow');
}

searchIcon.on('click', function() {
    const searchTerm = searchInput.val().trim();
    performSearch(searchTerm);
});

searchInput.on('input', function() {
    const searchTerm = $(this).val().trim();
    if (searchTerm.length >= 3) {
        performSearch(searchTerm);
    } else if (searchTerm.length === 0) {
        fetchProducts();
    }
});

searchInput.on('keypress', function(event) {
    if (event.key === 'Enter') {
        const searchTerm = searchInput.val().trim();
        performSearch(searchTerm);
    }
});

$(document).on('click', '.tambah-jumlah', function() {
    const input = $(this).siblings('.input-jumlah');
    const currentVal = parseInt(input.val());
    input.val(currentVal + 1);
});

// Fungsi tombol kurang jumlah
$(document).on('click', '.kurang-jumlah', function() {
    const input = $(this).siblings('.input-jumlah');
    const currentVal = parseInt(input.val());
    if (currentVal > 1) {
        input.val(currentVal - 1);
    }
});

// Fungsi tambah ke keranjang
$(document).on('click', '.btn-tambah', function() {
    const parentCard = $(this).closest('.tombol-container');
    const idProduk = parentCard.data('id');
    const jumlahInput = parentCard.find('.input-jumlah');
    const jumlah = parseInt(jumlahInput.val() || 1);

    console.log(`ID Produk: ${idProduk}, Jumlah: ${jumlah}`);

    $.ajax({
        url: 'tambah_keranjang.php',
        method: 'POST',
        data: { id_produk: idProduk, jumlah: jumlah },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                $('#cartCountProduk').text(data.total_items);
                alert('Produk berhasil ditambahkan ke keranjang!');
            } else {
                alert('Gagal menambahkan produk ke keranjang!');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error adding to cart:", status, error);
            alert('Terjadi kesalahan saat menambahkan produk ke keranjang.');
        }
    });
});
</script>