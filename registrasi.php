<?php
include 'koneksi.php'; // koneksi ke database

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username sudah terdaftar
    $cek = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
    } else {
        // Simpan password apa
        $insert = mysqli_query($koneksi, "INSERT INTO pengguna (email, username, password) VALUES ('$email','$username', '$password')");

        if ($insert) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='loginn.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal. Coba lagi!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-sm" style="width: 22rem;">
    <div class="card-body">
        <h3 class="card-title text-center mb-4">Daftar Akun</h3>
        <form method="post">
            <div class="mb-3">
                <label class="small mb -1">Email</label>
                <input type="email" name="" class="form-control" placeholder="Masukkan email" required />
            </div>
            <div class="mb-3">
                <label class="small mb-1">Username</label>
                <input type="username" name="username" class="form-control" placeholder="Masukkan username" required />
            </div>
            <div class="mb-3">
                <label class="small mb-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required />
            </div>
            <p class="small">Sudah punya akun?<a href="loginn.php">Klik disini untuk login</a></p>
            <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>
</div>
</body>
</html>