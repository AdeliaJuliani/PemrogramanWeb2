<?php
session_start(); // Memulai session untuk menyimpan daftar nilai

// Inisialisasi daftar nilai jika belum ada
if (!isset($_SESSION["nilai_list"])) {
    $_SESSION["nilai_list"] = [];
}

// Jika form dikirim dan belum mencapai 10 nilai
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nilai"]) && count($_SESSION["nilai_list"]) < 10) {
    $nilai = intval($_POST["nilai"]); // Ambil nilai dari input dan pastikan integer
    
    // Pastikan nilai berada dalam rentang 0-100
    if ($nilai >= 0 && $nilai <= 100) {
        $_SESSION["nilai_list"][] = $nilai;
    }
}

// Fungsi untuk menentukan grade dan predikat
function getGradePredikat($nilai) {
    if ($nilai >= 85) return ["A", "Sangat Memuaskan"];
    if ($nilai >= 70) return ["B", "Memuaskan"];
    if ($nilai >= 55) return ["C", "Cukup"];
    if ($nilai >= 40) return ["D", "Kurang"];
    return ["E", "Sangat Kurang"];
}

// Reset daftar nilai jika tombol reset ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset"])) {
    $_SESSION["nilai_list"] = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Predikat Nilai</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }
    </style>
</head>
<body>

    <h2>Konversi Nilai</h2>

    <!-- Form untuk input nilai -->
    <?php if (count($_SESSION["nilai_list"]) < 10): ?>
        <form method="post">
            <label for="nilai">Masukkan Nilai (0-100):</label>
            <input type="number" name="nilai" min="0" max="100" required>
            <input type="submit" value="Tambahkan">
        </form>
    <?php else: ?>
        <p><strong>Anda telah memasukkan 10 nilai.</strong></p>
    <?php endif; ?>

    <!-- Tombol Reset -->
    <form method="post">
        <input type="submit" name="reset" value="Reset Nilai">
    </form>

    <!-- Menampilkan tabel hasil -->
    <?php if (!empty($_SESSION["nilai_list"])): ?>
        <h3>Hasil Konversi:</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Grade</th>
                <th>Predikat</th>
            </tr>
            <?php foreach ($_SESSION["nilai_list"] as $index => $nilai): 
                list($grade, $predikat) = getGradePredikat($nilai);
            ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $grade; ?></td>
                    <td><?= $predikat; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</body>
</html>
