<?php include 'db.php';

$tabel = $_GET['tabel'];  // Nama tabel yang dituju
$id = $_GET['id'] ?? '';  // ID yang akan diedit atau kosong jika untuk tambah data

if ($tabel == 'produk') {
    // Menangani data untuk tabel produk
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    
    if ($id) {
        mysqli_query($conn, "UPDATE produk SET nama='$nama', harga='$harga' WHERE id_produk='$id'");
    } else {
        mysqli_query($conn, "INSERT INTO produk (nama, harga) VALUES ('$nama', '$harga')");
    }
} 
else if ($tabel == 'testimoni') {
    // Menangani data untuk tabel testimoni
    $nama_singkat = $_POST['nama_singkat'];
    $isi = $_POST['isi'];
    $tanggal = date('Y-m-d');
    $rating = $_POST['rating'] ?? 5;  // Rating, jika tidak diisi default 5
    $produk_id = $_POST['produk_id'] ?? 1;  // ID Produk, jika tidak diisi default 1
    $tokoh_id = $_POST['tokoh_id'] ?? 1;  // ID Tokoh, jika tidak diisi default 1
    
    if ($id) {
        mysqli_query($conn, "UPDATE testimoni SET nama_singkat='$nama_singkat', komentar='$isi', tanggal='$tanggal', rating='$rating', produk_id='$produk_id', tokoh_id='$tokoh_id' WHERE id_testimoni='$id'");
    } else {
        mysqli_query($conn, "INSERT INTO testimoni (nama_singkat, komentar, tanggal, rating, produk_id, tokoh_id) VALUES ('$nama_singkat', '$isi', '$tanggal', '$rating', '$produk_id', '$tokoh_id')");
    }
} 
else if ($tabel == 'tokoh') {
    // Menangani data untuk tabel tokoh
    $nama = $_POST['nama'];
    $kategori_tokoh_id = $_POST['kategori_tokoh_id'];  // Kategori Tokoh (Remaja/Dewasa/Lansia)

    if ($id) {
        mysqli_query($conn, "UPDATE tokoh SET nama='$nama', kategori_tokoh_id='$kategori_tokoh_id' WHERE id_tokoh='$id'");
    } else {
        mysqli_query($conn, "INSERT INTO tokoh (nama, kategori_tokoh_id) VALUES ('$nama', '$kategori_tokoh_id')");
    }
} 
else {
    // Menangani data untuk tabel lainnya yang hanya memiliki nama
    $nama = $_POST['nama'];
    if ($id) {
        mysqli_query($conn, "UPDATE $tabel SET nama='$nama' WHERE id_$tabel='$id'");
    } else {
        mysqli_query($conn, "INSERT INTO $tabel (nama) VALUES ('$nama')");
    }
}

header("Location: $tabel.php");  // Redirect ke halaman utama tabel
?>
