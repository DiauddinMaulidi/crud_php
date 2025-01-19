<?php

require '../config.php';

if (isset($_POST['update'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $total = $_POST['total'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $catatan = htmlspecialchars($_POST['catatan']);
    $id = $_POST['id'];

    $query = mysqli_prepare($koneksi, "UPDATE transaksi SET judul = ?, total = ?, id_kategori = ?, tanggal = ?, catatan = ? WHERE id = ?");
    mysqli_stmt_bind_param($query, 'siissi', $judul, $total, $kategori, $tanggal, $catatan, $id);

    if (mysqli_stmt_execute($query)) {
        echo "<script>
                alert('Catatan berhasil diperbarui');
                window.location.href = '../informasi.php';
              </script>";
    } else {
        die("Error execute statement: " . mysqli_error($koneksi));
    }
    exit();
}
