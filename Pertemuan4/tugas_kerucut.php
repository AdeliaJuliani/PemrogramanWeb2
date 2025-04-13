<?php
// Fungsi untuk menghitung luas, keliling, dan volume kerucut
function hitungKerucut($jari_jari, $tinggi) {
    $pi = 3.14;
    $s = sqrt(($jari_jari ** 2) + ($tinggi ** 2)); // Menghitung garis pelukis (s)
    
    $luas_permukaan = $pi * $jari_jari * ($jari_jari + $s);
    $keliling_alas = 2 * $pi * $jari_jari;
    $volume = (1 / 3) * $pi * ($jari_jari ** 2) * $tinggi;

    return [
        "luas" => $luas_permukaan,
        "keliling" => $keliling_alas,
        "volume" => $volume
    ];
}

// Inisialisasi variabel hasil
$hasil = null;

// Proses form jika ada input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jari_jari = $_POST["jari_jari"];
    $tinggi = $_POST["tinggi"];

    // Validasi input (tidak boleh kosong atau negatif)
    if ($jari_jari > 0 && $tinggi > 0) {
        $hasil = hitungKerucut($jari_jari, $tinggi);
    } else {
        $error = "Jari-jari dan tinggi harus lebih dari 0!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Kerucut</title>
</head>
<body>
    <h2>Hitung Luas, Keliling, dan Volume Kerucut</h2>

    <form action="" method="POST">
        <label for="jari_jari">Jari-Jari (r):</label>
        <input type="number" name="jari_jari" id="jari_jari" step="0.01" required><br><br>

        <label for="tinggi">Tinggi (t):</label>
        <input type="number" name="tinggi" id="tinggi" step="0.01" required><br><br>

        <button type="submit">Hitung</button>
    </form>

    <?php if (isset($hasil)): ?>
        <h3>Hasil Perhitungan:</h3>
        <ul>
            <li><b>Luas Permukaan:</b> <?= number_format($hasil["luas"], 2) ?> cm²</li>
            <li><b>Keliling Alas:</b> <?= number_format($hasil["keliling"], 2) ?> cm</li>
            <li><b>Volume:</b> <?= number_format($hasil["volume"], 2) ?> cm³</li>
        </ul>
    <?php elseif (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>
