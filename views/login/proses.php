<?php

session_start();

require '../config.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $query = "SELECT * FROM login WHERE email = '$email' ";
    $cekPengguna = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($cekPengguna) > 0) {
        $cekPass = mysqli_fetch_assoc($cekPengguna);
        $nama = $cekPass['nama'];

        if (password_verify($password, $cekPass['password'])) {

            // set session
            $_SESSION['login'] = true;
            $_SESSION['nama'] = htmlspecialchars($nama);

            echo "<script>
                    alert('anda berhasil login $nama');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('password anda salah');
                    window.location.href = './login.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('email anda salah');
                window.location.href = './login.php';
              </script>";
        exit();
    }
} else {
    echo "error";
}
