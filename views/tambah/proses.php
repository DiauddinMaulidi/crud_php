<?php

session_start();

require '../config.php';

if (isset($_POST['simpan'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $kategori = (int) htmlspecialchars($_POST['kategori']);
    $total = (int) $_POST['total'];
    $tanggal = $_POST['tanggal'];
    $catatan = htmlspecialchars($_POST['catatan']);

    $query = mysqli_prepare($koneksi, "INSERT INTO transaksi (judul, total, id_kategori, tanggal, catatan) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, 'siiss', $judul, $total, $kategori, $tanggal, $catatan);

    if (mysqli_stmt_execute($query)) {
        echo "<script>
                alert('Berhasil menambahkan catatan');
                window.location.href = '../informasi.php';
              </script>";
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
    exit();
}
