<?php include 'db.php';
$tabel = $_GET['tabel'];
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM $tabel WHERE id_$tabel='$id'");
header("Location: $tabel.php");
?>