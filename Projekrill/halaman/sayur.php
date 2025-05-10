<?php
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kategori</title>
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
<div class="px-8 mb-12" id="rekomendasiProduk">
  <span id="cartCountProduk"></span>
  <h2 class="text-center text-5xl font-bold text-blue-600 mb-6">Sayuran</h2>
  <div id="product-list" class="space-y-6"></div>
</div>

<script>
    $(document).ready(function(){
        // Panggil produk berdasarkan kode_varchar
        fetchProducts('SYR');
    });

const productContainer = $('#product-list');

function fetchProducts() {
    $.ajax({
        url: 'fp_2.php',
        method: 'GET',
        data: { kode: 'SYR' },  // <=== tambahkan ini
        success: function(response) {
            console.log(response);  // debug
            productContainer.html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching products:", status, error);
            productContainer.html('<p>Gagal memuat produk.</p>');
        }
    });
}

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

</body>
</html>
