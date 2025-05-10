<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Minimarket</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: radial-gradient(circle at 20% 30%, rgba(173, 216, 230, 0.4), transparent 40%),
                  radial-gradient(circle at 80% 70%, rgba(135, 206, 250, 0.3), transparent 40%),
                  linear-gradient(135deg, #e0f7ff, #ffffff);
      backdrop-filter: blur(20px);
      z-index: -1;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center">

  <div class="bg-white/70 backdrop-blur-xl shadow-xl rounded-lg p-8 w-96">
    <!-- Logo -->
    <img src="img/logo.png" alt="Logo Minimarket" class="mx-auto h-20 mb-4">
    
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = strtolower(trim($_POST['username']));
        $password = strtolower(trim($_POST['password']));

        if ($username === 'aldy' && $password === 'user') {
          echo "<script>alert('Selamat datang, Aldy!'); window.location.href='halaman/index.php';</script>";
        } elseif ($username === 'lili' && $password === 'admin') {
          echo "<script>alert('Selamat datang, Admin Lili!'); window.location.href='halaman2/header.php';</script>";
        } else {
          echo "<div class='text-red-500 text-center mb-4'>Username atau password salah!</div>";
        }
      }
    ?>

    <form method="POST">
      <label class="block text-sm font-semibold text-gray-700">Username</label>
      <input type="text" name="username" placeholder="Masukkan username" class="w-full border rounded px-3 py-2 mt-1 mb-4 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
      
      <label class="block text-sm font-semibold text-gray-700">Password</label>
      <input type="password" name="password" placeholder="Masukkan password" class="w-full border rounded px-3 py-2 mt-1 mb-6 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
      
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 rounded shadow">Login</button>
    </form>
    <p class="text-center text-sm text-gray-500 mt-4">Belum punya akun? <a href="#" class="text-blue-500 font-semibold">Daftar</a></p>
  </div>

</body>
</html>
