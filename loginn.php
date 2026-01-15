<?php
session_start();
include 'koneksi.php';

//cek login apakah sudah terdaftar
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $sql = "SELECT * FROM pengguna WHERE username = '$username' AND password = '$password'";

    $cekdatabase = mysqli_query($koneksi, $sql);
    $hitung = mysqli_num_rows($cekdatabase);
    $data = mysqli_fetch_assoc($cekdatabase);

    if ($data) {
        ($password === $data['password']);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        header('Location: admin.php');
        exit();
        
    } else {
        echo "<script>alert('username atau password salah');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-sm" style="width: 22rem;">
    <div class="card-body">
        <h3 class="card-title text-center mb-4">Login</h3>

        <!-- Alert jika gagal login -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <p class="small">Belum punya akun? <a href="registrasi.php">Klik di sini untuk daftar</a></p>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (opsional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
