<?php
require_once 'nilai_mahasiswa.php';

// Fungsi membaca data dari JSON
function bacaData() {
    $file = 'data.json';
    if (!file_exists($file)) {
        return [];
    }
    $data = file_get_contents($file);
    return json_decode($data, true);
}

// Fungsi menyimpan data ke JSON
function simpanData($data) {
    file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));
}

// Fungsi menambahkan mahasiswa baru ke JSON
function tambahMahasiswa($nama, $matkul, $nilai_uts, $nilai_uas, $nilai_tugas) {
    $data = bacaData();

    // Tambah data baru
    $data[] = [
        "nama" => $nama,
        "matakuliah" => $matkul,
        "nilai_uts" => $nilai_uts,
        "nilai_uas" => $nilai_uas,
        "nilai_tugas" => $nilai_tugas
    ];

    simpanData($data);
}
?>
