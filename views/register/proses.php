<?php

session_start();

require '../config.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $nama = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confPass = htmlspecialchars($_POST['confPassword']);

    // Validasi password dan konfirmasi password
    if ($password !== $confPass) {
        echo "<script>
            alert('Password dan konfirmasi password tidak sama');
            window.location.href = './register.php';
          </script>";
        exit();
    }

    $pswrd_hash = password_hash($password, PASSWORD_DEFAULT);

    $query  = mysqli_prepare($koneksi, "INSERT INTO login (nama, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($query, 'sss', $nama, $email, $pswrd_hash);

    if (mysqli_stmt_execute($query)) {
        echo "<script>
            alert('berhasil register');
            window.location.href = '../login/login.php';
          </script>";
        exit();
    }
} else {
    echo "<script>alert('gagal registerasi');</script>";
    exit();
}
