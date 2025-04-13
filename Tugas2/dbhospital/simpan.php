<?php
include 'config.php';

$nama       = $_POST['nama'];
$tmp_lahir  = $_POST['tmp_lahir'];
$tgl_lahir  = $_POST['tgl_lahir'];
$gender     = $_POST['gender'];
$email      = $_POST['email'];
$alamat     = $_POST['alamat'];
$kelurahan  = $_POST['kelurahan_id'];

$conn->query("INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id)
              VALUES ('', '$nama', '$tmp_lahir', '$tgl_lahir', '$gender', '$email', '$alamat', $kelurahan)");

header("Location: index.php");
?>