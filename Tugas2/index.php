<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Puskesmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #a8edea, #fed6e3);
            min-height: 100vh;
        }
        .sidebar {
            background-color: #0d6efd;
            height: 100vh;
            color: white;
            padding-top: 30px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 5px;
        }
        .sidebar a:hover {
            background-color: #084298;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h3 class="text-left">Database</h3>
            <a href="pasien.php">Tambah Pasien</a>
            <a href="kelurahan.php">Data Kelurahan</a>
            <a href="paramedik.php">Data Paramedik</a>
            <a href="pasien_data.php">Data Pasien</a>
            <a href="periksa.php">Data Periksa</a>
            <a href="unitkerja.php">Data Unit Kerja</a>
        </div>