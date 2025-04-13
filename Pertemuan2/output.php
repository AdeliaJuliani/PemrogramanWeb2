<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Data yang dikirim</h1>
        <?php
        // Periksa metode pengiriman data (POST atau GET)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari POST
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';

            $datauser = array(
                "name" => $name,
                "email" => $email,
                "pesan" => $pesan
            );

            // Tampilkan data yang dikirim
            echo "<h2>Data yang dikirim melalui POST:</h2>";
            echo '<ul class="list-group">';

            foreach ($datauser as $key => $value) {
                if (!empty($value)) {
                    echo '<li class="list-group-item"><strong>' . ucfirst($key) . ':</strong> ' . htmlspecialchars($value) . '</li>';
                } else {
                    echo '<li class="list-group-item"><strong>' . ucfirst($key) . ':</strong> Data kosong</li>';
                }
            }
            echo '</ul>';
        } else {
            echo "<p class='alert alert-warning'>Tidak ada data yang dikirim.</p>";
        }
        ?>
    </div>
</body>
</html>
